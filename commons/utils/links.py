from roadersmap import settings


def generate_user_invite_link(user_id: str) -> str:
    """
    Generates a link for inviting a user to roadersmap.
    """
    return f"{settings.FRONTEND_URL}/invite/?user={user_id}"


def generate_user_share_place_link(user_id: str, place_id) -> str:
    """
    Generates a link for sharing location with a user.
    """
    return f"{settings.FRONTEND_URL}/share/?user={user_id}&place={place_id}"