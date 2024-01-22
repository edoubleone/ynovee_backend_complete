
from rest_framework_simplejwt.serializers import TokenRefreshSerializer
from rest_framework_simplejwt.tokens import RefreshToken
from django.contrib.auth import get_user_model, logout
from rest_framework import serializers
from users.models import User


class _UserSerializer(serializers.ModelSerializer):

    class Meta:
        model = User
        fields = '__all__'

    def create(self, validated_data):
        user = User.objects.create(**validated_data
                                         )
        user.set_password(validated_data['password'])
        user.save()
        return user
    
class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ["user_id","email","first_name","last_name","language","address","work_location","mobile","image_path","email_verified","otp_login_enabled","is_active","date_joined", ]
        
    def create(self, validated_data):
        user = User.objects.create_user(**validated_data
                                         )
        return user['user']
    



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