from typing import Literal
from roadersmap.utils import get_jwt_token, get_data_from_token, get_refresh_token, validate_token
from users.models import UserVerification, User
from rest_framework import exceptions


class UserAuthHandler(object):
    def __init__(self):
        self.user_handler = User.objects

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
       
    def refresh_login(self, token):
        data = get_data_from_token(token)
        return get_jwt_token(data)
    
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
     




