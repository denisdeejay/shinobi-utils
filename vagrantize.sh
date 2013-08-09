#!/bin/bash

VERSION=v0.1
WWW_ROOT=/var/www
VAGRANT_ROOT=/vagrant

MSG_ERR=ERR:
MSG_INFO=INFO:
MSG_OK=OK:
MSG_DONE=DONE...

echo ""
echo "-> Vagrantize $VERSION"

# Check for domain name parameter
if [[ -z "$1" ]]; then
        echo "-> $MSG_ERR Please pass ispconfig domain name, eg ./vagrantize example.com"
        echo "-> $MSG_DONE"
        exit 1;
fi

# Check for sudo
if [[ "$(whoami)" != "root" ]]; then

        echo "-> $MSG_ERR Sorry, you are not root - sudo?"
        echo "-> $MSG_DONE"
        exit 1
fi

# Check for VAGRANT_ROOT
if [[ ! -d "$VAGRANT_ROOT" ]]; then
        echo "-> $MSG_ERR $VAGRANT_ROOT doesn't exist"
        echo "-> $MSG_DONE"
        exit 1
fi

# Check for VAGRANT_ROOT/domain
if [[ -L "$VAGRANT_ROOT/$1" ]]; then
        echo "-> $MSG_ERR $VAGRANT_ROOT/$1 already exists"
        echo "-> $MSG_DONE"
        exit 1
fi


if [[ -d "$VAGRANT_ROOT/$1" ]]; then
        echo "-> $MSG_ERR $VAGRANT_ROOT/$1 already exists"
        echo "-> $MSG_DONE"
        exit 1
fi

# If directory exists as symlink...
if [[ -L "$WWW_ROOT/$1" ]]; then

        echo "-> $MSG_INFO Found $1, processing..."

        echo "-> $MSG_INFO Removing immutable flag attribute..."
        cd -P $WWW_ROOT/$1
        cd ..
        chattr -i web*

        echo "-> $MSG_INFO Making $VAGRANT_ROOT/$1..."
        mkdir $VAGRANT_ROOT/$1

        echo "-> $MSG_INFO Copying $1 to $VAGRANT_ROOT/$1..."
        cd -P $WWW_ROOT/$1
        cp -prf * $VAGRANT_ROOT/$1

        echo "-> $MSG_INFO Removing original directory..."
        rm -rf $WWW_ROOT/$1

        echo "-> $MSG_INFO Creating new symlink..."
        cd $WWW_ROOT
        ln -s $VAGRANT_ROOT/$1 .

        echo "-> $MSG_INFO $1 successfully vagrantized!"
        echo "-> $MSG_DONE"
        exit 1;
else
        echo "-> $MSG_ERR Couldn't find ispconfig domain... ($1)"
        echo "-> $MSG_DONE"
        exit 1;
fi

exit 1;

