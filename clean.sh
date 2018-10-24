#!/usr/bin/env bash

# Use to free up disk space on your default docker-machine
# Images + containers + related volumes start to take up a lot of memory over time!
# Run this command frequently for house-keeping!!! If you are getting disk-space related errors, definitely run this script!!!
#
# Reference: https://stackoverflow.com/questions/36663809/how-to-remove-all-docker-volumes
#
# The following commands will remove:
#
# - all stopped containers
# - all networks not used by at least one container
# - all dangling images
# - all build cache
# - all volumes

docker system prune
docker volume prune