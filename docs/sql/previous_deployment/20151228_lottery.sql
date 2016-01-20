use casarover;
create table lottery(
id bigint primary key auto_increment,
wechat_openid varchar(64) not null unique,
count_total smallint default 0,
count_today smallint default 0,
update_time datetime
);

create table reward(
id bigint primary key auto_increment,
wechat_openid varchar(64) not null unique,
cellphone varchar(64) not null,
reward_level smallint,
received smallint default 0,
update_time datetime
);
