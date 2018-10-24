#!/usr/bin/env bash

# Start the docker containers via docker-compose
# https://docs.docker.com/compose/overview/
#
# This project consists of 2 containers:
# 1) docusign_app_1 - The api application environment (Apache / PHP7)
# 2) docusign_db_1 - MySQL Database
#
# See the docker-compose.yml file for more details.
# Also, see docker/app/Dockerfile for specific details about the application environment.

docker-compose up -d --build --force-recreate

printf "\n\n#########################################################\n"
printf "#########################################################\n\n"
printf "NOTICE: PLEASE ALLOW 30 - 60 SECONDS FOR MYSQL CONTAINER TO COMPLETE INITIALIZATION.\n"
printf "DURING THIS TIME, THE API AND ACCESS TO MYSQL VIA CLIENT MAY BE UNAVAILABLE.\n\n"
printf "Running application can be accessed at http://{docker-machine ip}:8084\n\n"
printf "** USE POSTMAN (NOT BROWSER) TO TEST API CALLS!! **"
printf "MySQL instance can be accessed at:\n\n\tHOST: {docker-machine ip}\n\tPORT: 32774\n\tUSERNAME: root\n\tPASSWORD: (blank)\n\n"
printf "You can start a terminal session on the running notes_api_app_1 container by running the command \"./container-shell.sh app\"\n\n"
printf "You can check the i.p. and status of your docker-machine VM with the command \"docker-machine ls\"\n\n"
printf "Happy Coding :-)\n\n"
printf "#########################################################\n"
printf "#########################################################\n\n"