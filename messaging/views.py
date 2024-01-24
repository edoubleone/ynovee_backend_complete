from django.http import StreamingHttpResponse
from rest_framework.renderers import JSONRenderer
from rest_framework.views import APIView

from messaging.redis import listen_to_channel
from messaging.sse import ServerSentEventRenderer

# class NotificationViewSet(viewsets.ModelViewSet):
#     queryset = Notification.objects.all()
#     serializer_class = NotificationSerializer


class Notify(APIView):
    # permission_classes = [IsAuthenticated]
    renderer_classes = [JSONRenderer, ServerSentEventRenderer]

    def get(self, request):
        generator = listen_to_channel()
        response = StreamingHttpResponse(streaming_content=generator, content_type="text/event-stream")
        response["X-Accel-Buffering"] = "no"  # Disable buffering in nginx
        response["Cache-Control"] = "no-cache"  # Ensure clients don't cache the data
        return response

