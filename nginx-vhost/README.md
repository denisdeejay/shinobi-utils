# shinobi-utils
 
## Nginx-Vhosts
 
A simple script to create a basic VHOST for nginx.
 
### nginx-vhost usage (Ubuntu/Debian)

1. Copy nginx-vhost.sh & nginx-vhost-template.txt to /usr/local/bin/
2. Edit nginx-vhost-template.txt as appropriate
3. Edit nginx-vhost variables as appropriate (VHOST_AVAILABLE, VHOST_ENABLED, VHOST_TEMPLATE, WWW_ROOT)
4. sudo nginx-vhost example.com will create a vhost