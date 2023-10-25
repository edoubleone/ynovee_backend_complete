import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from places.handlers.place_handler import PlaceHandler


class NearbyPlacesView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_handler = PlaceHandler()

    def get(self, request):
        params = request.query_params
        nearby_place = params.get("q")
        try:
            places = self.place_handler.get_nearby_places(nearby_place)
            # places = self.place_handler.get_all_places()
            return Response({"data": places}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to Fetch Places nearby {nearby_place}")


class PlaceView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_handler = PlaceHandler()

    def get(self, request, place_id):
        try:
            places = self.place_handler.get_place(place_id)
            return Response({"data": places.__dict__}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Fetch Place for {place_id}")

    def post(self, request, place_id):
        try:
            data = request.data
            data["place_id"] = place_id
            self.place_handler.add_place(data)
            return Response({"data": f"Place Saved with ID {place_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Save Place for {place_id}")


class PlacesView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.place_handler = PlaceHandler()

    def get(self, request):
        try:
            places = self.place_handler.get_all_places()
            return Response({"data": places}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Fetch Place")

    # def post(self, request, place_id):
    #     try:
    #         data = request.data
    #         data["place_id"] = place_id
    #         self.place_handler.add_place(data)
    #         return Response({"data": f"Place Saved with ID {place_id}"}, status=status.HTTP_201_CREATED)
    #     except Exception as exc:
    #         print (traceback.format_exc())
    #         raise ApiException(str(exc), 6001, f"Not able to Save Place for {place_id}")