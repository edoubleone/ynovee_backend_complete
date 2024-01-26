from datetime import datetime
from typing import Any

from asgiref.sync import async_to_sync
from celery import shared_task
from channels.layers import get_channel_layer

from commons.utils.smtp import Smtp
from roadersmap import settings
from roadersmap.utils import create_token
from users.models import User

sender = Smtp()


@shared_task
def send_verification_mail(user_id, handler=User.objects) -> dict:
    user = handler.get_user(user_id)
    email_verification_data = {"user_id": user.user_id, "validation_code": create_token(user)}
    user_verification_obj = handler.verification_model(**email_verification_data)
    user_verification_obj.save()

    end_point = "api/verify_account"
    link = f"{settings.SERVICE_HOST}/{end_point}/{user.user_id}?code={email_verification_data['validation_code']}"
    html_message = settings.NEW_ACCOUNT_EMAIL_TPL.format(USER_NAME=user.full_name, VALIDATION_LINK=link)
    message = Smtp.generate_email_message(
        recipients=user.email, subject=settings.VERIFY_ACCOUNT_SUBJECT, html_message=html_message
    )
    sender.send_email(user.email, message)
    print("celery has sent mail ")
    return {
        "status": "sent",
        "user_id": user.user_id,
        "email": user.email,
    }


@shared_task
def celery_send_realtime_notification(
    user_id,
    id: Any,
    message: str,
    timestamp: str | datetime,
    sender: str = "user_action",
    ref_id: Any = "",
    ref_model: Any = "",
) -> None:
    """
    Sends a realtime notification to a specific user via a celery worker.

    Args:
        user_id (int): The ID of the user to send the notification to.
        message (str): The content of the notification message.
        timestamp (str | datetime): The timestamp of the notification. Can be either a string or a datetime object.
        sender (str, optional): The sender of the notification. Defaults to "user_action".

    Returns:
        None

    Examples:
        >>> from datetime import datetime
        >>> celery_send_realtime_notification.delay(1, "Hello World!", datetime.now(), "user_action")

    """
    if isinstance(timestamp, datetime):
        timestamp = timestamp.isoformat()
    channel_layer = get_channel_layer()
    async_to_sync(channel_layer.group_send)(  # type: ignore
        f"notification_{user_id}",
        {
            "type": "notification_message",
            "id": id,
            "ref_id": ref_id,
            "ref_model":ref_model,
            "message": message,
            "sender": sender,
            "timestamp": timestamp,
        },
    )


# @shared_task
# def send_notification_mail(target_mail, message):
#     mail_subject = "Welcome on Board!"
#     send_mail(
#         subject = mail_subject,
#         message=message,
#         from_email=settings.EMAIL_HOST_USER,
#         recipient_list=[target_mail],
#         fail_silently=False,
#         )
#     return "Done"
