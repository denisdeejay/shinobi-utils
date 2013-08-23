# vagrant-ispconfig

## Details

A vagrant box pre-installed with the following:

- ISPConfig 3.0.5.2 (Apache/Courier via https://github.com/dclardy64/ISPConfig-3-Debian-Installer)
- Debian Wheezy
- Node.js

## Installation instructions (OSX)

1. Install Virtual Box - https://www.virtualbox.org/
2. Install Vagrant - http://www.vagrantup.com/
3. vagrant box add dev-ispconfig https://googledrive.com/host/0B-Ale1bdCR9pUmN2bHRXVmt2RXM/dev-ispconfig-v1.box
4. mkdir -p ~/Vagrant/dev-ispconfig && cd $_;
5. vagrant init dev-ispconfig
6. vagrant up
7. vagrant ssh

## Useful access & account information (user/pass)

- VM Root: root/vagrant
- VM User: vagrant/vagrant
- HTTP: http://127.0.0.1:8080
- HTTPS: https://127.0.0.1:8443
- ISPConfig: http://127.0.0.1:8081 admin/vagrant
- MySQL: root/vagrant
- SSH: ssh -2 -p 2222 vagrant@127.0.0.2

## Default Apache ports

For some reason we can't forward any port < 1000 with Vagrant or Virtual box, the following rules will fix that, but they will be lost at reboot.

	sudo ipfw add 100 fwd 127.0.0.1,8080 tcp from any to me 80
	sudo ipfw add 101 fwd 127.0.0.1,8443 tcp from any to me 443

## Vagrantize

When creating new sites through ISPConfig you can to use 'vagrantize' to move the new site to the shared /vagrant directory.
The purpose of this is purely so www files are easily accessible from the host.

### vagrantize usage

1. Create a new site called 'example.com' through ISPConfig
2. vagrant ssh
3. sudo vagrantize example.com

#### The vagrantize script in the box is outdated, do this to update:

	sudo rm /usr/local/bin/vagrantize ; sudo wget -O /usr/local/bin/vagrantize https://raw.github.com/ShinobiCorp/shinobi-utils/master/vagrantize.sh ; sudo chmod +x /usr/local/bin/vagrantize 
