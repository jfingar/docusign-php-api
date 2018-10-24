#!/usr/bin/env bash

# Builds the image for the app container
# Run this to persist additions or changes to the Apache / PHP environment (configuration files, etc)
# These files are located in the docker/app folder.
#
# PLEASE NOTE: The "docker-compose up" command used in the ./start-dev.sh and ./restart-dev.sh scripts also re-builds the image,
# so you shouldn't need to run this script on a routine basis.

docker build -t docusign_app ./docker/app