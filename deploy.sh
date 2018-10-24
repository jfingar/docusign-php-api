#!/usr/bin/env bash

# Command to deploy changes. Uses rsync to transfer changed files to the production (and testing) server.
# Files to exclude from deployment can be viewed or added / altered in rsync-exclusions.txt
# Please provide either "test" or "prod" as argument 1.
#
# Example: ./deploy.sh prod
#
# "test" points to http://docusign-testing.fredloya.com (/var/www/html/docusign/test/)
# "prod" points to http://docusign.fredloya.com (/var/www/html/docusign/prod/)

if [ "$1" != "prod" ] && [ "$1" != "test" ] ; then
	echo "Please provide \"prod\" or \"test\" as argument 1, to denote which environment to deploy."
	echo "http://docusign.fli.com = \"prod\". http://docusign-testing.fli.com = \"test\"."
	exit;
fi

echo "Syncing folder contents...."
rsync -urv --delete --exclude-from=rsync-exclusions.txt ./ root@ep-docusign.fli.com:/var/www/html/$1/