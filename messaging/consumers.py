import datetime
import json
from asgiref.sync import async_to_sync
from channels.generic.websocket import AsyncJsonWebsocketConsumer

class NotificationConsumer(AsyncJsonWebsocketConsumer):
    async def connect(self):
        # self.user_id = self.scope['url_route']['kwargs']['user_id']
        self.group_name = f'notification'

        # Join room group
        await self.channel_layer.group_add(
            self.group_name,
            self.channel_name
        )
        # await self.receive()
        await self.accept()

    async def disconnect(self, close_code):
        await self.channel_layer.group_discard(
            self.group_name,
            self.channel_name
        )
        
     # Receive message from WebSocket
    async def receive(self, text_data):
        # message = text_data['message']
        # sender = text_data.get('sender', 'Anonymous')  # Default to 'Anonymous' if sender is not provided
        # timestamp = datetime.datetime.now().isoformat()

        await self.send(text_data=text_data)

        # # Send message to room group
        # await self.channel_layer.group_send(
        #     self.group_name,
        #     {
        #         'type': 'notification_message',
        #         'message': message,
        #         'sender': sender,
        #         'timestamp': timestamp,
        #     }
        # )

    async def notification_message(self, event):
        # try:
        #     message = event['message']
        #     sender = event.get('sender', 'Anonymous')  # Default to 'Anonymous' if sender is not provided
        #     timestamp = event.get('timestamp', datetime.datetime.now().isoformat())
        # except TypeError:
        #     await self.send(text_data=event)
        #     pass
        await self.send(text_data=event)

        # # Send message to WebSocket
        # await self.send(text_data={
        #     'message': message,
        #     'sender': sender,
        #     'timestamp': timestamp,
        # })


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
