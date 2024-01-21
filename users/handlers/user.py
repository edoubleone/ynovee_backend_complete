import random
from typing import Any, Type
from rest_framework.exceptions import APIException
from django.contrib.auth.base_user import BaseUserManager

from commons.utils.cache import Cache
from commons.utils.smtp import Smtp
from roadersmap import settings
from roadersmap.local_types import UserType
from roadersmap.utils import get_jwt_token, create_token
from rest_framework import status
from django.contrib.auth.hashers import make_password

class UserManager(BaseUserManager):
    use_in_migration = True

    def __init__(self, verification_model):
        super().__init__()  #
        self.cache = Cache.get_instance()
        self.verification_model = verification_model
        
    def send_verification_mail(self, user_id) -> dict:
        user = self.get_user(user_id)
        email_verification_data = {"user_id": user.user_id, "validation_code": create_token(user)}
        user_verification_obj = self.verification_model(**email_verification_data)
        user_verification_obj.save()

        end_point = "api/verify_account"
        link = f"{settings.SERVICE_HOST}{end_point}/{user.user_id}?code={email_verification_data['validation_code']}"
        html_message = settings.NEW_ACCOUNT_EMAIL_TPL.format(USER_NAME=user.full_name, VALIDATION_LINK=link)
        message = Smtp.generate_email_message(
            recipients=user.email, subject=settings.VERIFY_ACCOUNT_SUBJECT, html_message=html_message
        )
        smtp = Smtp.get_instance()
        smtp.send_email(user.email, message)
        return {
            "status": "sent",
            "user_id": user.user_id,
            "email": user.email,
        }

    def on_registration(self, user_id):
        res = self.send_verification_mail(user_id)
        return {"message": f"Verification Code Send to {res['email']}, Please check your email"}
    
    def on_verification(self, user_id):
        pass

    def resend_verification(self, user_id):
        user = self.get_user(user_id)
        if user.email_verified is True:
            return "Email already verified, Skipping Validation"
        res = self.send_verification_mail(user_id)
        return {"message": f"Verification Code Send to {res['email']}, Please check your email"}

    def create_user(self, email, password=None, **extra_fields) -> dict[str, Any]:
        """
        Create a new user with the given email and password.
        
        Returns:
            dict[str, Any]: A dict containing the created user object and a dictionary of response from sending mail.

        Raises:
            ValueError: If the email is not provided.
        """
        if not email:
            raise ValueError('Email is Required')
        if self.email_exists(email):
            raise APIException(f"User with Email {email} already exist in system!", code=status.HTTP_400_BAD_REQUEST)
        hashed_password = make_password(password)
        user = self.model(email=self.normalize_email(email),password=hashed_password, **extra_fields)
        # user.set_password(password)
        user.save(using=self._db)
        userindb = self.get(email=email)
        res = self.on_registration(userindb.user_id)
        return {
            "user": userindb,
            "response": res
        }
    
    def email_exists(self, email: str) -> bool:
        users = self.get_users({"email": email})
        if users:
            return True
        return False
    
    def _create_superuser(self, email, password, **extra_fields) -> None:
        if not email:
            raise ValueError('Email is Required')
        user = self.model(email=self.normalize_email(email), **extra_fields)
        user.set_password(password)
        user.save(using=self._db)

    def add_user(self, data) -> UserType:
        email = data["email"]
        if self.email_exists(email):
            raise APIException(f"User with Email {email} already exist in system!", code=status.HTTP_400_BAD_REQUEST)
        user = self.model(**data)
        user.set_password(data["password"])
        user.save()
        userindb = self.get(email=email)
        res = self.on_registration(userindb.user_id)
        return userindb

    def delete_user(self, user_id):
        self.filter(user_id=user_id).delete()

    def update_user(self, data):
        self.filter(user_id=data["user_id"]).update(password=data["password"])
        # User.objects.filter(user_id=data["user_id"])\
        #     .update(password=data["password"])

    def update_user_data(self, user_id, data):
        self.filter(user_id=user_id).update(**data)

    def update_user_pic(self, user_id, image_path):
        self.filter(user_id=user_id).update(image_path=image_path)

    def get_user(self, user_id):
        # import pdb;pdb.set_trace()
        user = self.filter(user_id=user_id).get()
        # user = User.objects.all()
        return user
    
    def get_user_by_email(self, email):
        return self.filter(email=email).get()

    def get_users(self, filters={}):
        users = self.filter(**filters)
        return [user for user in users]

    def send_forget_password_code(self, email):
        # user = self.get_user(user_id)
        smtp = Smtp.get_instance()

        users = self.get_users({"email": email})
        if not users:
            raise Exception(f"No User Found for Email {email}")
        user = users[0]

        code = self.generate_code()
        html_message = settings.FORGET_PASSWORD_CODE_TPL.format(USER_NAME=user.full_name, OTP_CODE=code)
        message = Smtp.generate_email_message(
            recipients=user.email, subject=settings.FORGET_PASSWORD_CODE_SUBJECT, html_message=html_message
        )
        smtp.send_email(user.email, message)
        self.cache.set_key_value(email, code)
        return {"message": f"Code Send to {email}, User ID {user.email}, Please check your email"}

    @staticmethod
    def generate_code():
        number = random.randint(1000, 9999)
        return number

    def submit_forget_password_code(self, data):
        # user_id = data["user_id"]
        code = int(data["code"])
        email = data["email_id"]

        users = self.get_users({"email": email})
        if not users:
            raise Exception(f"No User Found for Email {email}")

        user = users[0]

        expected_code = self.cache.get_key_value(email)
        if code == expected_code:
            return {"user": user.__dict__, "status": "success", "message": "Code Matched Successfully"}
        raise Exception("Invalid Code")

    def get_user_verification_code(self, user_id) -> str:
        instance = self.verification_model.objects.filter(user_id=user_id).get()
        return instance.validation_code

    def create_superuser(self, email, password, **extra_fields):
        extra_fields.setdefault("is_staff", True)
        extra_fields.setdefault("is_superuser", True)
        extra_fields.setdefault("is_active", True)

        if extra_fields.get("is_staff") is not True:
            raise ValueError("Superuser must have is_staff = True")
        if extra_fields.get("is_superuser") is not True:
            raise ValueError("Superuser must have is_superuser = True")

        return self._create_superuser(email, password, **extra_fields)


# class UserHandler(object):

#     def __init__(self):
#         self.cache = Cache.get_instance()
#         # self.smtp = Smtp.get_instance()

#     def add_user(self, data):
#         email = data["email"]
#         users = self.get_users({"email": email})
#         if users:
#             raise Exception(f"User with Email {email} already exist in system..!!")

#         data["created_time"] = datetime.datetime.now()
#         user = User(**data)
#         user.save()

#         data["created_time"] = data["created_time"].strftime("%Y-%m-%d %H:%M:%S")

#         email_verification_data = {
#             "user_id": user.user_id,
#             "validation_code": get_jwt_token(data)
#         }

#         user_verification_obj = UserVerification(**email_verification_data)
#         user_verification_obj.save()

#         end_point = "api/verify_account"
#         link = f"{SERVICE_HOST}{end_point}/{user.user_id}?code={email_verification_data['validation_code']}"
#         html_message = NEW_ACCOUNT_EMAIL_TPL.format(USER_NAME=user.full_name, VALIDATION_LINK=link)
#         message = Smtp.generate_email_message(recipients=user.email,
#                                               subject=VERIFY_ACCOUNT_SUBJECT,
#                                               html_message=html_message)
#         smtp = Smtp.get_instance()
#         smtp.send_email(user.email, message)

#     @staticmethod
#     def delete_user(user_id):
#         User.objects.filter(user_id=user_id).delete()

#     @staticmethod
#     def update_user(data):
#         User.objects.filter(user_id=data["user_id"]) \
#             .update(password=data["password"])
#         # User.objects.filter(user_id=data["user_id"])\
#         #     .update(password=data["password"])

#     @staticmethod
#     def update_user_data(user_id, data):
#         User.objects.filter(user_id=user_id).update(**data)

#     @staticmethod
#     def update_user_pic(user_id, image_path):
#         User.objects.filter(user_id=user_id) \
#             .update(image_path=image_path)

#     @staticmethod
#     def get_user(user_id):
#         # import pdb;pdb.set_trace()
#         user = User.objects.filter(user_id=user_id).get()
#         # user = User.objects.all()
#         return user

#     @staticmethod
#     def get_users(filters={}):
#         users = User.objects.filter(**filters)
#         return [user for user in users]

#     def send_forget_password_code(self, email):
#         # user = self.get_user(user_id)
#         smtp = Smtp.get_instance()

#         users = self.get_users({"email": email})
#         if not users:
#             raise Exception(f"No User Found for Email {email}")
#         user = users[0]

#         code = self.generate_code()
#         html_message = FORGET_PASSWORD_CODE_TPL.format(USER_NAME=user.full_name, OTP_CODE=code)
#         message = Smtp.generate_email_message(recipients=user.email,
#                                               subject=FORGET_PASSWORD_CODE_SUBJECT,
#                                               html_message=html_message)
#         smtp.send_email(user.email, message)
#         self.cache.set_key_value(email, code)
#         return {
#             "message": f"Code Send to {email}, User ID {user.email}, Please check your email"
#         }

#     @staticmethod
#     def generate_code():
#         number = random.randint(1000, 9999)
#         return number

#     def submit_forget_password_code(self, data):
#         # user_id = data["user_id"]
#         code = int(data["code"])
#         email = data["email_id"]

#         users = self.get_users({"email": email})
#         if not users:
#             raise Exception(f"No User Found for Email {email}")

#         user = users[0]

#         expected_code = self.cache.get_key_value(email)
#         if code == expected_code:
#             return {
#                 "user": user.__dict__,
#                 "status": "success",
#                 "message": "Code Matched Successfully"
#             }
#         raise Exception("Invalid Code")

#     def get_user_verification_code(self, user_id):
#         return UserVerification.objects.filter(user_id=user_id).get()
