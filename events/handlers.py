import os

from commons.utils.logger import Logger

from serpapi import GoogleSearch

from events.models import Event


class SerpApiEventsHandler(object):

    def __init__(self):
        self._logger = Logger.get_instance(__name__)
        self.API_KEY = os.environ["SERPAPI_KEY"]

    def get_nearby_events(self, keyword):
        """
        """
        params = {
            "engine": "google_events",
            "q": keyword,
            "hl": "en",
            "gl": "us",
            "htichips": "event_type:Virtual-Event,date:today",
            "api_key": self.API_KEY
        }
        search = GoogleSearch(params)
        results = search.get_dict()
        if results.get("error"):
            raise Exception(results["error"])
        events_results = results["events_results"]
        self._logger.info(f"Get Events Successfully for {keyword} from serpapi")
        return events_results


class EventHandler:
    def __init__(self):
        self._logger = Logger.get_instance(__name__)
        self._serpapi_handler = SerpApiEventsHandler()

    def add_event(self, data):
        event = Event(**data)
        event.save()

    def process_events(self, events, input_query):
        for event in events:
            event["event_date"] = event["date"]["when"]
            event["event_start_date"] = event["date"]["start_date"]
            del event["date"]
            del event["ticket_info"]
            event["address"] = ", ".join(event["address"])
            event["query"] = input_query
            event["event_id"] = event["title"] + event["event_date"] + event["event_start_date"]
            self.add_event(event)

    def get_nearby_events(self, keyword=None):
        events_from_db = self.get_events_for_query(keyword)
        if events_from_db:
            return events_from_db
        self._logger.info(f"Fetching Nearby Events for Query {keyword}")
        events = self._serpapi_handler.get_nearby_events(keyword)
        self.process_events(events, keyword)
        return events

    def get_events_for_query(self, input_query):
        return Event.objects.filter(query=input_query).all().values()
