from rest_framework import serializers

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
            "date_joined",
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
