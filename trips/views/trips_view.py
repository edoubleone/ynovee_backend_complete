import datetime
import traceback

from rest_framework import status
from rest_framework.response import Response

from apis.exceptions import ApiException
from apis.views.base_views import BaseAPIView


from trips.handlers.trips_handler import TripsHandler


class TripsView(BaseAPIView):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.trips_handler = TripsHandler()

    def get(self, request):
        try:
            trips = self.trips_handler.get_all_trips()
            return Response({"data": trips}, status=status.HTTP_200_OK)
        except Exception as exc:
            raise ApiException(str(exc), 6001, f"Not able to Fetch trips")


class UserTripView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.trips_handler = TripsHandler()

    def get(self, request, user_id):
        params = request.query_params
        trip_date_filter = last_x_days = int(params.get("last_x_days"))
        if last_x_days:
            trip_date_filter = datetime.datetime.now() - datetime.timedelta(days=last_x_days)
        try:
            user_trips = self.trips_handler.get_user_trips(user_id, trip_date_filter)
            return Response({"data": user_trips}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Fetch Trips for {user_id}")

    def post(self, request, user_id):
        try:
            data = request.data
            data["user_id"] = user_id
            self.trips_handler.add_trip(data)
            return Response({"data": f"Trips Saved for User ID {user_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Save Trip for User {user_id}")


class TripView(BaseAPIView):

    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.trips_handler = TripsHandler()

    def get(self, request, trip_id):
        try:
            trip = self.trips_handler.get_trip(trip_id)
            return Response({"data": trip.to_dict()}, status=status.HTTP_200_OK)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Fetch Trip for {trip_id}")

    def post(self, request, trip_id):
        try:
            data = request.data
            data["trip_id"] = trip_id
            self.trips_handler.add_trip(data)
            return Response({"data": f"Trips Saved with ID {trip_id}"}, status=status.HTTP_201_CREATED)
        except Exception as exc:
            print (traceback.format_exc())
            raise ApiException(str(exc), 6001, f"Not able to Save Trip for {trip_id}")