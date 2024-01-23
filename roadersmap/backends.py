from django.contrib.auth import get_user_model
from django.contrib.auth.backends import ModelBackend
from django.contrib.auth.hashers import check_password

from roadersmap.exceptions import OTPRequiredException
from users.handlers.user_auth import static_auth_handler
from users.models import User


class CustomBackend(ModelBackend):
    def authenticate(self, request, **kwargs):
        # raise Exception("This is a test")
        if not kwargs.get("email") or not kwargs.get("password"):
            return None
        email = kwargs["email"]
        password = kwargs["password"]
        UserModel = User
        try:
            user =  UserModel.objects.get(email=email)
        except UserModel.DoesNotExist:
            UserModel().set_password(password)
            return None
        else:
            if user.check_password(password) and self.user_can_authenticate(user):
                if user.otp_login_enabled:
                    static_auth_handler.send_otp_email(user)
                    raise OTPRequiredException
                return user
            return None
            # password_match = check_password(password, user.password)
            # if password_match:
            #     return user
            # return
