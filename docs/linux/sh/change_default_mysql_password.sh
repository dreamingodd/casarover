#!/bin/bash
#--------------------------------------------------------------------------------------------------
#@auther dreamingodd(Ye, Wenda)
#@20160223
#Change the password of new installed mysql. (default password is null)
#Must restart mysqld service.
#--------------------------------------------------------------------------------------------------
use mysql;
update user set Password=PASSWORD('24') where User='root';