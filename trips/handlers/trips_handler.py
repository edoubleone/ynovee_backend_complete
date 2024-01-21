from trips.models.trips import Trips
from users.handlers.user import UserManager as UserHandler
from commons.utils.logger import Logger


class TripsHandler(object):
    def __init__(self):
        self.user_handler = UserHandler()
        self._logger = Logger.get_instance(__name__)

    def add_trip(self, data):
        user_obj = self.user_handler.get_user(data["user_id"])
        data["user_id"] = user_obj
        trip = Trips(**data)
        trip.save()

    @staticmethod
    def get_trip(trip_id):
        trip = Trips.objects.filter(trip_id=trip_id).get()
        return trip

    @staticmethod
    def get_all_trips():
        return Trips.objects.all().values()

    def get_user_trips(self, user_id, trip_date_filter):
        model_filter = Trips.objects.filter(user_id=user_id)
        if trip_date_filter:
            model_filter = model_filter.filter(trip_date__gte=trip_date_filter)
        data = model_filter.values()
        return self.format_data_for_trips(data)

    def format_data_for_trips(self, data):
        self._logger.info("Formatting Data of Trip")
        response = {}
        for record in data:
            month = record["trip_date"].strftime("%b")
            year = record["trip_date"].year
            key = f"{month}, {year}"
            response[key] = response.get(key, []) + [record]
        return response
