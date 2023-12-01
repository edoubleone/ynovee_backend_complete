import json
import traceback

from rest_framework import status
from rest_framework.response import Response
from django.core.files.storage import FileSystemStorage

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from weather.handlers import WeatherHandler


class WeatherView(BaseAPIView):

    def __init__(self):
        self.weather_handler = WeatherHandler()

    def get(self, request):
        try:
            params = dict(request.query_params.items())
            weather = self.weather_handler.get_weather_details(params)
            return Response({"data": weather}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get Weather Details")