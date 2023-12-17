from datetime import datetime
from django.db import models

from users.models.user import User
from places.models.place import Place


class PlaceReview(models.Model):
    user_id = models.ForeignKey(User, on_delete=models.CASCADE)
    place_id = models.ForeignKey(Place, on_delete=models.CASCADE)
    review = models.CharField(max_length=10000)
    rating = models.CharField(max_length=10)
    review_date = models.DateTimeField(default=datetime.now)
    review_id = models.CharField(max_length=200, primary_key=True, auto_created=True)

    class Meta:
        db_table = "place_reviews"

    def save(self, force_insert=False, force_update=False, using=None, update_fields=None):
        self.review_id = f"{self.user_id.user_id}-{self.place_id.place_id}-{self.review_date.strftime('%Y-%m-%d')}"
        super().save(force_insert=force_insert,
                     force_update=force_update,
                     using=using,
                     update_fields=update_fields)

    def to_dict(self):
        return {
            "id": self.review_id,
            # "place_id": self.place_id.__dict__,
            "user_id": self.user_id.user_id,
            "review": self.review,
            "rating": self.rating,
            "date": self.review_date.strftime("%Y-%m-%d")
        }