
class ApiException(Exception):

    def __init__(self, message, service_status_code, internal_message, *args):
        self.service_status_code = service_status_code
        self.message = internal_message
        super(ApiException, self).__init__(
            message, service_status_code, internal_message, *args
        )