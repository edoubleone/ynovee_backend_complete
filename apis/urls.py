from django.urls import path

# from views.auth_view import
from users.views.user_view import UserView, UserUploadPicView, UsersView
from places.views.user_places import UserPlacesView
from users.views.auth_view import AuthView, ValidateAccountView
from users.views.forget_password_view import ForgetPasswordSubmitCodeView, ForgetPasswordCodeView
from places.views.places_view import PlaceView, NearbyPlacesView, PlacesView
from places.views.places_lat_lang_view import PlaceLatitudeLongitudeView
from places.views.place_type_view import GeoTagsView, UserPreferredGeoTagView, UsersNearbyPlacesView
from trips.views.trips_view import TripsView, TripView, UserTripView
from places.views.distance_places_view import DistanceApiView
from places.views.directions import DirectionsApiView

from weather.views import WeatherView
from events.views import EventsView
from transcriber.views import TranscriberView

app_name = "apis"

urlpatterns = [

    path("auth", AuthView.as_view(), name="auth"),
    path("users", UsersView.as_view(), name="users"),
    path("user/<slug:user_id>", UserView.as_view(), name="user"),
    path("user/<slug:user_id>/upload_pic", UserUploadPicView.as_view(), name="users_upload_pic"),
    path("send_validation_code", ForgetPasswordCodeView.as_view(), name="send_validation_code"),
    path("validate_forget_password_code", ForgetPasswordSubmitCodeView.as_view(), name="forget_password"),

    path("verify_account/<slug:user_id>", ValidateAccountView.as_view(), name="verify-account"),

    path("place_types", GeoTagsView.as_view(), name="place_types"),
    path("place_types/users/<slug:user_id>", UserPreferredGeoTagView.as_view(), name="user_place_types"),

    path("nearby_places", NearbyPlacesView.as_view(), name="nearby_places"),
    path("nearby_places/users/<slug:user_id>", UsersNearbyPlacesView.as_view(), name="users_nearby_places"),

    path("places", PlacesView.as_view(), name="places"),
    path("places_lat_lang", PlaceLatitudeLongitudeView.as_view(), name="places_lat_lang"),

    path("places/user/<slug:user_id>", UserPlacesView.as_view(), name="user_places"),
    path("place/<slug:place_id>", PlaceView.as_view(), name="place"),

    path("trips", TripsView.as_view(), name="trips"),
    path("trips/user/<slug:user_id>", UserTripView.as_view(), name="user_trips"),
    path("trip/<slug:trip_id>", TripView.as_view(), name="trip"),

    path("events", EventsView.as_view(), name="events"),

    path("distance_matrix", DistanceApiView.as_view(), name="distance_matrix"),

    path("directions", DirectionsApiView.as_view(), name="directions"),

    path("weather", WeatherView.as_view(), name="weather"),

    path("convert_text_to_speech", TranscriberView.as_view(), name="transcriber"),

]