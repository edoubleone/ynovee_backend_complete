#!/bin/bash

# Activate the virtual environment
source venv/bin/activate

# Install the requirements
source ./env.sh
pip install -r requirements.txt

# Run the Django migrations
python manage.py makemigrations
python manage.py migrate

# Run the Django server
python manage.py runserver
celery -A your_project_name worker --loglevel=info &