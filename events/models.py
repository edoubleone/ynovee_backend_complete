from django.db import models

# Create your models here.
from django.db import models


class Event(models.Model):
    event_id = models.CharField(primary_key=True, max_length=100)
    title = models.CharField(max_length=100)
    description = models.TextField(null=True)
    event_date = models.CharField(max_length=100)
    event_start_date = models.CharField(max_length=100)
    thumbnail = models.CharField(max_length=100)
    address = models.CharField(max_length=100)
    link = models.CharField(max_length=100, null=True)
    query = models.CharField(max_length=100)

    class Meta:
        db_table = "events"