ALTER TABLE `tbl_stock_assign_tracking` ADD `quantityDeducted` INT NOT NULL AFTER `szQuantityAssigned`;
<--29 nov-->
ALTER TABLE `tbl_client` ADD `szNoOfSites` INT(5) NOT NULL AFTER `szContactMobile`;