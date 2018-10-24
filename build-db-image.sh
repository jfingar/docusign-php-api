#!/usr/bin/env bash

# Builds the image for the mysql db container
# Run this to persist additions or changes to mysql tables.
# All .sql files located in the docker/local_mysql_db/files/docker-entrypoint-initdb.d folder will be initialized.
#
# PLEASE NOTE: The "docker-compose up" command used in the ./start-dev.sh and ./restart-dev.sh scripts also re-builds the image,
# so you shouldn't need to run this script on a routine basis.

docker build -t docusign_db ./docker/local_mysql_db