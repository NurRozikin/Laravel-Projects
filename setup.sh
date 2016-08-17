#!/bin/sh

echo "proses provisioning"

echo "konfigurasi sources dan environment"
cp /vagrant/configuration/sources.list /etc/apt/sources.list
cp /vagrant/configuration/environment /etc/environment

echo "Tambah Repo Git"
sudo add-apt-repository -y ppa:git-core/ppa

echo "Tambah Repo Nginx"
add-apt-repository -y ppa:nginx/stable

echo "Tambah Repo Mariadb"
apt-get install software-properties-common
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
add-apt-repository 'deb [arch=amd64,i386] http://mariadb.biz.net.id/repo/10.1/ubuntu trusty main'

echo "Tambah Repo HHVM"
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"

echo "Tambah Repo Node JS"
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -

apt-get update
apt-get update -y
apt-get dist-upgrade -y

echo "Konfigurasi Mariadb"
apt-get install -y debconf-utils
echo mariadb-server-10.1 mysql-server/root_password password root | debconf-set-selections
echo mariadb-server-10.1 mysql-server/root_password_again password root | debconf-set-selections

apt-get install -y git nginx mariadb-server mariadb-client hhvm vim nodejs

echo "Konfigurasi Virtual Host Nginx"
cp /vagrant/configuration/nginx-vhost /etc/nginx/sites-available/laravelprojects
ln -s /etc/nginx/sites-available/laravelprojects /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default

echo "Konfigurasi HHVM"
/usr/share/hhvm/install_fastcgi.sh
update-rc.d hhvm defaults
/usr/bin/update-alternatives --install /usr/bin/php php /usr/bin/hhvm 60
service nginx restart


echo "Install Composer"
curl -sS https://getcomposer.org/installer | php
mv /home/vagrant/composer.phar /usr/local/bin/composer