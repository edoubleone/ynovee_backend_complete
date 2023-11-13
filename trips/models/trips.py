from django.db import models
from users.models.user import User


class Trips(models.Model):
    trip_id = models.CharField(primary_key=True, max_length=100)
    trip_date = models.DateField()
    source = models.CharField(max_length=100)
    destination = models.CharField(max_length=100)
    trip_start_time = models.DateTimeField(null=True)
    trip_end_time = models.DateTimeField(null=True)
    status = models.CharField(max_length=100)
    user_id = models.ForeignKey(User,
                                on_delete=models.CASCADE)

    class Meta:
        db_table = "trips"

    def to_dict(self):
        duration = self.trip_end_time - self.trip_start_time
        days, hours, minutes = duration.days, duration.seconds // 3600, duration.seconds % 3600 / 60.0
        trip_duration = ''
        if days:
            trip_duration = trip_duration + f"{days}Days "
        if hours:
            trip_duration = trip_duration + f"{hours}hr"
        if minutes:
            trip_duration = trip_duration + f"{minutes}min"

        return {
            "trip_id": self.trip_id,
            "trip_date": self.trip_date,
            "trip_start_time": self.trip_start_time,
            "source": self.source,
            "destination": self.destination,
            "duration": trip_duration,
        }