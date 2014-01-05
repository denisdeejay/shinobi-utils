#!/bin/bash

VERSION=v0.1

BASEDIR=$(dirname $0)
DOMAIN=$1
VHOST_AVAILABLE=/etc/nginx/sites-available
VHOST_ENABLED=/etc/nginx/sites-enabled
VHOST_TEMPLATE=$BASEDIR/nginx-vhost-template.txt
WWW_ROOT=/mnt/www

MSG_ERR=ERR:
MSG_INFO=INFO:
MSG_OK=OK:
MSG_DONE=DONE...

echo ""
echo "-> nginx-vhost $VERSION"

# Check for domain name parameter
if [[ -z "$DOMAIN" ]]; then
	echo "-> $MSG_ERR Please pass domain name, eg ./nginx-vhost example.com"
	echo "-> $MSG_DONE"
    echo ""
    exit 1;
fi

# Check for sudo
if [[ "$(whoami)" != "root" ]]; then

    echo "-> $MSG_ERR Sorry, you are not root - sudo?"
    echo "-> $MSG_DONE"
    echo ""
    exit 1
fi

# Check for VHOST_DIR
if [[ ! -d "$VHOST_AVAILABLE" ]]; then
    echo "-> $MSG_ERR $VHOST_AVAILABLE doesn't exist"
    echo "-> $MSG_DONE"
    echo ""
	exit 1
fi

# Check for VHOST_DIR
if [[ ! -d "$VHOST_ENABLED" ]]; then
    echo "-> $MSG_ERR $VHOST_ENABLED doesn't exist"
    echo "-> $MSG_DONE"
    echo ""
    exit 1
fi

# Check for WWW_ROOT
if [[ ! -d "$WWW_ROOT" ]]; then
    echo "-> $MSG_ERR $WWW_ROOT doesn't exist"
    echo "-> $MSG_DONE"
    echo ""
	exit 1
fi

# Check for WWW_ROOT/DOMAIN
if [[ -d "$WWW_ROOT/$DOMAIN" ]]; then
    echo "-> $MSG_ERR $WWW_ROOT/$DOMAIN already exists"
    echo "-> $MSG_DONE"
    echo ""
    exit 1
fi

# Check for VHOST_DIR/DOMAIN
if [[ -f "$VHOST_AVAILABLE/$DOMAIN" ]]; then
	echo "-> $MSG_ERR $VHOST_AVAILABLE/$DOMAIN already exists"
    echo "-> $MSG_DONE"
    echo ""
    exit 1
fi

# Check for VHOST_TEMPLATE
if [[ ! -f "$VHOST_TEMPLATE" ]]; then
    echo "-> $MSG_ERR $VHOST_TEMPLATE doesn't exist"
    echo "-> $MSG_DONE"
    echo ""
    exit 1
fi

# Create vhost directories
mkdir -p $WWW_ROOT/$DOMAIN
mkdir $WWW_ROOT/$DOMAIN/web
mkdir $WWW_ROOT/$DOMAIN/private
mkdir $WWW_ROOT/$DOMAIN/ssl
mkdir $WWW_ROOT/$DOMAIN/log
mkdir $WWW_ROOT/$DOMAIN/
echo "Welcome to $DOMAIN" > $WWW_ROOT/$DOMAIN/web/index.html
chown -R www-data:www-data $WWW_ROOT/$DOMAIN

# Create vhost record from template
sed -e "s;%WWW_ROOT%;$WWW_ROOT;" -e "s;%DOMAIN%;$DOMAIN;" $VHOST_TEMPLATE > $VHOST_AVAILABLE/$DOMAIN
cp -prf $VHOST_AVAILABLE/$DOMAIN $VHOST_ENABLED/$DOMAIN

echo "-> $MSG_INFO nginx-vhost for $1 successfully created!"
echo "-> $MSG_DONE"
exit 1;