from rest_framework import serializers

from .models import SavedWeather, WeatherData


class WeatherDataSerializer(serializers.ModelSerializer):
    class Meta:
        model = WeatherData
        fields = "__all__"


class SavedWeatherSerializer(serializers.ModelSerializer):
    weather_data = WeatherDataSerializer()

    class Meta:
        model = SavedWeather
        fields = ["location_as_id", "name", "weather_data", "last_revalidated"]


class AddWeatherSerializer(serializers.ModelSerializer):
    class Meta:
        model = SavedWeather
        fields = ["name", "lon", "lat"]

    # def create(
    #     self,
    #     request,
    #     validated_data,
    # ):
    #     saved_weather = SavedWeather.objects.create(
    #         location_as_id=create_weather_id(validated_data), users=user, weather_data=None
    #     )
    #     return saved_weather
