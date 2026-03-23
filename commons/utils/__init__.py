import re
CLEANER = re.compile('<.*?>')


def clean_html(raw_html):
  cleantext = re.sub(CLEANER, '', raw_html)
  return cleantext