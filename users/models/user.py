from django.db import models


class User(models.Model):
    user_id = models.CharField(primary_key=True)
    first_name = models.CharField()
    last_name = models.CharField()
    email = models.CharField()
    mobile = models.CharField()
    image_path = models.CharField()
    password = models.CharField()
    sso_sign_in = models.CharField()
    address = models.TextField()
    work_location = models.TextField()
    email_verified = models.BooleanField(default=False)

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
            "contact": self.mobile
        }