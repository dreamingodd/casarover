use casarover;
CREATE TABLE  activity_youyuan(
`id` INT NOT NULL primary key auto_increment,
`openid` VARCHAR( 64 ) NOT NULL unique,
`phone` VARCHAR( 16 ) NOT NULL unique,
`orderid` VARCHAR( 128 )  unique,
`status` TINYINT default 0
)