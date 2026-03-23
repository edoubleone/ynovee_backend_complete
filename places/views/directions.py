import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from places.handlers.directions_handler import DirectionsHandler


class DirectionsApiView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.direction_handler = DirectionsHandler()

    def get(self, request):
        params = dict(request.query_params.items())

        destination = params.pop("destination")
        origin = params.pop("origin")
        mode = params.pop("mode", "driving")
        language = params.pop("language", "en")
        try:
            matrix = self.direction_handler.get_directions(destination, origin, mode, language, **params)
            return Response({"data": matrix}, status=status.HTTP_200_OK)
        except Exception as exc:
            traceback.format_exc(exc)
            raise ApiException(str(exc), 6001, f"Not able to Fetch Directions for {destination}, {origin} in {mode} Mode")
