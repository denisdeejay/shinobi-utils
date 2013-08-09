#!/bin/bash

VERSION=0.1
SITES_AVAILABLE=/etc/apache2/sites-available
DOCUMENT_ROOT=/mnt/www

MSG_ERR=ERR:
MSG_INFO=INFO:
MSG_OK=OK:
MSG_DONE=DONE...

echo ""
echo "-> Vhosts $VERSION"

# Check for domain name parameter $1
if [[ -z "$1" ]]; then
        echo "-> $MSG_ERR Please pass domain name, eg ./vhosts example.com"
        echo "-> $MSG_DONE"
        exit 1;
fi

# Check for sudo
if [[ "$(whoami)" != "root" ]]; then

        echo "-> $MSG_ERR Sorry, you are not root - sudo?"
        echo "-> $MSG_DONE"
        exit 1
fi

# Check for SITES_AVAILABLE
if [[ ! -d "$SITES_AVAILABLE" ]]; then
        echo "-> $MSG_ERR $SITES_AVAILABLE doesn't exist"
        echo "-> $MSG_DONE"
        exit 1
fi

# Check for DOCUMENT_ROOT
if [[ ! -d "$DOCUMENT_ROOT" ]]; then
        echo "-> $MSG_ERR $DOCUMENT_ROOT doesn't exist"
        echo "-> $MSG_DONE"
        exit 1
fi

echo "-> $MSG_INFO Found $1, processing..."

# Mv to .bak if vhost already exists
if [[ -f SITES_AVAILABLE/$1 ]]; then
	mv $SITES_AVAILABLE/$1 $SITES_AVAILABLE/$1.bak
fi

# Create dir
mkdir $DOCUMENT_ROOT/$1
mkdir $DOCUMENT_ROOT/$1/log
mkdir $DOCUMENT_ROOT/$1/private
mkdir $DOCUMENT_ROOT/$1/web

# Create domain vhost file
touch $SITES_AVAILABLE/$1

echo "<VirtualHost *:80>
	ServerName $1
	# ServerAlias foo.com www.bar.com bar.com
	DocumentRoot $DOCUMENT_ROOT/$1/web
	CustomLog $DOCUMENT_ROOT/$1/log/access.log combined
	ErrorLog $DOCUMENT_ROOT/$1/log/error.log
</virtualHost>" > $SITES_AVAILABLE/$1

exit 1;