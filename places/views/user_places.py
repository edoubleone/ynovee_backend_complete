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
            params = request.query_params
            is_place_private = params.get("is_place_private")
            mapper = {"true": True, "false": False}

            if is_place_private and is_place_private not in mapper:
                raise ApiException("Invalid value of is_place_private", 6001, "Not able to get User Places")
            elif is_place_private:
                is_place_private = mapper[is_place_private.lower()]

            user = self.user_place_handler.get_user_fav_places(user_id, is_place_private)
            return Response({"data": user}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get User Places")

    def post(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.user_place_handler.add_user_fav_places(data)
            return Response({"data": f"Favourite Places Added for User ID {user_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User Fav Places")

    def delete(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.user_place_handler.delete_user_fav_places(data)
            return Response({"data": f"Favourite Places Deleted for User ID {user_id}, {data}"}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Delete User Fav Places")
