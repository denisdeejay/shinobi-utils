# shinobi-utils

A collection of Debian/Ubuntu utils

## Vagrantize

When creating new sites through ISPConfig you will can to use 'vagrantize' to move the new site to the shared /vagrant directory.
The purpose of this is purely so www files are easily accessible from the host.

### vagrantize usage

1. Create a new site called 'example.com' through ISPConfig
2. vagrant ssh
3. sudo vagrantize example.com

## Nginx-Vhosts

A simple script to create a basic VHOST for nginx.

### nginx-vhost usage (Ubuntu/Debian)

1. Copy nginx-vhost.sh & nginx-vhost-template.txt to /usr/local/bin/
2. Edit nginx-vhost-template.txt as appropriate
3. Edit nginx-vhost variables as appropriate (VHOST_AVAILABLE, VHOST_ENABLED, VHOST_TEMPLATE, WWW_ROOT=/mnt/www)
3. sudo nginx-vhost example.com will create a vhost