#!/bin/bash

# Activate the virtual environment
source venv/bin/activate
pip install -r requirements.txt

# Install the requirements
source ./env.sh

# Run the Django migrations
python manage.py makemigrations
python manage.py migrate

# Run the Django server
python manage.py runserver
celery -A your_project_name worker --loglevel=info &