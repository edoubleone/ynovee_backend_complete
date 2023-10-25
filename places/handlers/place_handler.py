from places.models.place import Place
from places.handlers.gpa_handler import GooglePlaceHandler


class PlaceHandler(object):
    def __init__(self):
        self.gpa_handler = GooglePlaceHandler()

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

    def get_nearby_places(self, nearby_area):
        places_obj = self.gpa_handler.get_places_from_text(nearby_area)
        for place in places_obj:
            import pdb; pdb.set_trace()
            self.add_place(place)
        return places_obj

    @staticmethod
    def get_all_places():
        return Place.objects.all().values()
