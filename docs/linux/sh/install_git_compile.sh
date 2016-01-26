#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160126
#Install Git environment on Aliyun.
#--------------------------------------------------------------------------------------------------
yum install curl
yum install curl-devel
yum install zlib-devel
yum install openssl-devel
yum install perl
yum install cpio
yum install expat-devel
yum install gettext-devel
wget http://distfiles.macports.org/git/git-2.1.1.tar.gz
tar xzvf git-2.1.1.tar.gz
#你的目录可能不是这个
cd git-2.1.1
autoconf
./configure
make
sudo make install
git --version
