#!/usr/bin/python3

import os
import ast
import smtplib
import traceback
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

from commons.utils.logger import Logger

SMTP_HOST = "edoubleone.com"  # localhost
SMTP_PORT = "465"
SMTP_SENDER_EMAIL = "benjamin.onogwu@edoubleone.com"
SSL_ENABLED = "True"


class Smtp:
    instance = None

    def __init__(self):
        self.sender_mail = os.environ.get("SMTP_SENDER_EMAIL", SMTP_SENDER_EMAIL)
        self.smtp_obj = self.connect_smtp()
        self._logger = Logger.get_instance(__name__)
        Smtp.instance = self

    def connect_smtp(self):
        ssl_enabled = os.environ.get("SSL_ENABLED", SSL_ENABLED)
        ssl_enabled = ast.literal_eval(ssl_enabled)
        # import pdb;pdb.set_trace()
        smtp_host = os.environ.get("SMTP_HOST", SMTP_HOST)
        smtp_port = os.environ.get("SMTP_PORT", SMTP_PORT)
        if ssl_enabled:
            smtp_obj = smtplib.SMTP_SSL(smtp_host, smtp_port)
            password = os.environ.get("SMTP_PASSWORD")
            smtp_obj.login(self.sender_mail, password)
        else:
            smtp_obj = smtplib.SMTP(smtp_host, smtp_port)

        return smtp_obj

    @staticmethod
    def get_instance():

        if Smtp.instance is None:
            Smtp()
        return Smtp.instance

    def send_email(self, receivers_mail, message: MIMEMultipart):
        try:
            self.smtp_obj.sendmail(self.sender_mail,
                                   receivers_mail,
                                   message.as_string())
            self._logger.info(f"Successfully sent email to {receivers_mail}")
        except Exception as e:
            print(traceback.format_exc())
            raise Exception("Smtp Server is Down, Not able to send Messages")

    @staticmethod
    def generate_email_message(recipients, subject, html_message):
        msg = MIMEMultipart('')
        msg['From'] = SMTP_SENDER_EMAIL
        msg['To'] = recipients

        msg['Subject'] = subject

        body = MIMEText(html_message, "html")
        msg.attach(body)

        return msg
