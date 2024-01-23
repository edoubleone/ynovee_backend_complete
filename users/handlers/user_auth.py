import random
import string
from typing import Literal
from commons.utils.cache import Cache
from commons.utils.smtp import Smtp
from roadersmap import settings
from roadersmap.utils import get_jwt_token, get_data_from_token, get_refresh_token, validate_token
from users.models import UserVerification, User
from rest_framework import exceptions


class UserAuthHandler(object):
    def __init__(self):
        self.user_handler = User.objects
        self.cache = Cache.get_instance()

    # def authenticate(self, email, password) -> bool:
    #     users = self.user_handler.get_users({"email": email})
    #     if len(users) > 1:
    #         raise Exception("Duplicates User Found")
    #     elif len(users) == 0:
    #         raise Exception("Invalid Email Id, No User Found")
    #     user = users[0]
    #     if user.password == password:
    #         data = user.__dict__
    #         login_response ={
    #             "access_token": get_jwt_token(data),
    #             "refresh_token": get_refresh_token(data),
    #             "token_type": "Bearer"
    #         }
    #         return login_response
    #     else:
    #         raise Exception("Wrong Password, Please use correct password")
    
    def verify_account(self, user_id, validate_code) -> Literal[True]:
        data = validate_token(validate_code)
        correct_code = self.user_handler.get_user_verification_code(data['user_id'])
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
        # if data["user_id"] != user.user_id:
        #     raise Exception("Code Invalid")
        if data["email"] != user.email:
            raise Exception("Code Invalid")
        
        
        
    # Two Factor Authentication
    def generate_otp(self, length=6):
        characters = string.digits
        otp = ''.join(random.choice(characters) for _ in range(length))
        return otp

    # def send_otp_email(email, otp):
    #     subject = 'Your OTP for Login'
    #     message = f'Your OTP is: {otp}'
    #     from_email = settings.EMAIL_HOST_USER
    #     recipient_list = [email]
    #     send_mail(subject, message, from_email, recipient_list)
    
    def send_otp_email(self, user) -> dict:
        code = self.generate_otp()
        html_message = settings.OTP_EMAIL_TPL.format(USER_NAME=user.full_name, OTP_CODE=code)
        message = Smtp.generate_email_message(
            recipients=user.email, subject=settings.OTP_EMAIL_SUBJECT, html_message=html_message
        )
        # html_message = settings.NEW_ACCOUNT_EMAIL_TPL.format(USER_NAME=user.full_name, VALIDATION_LINK=link)
        # message = Smtp.generate_email_message(
        #     recipients=user.email, subject=settings.VERIFY_ACCOUNT_SUBJECT, html_message=html_message
        # )
        smtp = Smtp.get_instance()
        smtp.send_email(user.email, message)
        return {
            "status": "sent",
            "user_id": user.user_id,
            "email": user.email,
        }


    def validate_otp(self, otp, email) -> bool:
        # user_id = data["user_id"]
        # user = self.user_handler.get_user_by_email(email)
        # if not user:
        #     raise Exception(f"No User Found for Email {email}")
        return True
        # TODO: Remove this return True, and implement cache
        expected_otp = self.cache.get_key_value(email)
        if otp == expected_otp:
            return True
        return False
        

static_auth_handler = UserAuthHandler()


