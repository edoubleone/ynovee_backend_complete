from datetime import datetime
from django.db import models


class User(models.Model):
    user_id = models.CharField(primary_key=True, max_length=100)
    first_name = models.CharField( max_length=100)
    last_name = models.CharField( max_length=100)
    email = models.CharField( max_length=100)
    mobile = models.CharField( max_length=100)
    image_path = models.CharField( max_length=100)
    password = models.CharField( max_length=100)
    sso_sign_in = models.CharField( max_length=100)
    address = models.TextField(max_length=1000)
    work_location = models.TextField(max_length=100)
    email_verified = models.BooleanField(default=False)
    language = models.CharField(max_length=200, default="english")
    created_time = models.DateTimeField(default=datetime.now, blank=True)

    class Meta:
        db_table = "users"

    @property
    def full_name(self):
        return f"{self.first_name} {self.last_name}"

    def save(self, *args, **kwargs):
        if not self.user_id:
            self.user_id = self.email
        super().save(*args, **kwargs)

    @property
    def __dict__(self):
        return {
            "user_id": self.user_id,
            "name": self.full_name,
            "email": self.email,
            "contact": self.mobile,
            "image_path": self.image_path,
            "address": self.address,
            "language": self.language,
            "email_verified": self.email_verified
        }


class UserVerification(models.Model):
    user_id = models.CharField(primary_key=True, max_length=100)
    validation_code = models.TextField(default="")

    class Meta:
        db_table = "users_validation_codes"