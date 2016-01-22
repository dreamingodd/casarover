#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160121
#Install casarover project, based on LAMP and Git.
#--------------------------------------------------------------------------------------------------

#Check input
if [ "$1"X == ""X ]
then
    echo "Error: Please input DB password, e.g. ./casarover_install.sh P@$$W0RD"
    exit 1
else
    echo "The password you input is "$1", if it's wrong, you have to change it in /var/www/html/casarover/application/model/constant.php"
fi
pwd=$1
#deploy casarover
#if [ -d /home/git ]
#then
#    echo "Git folder exists."
#else
#    mkdir /home/git
#fi
#cd /home/git
#git clone https://github.com/dreamingodd/casarover.git
cd /var/www/html/
mkdir photo
mkdir cache
chmod 777 photo
chmod 777 cache
cp /home/git/casarover/docs/linux/cache/*.json ./cache/
cd /var/www/html/cache/
chmod 777 ./*
mkdir casarover
cd casarover
cp /home/git/casarover/application/ ./application
cp /home/git/casarover/website/ ./website
cp /home/git/casarover/docs/config/index.html ./
#Change DB password
mv /var/www/html/casarover/application/models/constant.php /var/www/html/casarover/application/models/constant.php.back
echo "<?php" >> /home/git/casarover/application/models/constant.php
echo "define('DB_HOST','localhost');" >> /home/git/casarover/application/models/constant.php
echo "define('DB_USER','root');" >> /home/git/casarover/application/models/constant.php
echo "define('DB_PWD','"$1"');" >> /home/git/casarover/application/models/constant.php
echo "define('DB_NAME','casarover');" >> /home/git/casarover/application/models/constant.php
echo "?>" >> /home/git/casarover/application/models/constant.php

