import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from users.handlers.user import UserHandler


class UserView(BaseAPIView):

    def __init__(self):
        self.user_handler = UserHandler()

    def get(self, request, user_id):
        try:
            user = self.user_handler.get_user(user_id)
            return Response({"data": user.__dict__}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get User")

    def post(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.user_handler.add_user(data)
            return Response({"data": f"User Created with User ID {user_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User")

    def put(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.user_handler.update_user(data)
            return Response({"data": f"User Updated with User ID {user_id}"}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User")
