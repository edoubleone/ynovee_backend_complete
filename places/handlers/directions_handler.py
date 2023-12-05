from places.handlers.gpa_handler import GooglePlaceHandler


class DirectionsHandler(object):
    def __init__(self):
        self.gpa_handler = GooglePlaceHandler()

    def get_directions(self, destination_place, origin_place, mode=100, **kwargs):
        get_meta = self.gpa_handler.get_directions(
            destination=destination_place, source=origin_place,
            mode=mode, **kwargs
        )
        return get_meta

