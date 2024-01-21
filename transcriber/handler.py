import os
import uuid

from django.http import HttpResponse

from gtts import gTTS
from commons.utils.logger import Logger


class TextSpeechHandler(object):

    def __init__(self):
        self._logger = Logger.get_instance(__name__)

    def convert_text(self, data):
        """
        """
        # move to temp file.
        random_id = uuid.uuid4()
        file_name = f"{random_id}.mp3"

        tts = gTTS(data["text"], lang="en", tld="co.uk")
        tts.save(file_name)

        with open(file_name, "rb") as f:
            response = HttpResponse()
            response.write(f.read())
            response['Content-Type'] = 'audio/mp3'

        os.remove(file_name)
        return response
