use casarover;

drop table if exists theme;
create table theme (
    id int not null auto_increment,
    name varchar(16) not null,
    description varchar(128) not null,
    
    primary key(id)
);
create table theme_content (
    
    primary key(id);
);