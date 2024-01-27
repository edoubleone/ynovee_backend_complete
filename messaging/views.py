from uuid import uuid4

from django.core.cache import cache
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.views import APIView

from apis.views.base_views import BaseAPIView
from messaging.models import Notification
from messaging.serializers import NotificationSerializer
from roadersmap import settings
from roadersmap.permissions import IsOwnerOrAdmin


class NotificationList(BaseAPIView):
    serializer_class = NotificationSerializer
    permission_classes = [IsAuthenticated, IsOwnerOrAdmin]

    def get_queryset(self):
        # Return notifications for the logged-in user
        return Notification.objects.filter(recipient=self.request.user.user_id)  # type: ignore

    def get(self, request, *args, **kwargs):
        # get all notifications
        notifications = Notification.objects.filter(recipient=request.user)
        serializer = NotificationSerializer(notifications, many=True)
        return Response(
            {"message": f"notifications for user {request.user.user_id}", "data": serializer.data}
        )

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
