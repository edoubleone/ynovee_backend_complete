from datetime import datetime, timezone

from celery import shared_task

from weather.models import SavedWeather, WeatherData


@shared_task
def save_weather_data_to_db(saved_weathers: list[SavedWeather], weather_data: list[dict]) -> str:
    # TODO: Add a check to see if the weather data is already present in the DB
    if len(saved_weathers) != len(weather_data):
        return "error, length of saved_weathers and weather_data is not equal"
    for i in range(len(saved_weathers)):
        saved_weathers[i].weather_data = WeatherData.objects.create(**weather_data[i]).save()
        saved_weathers[i].last_revalidated = datetime.now(timezone.utc)
        saved_weathers[i].save()
    return "success"


@shared_task
def update_all_weather_data():
    pass