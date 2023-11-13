from places.models.user_saved_locations import UsersSavedPlaces
from users.handlers.user import UserHandler
from places.handlers.place_handler import PlaceHandler


class UserPlaceHandler(object):
    def __init__(self):
        self.user_handler = UserHandler()
        self.place_handler = PlaceHandler()

    def add_user_fav_places(self, data):
        user = self.user_handler.get_user(data["user_id"])
        place = self.place_handler.get_place(data["place_id"])
        data["user_id"] = user
        data["place_id"] = place
        user = UsersSavedPlaces(**data)
        user.save()

    def get_user_fav_places(self, user_id):
        user_places = UsersSavedPlaces.objects.filter(user_id=user_id).all()
        places_id = [user_place.place_id.place_id for user_place in user_places]
        user = self.user_handler.get_user(user_id)
        user = user.__dict__
        places = self.place_handler.get_places(places_id)
        user["places"] = places
        return user
