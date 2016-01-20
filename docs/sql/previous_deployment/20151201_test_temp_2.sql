drop database if exists tempdb1;
create database tempdb1;
use tempdb1
create table if not exists tb_tmp(id smallint,val varchar(20));
insert into tb_tmp values (11,'wenda'),(22,'jason'),(33,'yunlong');
select * from tb_tmp;
