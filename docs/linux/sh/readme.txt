环境搭建的运行顺序：
需要拷贝到linux：
1.install_git.sh : git-core失败则手动运行yum -y install git-core，删除脚本里的yum命令，再跑一次配置git
2.install_lamp.sh : mysql启动失败则将/etc/init.d/mysqld 第23行/etc/sysconfig/network  => /etc/sysconfig/network-scripts/ifcfg-XXX文件 (ifcfg-lo)
3.deploy_by_git.sh