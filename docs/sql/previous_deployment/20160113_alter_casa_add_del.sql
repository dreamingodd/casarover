use casarover;
alter table casa add column deleted smallint default 0 after min_price;