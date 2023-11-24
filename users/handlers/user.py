import random

from users.models.user import User
from commons.utils.smtp import Smtp
from commons.utils.cache import Cache


class UserHandler(object):
    def __init__(self):
        self.cache = Cache.get_instance()
        self.smtp = Smtp.get_instance()

    def add_user(self, data):
        email = data["email"]
        users = self.get_users({"email": email})
        if users:
            raise Exception(f"User with Email {email} already exist in system..!!")
        user = User(**data)
        # import pdb;pdb.set_trace()
        user.save()

    @staticmethod
    def update_user(data):
        User.objects.filter(user_id=data["user_id"])\
            .update(password=data["password"])

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
    def get_users(filters):
        users = User.objects.filter(**filters)
        return [user for user in users]

    def send_forget_password_code(self, email):
        # user = self.get_user(user_id)
        users = self.get_users({"email": email})
        if not users:
            raise Exception(f"No User Found for Email {email}")
        user = users[0]

        code = self.generate_code()
        message = f"OTP : {code}"
        self.smtp.send_email(user.email, message)
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