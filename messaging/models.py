from django.db import models

from users.models import User


class Notification(models.Model):
    id = models.AutoField(primary_key=True)
    ref_id = models.CharField(max_length=50, blank=True, null=True)
    recipient = models.ForeignKey(User, on_delete=models.CASCADE)
    message = models.TextField(default="")
    timestamp = models.DateTimeField(auto_now_add=True)
    read_status = models.BooleanField(default=False)

    def __str__(self):
        return self.message
