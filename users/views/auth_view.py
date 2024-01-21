import traceback

from rest_framework import status
from rest_framework.permissions import IsAuthenticated
from rest_framework.views import APIView
from rest_framework.permissions import AllowAny
from rest_framework_simplejwt.tokens import RefreshToken, AccessToken
from rest_framework_simplejwt.exceptions import TokenError
from rest_framework_simplejwt.views import TokenObtainPairView, TokenRefreshView
from django.contrib.auth import authenticate
from rest_framework.response import Response
from rest_framework import exceptions


from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView
from users.handlers.user_auth import UserAuthHandler
from users.models import User
from users.serializers import UserSerializer


# view for registering users
class RegisterView(BaseAPIView):
    def post(self, request):
        serializer = UserSerializer(data=request.data)
        serializer.is_valid(raise_exception=True)
        serializer.save()
        return Response(serializer.data)

class LoginView(TokenObtainPairView):
    def post(self, request, *args, **kwargs):
        response = super().post(request, *args, **kwargs)
        if not response.data:
            return response
        if response.status_code == status.HTTP_200_OK:
            refresh = response.data['refresh']
            access = response.data['access']
            response.data = {
                'message': 'login accepted, tokens generated successfully',
                'token_type':'Bearer',
                'refresh_token': refresh,
                'access_toke': access,
            }
        return response
    
class LoginRefreshView(TokenRefreshView):
    def post(self, request, *args, **kwargs):
        response = super().post(request, *args, **kwargs)
        if not response.data:
            return response
        if response.status_code == status.HTTP_200_OK:
            refresh = response.data['access']
            response.data = {
                'message': 'new access token generated successfully',
                'access_token': refresh,
            }
        return response


class LogoutView(BaseAPIView):
    permission_classes = (IsAuthenticated,)

    def post(self, request):
        try:
            refresh_token = request.data["refresh_token"]
            token = RefreshToken(refresh_token)
            token.blacklist()

            return Response(
                {"message": "successfully logged out", "refresh": "invalidated"},
                status=status.HTTP_205_RESET_CONTENT,
            )
        except TokenError:
            raise exceptions.AuthenticationFailed("Invalid Token")



class ValidateAccountView(BaseAPIView):
    def __init__(self):
        self.user_auth_handler = UserAuthHandler()

    def get(self, request, user_id):
        params = request.query_params
        code = params.get("code")
        feedback = self.user_auth_handler.verify_account(user_id, code)
        if feedback:
            return Response({"message": "Email Verified Successfully"}, status=status.HTTP_200_OK)
     
    
class ResendEmailVerificationView(BaseAPIView):
    def __init__(self):
        self.user_handler = User.objects

    def get(self, request, user_id):
        try:
            res = self.user_handler.resend_verification(user_id)
            return Response({"data": res}, status=status.HTTP_200_OK)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to authenticate User Details")



# class AuthView(BaseAPIView):
#     def __init__(self):
#         self.user_auth_handler = UserAuthHandler()

#     def post(self, request):
#         try:
#             data = request.data
#             res = self.user_auth_handler.authenticate(data)
#             return Response({"data": res}, status=status.HTTP_200_OK)
#         except Exception as exc:
#             print(traceback.format_exc())
#             raise ApiException(str(exc), 6001, "Not able to authenticate User Details")