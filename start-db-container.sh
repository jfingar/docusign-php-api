#!/usr/bin/env bash

# starts the container for the mysql database
#
# **** YOU SHOULD NOT NEED TO RUN THIS SCRIPT ****
#
# ./start-dev.sh USES docker-compose TO START THE DB CONTAINER AND THEN THE APP CONTAINER IN THE CORRECT SEQUENCE.
# RUNNING THIS SCRIPT FOLLOWED BY THE ./start-app-container.sh ESSENTIALLY DOES THE SAME THING AS ./start-dev.sh
#
# THIS SCRIPT CAN BE USEFUL FOR DEBUGGING, IF YOUR CONTAINERS AREN'T STARTING CORRECTLY VIA ./start-dev.sh

docker run -e "MYSQL_ALLOW_EMPTY_PASSWORD=true" -e "MYSQL_USER=development" -e "MYSQL_PASSWORD=development" -e "MYSQL_DATABASE=test_intranet" -p 32774:3306 --name docusign_db_1 docusign_db
