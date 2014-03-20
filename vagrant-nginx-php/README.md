# Install Process

1. Extract .zip folder, and cd to directory with `Vagrantfile`
2. `vagrant up` and then `vagrant halt` after install is completed.
3. `vagrant plugin install vagrant-bindfs`
4. Add the following two lines to `Vagrantfile`

    ```
    config.bindfs.bind_folder "/var/www", "/www",
    :perms           => "u=rwx:g=rwx:o=rwx"
    ```
    
5. `vagrant up` and `vagrant ssh` into your newly running vagrant box
6. `cd /usr/local/bin;sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost.sh;sudo curl -O https://raw.github.com/Shinobi-Corp/shinobi-utils/master/nginx-vhost/nginx-vhost-template.txt
;sudo chmod +x nginx-vhost*`

7. Edit nginx-vhost.sh to contain the following:

    ```
    BASE_DIR=$(dirname $0)
    DOMAIN=$1
    PUBLIC_DIR=public

    # Full path to vhost available - you should create this if it doesn't exist.
    VHOST_AVAILABLE=/etc/nginx/sites-available

    # Should script chwon newly created vhosts?
    VHOST_CHOWN=false

    # Which User/Group do we chown the vhost with?
    VHOST_CHOWN_USER=www-data
    VHOST_CHOWN_GROUP=www-data

    # Full path to vhost enabled - this should exist already as part of your nginx $
    VHOST_ENABLED=/etc/nginx/conf.d

    # Place templatae in same directory as this script.
    VHOST_TEMPLATE=$BASE_DIR/nginx-vhost-template.txt

    # Vhost Directory Root.
    WWW_ROOT=/www

    MSG_ERR=ERR:
    MSG_INFO=INFO:
    MSG_OK=OK:
    MSG_DONE=DONE...
    ```
