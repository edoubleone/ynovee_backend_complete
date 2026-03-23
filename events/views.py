from django.shortcuts import render

# Create your views here.
import datetime

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from events.handlers import EventHandler
from apis.views.base_views import BaseAPIView


class EventsView(BaseAPIView):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.events_handler = EventHandler()

    def get(self, request):
        try:
            params = request.query_params
            keyword = params.get("keyword")
            events = self.events_handler.get_nearby_events(keyword)
            return Response({"data": events}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(exc.__str__(), 6001, f"Not able to Fetch Events")