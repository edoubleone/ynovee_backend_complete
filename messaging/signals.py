from django.db.models.signals import post_save
from django.dispatch import receiver

from messaging.consumers import send_realtime_notification
from messaging.tasks import send_verification_mail
from users.models import User

from .models import Notification


@receiver(post_save, sender=Notification)
def notification_created(sender, instance: Notification, created, **kwargs):
    user_id = instance.recipient.user_id
    send_realtime_notification(user_id, instance.message, id=instance.id, timestamp=instance.timestamp)


@receiver(post_save, sender=User)
def user_created(sender, instance: User, created, **kwargs):
    if created:
        send_verification_mail.delay(instance.pk)
        noti = Notification.objects.create(recipient=instance, message="Welcome to roadersmap!")
        noti.save()


@receiver(post_save, sender=User)
def user_verified(sender, instance: User, created, **kwargs):
    # send_verification_mail.delay(instance.user_id)
    if instance.email_verified:
        noti = Notification.objects.create(recipient=instance, message="Your email has been verified!")
        noti.save()
