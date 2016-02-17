#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160121~28
#Install/deploy casarover project, based on LAMP and Git.
#--------------------------------------------------------------------------------------------------

sys_time=`date "+%Y%m%d_%H%M%S"`
#Check input
if [ "$1"X == ""X ]
then
    echo "Warning: Please input DB password, e.g. ./casarover_install.sh P@$$W0RD"
else
    echo "If the MySQL password is wrong, you have to change it in /var/www/html/casarover/application/model/constant.php"
fi
pwd=$1

#Refresh git folder
if [ -d /home/git ]
then
    echo "Git folder exists."
    cd /home/git/casarover
    git pull
else
    mkdir /home/git
    echo "created Git folder"
    cd /home/git
    git clone https://github.com/dreamingodd/casarover.git
fi

#Deploy casarover
cd /var/www/html/
if [ -d /var/www/html/casarover ]
then
    echo "Casarover exists."
    if [ -d /home/back ]
    then
        echo "Backup folder exists."
    else
        mkdir /home/back
    fi
    mv /var/www/html/casarover /home/back/casarover_${sys_time}
    mkdir /var/www/html/casarover
else
    if [ ! -d "/photo" ]
    then
        mkdir photo
        chmod 777 photo
    fi
    if [ ! -d "/cache" ]
    then
        mkdir cache
        chmod 777 cache
        cp /home/git/casarover/docs/linux/cache/*.json ./cache/
        cd /var/www/html/cache/
        chmod 777 ./*
    fi
    cd /var/www/html/
    mkdir casarover
    cp /home/git/casarover/docs/linux/config/index.html /var/www/html/index.html
    echo "Casarover folders and files are created."
fi
cd casarover
cp -r /home/git/casarover/application/ ./application
cp -r /home/git/casarover/website/ ./website
#Change DB password
mv /var/www/html/casarover/application/models/constant.php /var/www/html/casarover/application/models/constant.php.back
echo "<?php" >> /var/www/html/casarover/application/models/constant.php
echo "define('DB_HOST','localhost');" >> /var/www/html/casarover/application/models/constant.php
echo "define('DB_USER','root');" >> /var/www/html/casarover/application/models/constant.php
echo "define('DB_PWD','"${pwd}"');" >> /var/www/html/casarover/application/models/constant.php
echo "define('DB_NAME','casarover');" >> /var/www/html/casarover/application/models/constant.php
echo "?>" >> /var/www/html/casarover/application/models/constant.php

#Mysql script deployment
if [ -f /home/git/casarover/docs/sql/deployment/*.sql ]
then
    for FILE in /home/git/casarover/docs/sql/deployment/*.sql
    do
       mysql -uroot -p${pwd} -e "source $FILE" | tee /tmp/mysql_tmp.sql
    done
fi


