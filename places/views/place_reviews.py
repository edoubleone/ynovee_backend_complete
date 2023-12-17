import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from places.handlers.place_reviews_handler import PlaceReviewsHandler


class PlacesReviewsView(BaseAPIView):

    def __init__(self):
        self.place_review_handler = PlaceReviewsHandler()

    def get(self, request, place_id):
        try:
            params = request.query_params
            user_id = params.get("user_id")
            reviews = self.place_review_handler.get_reviews(place_id, user_id=user_id)
            return Response({"data": reviews}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to get Place {place_id} Reviews")

    def post(self, request, place_id):
        try:
            data = request.data
            data["place_id"] = place_id
            self.place_review_handler.add_place_review(data)
            return Response({"data": f"Place Review Added for Place ID {place_id}"},
                            status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save Place Review")

    def delete(self, request, place_id):
        try:
            data = request.data
            data["place_id"] = place_id
            self.place_review_handler.delete_place_review(data)
            return Response({"data": f"Place Review Deleted for Place ID {place_id}, {data}"}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Delete Place Review")
