ALTER TABLE `tbl_client` ADD `szBusinessName` VARCHAR(100) NULL , ADD `szContactEmail` VARCHAR(100) NOT NULL , ADD `szContactPhone` VARCHAR(15) NOT NULL , ADD `szContactMobile` VARCHAR(15) NOT NULL , ADD UNIQUE (`szBusinessName`) ;=======
<--29 nov-->
ALTER TABLE `tbl_client` ADD `szNoOfSites` INT(5) NOT NULL AFTER `szContactMobile`;
ALTER TABLE `tbl_client` ADD UNIQUE(`szBusinessName`);