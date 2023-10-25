from django.db import models


class Place(models.Model):
    place_id = models.CharField(primary_key=True)
    name = models.CharField()
    description = models.TextField()
    image = models.CharField()
    contact = models.CharField(null=True)
    address = models.TextField()
    country = models.CharField()
    state = models.CharField()
    city = models.CharField()
    zip = models.CharField()
    rating = models.CharField()
    type = models.TextField()

    class Meta:
        db_table = "places"

    @property
    def __dict__(self):
        return {
            "id": self.place_id,
            "name": self.name,
            "description": self.description,
            "address": self.address,
            "contact": self.contact
        }