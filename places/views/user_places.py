import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from users.handlers.user_places import UserPlaceHandler


class UserPlacesView(BaseAPIView):

    def __init__(self):
        self.user_place_handler = UserPlaceHandler()

    def get(self, request, user_id):
        try:
            user = self.user_place_handler.get_user_fav_places(user_id)
            return Response({"data": user}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get User")

    def post(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.user_place_handler.add_user_fav_places(data)
            return Response({"data": f"Favourite Places Added for User ID {user_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User Fav Places")
