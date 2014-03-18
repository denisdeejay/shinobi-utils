# Nginx-Vhosts
 
A simple script to create a basic VHOST for nginx.
 
## nginx-vhost usage (Ubuntu/Debian)

1. Copy nginx-vhost.sh & nginx-vhost-template.txt to /usr/local/bin/
2. Edit nginx-vhost-template.txt as appropriate
3. Edit nginx-vhost.sh variables as appropriate (VHOST_AVAILABLE, VHOST_ENABLED, VHOST_TEMPLATE, WWW_ROOT)
4. sudo nginx-vhost.sh example.com will create a vhost


1. Install shinobi-utils/nginx-vhost
	1. `cd /usr/local/bin`
	2. `sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost.sh`
	3. `sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost-template.txt`
	4. `sudo chmod +x nginx-vhost*`
