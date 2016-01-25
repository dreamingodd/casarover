#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160121
#Install/deploy casarover project, based on LAMP and Git.
#--------------------------------------------------------------------------------------------------

sys_time=`date "+%Y%m%d_%H%M%S"`
#Check input
if [ "$1"X == ""X ]
then
    echo "Error: Please input DB password, e.g. ./casarover_install.sh P@$$W0RD"
    exit 1
else
    echo "The password you input is "$1", if it's wrong, you have to change it in /var/www/html/casarover/application/model/constant.php"
fi
pwd=$1
if [ $1 == "null" ]
then
    pwd=""
fi
#refresh git folder
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
#deploy casarover
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
else
    mkdir photo
    mkdir cache
    chmod 777 photo
    chmod 777 cache
    cp /home/git/casarover/docs/linux/cache/*.json ./cache/
    cd /var/www/html/cache/
    chmod 777 ./*
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
echo "define('DB_PWD','"$1"');" >> /var/www/html/casarover/application/models/constant.php
echo "define('DB_NAME','casarover');" >> /var/www/html/casarover/application/models/constant.php
echo "?>" >> /var/www/html/casarover/application/models/constant.php

