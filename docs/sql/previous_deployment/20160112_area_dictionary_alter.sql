use casarover;
ALTER TABLE  `area_dictionary` ADD  `position` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER  `tier` ;
ALTER TABLE `area_dictionary` DROP `longitude`, DROP `latitude`;