from datetime import datetime
from typing import Any
from urllib.parse import parse_qsl

from asgiref.sync import async_to_sync
from channels.generic.websocket import AsyncJsonWebsocketConsumer
from channels.layers import get_channel_layer
from django.core.cache import cache


class NotificationConsumer(AsyncJsonWebsocketConsumer):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_id = None
        self.group_name = "placeholder"

    async def websocket_connect(self, event):
        try:
            query_string = self.scope["query_string"].decode("utf-8")
            query_params = dict(parse_qsl(query_string))
            ticket_uuid = query_params.get("ticket")
            if not ticket_uuid:
                raise Exception("ticket not found")
            self.scope["has_ticket"] = await cache.aget(ticket_uuid)
            # if not await cache.adelete_many(ticket_uuid):
            #     raise Exception("invalid ticket")
            self.scope["user"] = self.scope["has_ticket"]
        except Exception as e:
            print("socket error ", e)
            await self.close()
            return
        # create a unique group for each user
        self.user_id = self.scope["user"]
        self.group_name = f"notification_{self.user_id}"
        await self.connect()

    async def connect(self):
        await self.channel_layer.group_add(self.group_name, self.channel_name)  # type: ignore
        await self.accept()

    async def disconnect(self, close_code):
        await self.channel_layer.group_discard(self.group_name, self.channel_name)  # type: ignore

    # Receive message from WebSocket
    async def receive_json(self, text_data):
        print(text_data)
        try:
            id = text_data.get("id", "")
            ref_id = text_data.get("ref_id", "")
            ref_model = text_data.get("ref_model", "")
            message = text_data["message"]
            sender = text_data.get("sender", "Anonymous")  # Default to 'Anonymous' if sender is not provided
            timestamp = text_data.get("timestamp", datetime.now().isoformat())
        except TypeError:
            await self.channel_layer.group_send(self.group_name, text_data)  # type: ignore
        else:
            # # Send message to room group
            await self.channel_layer.group_send(  # type: ignore
                self.group_name,
                {
                    "type": "notification_message",
                    "id": id,
                    "ref_id": ref_id,
                    "ref_model": ref_model,
                    "message": message,
                    "sender": sender,
                    "timestamp": timestamp,
                },
            )

    async def notification_message(self, event):
        print(event)
        id = event["id"]
        ref_id = event.get("ref_id", "")
        message = event["message"]
        sender = event.get("sender", "Anonymous")
        timestamp = event.get("timestamp", datetime.now().isoformat())
        # Send message to WebSocket
        await self.send_json(
            content={
                "id": id,
                "ref_id": ref_id,
                "ref_model": "Notification",
                "message": message,
                "sender": sender,
                "timestamp": timestamp,
            }
        )


def send_realtime_notification(
    user_id,
    message: str,
    id: str,
    timestamp: str | datetime,
    sender: str = "user_action",
    ref_id: Any = "",
    ref_model: str = "",
) -> None:
    """
    Sends a realtime notification to a specific user.

    Args:
        user_id (int): The ID of the user to send the notification to.
        message (str): The content of the notification message.
        timestamp (str | datetime): The timestamp of the notification. Can be either a string or a datetime object.
        sender (str, optional): The sender of the notification. Defaults to "user_action".

    Returns:
        None
    """
    if isinstance(timestamp, datetime):
        timestamp = timestamp.isoformat()
    channel_layer = get_channel_layer()
    async_to_sync(channel_layer.group_send)(
        f"notification_{user_id}",
        {
            "type": "notification_message",
            "id": id,
            "ref_id": ref_id,
            "ref_model": ref_model,
            "message": message,
            "sender": sender,
            "timestamp": timestamp,
        },
    )


# consumers.py


# class NotificationConsumer(AsyncWebsocketConsumer):
#     async def connect(self):
#         await self.accept()

#     async def disconnect(self, close_code):
#         pass

#     async def receive(self, text_data):
#         data = json.loads(text_data)
#         message = data['message']

#         # Your logic to fetch notifications from the database
#         notifications = Notification.objects.filter(user=self.scope['user'], read_status=False)

#         # Send real-time updates to the connected client
#         await self.send(text_data=json.dumps({
#             'message': message,
#             'notifications': [{'id': n.id, 'message': n.message, 'timestamp': n.timestamp} for n in notifications]
#         }))

#         # Publish the notifications to a Redis channel for other consumers
#         channel_layer = get_channel_layer()
#         await channel_layer.group_add(
#             f"user_{self.scope['user'].id}",
#             self.channel_name
#         )


# class NotificationConsumer(AsyncWebsocketConsumer):
#     async def connect(self):
#         await self.accept()
#         await self.send(text_data=json.dumps({"message": "Hello World", "type": "notification.message"}))

#     async def disconnect(self, close_code):
#         pass

#     async def receive(self, text_data):
#         text_data_json = json.loads(text_data)
#         message = text_data_json["message"]

#         await self.send(text_data=json.dumps({"message": message}))


# channel_layer = get_channel_layer()


# def send_notification(message):
#     async_to_sync(channel_layer.group_send)(
#         "notifications", {"type": "notification.message", "message": message}
#     )
