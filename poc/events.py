from serpapi import GoogleSearch

API_KEY = "a253b175265e25b1f87d2acb97ec869bf90d60631e351f412dad036451b81398"
params = {
  "engine": "google_events",
  "q": "Events in Lagos",
  "hl": "en",
  "gl": "us",
  "htichips": "event_type:Virtual-Event,date:today",
  "api_key": API_KEY
}

search = GoogleSearch(params)
results = search.get_dict()
events_results = results["events_results"]
import pdb;pdb.set_trace()