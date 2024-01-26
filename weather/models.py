from django.db import models

# Create your models here.
class SavedWeather(models.Model):
    location = models.CharField(max_length=255)
    temperature = models.FloatField()
    condition = models.CharField(max_length=255)
    timestamp = models.DateTimeField(auto_now_add=True)
