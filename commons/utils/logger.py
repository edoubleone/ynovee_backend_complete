import logging


class Logger:

    @staticmethod
    def get_instance(class_name):
        if not logging.getLogger(class_name).hasHandlers():
            logger = logging.getLogger(class_name)
            logger.setLevel(level=logging.INFO)

            # formatter = logging.Formatter(fmt=log_format)
            formatter = logging.Formatter('%(asctime)s - %(name)s - %(levelname)s - %(message)s')

            handler = logging.StreamHandler()
            handler.setLevel(level=logging.INFO)
            handler.setFormatter(formatter)

            logger.addHandler(handler)
            return logger

        return logging.getLogger(class_name)
