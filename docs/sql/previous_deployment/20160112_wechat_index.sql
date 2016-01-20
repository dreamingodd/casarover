use casarover;
drop table if exists wechat_article;
create table wechat_article (
    id bigint auto_increment primary key,
    attachment_id bigint,
    title varchar(64),
    brief text,
    address varchar(10240),
    type smallint default 0, /*1：民宿推荐，2：民宿杂谈*/
    deleted smallint default 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
alter table wechat_article add constraint fk_reference_19 foreign key (attachment_id)
      references attachment (id) on delete restrict on update restrict;

/*所有表改为InnoDB*/
/*执行结果*/
/*SELECT GROUP_CONCAT(CONCAT( 'ALTER TABLE ' ,TABLE_NAME ,' ENGINE=InnoDB; ') SEPARATOR '' )
FROM information_schema.TABLES AS t
WHERE TABLE_SCHEMA = 'casarover' AND TABLE_TYPE = 'BASE TABLE';*/
ALTER TABLE activity_register ENGINE=INNODB; ALTER TABLE area_content ENGINE=INNODB; ALTER TABLE area_dictionary ENGINE=INNODB; ALTER TABLE attachment ENGINE=INNODB; ALTER TABLE casa ENGINE=INNODB; ALTER TABLE casa_tag ENGINE=INNODB; ALTER TABLE comment ENGINE=INNODB; ALTER TABLE content ENGINE=INNODB; ALTER TABLE content_attachment ENGINE=INNODB; ALTER TABLE favourite ENGINE=INNODB; ALTER TABLE log ENGINE=INNODB; ALTER TABLE lottery ENGINE=INNODB; ALTER TABLE reward ENGINE=INNODB; ALTER TABLE STATUS ENGINE=INNODB; ALTER TABLE tag ENGINE=INNODB; ALTER TABLE theme ENGINE=INNODB; ALTER TABLE user ENGINE=INNODB; ALTER TABLE wechat_article ENGINE=INNODB; 

