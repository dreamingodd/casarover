
#Git related
#successive yums are not able to install except the first yum here
yum -y install curl-devel expat-devel gettext-devel openssl-devel zlib-devel
yum -y install git-core
git config --global user.name "Ye_WD"
git config --global user.email memorywilllast@sina.com

echo "Git installation completed."