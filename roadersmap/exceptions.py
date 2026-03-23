class RequestApiException(Exception):
    def __init__(self, message, service_status_code, internal_message, *args):
        self.service_status_code = service_status_code
        self.message = internal_message
        super(RequestApiException, self).__init__(message, service_status_code, internal_message, *args)


class OTPRequiredException(Exception):
    """
    Unique Exception raised when OTP (One-Time Password) is required for authentication.

    To be handled by view
    """

    def __init__(self, detail=None, code=None, available_renderers=None):
        self.available_renderers = available_renderers
        super().__init__(detail, code)
