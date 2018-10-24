#!/usr/bin/env bash


# Stop / Build / Re-Start the containers.
# This will rebuild the docker images to pull in Database or Environment changes
#
# WHEN TO RUN THIS SCRIPT:
#
# - when you want to re-build your environment to include changes to DB Schema / Tables
# (to receive changes or additions to files located in docker/local_mysql_db/files/docker-entrypoint-initdb.d folder)
#
# - when you want to re-build your environment to include changes to dev-ops / infrastructure related files such as Dockerfiles or server config files, etc.
#
# YOU DO NOT NEED TO RUN THIS SCRIPT TO GET NORMAL CODE CHANGES, CODE IN THE intranet/ and library/ directories are shared (live) with the docker container

echo "Stopping and Removing Running Containers..."
./stop-dev.sh

echo "Building and Starting Containers..."
./start-dev.sh