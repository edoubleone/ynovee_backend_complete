from users.models.user import User


class UserHandler(object):
    def __init__(self):
        pass

    @staticmethod
    def add_user(data):
        user = User(**data)
        user.save()

    @staticmethod
    def update_user(data):
        User.objects.filter(user_id=data["user_id"])\
            .update(password=data["password"])

    @staticmethod
    def get_user(user_id):
        user = User.objects.filter(user_id=user_id).get()
        return user

    @staticmethod
    def get_users(filters):
        users = User.objects.filter(**filters)
        return [user for user in users]

    def send_forget_password_code(self, user_id):
        user = self.get_user(user_id)
        # TODO Write Code to Send Code in Email. This code later used to validate the Password.
        return {
            "message": f"Code Send to {user.email}, Please check your email"
        }

    @staticmethod
    def submit_forget_password_code(data):
        user_id = data["user_id"]
        code = int(data["code"])
        # TODO - Write Code and Discuss Logic for the same.
        if code > 5000:
            return {
                "status": "success",
                "message": "Code Matched Successfully"
            }
        return {
            "status": "error",
            "message": "Invalid Code"
        }
