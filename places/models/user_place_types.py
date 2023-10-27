from django.db import models

from users.models.user import User
from places.models.place_types import GeoTagTypes


class UserPlaceTypes(models.Model):
    user_id = models.ForeignKey(User, on_delete=models.CASCADE)
    place_type_id = models.ForeignKey(GeoTagTypes, on_delete=models.CASCADE)

    class Meta:
        db_table = "user_place_types"