import traceback

from rest_framework import generics, permissions, status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView
from weather.handlers import WeatherHandler, create_weather_id
from weather.models import SavedWeather
from weather.serializers import AddWeatherSerializer, SavedWeatherSerializer

from .models import SavedWeather


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


class CRUDWeatherSaveView(generics.RetrieveUpdateDestroyAPIView):
    serializer_class = AddWeatherSerializer
    permission_classes = [permissions.IsAuthenticated]

    def post(self, request):
        validated_data = self.serializer_class(data=request.data).validate(request.data)
        location_as_id = create_weather_id(validated_data)
        existing = SavedWeather.objects.filter(location_as_id=location_as_id).first()
        if existing:
            existing.users.add(request.user)
            existing.save()
            return Response({"message": "success"})
        saved_weather = SavedWeather.objects.create(
            location_as_id=location_as_id, users=request.user, weather_data=None
        )
        return saved_weather

    def delete(self, request, location_as_id: str):
        existing = SavedWeather.objects.filter(location_as_id=location_as_id).first()
        if existing:
            existing.users.remove(request.user)
            existing.save()
            return Response({"message": "success"})
        return Response({"message": "not found"}, status=status.HTTP_404_NOT_FOUND)

    def get(self, request):
        existing = SavedWeather.objects.filter(users=request.user).get()
        if existing:
            return existing
        return Response({"message": "not found"}, status=status.HTTP_404_NOT_FOUND)


# class WeatherSaveView(generics.CreateAPIView):
#     queryset = SavedWeather.objects.all()
#     serializer_class = WeatherSerializer

# class WeatherRetrieveView(generics.RetrieveAPIView):
#     serializer_class = WeatherSerializer

#     def get_object(self):
#         location = self.kwargs['location']  # Adjust this based on your API design
#         weather = SavedWeather.objects.filter(location=location).order_by('-timestamp').first()

#         # Revalidate if last saved more than an hour ago
#         if weather and (timezone.now() - weather.timestamp).seconds > 3600:
#             # Perform the logic to fetch and save the latest weather data from the API
#             # Update the 'weather' object and save it to the database
#             # ...
#             pass
#         return weather

# views.py


# class SavedWeatherList(generics.ListCreateAPIView):
#     queryset = SavedWeather.objects.all()
#     serializer_class = SavedWeatherSerializer
#     permission_classes = [permissions.IsAuthenticated]

#     def perform_create(self, serializer):
#         # Ensure that users are associated with the existing location if it already exists
#         location_as_id = create_weather_id(serializer.validated_data["location"])
#         existing_instance = SavedWeather.objects.filter(location_as_id=location_as_id).first()
#         # if weather already exists, current user to users associated with weather
#         if existing_instance:
#             existing_instance.users.add(self.request.user)
#             existing_instance.save()
#             return existing_instance
#         else:
#             serializer.save(location_as_id=location_as_id)


class SavedWeatherDetail(generics.ListAPIView):
    handler = WeatherHandler()
    queryset = SavedWeather.objects.all()
    serializer_class = SavedWeatherSerializer
    permission_classes = [permissions.IsAuthenticated]
    params = {
        "q": "London",
        "days": 10,
        "mode":"forecast",
        "forecastday":"astro",
        "hour":12
    }
    
    def get(self, request):
        saved_weather = SavedWeather.objects.filter(users=request.user)
        weather_data = []
        for weather in saved_weather:
            self.params['q'] = weather.name
            weather_detail = self.handler.get_weather_details(self.params)
            weather_data.append(weather_detail)
        
        return Response(weather_data)
