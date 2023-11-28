from roadersmap.utils import get_jwt_token, get_data_from_token
from users.handlers.user import UserHandler


class UserAuthHandler(object):
    def __init__(self):
        self.user_handler = UserHandler()

    def authenticate(self, data):
        email = data["email"]
        password = data["password"]
        users = self.user_handler.get_users({"email": email})
        if len(users) > 1:
            raise Exception("Duplicates User Found")
        elif len(users) == 0:
            raise Exception("Invalid Email Id, No User Found")
        user = users[0]
        if user.password == password:
            data = user.__dict__
            data["token"] = get_jwt_token(data)
            return data
        else:
            raise Exception("Wrong Password, Please use correct password")

    def verify_account(self, user_id, validate_code):
        users = self.user_handler.get_users({"user_id": user_id})

        if len(users) > 1:
            raise Exception("Duplicates User Found")
        elif len(users) == 0:
            raise Exception("Invalid Email Id, No User Found")
        user = users[0]

        if user.email_verified:
            return "Email already verified, Skipping Validation"

        data = get_data_from_token(validate_code)

        user_validation_code = self.user_handler.get_user_verification_code(user.user_id).__dict__
        if validate_code != user_validation_code["validation_code"]:
            raise Exception("Invalid Code, Not able to match it with the generate one..!!")

        self.validate_data_with_code(data, user)
        self.user_handler.update_user_data(user_id, data={"email_verified": True})
        return "Email Validation Successful"

    def validate_data_with_code(self, data, user):
        if data["first_name"] != user.first_name:
            raise Exception("Code Invalid, First Name Not Matching")
        if data["last_name"] != user.last_name:
            raise Exception("Code Invalid")
        if data["email"] != user.email:
            raise Exception("Code Invalid")
        if data["created_time"] != user.created_time.strftime("%Y-%m-%d %H:%M:%S"):
            raise Exception("Code Invalid")




