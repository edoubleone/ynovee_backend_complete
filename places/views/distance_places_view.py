import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from places.handlers.distance_matrix_handler import DistanceMatrixHandler


class DistanceApiView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.distance_matrix_handler = DistanceMatrixHandler()

    def get(self, request):
        params = dict(request.query_params.items())

        destination = params.pop("destination")
        origin = params.pop("origin")
        mode = params.pop("mode", "driving")
        try:
            matrix = self.distance_matrix_handler.get_distance_matrix(destination, origin, mode, **params)
            return Response({"data": matrix}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to Fetch Distance for {destination}, {origin} in {mode} Mode")
