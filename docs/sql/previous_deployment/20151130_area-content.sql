use casarover;
CREATE TABLE area_content (
id bigint primary key auto_increment,
area_id bigint not null,
content_id bigint not null
);
alter table area_content add constraint fk_reference_17 foreign key (area_id)
      references area_dictionary (id) on delete restrict on update restrict;
alter table area_content add constraint fk_reference_18 foreign key (content_id)
      references content (id) on delete restrict on update restrict;
alter table area_dictionary add column tier tinyint;
alter table area_dictionary add column longitude double;
alter table area_dictionary add column latitude double;
alter table content change back1 type varchar(16);