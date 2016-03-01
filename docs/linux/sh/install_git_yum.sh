#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160120
#Install git.
#@20160223
#This shell may run failed, if so, you will have to run it line by line.
#--------------------------------------------------------------------------------------------------

yum -y install git-core
git config --global user.name "Ye_WD"
git config --global user.email memorywilllast@sina.com

echo "Git installation completed."