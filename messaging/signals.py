from django.db.models.signals import post_save
from django.dispatch import receiver
from channels.layers import get_channel_layer
from asgiref.sync import async_to_sync

from users.models import User
from .models import Notification

@receiver(post_save, sender=Notification)
def notification_created(sender, instance: Notification, created, **kwargs):
    if created:
        channel_layer = get_channel_layer()
        print("sent to channel ", instance.message)
        async_to_sync(channel_layer.group_send)(
            'notification',
            {
                "type": "user_notification",
                "recipient_id": instance.recipient,
                "message": instance.message
            }
        )
        
@receiver(post_save, sender=User)
def user_created(sender, instance, created, **kwargs):
    if created:
        Notification.objects.create(
            user=instance,
            message="Welcome to roadersmap!"
        )
        
            
# when user is verified, send notification to user
@receiver(post_save, sender=User)
def user_verified(sender, instance: User, created, **kwargs):
    if instance.email_verified:
        Notification.objects.create(
            user=instance,
            message="Your email has been verified!"
        )
        

