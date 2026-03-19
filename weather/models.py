from typing import Any
from django.db import models
from roadersmap import settings

# Create your models here.
from users.models import User
from datetime import datetime, timedelta, timezone



class WeatherDataManager(models.Manager):
    pass
        

class WeatherData(models.Model):
    location = models.JSONField()
    current = models.JSONField()
    forecast = models.JSONField()
    
    objects = WeatherDataManager()

class SavedWeatherManager(models.Manager):
    def weather_exists(self, location_as_id: str) -> bool:
        return self.filter(location_as_id=location_as_id).exists()
    
    def weather_data_exists_and_isvalid(self, location_as_id: str) -> Any:
        existing = self.get(location_as_id=location_as_id)
        if existing.weather_data is not None and existing.weather_data.last_revalidated is not None:
            last_revalidated = existing.weather_data.last_revalidated
            current_time = datetime.now(timezone.utc)
            time_difference = current_time - last_revalidated
            if time_difference > timedelta(minutes=settings.WEATHER_DATA_VALIDITY_MINUTES):
                return False
            else:
                return existing.weather_data
        return False
    
    def has_valid_weather_data(self, saved_weather: Any) -> Any:
        print(saved_weather)
        if saved_weather.weather_data is not None and saved_weather.weather_data.last_revalidated is not None:
            last_revalidated = saved_weather.weather_data.last_revalidated
            current_time = datetime.now(timezone.utc)
            time_difference = current_time - last_revalidated
            print(f"arithemtic is {time_difference} > {timedelta(minutes=settings.WEATHER_DATA_VALIDITY_MINUTES)}")
            if time_difference > timedelta(minutes=settings.WEATHER_DATA_VALIDITY_MINUTES):
                return False
            else:
                return saved_weather.weather_data
        return False
            
        
        
    
    def weather_exists_and_add_user(self, location_as_id: str, user: User) -> bool:
        if self.weather_exists(location_as_id):
            existing = self.get(location_as_id=location_as_id)
            existing.users.add(user)
            existing.save()
            return True
        return False
    
    


class SavedWeather(models.Model):
    location_as_id = models.CharField(primary_key=True, max_length=255)
    name = models.CharField(max_length=255)
    users = models.ManyToManyField(User)
    weather_data = models.ForeignKey(WeatherData, on_delete=models.CASCADE, null=True, blank=True)
    last_revalidated = models.DateTimeField(null=True, blank=True)

    objects:SavedWeatherManager = SavedWeatherManager()
    
    def __str__(self):
        return self.name
    
    