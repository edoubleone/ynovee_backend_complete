import jwt
import datetime
from datetime import timezone

from roadersmap.constant import APP_SECRET


def get_jwt_token(data):
    data["exp"] = datetime.datetime.now(tz=timezone.utc) + datetime.timedelta(minutes=30)
    return jwt.encode(data, APP_SECRET, algorithm="HS256")


def get_data_from_token(token):
    return jwt.decode(token, APP_SECRET, algorithms=["HS256"])