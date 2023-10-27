from places.models.place import Place

from places.handlers.gpa_handler import GooglePlaceHandler
from users.handlers.user import UserHandler


class PlaceHandler(object):
    def __init__(self):
        self.gpa_handler = GooglePlaceHandler()
        self.user_handler = UserHandler()

    @staticmethod
    def add_place(data):
        place = Place(**data)
        place.save()

    @staticmethod
    def get_place(place_id):
        place = Place.objects.filter(place_id=place_id).get()
        return place

    @staticmethod
    def get_places(places_id):
        places = Place.objects.filter(place_id__in=places_id).all()
        return [place.__dict__ for place in places]

    def get_places_from_text(self, nearby_area):
        places_obj = self.gpa_handler.get_places_from_text(nearby_area)
        for place in places_obj:
            # import pdb; pdb.set_trace()
            self.add_place(place)
        return places_obj

    def get_nearby_places(self, latitude, longitude, radius=100, keyword=None):
        "https://maps.googleapis.com/maps/api/place/nearbysearch/json"
        matching_places = self.gpa_handler.get_nearby_places(latitude, longitude, radius, keyword)
        places_obj = []
        keys = ["place_id", "name", "vicinity", "rating", "types", "business_status"]
        fpkeys = {
            "vicinity": "address", "types": "type"
        }

        for place in matching_places:
            place_meta = {fpkeys.get(key, key): place.get(key) for key in keys}
            image = ""
            photos = place.get("photos")
            if photos:
                image_ref = photos[0]["photo_reference"]
                image = self.gpa_handler.get_place_photo(photo_reference=image_ref)
            place_meta["image"] = image
            place_meta["type"] = ",".join(place_meta["type"])
            # self.add_place(place)
            places_obj.append(place_meta)
        return places_obj

    @staticmethod
    def get_all_places():
        return Place.objects.all().values()
