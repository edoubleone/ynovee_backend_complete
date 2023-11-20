import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from users.handlers.user import UserHandler


class ForgetPasswordCodeView(BaseAPIView):

    def __init__(self):
        self.user_handler = UserHandler()

    def post(self, request):
        try:
            data = request.data
            response = self.user_handler.send_forget_password_code(data["email"])
            return Response({"data": response}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Send Code")


class ForgetPasswordSubmitCodeView(BaseAPIView):

    def __init__(self):
        self.user_handler = UserHandler()

    def post(self, request):
        try:
            data = request.data
            response = self.user_handler.submit_forget_password_code(data)
            return Response({"data": response}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Submit Code")