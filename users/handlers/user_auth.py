from roadersmap.utils import get_jwt_token
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