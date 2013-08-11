mkfs.ext4 /dev/xvdf
mkdir /vol
echo "/dev/xvdf /vol auto noatime 0 0" | sudo tee -a /etc/fstab
mount /vol