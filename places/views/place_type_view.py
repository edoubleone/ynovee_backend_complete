import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from places.handlers.geo_tag_handler import GeoTagHandler


class GeoTagsView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_type_handler = GeoTagHandler()

    def get(self, request):
        try:
            place_types = self.place_type_handler.get_all_place_types()
            return Response({"data": place_types}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to Fetch Place Types")

    def post(self, request):
        try:
            data = request.data
            self.place_type_handler.add_places_types_meta(data)
            return Response({"data": "Data Saves in Places Type Meta"}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to Fetch Place Types")


class UserPreferredGeoTagView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_type_handler = GeoTagHandler()

    def get(self, request, user_id):
        try:
            places = self.place_type_handler.get_place_types_for_user(user_id)
            return Response({"data": places}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Fetch Place for User {user_id}")

    def post(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.place_type_handler.add_place_types_for_user(data)
            return Response({"data": f"Place Saved with ID {user_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Save Place for {user_id}")


class UsersNearbyPlacesView(BaseAPIView):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_type_handler = GeoTagHandler()

    def get(self, request, user_id):
        params = request.query_params
        latitude = params.get("latitude")
        longitude = params.get("longitude")
        radius = params.get("radius")
        try:
            places = self.place_type_handler.get_nearby_places_for_user(latitude, longitude, radius, user_id)
            return Response({"data": places}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001,
                               f"Not able to Fetch Places nearby {latitude}, {longitude} in {radius} radius")
