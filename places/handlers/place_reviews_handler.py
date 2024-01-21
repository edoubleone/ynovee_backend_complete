from places.models.place_reviews import PlaceReview

from places.handlers.place_handler import PlaceHandler
from users.handlers.user import UserManager as UserHandler

from commons.utils.logger import Logger


class PlaceReviewsHandler(object):
    def __init__(self):
        self.place_handler = PlaceHandler()
        self.user_handler = UserHandler()
        self._logger = Logger.get_instance(__name__)

    def add_place_review(self, data):
        data["user_id"] = self.user_handler.get_user(data["user_id"])
        data["place_id"] = self.place_handler.get_place(data["place_id"])

        place_review = PlaceReview(**data)
        place_review.save()
        self._logger.info(f"Saved Review for Place for {place_review.place_id} in DB")

    def get_reviews(self, **kwargs):
        self._logger.info(f"Fetching Place for {kwargs['place_id']} from DB")
        # import pdb;pdb.set_trace()
        reviews = PlaceReview.objects.filter(**kwargs).all()
        return [review.to_dict() for review in reviews]

    def delete_place_review(self, data):
        user = data["user_id"]
        place = data["place_id"]
        review_id = data["review_id"]
        PlaceReview.objects.filter(user_id=user, place_id=place,
                                   review_id=review_id).delete()
