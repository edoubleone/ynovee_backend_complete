from typing import Any

from django.contrib.auth.models import update_last_login
from rest_framework import serializers
from rest_framework_simplejwt.serializers import TokenObtainPairSerializer

from roadersmap import settings
from users.handlers.user_auth import static_auth_handler
from users.models import User


class _UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = "__all__"

    def create(self, validated_data):
        user = User.objects.create(**validated_data)
        user.set_password(validated_data["password"])
        user.save()
        return user


class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = [
            "user_id",
            "email",
            "first_name",
            "last_name",
            "language",
            "address",
            "work_location",
            "mobile",
            "image_path",
            "email_verified",
            "is_active",
            "otp_login_enabled",
            "date_joined",
            "date_updated",
        ]


class RegisterSerializer(serializers.ModelSerializer):
    password = serializers.CharField(write_only=True)
    user_id = serializers.CharField(read_only=True)
    date_joined = serializers.DateTimeField(read_only=True)

    class Meta:
        model = User
        fields = [
            "user_id",
            "email",
            "password",
            "first_name",
            "last_name",
            "language",
            "address",
            "work_location",
            "mobile",
            "date_joined",
        ]

    def create(self, validated_data: dict):
        email = validated_data.pop("email", None)
        password = validated_data.pop("password", None)
        userres = User.objects.create_user(email, password, **validated_data)
        return userres["user"]


class CompleteOTPSerializer(TokenObtainPairSerializer):
    def __init__(self, *args, **kwargs) -> None:
        super().__init__(*args, **kwargs)

        self.fields["password"].required = False
        self.fields["email"] = serializers.CharField(write_only=True)
        self.fields["otp"] = serializers.CharField(write_only=True)

    def validate(self, attrs: dict[str, Any]) -> dict[str, str]:
        # data = super().validate(attrs)
        email = attrs["email"]
        otp = attrs["otp"]

        status = static_auth_handler.validate_otp(otp, email)
        if status:
            self.user = User.objects.get_user_by_email(email)

        refresh = self.get_token(self.user)
        data = {
            "message": "login accepted, tokens generated successfully",
            "refresh_token": str(refresh),
            "access_token": str(refresh.access_token), # type: ignore
        }

        if settings.SIMPLE_JWT["UPDATE_LAST_LOGIN"]:
            update_last_login(None, self.user) # type: ignore

        return data

    # def post(self, request: Request) -> Response:
    #     email = request.data.get("email", "")
    #     otp = request.data.get("otp", "")
    #     status = self.auth_handler.validate_otp(otp, email)
    #     if status:


# class LogoutSerializer(TokenRefreshSerializer):
#     def validate(self, attrs):
#         data = super().validate(attrs)
#         token = RefreshToken(data['refresh'])
#         token.blacklist()

#         # Decode the token to get user's id
#         token_payload = token.payload
#         user_id = token_payload.get('user_id')

#         # Get the user and log them out
#         User = get_user_model()
#         user = User.objects.get(id=user_id)
#         logout(user)

#         return data
