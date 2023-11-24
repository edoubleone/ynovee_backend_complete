#!/usr/bin/python3

from commons.utils.logger import Logger


class Cache:
    instance = None

    def __init__(self):
        self.cache_data = {}
        self._logger = Logger.get_instance(__name__)
        Cache.instance = self

    @staticmethod
    def get_instance():
        if Cache.instance is None:
            Cache()
        return Cache.instance

    def set_key_value(self, key, value):
        self.cache_data[key] = value

    def get_key_value(self, key):
        data = self.cache_data.get(key)
        if data is None:
            raise Exception(f"No code found for {key}, Please generate code again")
        return data