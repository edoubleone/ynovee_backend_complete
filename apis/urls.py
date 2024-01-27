from django.urls import path

# from two_factor.gateways.twilio.urls import urlpatterns as tf_twilio_urls
# from two_factor.urls import urlpatterns as tf_urls
from events.views import EventsView
from messaging import views
from messaging.views import NotificationDetail, NotificationList
from places.views.directions import DirectionsApiView
from places.views.distance_places_view import DistanceApiView
from places.views.place_reviews import PlacesReviewsView
from places.views.place_type_view import (
    GeoTagsView,
    UserPreferredGeoTagView,
    UsersNearbyPlacesView,
)
from places.views.places_lat_lang_view import PlaceLatitudeLongitudeView
from places.views.places_view import NearbyPlacesView, PlacesView, PlaceView
from places.views.user_places import UserPlacesView
from transcriber.views import TranscriberView
from trips.views.trips_view import TripsView, TripView, UserTripView
from users.views.auth_view import (
    CompleteOTPLoginView,
    LoginRefreshView,
    LoginView,
    LogoutView,
    RegisterView,
    ResendEmailVerificationView,
    ValidateAccountView,
)
from users.views.forget_password_view import (
    ForgetPasswordCodeView,
    ForgetPasswordSubmitCodeView,
)
from users.views.user_view import (
    UserProfileViewSet,
    UsersView,
    UserUploadPicView,
    UserView,
)
from weather.views import CRUDWeatherSaveView, SavedWeatherDetail, WeatherView

app_name = "apis"

urlpatterns = [
    path("user/realtime_notification_ticket", views.TicketRegister.as_view(), name="notification_ticket"),
    path("user/notifications", NotificationList.as_view(), name="notification-list"),
    path("user/notifications/<int:pk>", NotificationDetail.as_view(), name="notification-detail"),
    path("register", RegisterView.as_view(), name="sign_up"),
    path("login", LoginView.as_view(), name="login"),
    path("refresh_login", LoginRefreshView.as_view(), name="refresh_login"),
    path(
        "login/complete_otp_login", CompleteOTPLoginView.as_view(), name="complete_login"
    ),  # applies only to users with otp enabled
    path("logout", LogoutView.as_view(), name="logout"),
    path("profile", UserProfileViewSet.as_view(), name="my_profile"),
    path(
        "resend_email_verification/<uuid:user_id>",
        ResendEmailVerificationView.as_view(),
        name="resend_email_verification",
    ),
    path("verify_account/<slug:user_id>", ValidateAccountView.as_view(), name="verify-account"),
    path("user", UserView.as_view(), name="user"),
    path("users", UsersView.as_view(), name="users"),
    path("user/<slug:user_id>", UserView.as_view(), name="user"),
    path("user/<slug:user_id>/upload_pic", UserUploadPicView.as_view(), name="users_upload_pic"),
    path("send_validation_code", ForgetPasswordCodeView.as_view(), name="send_validation_code"),
    path("validate_forget_password_code", ForgetPasswordSubmitCodeView.as_view(), name="forget_password"),
    path("place_types", GeoTagsView.as_view(), name="place_types"),
    path("place_types/users/<uuid:user_id>", UserPreferredGeoTagView.as_view(), name="user_place_types"),
    path("nearby_places", NearbyPlacesView.as_view(), name="nearby_places"),
    path("nearby_places/users/<uuid:user_id>", UsersNearbyPlacesView.as_view(), name="users_nearby_places"),
    path("places", PlacesView.as_view(), name="places"),
    path("places_lat_lang", PlaceLatitudeLongitudeView.as_view(), name="places_lat_lang"),
    path("places/user/<uuid:user_id>", UserPlacesView.as_view(), name="user_places"),
    path("place/<slug:place_id>", PlaceView.as_view(), name="place"),
    path("place_reviews/<slug:place_id>", PlacesReviewsView.as_view(), name="reviews"),
    path("trips", TripsView.as_view(), name="trips"),
    path("trips/user/<uuid:user_id>", UserTripView.as_view(), name="user_trips"),
    path("trip/<slug:trip_id>", TripView.as_view(), name="trip"),
    path("events", EventsView.as_view(), name="events"),
    path("distance_matrix", DistanceApiView.as_view(), name="distance_matrix"),
    path("directions", DirectionsApiView.as_view(), name="directions"),
    path("weather", WeatherView.as_view(), name="weather"),
    path("weather/saved_details", SavedWeatherDetail.as_view(), name="weather-retrieve"),
    path("weather/saved", CRUDWeatherSaveView.as_view(), name="weather-crud"),
    path("weather/saved/<str:location_as_id>", CRUDWeatherSaveView.as_view(), name="weather-crud"),
    path("convert_text_to_speech", TranscriberView.as_view(), name="transcriber"),
]
