"""
Google Place API Handler
"""
import requests
from places.exceptions import GoogleApiException


API_KEY = "AIzaSyDzM3m0MOlip0uXRVyMHaVU6-SdAMBCNT4"


class GooglePlaceHandler(object):

    def __init__(self):
        self.GET_PLACES_FROM_TEXT = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json"
        self.PLACE_URL = "https://maps.googleapis.com/maps/api/place/details/json"
        self.GET_NEARBY_PLACES = "https://maps.googleapis.com/maps/api/place/nearbysearch/json"

    def get_places_from_text(self, text_search):
        places = []
        matching_places = self.get_nearby_places_from_text(text_search)
        for place in matching_places["candidates"]:
            place_meta = self.get_place_info(place["place_id"])
            place_details = place_meta["result"]
            keys = ["place_id", "name", "formatted_address", "formatted_phone_number", "rating", "types"]
            fpkeys = {
                "formatted_address": "address", "formatted_phone_number": "contact", "types": "type"
            }
            place_meta = {fpkeys.get(key, key): place_details.get(key) for key in keys}
            place_meta["type"] = ",".join(place_meta["type"])
            # [for key in place_meta if not pl]
            places.append(place_meta)
        return places

    def get_nearby_places_from_text(self, nearby_area):
        params = {
            "inputtype": "textquery",
            "input": nearby_area,
            "key": API_KEY
        }
        res = requests.get(self.GET_PLACES_FROM_TEXT, params=params)
        if res.status_code != 200:
            raise GoogleApiException(message=res.content,
                                     service_status_code=6001,
                                     internal_message=f"Failed to get place info {self.GET_PLACES_FROM_TEXT} for {nearby_area}")
        response = res.json()
        return response

    def get_place_info(self, place_id):
        params = {
            "place_id": place_id,
            "key": API_KEY
        }
        res = requests.get(self.PLACE_URL, params=params)
        if res.status_code != 200:
            raise GoogleApiException(message=res.content,
                                     service_status_code=6001,
                                     internal_message=f"Failed to get place info {self.PLACE_URL} for {place_id}")
        response = res.json()
        return response

    def get_nearby_places(self, latitude, longitude, radius=100, keyword=None):
        """

        :param latitude:
        :param longitude:
        :param radius: distance (in meters)
        :return:
        """
        params = {
            "location": f"{latitude},{longitude}",
            "radius": radius,
            "key": API_KEY
        }
        if keyword:
            params["keyword"] = keyword
        print (self.GET_NEARBY_PLACES, params)
        res = requests.get(self.GET_NEARBY_PLACES, params=params)
        if res.status_code != 200:
            raise GoogleApiException(message=res.content,
                                     service_status_code=6001,
                                     internal_message=f"Failed to get nearby place info {self.GET_NEARBY_PLACES} for {latitude}, {longitude}")
        response = res.json()
        return response["results"]

    @staticmethod
    def get_place_photo(photo_reference, max_width=400):
        base_end_point = "https://maps.googleapis.com/maps/api/place/photo"
        params = {
            "maxwidth": max_width,
            "photo_reference": photo_reference,
            "key": API_KEY
        }
        params = "&".join(f'{k}={v}' for k, v in params.items())
        return f"{base_end_point}?{params}"