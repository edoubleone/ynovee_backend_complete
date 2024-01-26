from uuid import uuid4

from django.core.cache import cache
from django.http import StreamingHttpResponse
from django.shortcuts import render
from rest_framework import generics
from rest_framework.permissions import IsAuthenticated
from rest_framework.renderers import JSONRenderer
from rest_framework.response import Response
from rest_framework.views import APIView
from apis.views.base_views import BaseAPIView

from messaging.models import Notification
from messaging.redis import listen_to_channel
from messaging.serializers import NotificationSerializer
from messaging.sse import ServerSentEventRenderer
from roadersmap import settings
from roadersmap.permissions import IsOwnerOrAdmin


# class Notify(APIView):
#     # permission_classes = [IsAuthenticated]
#     renderer_classes = [JSONRenderer, ServerSentEventRenderer]

#     def get(self, request):
#         generator = listen_to_channel()
#         response = StreamingHttpResponse(streaming_content=generator, content_type="text/event-stream")
#         response["X-Accel-Buffering"] = "no"  # Disable buffering in nginx
#         response["Cache-Control"] = "no-cache"  # Ensure clients don't cache the data
#         return response


class NotificationList(generics.ListAPIView):
    serializer_class = NotificationSerializer
    permission_classes = [IsAuthenticated, IsOwnerOrAdmin]

    def get_queryset(self):
        # Return notifications for the logged-in user
        return Notification.objects.filter(recipient=self.request.user.user_id)  # type: ignore

    def patch(self, request, *args, **kwargs):
        # mark all as read
        Notification.objects.filter(recipient=request.user).update(read_status=True)
        return Response({"message": "all notifications marked as read."})
    
    def delete(self, request, *args, **kwargs):
        # delete all notifications
        Notification.objects.filter(recipient=request.user).delete()
        return Response({"message": "all notifications deleted."})


class NotificationDetail(BaseAPIView):
    serializer_class = NotificationSerializer
    permission_classes = [IsAuthenticated]
    
    def patch(self, request, *args, **kwargs):
        # mark as read
        Notification.objects.filter(id=kwargs["pk"]).update(read_status=True)
        return Response({"message": "notification marked as read."})
    
    def delete(self, request, *args, **kwargs):
        # delete notification
        Notification.objects.filter(id=kwargs["pk"]).delete()
        return Response({"message": "notification deleted."})



# get ticket for real time notification websocket
class TicketRegister(APIView):
    permission_classes = [IsAuthenticated]

    def get(self, request, *args, **kwargs):
        ticket_uuid = str(uuid4())

        cache.set(ticket_uuid, request.user.user_id, settings.TICKET_EXPIRE_TIME)

        return Response({"ticket": ticket_uuid})
