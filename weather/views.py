import traceback

from rest_framework import generics, permissions, status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView
from roadersmap.permissions import IsOwnerOrAdmin
from weather.handlers import WeatherHandler, create_weather_id
from weather.models import SavedWeather
from weather.serializers import AddWeatherSerializer, SavedWeatherSerializer, WeatherDataSerializer
from weather.tasks import save_weather_data_to_db

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
    permission_classes = [permissions.IsAuthenticated, IsOwnerOrAdmin]

    def post(self, request):
        validated_data = self.serializer_class(data=request.data).validate(request.data)
        location_as_id = create_weather_id(validated_data)
        existing = SavedWeather.objects.filter(location_as_id=location_as_id).first()
        if existing:
            existing.users.add(request.user)
            existing.save()
            return Response({"message": "success", "data": SavedWeatherSerializer(existing).data})
        saved_weather = SavedWeather.objects.create(
            location_as_id=location_as_id, weather_data=None, name=validated_data["name"]
        )
        # print(saved_weather)
        saved_weather.users.add(request.user)
        saved_weather.save()
        return Response({"message": "success", "data": SavedWeatherSerializer(saved_weather).data})

    def delete(self, request, location_as_id = None):
        if not location_as_id:
            validated_data = self.serializer_class(data=request.data).validate(request.data)
            location_as_id = create_weather_id(validated_data)
        existing = (
            SavedWeather.objects.filter(users=request.user).filter(location_as_id=location_as_id).first()
        )
        if existing:
            existing.users.remove(request.user)
            existing.save()
            return Response({"message": "weather removed from user's list"})
        return Response(
            {"message": "not found", "detail": "user does not have this loaction saved for weather list"},
            status=status.HTTP_404_NOT_FOUND,
        )

    def get(self, request, location_as_id = None):
        if location_as_id is None:
            saved_weather = SavedWeather.objects.filter(users=request.user)
            return Response(
                {"message": "success", "data": SavedWeatherSerializer(saved_weather, many=True).data}
            )
        existing = (
            SavedWeather.objects.filter(users=request.user).filter(location_as_id=location_as_id).first()
        )
        if existing:
            return Response({"message": "success", "data": SavedWeatherSerializer(existing).data})
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
    saved_handler = SavedWeather.objects
    # queryset = SavedWeather.objects.all()
    serializer_class = WeatherDataSerializer
    permission_classes = [permissions.IsAuthenticated]
    params = {"q": "London", "days": 10, "mode": "forecast", "forecastday": "astro", "hour": 12}

    def get(self, request):
        saved_weather = SavedWeather.objects.filter(users=request.user)
        weather_data = []
        for weather in saved_weather:
            data = SavedWeather.objects.has_valid_weather_data(weather)
            if data:
                print("found in db")
                weather_data.append(WeatherDataSerializer(data.weather_data))
                continue
            self.params["q"] = weather.name
            weather_detail = self.handler.get_weather_details(self.params)
            weather_data.append(weather_detail)
        save_weather_data_to_db.delay(
            list(SavedWeatherSerializer(saved_weather, many=True).data), weather_data
        )
        return Response(weather_data)
