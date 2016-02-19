#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther draguo
#@20151230
#
#Hide mysql pwd
#@auther Ye_WD
#@20160126
#--------------------------------------------------------------------------------------------------

# 如果有错误进入vi set ff=unix
export DB_NAME="casarover"
export DB_USER="root"
export DB_PASS=$1

if [ "$1"X == ""X ]
then
    echo "Warning: please input the mysql password. e.g. ./backup_db_pic.sh P@$$W0RD"
fi

cd /home/back
Now=$(date +"%Y%m%d%H%M%S")
File=backup$Now

mysqldump -u$DB_USER -p$DB_PASS $DB_NAME >$File.sql
echo "database backup success"
#据说这个占用cpu 如果有问题可以换用tar -cvf /home/back/ph.tar ./*
zip -r ./$File.zip /var/www/html/photo/
echo "photo backup success"
echo "backup file name is  "$File".sql"