#!/usr/bin/env bash

# Command to stop and remove the running containers.

docker stop docusign_app_1
docker rm docusign_app_1
docker stop docusign_db_1
docker rm docusign_db_1