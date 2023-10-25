from django.urls import path

# from views.auth_view import
from users.views.user_view import UserView
from users.views.user_places import UserPlacesView
from users.views.auth_view import AuthView
from places.views.places_view import PlaceView, NearbyPlacesView, PlacesView

app_name = "apis"

urlpatterns = [
    path("auth", AuthView.as_view(), name="auth"),
    path("user/<slug:user_id>", UserView.as_view(), name="users"),

    path("nearby_places", NearbyPlacesView.as_view(), name="nearby_places"),
    path("places", PlacesView.as_view(), name="places"),
    path("place/<slug:place_id>", PlaceView.as_view(), name="place"),

    path("user/<slug:user_id>/places", UserPlacesView.as_view(), name="user_places"),

]