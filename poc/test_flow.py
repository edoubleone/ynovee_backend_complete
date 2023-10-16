import re
# as per recommendation from @freylis, compile once only
CLEANR = re.compile('<.*?>')

def cleanhtml(raw_html):
  cleantext = re.sub(CLEANR, '', raw_html)
  return cleantext


source = "Freedom Park Lagos, Old Prison Ground,1, Hospital Road, adjacent St' Nicholas Hospital, Lagos Island, Lagos, Nigeria"
destination = "Ikeja City Mall, Obafemi Awolowo Way, Alausa 101233, Ojodu, Lagos, Nigeria"
language = "yo"

english_language = "en"


from google_translate import translate

formatted_source = translate(source, input_format=language, output_format=english_language).text
formatted_dest = translate(destination, input_format=language, output_format=english_language).text

from maps_api import get_directions
directions = get_directions(formatted_source, formatted_dest)
print (directions)

from text_to_speech2 import get_speech_obj

for route in directions["routes"]:
  for leg in route["legs"]:
    for step in leg["steps"]:
      print (step["html_instructions"])
      updated_instrunction = cleanhtml(step["html_instructions"])
      translated_text = translate(updated_instrunction, input_format=english_language, output_format=language).text
      # step['speech_obj'] = get_speech_obj(translated_text)
      step['translated_text'] = translated_text

print (directions)
print (type(directions))
import json

with open("directions.json", "w") as outfile:
  json.dump(directions, outfile)

# for direction in directions:
#   legs = direction["legs"]
#   for leg in legs:
#     for step in leg["steps"]:
#       pass
#


