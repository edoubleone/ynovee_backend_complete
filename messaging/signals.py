from channels.layers import get_channel_layer
from django.db.models.signals import post_save
from django.dispatch import receiver

from users.models import User

from .models import Notification


@receiver(post_save, sender=Notification)
async def notification_created(sender, instance: Notification, created, **kwargs):
    print("notification was created")
    if created:
        channel_layer = get_channel_layer()
        print("sent to channel ", instance.message)
        await channel_layer.group_send(
            
            {"type": "notification_message", "notification": instance.message})


@receiver(post_save, sender=User)
def user_created(sender, instance: User, created, **kwargs):
    # send_verification_mail.delay(instance.user_id)
    print("user was created")
    noti = Notification.objects.create(recipient=instance, message="Welcome to roadersmap!")
    noti.save()


# when user is verified, send notification to user
@receiver(post_save, sender=User)
def user_verified(sender, instance: User, created, **kwargs):
    # send_verification_mail.delay(instance.user_id)
    if instance.email_verified:
        noti = Notification.objects.create(recipient=instance, message="Your email has been verified!")
        noti.save()
