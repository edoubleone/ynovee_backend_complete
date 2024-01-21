import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView

from places.handlers.place_handler import PlaceHandler


class PlaceLatitudeLongitudeView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_handler = PlaceHandler()

    def get(self, request):
        params = request.query_params
        try:
            data = self.place_handler.get_place_details_from_geocode_api(params)
            return Response({"data": data}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to get details for Params {params}")
