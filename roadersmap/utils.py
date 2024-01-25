from typing import Any
import jwt
from uuid import UUID
from roadersmap import settings
from roadersmap.constant import APP_SECRET

from datetime import datetime, timezone, timedelta

from roadersmap.local_types import UserType  # Import the datetime and timezone modules


        
        
def create_token(user: Any) -> str:
    return jwt.encode(
        {
            "user_id": str(user.user_id),
            "email": user.email,
            "exp": int((datetime.now(timezone.utc) + timedelta(minutes=30)).timestamp()) 
        },
        APP_SECRET,
        algorithm="HS256"
    )

def validate_token(token: str) -> dict[str, Any]:
    """
    Validates the expiry of a token.

    Args:
        token (str): The token to be validated.

    Returns:
        dict: The decoded token data.

    Raises:
        Exception: If the token has expired.
    """
    data = jwt.decode(token, APP_SECRET, algorithms=["HS256"])
    if datetime.now(timezone.utc) > datetime.fromtimestamp(data["exp"], tz=timezone.utc):  # Compare the current datetime with the expiry datetime
        raise Exception("Token Expired")
    return data

def get_jwt_token(data):
    user_data = {
        "user_id": str(data.user_id),  # Serialize id
        "token_type": "access",
        "email": data.email,
        "exp": (datetime.now(tz=timezone.utc) + timedelta(minutes=30)).isoformat()
    }
    return jwt.encode(user_data, APP_SECRET, algorithm="HS256")

def get_refresh_token(data):
    user_data = {
        "user_id": str(data.user_id),  # Serialize the id
        "token_type": "refresh",
        "email": data.email,
        "exp": (datetime.now(tz=timezone.utc) + timedelta(minutes=30)).isoformat()
    
    }
    return jwt.encode(user_data, APP_SECRET, algorithm="HS256")


def get_data_from_token(token):
    return jwt.decode(token, APP_SECRET, algorithms=["HS256"])