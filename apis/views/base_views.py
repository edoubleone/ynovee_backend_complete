from rest_framework import status
from rest_framework.response import Response
from rest_framework.views import APIView

from apis.exceptions import ApiException


class BaseAPIView(APIView):
    def handle_exception(self, exc):
        try:
            response = super(BaseAPIView, self).handle_exception(exc)
        except ApiException as exc:
            message = exc.args[0]
            service_status_code = exc.args[1]
            response = {
                "error": {"message": message},
                "statusCode": service_status_code
            }
            return Response(response, status=status.HTTP_500_INTERNAL_SERVER_ERROR)
        return response
