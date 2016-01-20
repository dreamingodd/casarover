/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2015/9/26 15:54:01                           */
/*==============================================================*/


drop database if exists casarover;

create database casarover CHARACTER SET utf8;

use casarover;

/*==============================================================*/
/* Database: casarover                                          */
/*==============================================================*/

/*==============================================================*/
/* Table: activity_register                                     */
/*==============================================================*/
create table activity_register
(
   id                   bigint not null auto_increment,
   username             varchar(64) not null,
   activity_name        varchar(128) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: area_dictionary                                       */
/*==============================================================*/
create table area_dictionary
(
   id                   bigint not null auto_increment,
   value                varchar(64),
   parentid             bigint,
   level                int,
   islast               int,
   type                 int,
   update_time          datetime,
   status               int,
   tier                 tinyint,
   longitude            double,
   latitude             double,
   primary key (id)
)DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: attachment                                            */
/*==============================================================*/
create table attachment
(
   id                   bigint not null auto_increment,
   type                 varchar(32),
   name                 varchar(64),
   comment              text,
   score                bigint,
   update_time          datetime,
   filepath             varchar(1024),
   status               int,
   primary key (id)
);

/*==============================================================*/
/* Table: brief                                                 */
/*==============================================================*/
create table brief
(
   id                   bigint not null auto_increment,
   casa_id              bigint,
   name                 varchar(64),
   body                 text,
   pic                  bigint,
   update_time          datetime,
   status               int,
   primary key (id)
);

/*==============================================================*/
/* Table: casa                                                  */
/*==============================================================*/
create table casa
(
   id                   bigint not null auto_increment,
   dictionary_id        bigint,
   attachment_id        bigint,
   user_id              bigint,
   code                 varchar(64) unique,
   name                 varchar(64),
   resume               text,
   praise_num           bigint default 0,
   favourite_num        bigint default 0,
   score                double default 0,
   max_price            double default 0,
   min_price            double default 0,
   update_time          datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: casa_tag                                              */
/*==============================================================*/
create table casa_tag
(
   id                   bigint not null auto_increment,
   casa_id              bigint not null,
   tag_id               bigint,
   primary key (id)
);

/*==============================================================*/
/* Table: comment                                               */
/*==============================================================*/
create table comment
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   parentid             bigint,
   value                varchar(64),
   update_time          datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: content                                               */
/*==============================================================*/
create table content
(
   id                   bigint not null auto_increment,
   casa_id              bigint,
   name                 varchar(64),
   text                 text,
   display_order        int,
   type                varchar(16),
   update_time          datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: content_attachment                                    */
/*==============================================================*/
create table content_attachment
(
   id                   bigint not null auto_increment,
   attachment_id        bigint,
   content_id           bigint,
   primary key (id)
);

/*==============================================================*/
/* Table: favourite                                             */
/*==============================================================*/
create table favourite
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   casa_id              bigint,
   favovrite_type       int,
   update_time          datetime,
   status               int,
   primary key (id)
);

/*==============================================================*/
/* Table: log                                                   */
/*==============================================================*/
create table log
(
   id                   bigint not null auto_increment,
   user_id              bigint,
   date                 datetime not null,
   class                varchar(64),
   method               varchar(64),
   text                 text,
   primary key (id)
);

/*==============================================================*/
/* Table: status                                                */
/*==============================================================*/
create table status
(
   id                   int,
   name                 varchar(64)
);

/*==============================================================*/
/* Table: tag                                                   */
/*==============================================================*/
create table tag
(
   id                   bigint not null auto_increment,
   name                 varchar(64) not null,
   type                 varchar(64),
   update_time          datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: theme                                                 */
/*==============================================================*/
create table theme
(
   id                   bigint not null auto_increment,
   name                 varchar(64),
   description          text,
   status               int,
   primary key (id)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   id                   bigint not null auto_increment,
   dictionary_id        bigint,
   attachment_id        bigint,
   dicid                bigint,
   name                 varchar(16) not null,
   pwd                  varchar(128) not null,
   resume               varchar(64),
   qq                   varchar(64),
   phone                varchar(32) unique,
   webchat              varchar(64),
   email                varchar(64),
   token                varchar(64),
   photofileid          bigint,
   birthday             datetime,
   update_time          datetime,
   logout_time          datetime,
   status               int,
   primary key (id)
);
CREATE TABLE area_content (
id bigint primary key auto_increment,
area_id bigint not null,
content_id bigint not null
);

alter table brief add constraint fk_reference_4 foreign key (casa_id)
      references casa (id) on delete restrict on update restrict;

alter table casa add constraint fk_reference_10 foreign key (attachment_id)
      references attachment (id) on delete restrict on update restrict;

alter table casa add constraint fk_reference_11 foreign key (user_id)
      references user (id) on delete restrict on update restrict;

alter table casa add constraint fk_reference_8 foreign key (dictionary_id)
      references area_dictionary (id) on delete restrict on update restrict;

alter table casa_tag add constraint FK_Reference_12 foreign key (casa_id)
      references casa (id) on delete restrict on update restrict;

alter table casa_tag add constraint FK_Reference_13 foreign key (tag_id)
      references tag (id) on delete restrict on update restrict;

alter table comment add constraint fk_reference_7 foreign key (user_id)
      references user (id) on delete restrict on update restrict;

alter table content add constraint FK_Reference_14 foreign key (casa_id)
      references casa (id) on delete restrict on update restrict;

alter table content_attachment add constraint FK_Reference_15 foreign key (content_id)
      references content (id) on delete restrict on update restrict;

alter table content_attachment add constraint FK_Reference_16 foreign key (attachment_id)
      references attachment (id) on delete restrict on update restrict;

alter table favourite add constraint fk_reference_2 foreign key (user_id)
      references user (id) on delete restrict on update restrict;

alter table favourite add constraint fk_reference_3 foreign key (casa_id)
      references casa (id) on delete restrict on update restrict;

alter table log add constraint fk_reference_1 foreign key (user_id)
      references user (id) on delete restrict on update restrict;

alter table user add constraint fk_reference_5 foreign key (dictionary_id)
      references area_dictionary (id) on delete restrict on update restrict;

alter table user add constraint fk_reference_6 foreign key (attachment_id)
      references attachment (id) on delete restrict on update restrict;

alter table area_content add constraint fk_reference_17 foreign key (area_id)
      references area_dictionary (id) on delete restrict on update restrict;

alter table area_content add constraint fk_reference_18 foreign key (content_id)
      references content (id) on delete restrict on update restrict;

insert into status values(0, 'INACTIVE');
insert into status values(1, 'ACTIVE');
insert into status values(2, 'DELETED');
insert into status values(3, 'HOMEPAGE');

insert into user(name,pwd) values('wendaye',md5('1111'));
insert into user(name,pwd) values('wenqianxu',md5('1111'));
insert into user(name,pwd) values('zenghuizhou',md5('1111'));
insert into user(name,pwd) values('liwang',md5('1111'));
insert into user(name,pwd) values('xiachen',md5('1111'));
insert into user(name,pwd) values('junjielian',md5('1111'));
insert into user(name,pwd) values('tom_dawn',md5('1111'));
insert into user(name,pwd) values('phil_hellmuth',md5('1111'));
insert into user(name,pwd) values('phil_ivey',md5('1111'));
insert into user(name,pwd) values('daniel_negreanu',md5('1111'));
insert into user(name,pwd) values('johnny_chan',md5('1111'));
insert into user(name,pwd) values('antonio_esfandiari',md5('1111'));

insert into tag(id, name, type, update_time) values(null, '文艺清新', '情怀', now());
insert into tag(id, name, type, update_time) values(null, '小资情调', '情怀', now());
insert into tag(id, name, type, update_time) values(null, '青葱岁月', '情怀', now());
insert into tag(id, name, type, update_time) values(null, '古朴禅韵', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '欧式古典', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '中式田园', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '简约淳朴', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '古堡神秘', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '海岛风情', '建筑风格', now());
insert into tag(id, name, type, update_time) values(null, '乡村田园', '内饰风格', now());
insert into tag(id, name, type, update_time) values(null, '少女情怀', '内饰风格', now());
insert into tag(id, name, type, update_time) values(null, '冬季恋歌', '季节主题', now());

/*====================================================================================*/
/*仅仅加入浙江省和上海市*/
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (1, '中国', 0,1,0,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (2, '上海', 1,2,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (3, '朱家角', 2,3,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (4, '黄浦区', 2,3,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (5, '其他', 2,3,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (6, '浙江', 1,2,0,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (7, '杭州', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (8, '白乐桥', 7,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (9, '四眼井', 7,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (10, '满觉陇', 7,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (11, '青芝坞', 7,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (12, '其他', 7,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (13, '嘉兴', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (14, '西塘', 13,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (15, '乌镇', 13,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (16, '南湖景区', 13,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (17, '其他', 13,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (18, '湖州', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (19, '莫干山', 18,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (21, '筏头乡', 18,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (22, '劳岭村', 18,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (23, '安吉', 18,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (24, '其他', 18,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (25, '绍兴', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (27, '越城区', 25,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (28, '诸暨', 25,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (29, '鲁迅故里', 25,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (30, '其他', 25,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (31, '宁波', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (32, '东湖', 31,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (33, '象山', 31,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (34, '其他', 31,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (35, '金华', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (36, '横店', 35,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (37, '磐安县', 35,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (38, '其他', 35,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (39, '舟山', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (40, '朱家尖', 39,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (41, '桃花岛', 39,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (42, '嵊泗', 39,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (43, '普陀山', 39,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (44, '其他', 39,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (45, '衢州', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (46, '烂柯山风景区', 45,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (47, '衢江区', 45,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (48, '其他', 45,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (49, '丽水', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (50, '古堰画乡', 49,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (51, '莲都区', 49,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (52, '其他', 49,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (53, '温州', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (54, '洞头', 53,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (55, '雁荡山', 53,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (56, '永嘉', 53,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (57, '其他', 53,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (58, '台州', 6,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (59, '仙居', 58,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (60, '黄岩', 58,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (61, '石塘', 58,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (62, '其他', 58,4,1,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (63, '江苏', 1,2,0,0,now(),0);

INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (64, '苏州', 63,3,0,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (65, '周庄', 64,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (66, '同里', 64,4,1,0,now(),0);
INSERT INTO area_dictionary (id,value,parentid,level,islast,type,update_time,status) VALUES (67, '其他', 64,4,1,0,now(),0);

-- Admin user
insert into user (name, pwd, phone, type) values ('admin', md5('P@$$W0RD_xwqzm'), 'admin', 'Admin');

set names gbk;

