from django.http import StreamingHttpResponse
from django.shortcuts import render
from rest_framework import generics, status
from rest_framework.permissions import IsAuthenticated
from rest_framework.renderers import JSONRenderer
from rest_framework.response import Response
from rest_framework.views import APIView

from messaging.models import Notification
from messaging.redis import listen_to_channel
from messaging.serializers import NotificationSerializer
from messaging.sse import ServerSentEventRenderer
from roadersmap.permissions import IsOwnerOrAdmin
from django.http import Http404


class Notify(APIView):
    # permission_classes = [IsAuthenticated]
    renderer_classes = [JSONRenderer, ServerSentEventRenderer]

    def get(self, request):
        generator = listen_to_channel()
        response = StreamingHttpResponse(streaming_content=generator, content_type="text/event-stream")
        response["X-Accel-Buffering"] = "no"  # Disable buffering in nginx
        response["Cache-Control"] = "no-cache"  # Ensure clients don't cache the data
        return response


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


class NotificationDetail(generics.DestroyAPIView):
    serializer_class = NotificationSerializer
    permission_classes = [IsAuthenticated]
    
    


def test(request):
    return render(request, "notifications.html")
