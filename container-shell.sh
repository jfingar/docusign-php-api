#!/usr/bin/env bash

# Command to ssh onto the app or mysql docker container (pass app or mysql as argument #1)
# Container must be running.
# Check your running containers with the "docker ps" command.

if [ "$1" != "app" ] && [ "$1" != "db" ] ; then
	echo "Please provide \"app\" or \"db\" as argument 1, to denote for which container to open a bash shell."
	exit;
fi

docker exec -it docusign_$1_1 /bin/bash