use casarover;

alter table user change column qq_openid qq_openid varchar(64) unique;
alter table user change column wechat_openid wechat_openid varchar(64) unique;