from users.models.user import User


class UserHandler(object):
    def __init__(self):
        pass

    @staticmethod
    def add_user(data):
        user = User(**data)
        user.save()

    @staticmethod
    def get_user(user_id):
        user = User.objects.filter(user_id=user_id).get()
        return user

    @staticmethod
    def get_users(filters):
        users = User.objects.filter(**filters)
        return [user for user in users]

