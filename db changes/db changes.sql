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

ALTER TABLE `ds_coc` ADD `commentscol1` VARCHAR( 255 ) NOT NULL AFTER `collectorsignone` ;
ALTER TABLE `fo_category` CHANGE `szDiscription` `szDiscription` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `fo_category` CHANGE `szName` `szName` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `fo_cmnt` CHANGE `szCmnt` `szCmnt` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `fo_reply` CHANGE `szReply` `szReply` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `fo_topic` CHANGE `szTopicTitle` `szTopicTitle` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;