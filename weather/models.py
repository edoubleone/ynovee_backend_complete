from django.db import models

# Create your models here.
from users.models import User


class WeatherData(models.Model):
    location = models.JSONField()
    current = models.JSONField()
    forecast = models.JSONField()


class SavedWeather(models.Model):
    location_as_id = models.CharField(primary_key=True, max_length=255)
    name = models.CharField(max_length=255)
    users = models.ManyToManyField(User)
    weather_data = models.ForeignKey(WeatherData, on_delete=models.CASCADE, null=True, blank=True)
    timestamp = models.DateTimeField(auto_now_add=True)
