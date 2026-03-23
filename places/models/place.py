from django.db import models


class Place(models.Model):
    place_id = models.CharField(primary_key=True, max_length=100)
    name = models.CharField(max_length=100)
    description = models.TextField(max_length=100)
    image = models.CharField(max_length=100)
    contact = models.CharField(null=True, max_length=100)
    address = models.TextField(max_length=100)
    country = models.CharField(max_length=100)
    state = models.CharField(max_length=100)
    city = models.CharField(max_length=100)
    zip = models.CharField(max_length=100)
    rating = models.CharField(max_length=100)
    type = models.TextField(max_length=100)

    class Meta:
        db_table = "places"

    @property
    def __dict__(self):
        return {
            "id": self.place_id,
            "name": self.name,
            "description": self.description,
            "address": self.address,
            "contact": self.contact,
            "type": self.type,
            "rating": self.rating,
            "image": self.image
        }