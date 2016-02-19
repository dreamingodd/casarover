use casarover;

alter table wechat_article add column series smallint default 0 after type;

drop table if exists wechat_series;
create table wechat_series (
id smallint primary key auto_increment,
type smallint default 0,
name varchar(16) not null
);

insert into wechat_series values(null, 2, '探庐·临安');
insert into wechat_series values(null, 2, '探庐·莫干山');

#synchonize the data wechat_article and wechat_series.
update wechat_article set series=1 where title like '%探庐·临安%';
update wechat_article set series=2 where title like '%探庐·莫干山%';