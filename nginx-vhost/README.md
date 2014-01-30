# Nginx-Vhosts
 
A simple script to create a basic VHOST for nginx.
 
## nginx-vhost usage (Ubuntu/Debian)

1. Copy nginx-vhost.sh & nginx-vhost-template.txt to /usr/local/bin/
2. Edit nginx-vhost-template.txt as appropriate
3. Edit nginx-vhost.sh variables as appropriate (VHOST_AVAILABLE, VHOST_ENABLED, VHOST_TEMPLATE, WWW_ROOT)
4. sudo nginx-vhost.sh example.com will create a vhost


# Example Ubuntu 12 nginx/fpm/git-deploy setup

1. Install nginx/php5-fpm
	1. `sudo apt-get install nginx git-core php5-fpm`
	2. `sudo apt-get install php-apc php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap`
	3. `sudo apt-get install php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp`
	4. `sudo apt-get install php5-json php5-sqlite php5-tidy php5-xmlrpc php5-xsl`

2. Configure nginx
	1. `sudo nano /etc/nginx/nginx.conf` set `keepalive_timeout 2;`
	2. `/etc/init.d/nginx reload`

3. Configure php5-fpm
	1. `sudo pico /etc/php5/fpm/php.ini` set `cgi.fix_pathinfo=0`
	2. `sudo /etc/php5/fpm/pool.d/www.conf` set `;listen = /var/run/php5-fpm.sock` to `listen = 127.0.0.1:9000`
	3. `sudo /etc/init.d/php5-fpm reload`

4. Install shinobi-utils/nginx-vhost
	1. `cd /usr/local/bin`
	2. `sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost.sh`
	3. `sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost-template.txt`
	4. `sudo chmod +x nginx-vhost*`

5. Attach EBS storage (Optional)
	1. `mkfs.ext4 /dev/xvdf` (Where xvdf is device name)
	2. `mkdir /mnt/www`
	3. `echo "/dev/xvdf /mnt/www auto noatime 0 0" | sudo tee -a /etc/fstab`
	4. `mount /mnt/www`


