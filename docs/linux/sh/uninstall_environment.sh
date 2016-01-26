#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(YeWenda)
#@20160122
#Uninstall LAMP, Git enviroment.
#--------------------------------------------------------------------------------------------------

#Git&LAMP
yum -y remove curl-devel expat-devel gettext-devel openssl-devel zlib-devel git-core mysql php httpd

#列出相关包
#rpm -qa | grep mysql/php/httpd
#删除包
rpm -e php-mysql
rpm -e httpd-tools
rpm -e php-pgsql
rpm -e php-pdo
rpm -e php-cli
rpm -e php-common