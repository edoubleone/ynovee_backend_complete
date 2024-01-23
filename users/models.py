
import uuid

from django.contrib.auth.models import AbstractUser
from django.db import models

from users.handlers.user import UserManager


class UserVerification(models.Model):
    user_id = models.CharField(primary_key=True, max_length=100)
    validation_code = models.TextField(default="")

    class Meta:
        db_table = "users_validation_codes"

class User(AbstractUser):
    username = None
    user_id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    first_name = models.CharField(max_length=100, blank=True)
    last_name = models.CharField(max_length=100, blank=True)
    password = models.CharField(max_length=100, default="")
    language = models.CharField(max_length=100, default="en")
    mobile = models.CharField(max_length=100, null=True)
    work_location = models.CharField(max_length=100, default="")
    image_path = models.CharField(max_length=100, default="")
    # password = models.CharField(max_length=100, default="")
    sso_sign_in = models.CharField(max_length=100, default="")
    address = models.TextField(max_length=1000, default="")
    work_location = models.TextField(max_length=100, default="")
    email_verified = models.BooleanField(default=False)
    email = models.EmailField(max_length=100, unique=True)
    otp_login_enabled = models.BooleanField(default=False)
    date_joined = models.DateTimeField(auto_now_add=True)
    is_admin = models.BooleanField(default=False)
    is_active = models.BooleanField(default=True)
    is_staff = models.BooleanField(default=False)
    is_superuser = models.BooleanField(default=False)

    objects: UserManager = UserManager(UserVerification)

    USERNAME_FIELD = "email"
    REQUIRED_FIELDS = []

    class Meta:
        db_table = "users"

    def __str__(self):
        return self.email

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
            "mobile": self.mobile,
            "image_path": self.image_path,
            "address": self.address,
            "language": self.language,
            "email_verified": self.email_verified,
            "first_name": self.first_name,
            "last_name": self.last_name,
            "work_location": self.work_location,
        }

