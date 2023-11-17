from django.urls import path

# from views.auth_view import
from users.views.user_view import UserView
from places.views.user_places import UserPlacesView
from users.views.auth_view import AuthView
from users.views.forget_password_view import ForgetPasswordSubmitCodeView
from places.views.places_view import PlaceView, NearbyPlacesView, PlacesView
from places.views.place_type_view import GeoTagsView, UserPreferredGeoTagView, UsersNearbyPlacesView
from trips.views.trips_view import TripsView, TripView, UserTripView

from events.views import EventsView

app_name = "apis"

urlpatterns = [
    path("auth", AuthView.as_view(), name="auth"),
    path("validate_forget_password_code", ForgetPasswordSubmitCodeView.as_view(), name="forget_password"),
    path("user/<slug:user_id>", UserView.as_view(), name="users"),



    path("place_types", GeoTagsView.as_view(), name="place_types"),
    path("place_types/users/<slug:user_id>", UserPreferredGeoTagView.as_view(), name="user_place_types"),

    path("nearby_places", NearbyPlacesView.as_view(), name="nearby_places"),
    path("nearby_places/users/<slug:user_id>", UsersNearbyPlacesView.as_view(), name="users_nearby_places"),

    path("places", PlacesView.as_view(), name="places"),
    path("places/user/<slug:user_id>", UserPlacesView.as_view(), name="user_places"),
    path("place/<slug:place_id>", PlaceView.as_view(), name="place"),

    path("trips", TripsView.as_view(), name="trips"),
    path("trips/user/<slug:user_id>", UserTripView.as_view(), name="user_trips"),
    path("trip/<slug:trip_id>", TripView.as_view(), name="trip"),

    path("events", EventsView.as_view(), name="events"),

]