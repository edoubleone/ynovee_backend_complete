from django.db import models


class GeoTagTypes(models.Model):
    place_type_id = models.CharField(primary_key=True)
    place_type_label = models.CharField()
    tags = models.TextField(default="")
    hide = models.BooleanField(default=False)

    class Meta:
        db_table = "place_types"

    @property
    def __dict__(self):
        return {
            "id": self.place_type_id,
            "name": self.place_type_label,
            "tags": self.tags
        }