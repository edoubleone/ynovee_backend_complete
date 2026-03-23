from places.handlers.gpa_handler import GooglePlaceHandler
from commons.utils.language_translate import convert_text
from commons.utils import clean_html

LANGUAGE_EN = "en"


class DirectionsHandler(object):
    def __init__(self):
        self.gpa_handler = GooglePlaceHandler()

    def get_directions(self, destination_place, origin_place, mode=100, language=LANGUAGE_EN, **kwargs):
        if language.lower() != LANGUAGE_EN:
            destination_place = convert_text(destination_place, input_format=language, output_format=LANGUAGE_EN)
            origin_place = convert_text(origin_place, input_format=language, output_format=LANGUAGE_EN)

        get_meta = self.gpa_handler.get_directions(
            destination=destination_place, source=origin_place,
            mode=mode, **kwargs
        )

        if language.lower() != LANGUAGE_EN:
            self.convert_directions(get_meta, language)
        return get_meta

    @staticmethod
    def convert_directions(directions, language):
        for route in directions["routes"]:
            for leg in route["legs"]:
                for step in leg["steps"]:
                    updated_instruction = clean_html(step["html_instructions"])
                    translated_text = convert_text(updated_instruction,
                                                   input_format=LANGUAGE_EN,
                                                   output_format=language)
                    step['translated_text'] = translated_text
