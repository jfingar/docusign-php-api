#!/usr/bin/env bash

# starts the container for the docusign connect API application
#
# **** YOU SHOULD NOT NEED TO RUN THIS SCRIPT ****
#
# ./start-dev.sh USES docker-compose TO START THE DB CONTAINER AND THEN THE APP CONTAINER IN THE CORRECT SEQUENCE.
# RUNNING THIS SCRIPT AFTER RUNNING ./start-db-container.sh ESSENTIALLY DOES THE SAME THING AS ./start-dev.sh
#
# THIS SCRIPT CAN BE USEFUL FOR DEBUGGING, IF YOUR CONTAINERS AREN'T STARTING CORRECTLY VIA ./start-dev.sh

docker run -p 8084:80 -v $PWD:/var/www/html -e "APPLICATION_ENV=docker-development" --link="docusign_db_1:dev.mysql.fli.com" --name docusign_app_1 docusign_app