import os
from typing import Any

import requests

from roadersmap.exceptions import RequestApiException


class WeatherApiHandler:
    BASE_URL = "https://api.weatherapi.com/v1/"
    CURRENT = "current.json"
    FORECAST = "forecast.json"
    API_KEY = os.environ["WEATHER_API_KEY"]

    def __init__(self):
        pass

    def get_api_results(self, url, params):
        res = requests.get(url, params=params)
        if res.status_code != 200:
            raise RequestApiException(
                message=res.content,
                service_status_code=6001,
                internal_message=f"Failed to get Weather info {url} for {params}",
            )
        return res.json()

    def get_current_results(self, params):
        params["key"] = self.API_KEY
        url = f"{self.BASE_URL}{self.CURRENT}"
        return self.get_api_results(url, params)

    def get_forecast_results(self, params):
        params["key"] = self.API_KEY
        params["alerts"] = "no"
        params["aqi"] = "no"
        if not params.get("days"):
            params["days"] = 5
        url = f"{self.BASE_URL}{self.FORECAST}"
        return self.get_api_results(url, params)


class WeatherHandler(object):
    def __init__(self):
        self.weather_api = WeatherApiHandler()
        self.mapper = {
            "current": self.weather_api.get_current_results,
            "forecast": self.weather_api.get_forecast_results,
        }

    def get_weather_details(self, params):
        mode = params.pop("mode", "current")
        method = self.mapper[mode.lower()]
        return method(params)


def create_weather_id(location: dict[str, Any]) -> str:
    location_name: str = location.get("name", None)
    lat: int = location.get("lat", None)
    lon: int = location.get("lon", None)
    if all([location_name, lat, lon]):
        location_id = [location_name , "la" + str(lat) , "lo" + str(lon)]
        location_id = "-".join(location_id)
        return location_id
    return "incomplete_entry"