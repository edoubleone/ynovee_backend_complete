import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView

from users.handlers.user_auth import UserAuthHandler


class AuthView(BaseAPIView):

    def __init__(self):
        self.user_auth_handler = UserAuthHandler()

    def post(self, request):
        try:
            data = request.data
            res = self.user_auth_handler.authenticate(data)
            return Response({"data": res}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to authenticate User Details")


class ValidateAccountView(BaseAPIView):

    def __init__(self):
        self.user_auth_handler = UserAuthHandler()

    def get(self, request, user_id):
        try:
            params = request.query_params
            code = params.get("code")
            res = self.user_auth_handler.verify_account(user_id, code)
            return Response({"data": res}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to authenticate User Details")