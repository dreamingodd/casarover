use casarover;
drop table if exists area_casa;
create table area_casa (
    id int primary key auto_increment,
    area_id bigint,
    casa_id bigint
);
alter table area_casa add constraint fk_reference_27 foreign key (area_id)
      references area_dictionary (id) on delete restrict on update restrict;
alter table area_casa add constraint fk_reference_28 foreign key (casa_id)
      references casa (id) on delete restrict on update restrict;

