from places.handlers.gpa_handler import GooglePlaceHandler


class DistanceMatrixHandler(object):
    def __init__(self):
        self.gpa_handler = GooglePlaceHandler()

    def get_distance_matrix(self, destination_place, origin_place, mode=100, **kwargs):
        get_meta = self.gpa_handler.get_distance_matrix_for_source_dest(
            destination_place=destination_place, origin_place=origin_place,
            mode=mode, **kwargs
        )
        return get_meta

