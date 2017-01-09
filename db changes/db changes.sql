ALTER TABLE `ds_coc` ADD `devicesrno` VARCHAR( 100 ) NOT NULL ,
ADD `cutoff` VARCHAR( 50 ) NOT NULL ,
ADD `donwaittime` VARCHAR( 15 ) NOT NULL ,
ADD `dontest1` VARCHAR( 100 ) NOT NULL ,
ADD `dontesttime1` VARCHAR( 15 ) NOT NULL ,
ADD `dontest2` VARCHAR( 100 ) NOT NULL ,
ADD `dontesttime2` VARCHAR( 15 ) NOT NULL ,
ADD `donordecdate` DATETIME NOT NULL ,
ADD `donordecsign` VARCHAR( 255 ) NOT NULL ;

ALTER TABLE `ds_coc` CHANGE `donordecdate` `donordecdate` DATE NOT NULL ;