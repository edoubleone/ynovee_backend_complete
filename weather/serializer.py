# serializers.py
from rest_framework import serializers
from weather.models import SavedWeather

class WeatherSerializer(serializers.ModelSerializer):
    class Meta:
        model = SavedWeather
        fields = '__all__'
