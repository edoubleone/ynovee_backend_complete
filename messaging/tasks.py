from commons.utils.smtp import Smtp
from roadersmap import settings
from roadersmap.utils import create_token
from users.handlers.user import UserManager
from django.core.mail import send_mail
from celery import shared_task

from users.models import UserVerification

staticmanager = UserManager(UserVerification)
sender = Smtp()
@shared_task
def send_verification_mail(user_id, handler = staticmanager) -> dict:
    user = handler.get_user(user_id)
    email_verification_data = {"user_id": user.user_id, "validation_code": create_token(user)}
    user_verification_obj = handler.verification_model(**email_verification_data)
    user_verification_obj.save()

    end_point = "api/verify_account"
    link = f"{settings.SERVICE_HOST}{end_point}/{user.user_id}?code={email_verification_data['validation_code']}"
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




