import datetime
import os
import random

from users.models.user import User, UserVerification
from commons.utils.smtp import Smtp
from commons.utils.cache import Cache
from roadersmap.utils import get_jwt_token


FORGET_PASSWORD_CODE_SUBJECT = "Reset Password with OTP"
FORGET_PASSWORD_CODE_TPL = """
    <b>Dear {USER_NAME}</b>,<br>
    Greetings from Roaders Map. <br>

    You can use the below One Time Password (OTP) to rest password on Roadersmap.com<br>
    <p style="border:1px solid powderblue,padding:10px">{OTP_CODE}</p>
    """

VERIFY_ACCOUNT_SUBJECT = "Confirm Your Email Address"
NEW_ACCOUNT_EMAIL_TPL = """
<b>Dear {USER_NAME}</b>,<br>
Greetings from Roaders Map. <br>

Tap the button below to confirm your email address. <br>
<button><a style="border:1px solid powderblue,padding:10px", href="{VALIDATION_LINK}">Verify Account</a></button>
"""

SERVICE_HOST = os.environ.get("SERVICE_HOST", "http://127.0.0.1:8000/")


class UserHandler(object):

    def __init__(self):
        self.cache = Cache.get_instance()
        # self.smtp = Smtp.get_instance()

    def add_user(self, data):
        email = data["email"]
        users = self.get_users({"email": email})
        if users:
            raise Exception(f"User with Email {email} already exist in system..!!")

        data["created_time"] = datetime.datetime.now()
        user = User(**data)
        user.save()

        data["created_time"] = data["created_time"].strftime("%Y-%m-%d %H:%M:%S")

        email_verification_data = {
            "user_id": user.user_id,
            "validation_code": get_jwt_token(data)
        }

        user_verification_obj = UserVerification(**email_verification_data)
        user_verification_obj.save()

        end_point = "api/verify_account"
        link = f"{SERVICE_HOST}{end_point}/{user.user_id}?code={email_verification_data['validation_code']}"
        html_message = NEW_ACCOUNT_EMAIL_TPL.format(USER_NAME=user.full_name, VALIDATION_LINK=link)
        message = Smtp.generate_email_message(recipients=user.email,
                                              subject=VERIFY_ACCOUNT_SUBJECT,
                                              html_message=html_message)
        smtp = Smtp.get_instance()
        smtp.send_email(user.email, message)

    @staticmethod
    def delete_user(user_id):
        User.objects.filter(user_id=user_id).delete()

    @staticmethod
    def update_user(data):
        User.objects.filter(user_id=data["user_id"])\
            .update(password=data["password"])

    @staticmethod
    def update_user_data(user_id, data):
        User.objects.filter(user_id=user_id).update(**data)

    @staticmethod
    def update_user_pic(user_id, image_path):
        User.objects.filter(user_id=user_id) \
            .update(image_path=image_path)

    @staticmethod
    def get_user(user_id):
        # import pdb;pdb.set_trace()
        user = User.objects.filter(user_id=user_id).get()
        # user = User.objects.all()
        return user

    @staticmethod
    def get_users(filters={}):
        users = User.objects.filter(**filters)
        return [user for user in users]

    def send_forget_password_code(self, email):
        # user = self.get_user(user_id)
        smtp = Smtp.get_instance()

        users = self.get_users({"email": email})
        if not users:
            raise Exception(f"No User Found for Email {email}")
        user = users[0]

        code = self.generate_code()
        html_message = FORGET_PASSWORD_CODE_TPL.format(USER_NAME=user.full_name, OTP_CODE=code)
        message = Smtp.generate_email_message(recipients=user.email,
                                              subject=FORGET_PASSWORD_CODE_SUBJECT,
                                              html_message=html_message)
        smtp.send_email(user.email, message)
        self.cache.set_key_value(email, code)
        return {
            "message": f"Code Send to {email}, User ID {user.email}, Please check your email"
        }

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
            return {
                "user": user.__dict__,
                "status": "success",
                "message": "Code Matched Successfully"
            }
        raise Exception("Invalid Code")

    def get_user_verification_code(self, user_id):
        return UserVerification.objects.filter(user_id=user_id).get()
