import json
from asgiref.sync import async_to_sync
from channels.generic.websocket import AsyncJsonWebsocketConsumer

class NotificationConsumer(AsyncJsonWebsocketConsumer):
    async def connect(self):
        await self.accept()
        await self.channel_layer.group_add("real_time_notification", self.channel_name)
        print(f"Added {self.channel_name} to Real time notification")

    async def disconnect(self, close_code):
        await self.channel_layer.group_discard(
            "real_time_notification",
            self.channel_name
        )

    async def send_notification(self, event):
        content = event['notification']
        print(content)
        await self.send_json({ 'message': event['message'] })



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
