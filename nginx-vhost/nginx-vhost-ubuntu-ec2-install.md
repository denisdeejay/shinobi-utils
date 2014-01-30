#Ubuntu 13 nginx/fpm/git-deploy server

1. Install nginx/php5-fpm
	1. `sudo apt-get install nginx git-core php5-fpm php-apc php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl`

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