
class PlaceService(Exception):

    def __init__(self, message, service_status_code, internal_message, *args):
        self.service_status_code = service_status_code
        self.message = internal_message
        super(PlaceService, self).__init__(
            message, service_status_code, internal_message, *args
        )


class GoogleApiException(Exception):
    def __init__(self, message, service_status_code, internal_message, *args):
        self.service_status_code = service_status_code
        self.message = internal_message
        super(GoogleApiException, self).__init__(
            message, service_status_code, internal_message, *args
        )