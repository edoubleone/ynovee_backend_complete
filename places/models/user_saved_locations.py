from django.db import models

from users.models.user import User
from places.models.place import Place


class UsersSavedPlaces(models.Model):
    user_id = models.ForeignKey(User, on_delete=models.CASCADE)
    place_id = models.ForeignKey(Place, on_delete=models.CASCADE)
    is_private = models.BooleanField(default=False)

    class Meta:
        db_table = "users_saved_places"
