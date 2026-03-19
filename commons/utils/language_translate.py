from googletrans import Translator


def convert_text(value, input_format, output_format="en"):
    translator = Translator()
    input_detect = translator.detect(value)
    if input_detect.lang == output_format:
        return value
    formatted_source = translator.translate(value, dest=output_format, src=input_format).text
    return formatted_source
