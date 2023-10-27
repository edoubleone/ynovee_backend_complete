from places.models.place_types import GeoTagTypes
from places.models.user_place_types import UserPlaceTypes

from users.handlers.user import UserHandler
from places.handlers.place_handler import PlaceHandler


class GeoTagHandler(object):
    def __init__(self):
        self.user_handler = UserHandler()
        self.place_handler = PlaceHandler()

    @staticmethod
    def get_all_place_types():
        data = GeoTagTypes.objects.filter(hide=False).all()
        return [record.__dict__ for record in data]

    @staticmethod
    def add_places_types_meta(data):
        for record in data:
            place_type = GeoTagTypes(**record)
            place_type.save()

    def get_place_types_for_user(self, user_id):
        # user = self.user_handler.get_user(user_id)
        user_preferred_places = UserPlaceTypes.objects.filter(user_id=user_id).all()
        places_id = [user_place.place_type_id.place_type_id for user_place in user_preferred_places]
        response = {"user_id": user_id}
        places = self.get_places_types(places_id)
        response["places_types"] = places
        return response

    @staticmethod
    def get_places_types(place_type_ids):
        places = GeoTagTypes.objects.filter(place_type_id__in=place_type_ids).all()
        return [place.__dict__ for place in places]

    def get_place_type(self, place_type_id):
        return GeoTagTypes.objects.filter(place_type_id=place_type_id).get()

    def add_place_types_for_user(self, data):
        user_id = self.user_handler.get_user(data["user_id"])
        tags_id = data["place_type_ids"]
        user_place_type_mapping_list = []
        for tag in tags_id:
            tag = self.get_place_type(place_type_id=tag)
            user_place_type_mapping = UserPlaceTypes(user_id=user_id,
                                                     place_type_id=tag)
            user_place_type_mapping_list.append(user_place_type_mapping)
        UserPlaceTypes.objects.bulk_create(user_place_type_mapping_list)

    def get_nearby_places_for_user(self, latitude, longitude, radius=100, user_id=None):
        if user_id is None:
            return []
        user_prefered_options = self.get_place_types_for_user(user_id)
        place_list = []
        for option in user_prefered_options["places_types"]:
            for keyword in option["tags"].split(","):
                places = self.place_handler.get_nearby_places(latitude, longitude, radius, keyword=keyword)
                place_list.extend(places)
        return place_list

