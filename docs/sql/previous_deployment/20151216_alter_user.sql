use casarover;

alter table user add column gender smallint default 0 after pwd;
alter table user add column type varchar(16) default 'Phone' after gender;
alter table user add column qq_openid varchar(64) after type;
alter table user add column wechat_openid varchar(64) after qq_openid;

