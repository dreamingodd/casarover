#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(YeWenda)
#@20160119
#Install LAMP, enviroment.
#--------------------------------------------------------------------------------------------------

#Apache
yum -y install httpd
##Apache service start
service httpd start
##Apache 扩展
yum -y install httpd-manual mod_ssl mod_perl mod_auth_mysql
#MySQL
yum -y install mysql mysql-server mysql-devel
##MySQL start
###若出现/etc/sysconfig/network不存在，/etc/sysconfig/network  =>   /etc/sysconfig/network-scripts/ifcfg-XXX文件
service mysqld start
#PHP
yum -y install php php-mysql
yum -y install gd php-gd gd-devel php-xml php-common php-mbstring php-ldap php-pear php-xmlrpc php-imap
##Apache restart
service httpd restart
echo "LAMP installation completed!"

#Git related
yum -y install curl-devel expat-devel gettext-devel openssl-devel zlib-devel
yum -y install git-core
git config --global user.name "Ye_WD"
git config --global user.email memorywilllast@sina.com

if [ -d /home/git ]
then
    echo "Git folder exists."
else
    mkdir /home/git
fi
echo "Git installation completed."
#casarover
cd /home/git
git clone https://github.com/dreamingodd/casarover
cd /var/www/html/
cp /home/git/casarover/casarover ./casarover
mkdir photo
mkdir cache
chmod 777 photo
chmod 777 cache






