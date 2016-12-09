ALTER TABLE `tbl_client` ADD `szBusinessName` VARCHAR(100) NULL , ADD `szContactEmail` VARCHAR(100) NOT NULL , ADD `szContactPhone` VARCHAR(15) NOT NULL , ADD `szContactMobile` VARCHAR(15) NOT NULL , ADD UNIQUE (`szBusinessName`) ;=======
<--29 nov-->
ALTER TABLE `tbl_client` ADD `szNoOfSites` INT(5) NOT NULL AFTER `szContactMobile`;
ALTER TABLE `tbl_client` ADD UNIQUE(`szBusinessName`);

ALTER TABLE `ds_sites` CHANGE `psc_email` `psc_mobile` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `ssc_mobile` `ssc_phone` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `ssc_email` `ssc_mobile` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `ds_sos` CHANGE `Drugtestid` `Drugtestid` VARCHAR(15) NOT NULL;
ALTER TABLE `ds_sos` CHANGE `Drugtestid` `Drugtest` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
<--7 dec By shalini-->
ALTER TABLE `ds_user` CHANGE `iRole` `iRole` TINYINT(4) NOT NULL COMMENT '1:Franchisor,2:Franchisee,3:Parent Client,4:Child Client,5:Operation Manager';