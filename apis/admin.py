from django.contrib import admin

# Register your models here.
from django.contrib import admin
from users.models import User
from messaging.models import Notification
from places.models.place import Place
from places.models.place_reviews import PlaceReview
from places.models.user_place_types import UserPlaceTypes
from trips.models.trips import Trips
from events.models import Event

admin.site.register(User)
admin.site.register(Notification)
admin.site.register(Place)
admin.site.register(PlaceReview)
admin.site.register(UserPlaceTypes)
admin.site.register(Trips)
admin.site.register(Event)
