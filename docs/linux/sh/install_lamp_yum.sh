#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160119
#Install LAMP environment.
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
###若出现/etc/sysconfig/network不存在，/etc/sysconfig/network  => /etc/sysconfig/network-scripts/ifcfg-XXX文件
service mysqld start
#PHP
yum -y install php php-mysql
yum -y install gd php-gd gd-devel php-xml php-common php-mbstring php-ldap php-pear php-xmlrpc php-imap
##Apache restart
service httpd restart
echo "LAMP installation completed!"

#TODO: LAMP config change for casarover









