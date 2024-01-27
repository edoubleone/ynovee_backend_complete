import random
import string
from typing import Literal

from rest_framework import exceptions

from commons.utils.cache import Cache
from commons.utils.smtp import Smtp
from roadersmap import settings
from roadersmap.utils import validate_token
from users.models import User
from django.core.cache import cache


class UserAuthHandler(object):
    def __init__(self):
        self.user_handler = User.objects
        self.cache = Cache.get_instance()


    def verify_account(self, user_id, validate_code) -> Literal[True]:
        data = validate_token(validate_code)
        correct_code = self.user_handler.get_user_verification_code(data["user_id"])
        if validate_code != correct_code:
            raise exceptions.APIException("Invalid Code", 400)
        user = self.user_handler.get_user(user_id)
        if not user:
            raise exceptions.APIException("User Not Found", 404)
        if user.email_verified:
            raise exceptions.APIException("Email Already Verified", 400)
        self.validate_data_with_code(data, user)
        self.user_handler.update_user_data(user_id, data={"email_verified": True})
        self.user_handler.on_verification(user_id)
        return True

    def validate_data_with_code(self, data, user):
        if data["email"] != user.email:
            raise Exception("Code Invalid")

    # Two Factor Authentication
    def generate_otp(self, length=6):
        characters = string.digits
        otp = "".join(random.choice(characters) for _ in range(length))
        return otp

    def send_otp_email(self, user) -> dict:
        code = self.generate_otp()
        cache.delete(user.email)
        cache.set(user.email, code, timeout=300)
        html_message = settings.OTP_EMAIL_TPL.format(USER_NAME=user.full_name, OTP_CODE=code)
        message = Smtp.generate_email_message(
            recipients=user.email, subject=settings.OTP_EMAIL_SUBJECT, html_message=html_message
        )
        smtp = Smtp.get_instance()
        smtp.send_email(user.email, message)
        return {
            "status": "sent",
            "user_id": user.user_id,
            "email": user.email,
        }

    def validate_otp(self, otp, email) -> bool:
        expected_otp = cache.get(email)
        if otp == expected_otp:
            return True
        return False


static_auth_handler = UserAuthHandler()
