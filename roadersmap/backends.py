from django.contrib.auth import get_user_model
from django.contrib.auth.backends import ModelBackend

from users.handlers.user import UserManager
from users.models import User
from django.contrib.auth.hashers import check_password



class CustomBackend(ModelBackend):
    def authenticate(self, request,**kwargs):
        if not kwargs.get('email') or not kwargs.get('password'):
            return None
        email = kwargs['email']
        password = kwargs['password']
        UserModel = get_user_model()
        user_handler = UserModel.objects
        try:
            user:User = user_handler.get_user_by_email(email=email)
        except UserModel.DoesNotExist:
            UserModel().set_password(password)
            return None
        else:
            if user.check_password(password) and self.user_can_authenticate(user):
                return user
            return None
            # password_match = check_password(password, user.password)
            # if password_match:
            #     return user
