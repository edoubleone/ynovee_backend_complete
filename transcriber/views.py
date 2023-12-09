import os

from django.http import HttpResponse
from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView

from transcriber.handler import TextSpeechHandler


class TranscriberView(BaseAPIView):

    def __init__(self):
        self.handler = TextSpeechHandler()

    def post(self, request):
        try:
            data = request.data
            res = self.handler.convert_text(data)
            # f = open(file, "rb")
            # response = HttpResponse()
            # response.write(f.read())
            # response['Content-Type'] = 'audio/mp3'
            # response['Content-Length'] = os.path.getsize(file)
            return res
        except Exception as exc:
            raise ApiException(str(exc), 6001, "Not able to convert text to speech")

