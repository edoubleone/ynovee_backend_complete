from datetime import timezone
import traceback

from rest_framework import generics, status
from rest_framework.response import Response
from weather.models import SavedWeather
from weather.serializer import WeatherSerializer

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
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get Weather Details")


class CRUDWeatherView(generics.RetrieveUpdateDestroyAPIView):
    pass

class WeatherSaveView(generics.CreateAPIView):
    queryset = SavedWeather.objects.all()
    serializer_class = WeatherSerializer

class WeatherRetrieveView(generics.RetrieveAPIView):
    serializer_class = WeatherSerializer

    def get_object(self):
        location = self.kwargs['location']  # Adjust this based on your API design
        weather = SavedWeather.objects.filter(location=location).order_by('-timestamp').first()
        
        # Revalidate if last saved more than an hour ago
        if weather and (timezone.now() - weather.timestamp).seconds > 3600:
            # Perform the logic to fetch and save the latest weather data from the API
            # Update the 'weather' object and save it to the database
            # ...
            pass
        return weather
