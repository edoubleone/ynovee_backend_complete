#!/usr/bin/python3
import smtplib

from commons.utils.logger import Logger


class Smtp:
    instance = None

    def __init__(self):
        self.sender_mail = 'parkashsharm01@gmail.com'
        password = ""
        self.smtp_obj = smtplib.SMTP("localhost", 1025)
        if password:
            self.smtp_obj.login(self.sender_mail, password)
        self._logger = Logger.get_instance(__name__)
        Smtp.instance = self

    @staticmethod
    def get_instance():
        if Smtp.instance is None:
            Smtp()
        return Smtp.instance

    def send_email(self, receivers_mail, message):
        self.smtp_obj.sendmail(self.sender_mail,
                               receivers_mail,
                               message)
        self._logger.info(f"Successfully sent email to {receivers_mail}")
