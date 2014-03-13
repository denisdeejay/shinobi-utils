# shinobi-utils

A collection of utils that I've made along the way...

## vagrant-ispconfig

A vagrant box pre-installed with the following:

- ISPConfig 3.0.5.2 (Apache/Courier via https://github.com/dclardy64/ISPConfig-3-Debian-Installer)
- Debian Wheezy
- Node.js

## vagrant-nginx-php

A vagrant box with nginx php mysql

- Ubuntu Precise 12.04 x64
- PHP 5.4
- Composer
- MySQL
- MongoDB
- Redis

## Vagrantize

When creating new sites through ISPConfig you can to use 'vagrantize' to move the new site to the shared /vagrant directory.
The purpose of this is purely so www files are easily accessible from the host.

## Nginx-Vhosts

A simple script to create a basic VHOST from a template for nginx.
