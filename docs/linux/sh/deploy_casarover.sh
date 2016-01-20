#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(YeWenda)
#@20151202
#This sh is used for casarover project deployment on Aliyun linux server.
#--------------------------------------------------------------------------------------------------

#variables
project="casarover"
project_path="/var/www/html/"
zip_path="/tmp/"
back_path="/home/back/"
#get sys time
sys_time=`date "+%Y%m%d_%H%M%S"`

#start to deploy
##unzip zip file
if [ -f ${zip_path}${project}.zip ]
then
    ##unzip zip file
    unzip ${zip_path}${project}.zip -d ${zip_path}
    ##move current project to backup folder
    mv ${project_path}${project} ${back_path}${project}.${sys_time}
    ##move new project to deployment folder
    mv ${zip_path}${project}_temp ${project_path}${project}
    ##change mysql password(move mysql constant.php to replace the dev constant.php)
    cp ${back_path}constant.php ${project_path}${project}/application/models/constant.php
    ##execute mysql update sql files
    if [ -f ${project_path}${project}/application/models/sql/deployment/*.sql ]
    then
        for FILE in ${project_path}${project}/application/models/sql/deployment/*.sql
        do
           mysql -uroot -pAa123456 -e "source $FILE" | tee /tmp/mysql_tmp.sql
        done
    fi
    ##remove zip file
    rm ${zip_path}${project}.zip
    ##write file access
    chmod -R 777 /var/www/html/casarover/website/wechat/\

else
    echo "Zip file not found!"
fi