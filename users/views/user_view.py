import traceback

from django.core.files.storage import FileSystemStorage
from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView
from users.models import User
from users.serializers import UserSerializer


class UserView(BaseAPIView):
    def __init__(self):
        self.user_handler = User.objects

    def get(self, request, user_id):
        try:
            user = self.user_handler.get_user(user_id)
            serialized = UserSerializer(user)
            return Response({"data": serialized.data}, status=status.HTTP_200_OK)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get User")

    def post(self, request):
        try:
            # import pdb;pdb.set_trace()
            data = request.data
            # data = json.loads(payload_data["payload"])
            # if "image" in payload_data:
            #     image_obj = payload_data["image"]
            #     file_name = image_obj.name
            #     file_format = file_name.split(".")[-1]
            #     output_file = f"{user_id}.{file_format}"
            #     output_file = FileSystemStorage(location="images").save(output_file, data["image"])
            #     data["image_path"] = f"images/{output_file}"
            #     # del data["image"]
            res = self.user_handler.create_user(**data)
            return Response({"data": f"User Created with User ID {str(res['user'].user_id)}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User")

    def put(self, request, user_id):
        try:
            data = request.data
            # data["user_id"] = user_id
            self.user_handler.update_user_data(user_id, data)
            return Response({"data": f"User Updated with User ID {user_id}"}, status=status.HTTP_200_OK)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User")

    def delete(self, request, user_id):
        try:
            self.user_handler.delete_user(user_id)
            return Response({"data": f"User deleted with User ID {user_id}"}, status=status.HTTP_200_OK)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Delete User")


class UsersView(BaseAPIView):
    def __init__(self):
        self.user_handler = User.objects

    def get(self, request):
        try:
            users = self.user_handler.get_users()
            users = [UserSerializer(user).data for user in users]
            return Response({"data": users}, status=status.HTTP_200_OK)
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to get Users")


class UserUploadPicView(BaseAPIView):
    def __init__(self):
        self.user_handler = User.objects

    def post(self, request, user_id):
        try:
            request_data = dict(request.data)
            # import pdb;pdb.set_trace()
            image_obj = request_data["image"][0]
            file_name = image_obj.name
            file_format = file_name.split(".")[-1]
            output_file = f"{user_id}.{file_format}"
            output_file = FileSystemStorage(location="images").save(output_file, image_obj)
            self.user_handler.update_user_pic(user_id, f"images/{output_file}")
            return Response(
                {"data": f"User Picture Uploaded for User ID {user_id} at {output_file}"},
                status=status.HTTP_201_CREATED,
            )
        except Exception as exc:
            print(traceback.format_exc())
            raise ApiException(str(exc), 6001, "Not able to Save User")
