# shinobi-utils

A collection of Debian/Ubuntu utils

## Vagrantize

When creating new sites through ISPConfig you will can to use 'vagrantize' to move the new site to the shared /vagrant directory.
The purpose of this is purely so www files are easily accessible from the host.

### Vagrantize usage

1. Create a new site called 'example.com' through ISPConfig
2. vagrant ssh
3. sudo vagrantize example.com

## Vhosts

A simple script to create a basic VHOST for Apache.