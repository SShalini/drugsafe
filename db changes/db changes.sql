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
ALTER TABLE `fo_data` CHANGE `szForumDiscription` `szForumDiscription` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `tbl_manual_calc` ADD `sosid` INT(6) NOT NULL AFTER `id`;
ALTER TABLE `tbl_manual_calc` DROP `mobileScreen`, DROP `travel`;
ALTER TABLE `tbl_manual_calc` ADD `mobileScreenBasePrice` INT NOT NULL AFTER `RtwScrenning`;
ALTER TABLE `tbl_manual_calc` ADD `mobileScreenHr` INT NOT NULL AFTER `mobileScreenBasePrice`;
ALTER TABLE `tbl_manual_calc` ADD `travelBasePrice` INT NOT NULL AFTER `mobileScreenHr`, ADD `travelHr` INT NOT NULL AFTER `travelBasePrice`;
ALTER TABLE `fo_cmnt` ADD `isAdminApproved` TINYINT NOT NULL AFTER `isApproved`;
ALTER TABLE `ds_sos` CHANGE `RepresentativeSignatureTime` `RepresentativeSignatureTime` VARCHAR( 15 ) NOT NULL ;

ALTER TABLE `ds_sos` CHANGE `TotalDonarScreeningUrine` `TotalDonarScreeningUrine` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `TotalDonarScreeningOral` `TotalDonarScreeningOral` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `ExtraUsed` `ExtraUsed` VARCHAR( 150 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `NegativeResultUrine` `NegativeResultUrine` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `NegativeResultOral` `NegativeResultOral` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `FurtherTestUrine` `FurtherTestUrine` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `FurtherTestOral` `FurtherTestOral` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `TotalAlcoholScreening` `TotalAlcoholScreening` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `NegativeAlcohol` `NegativeAlcohol` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `PositiveAlcohol` `PositiveAlcohol` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `ds_sos` CHANGE `Refusals` `Refusals` DECIMAL( 10, 2 ) NOT NULL ;

ALTER TABLE `ds_orders` ADD `validorder` TINYINT(1) NOT NULL AFTER `XeroIDnumber`;
ALTER TABLE `tbl_product` CHANGE `szProductCost` `szProductCost` DECIMAL(10,2) NOT NULL;
ALTER TABLE `ds_orders` CHANGE `paidon` `completedon` DATETIME NOT NULL;

CREATE TABLE IF NOT EXISTS `ds_usedsoskit` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `prodid` int(11) NOT NULL,
  `sosid` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `used` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE `ds_sos` ADD `collsign` VARCHAR(255) NOT NULL AFTER `Comments`;
ALTER TABLE `ds_coc` ADD `lastweekq` VARCHAR( 255 ) NOT NULL AFTER `idnumber` ;

ALTER TABLE `ds_sos` CHANGE `TotalDonarScreeningUrine` `TotalDonarScreeningUrine` VARCHAR( 10 ) NOT NULL ,
CHANGE `TotalDonarScreeningOral` `TotalDonarScreeningOral` VARCHAR( 10 ) NOT NULL ,
CHANGE `NegativeResultUrine` `NegativeResultUrine` VARCHAR( 10 ) NOT NULL ,
CHANGE `NegativeResultOral` `NegativeResultOral` VARCHAR( 10 ) NOT NULL ,
CHANGE `FurtherTestUrine` `FurtherTestUrine` VARCHAR( 10 ) NOT NULL ,
CHANGE `FurtherTestOral` `FurtherTestOral` VARCHAR( 10 ) NOT NULL ,
CHANGE `TotalAlcoholScreening` `TotalAlcoholScreening` VARCHAR( 10 ) NOT NULL ,
CHANGE `NegativeAlcohol` `NegativeAlcohol` VARCHAR( 10 ) NOT NULL ,
CHANGE `PositiveAlcohol` `PositiveAlcohol` VARCHAR( 10 ) NOT NULL ,
CHANGE `Refusals` `Refusals` VARCHAR( 10 ) NOT NULL ;

ALTER TABLE `tbl_product` ADD `szAvailableQuantity` INT(6) NOT NULL AFTER `szProductDiscription`;

ALTER TABLE `tbl_manual_calc` ADD `fcobp` DECIMAL( 10, 2 ) NOT NULL AFTER `travelType` ,
ADD `fcohr` INT( 2 ) NOT NULL AFTER `fcobp` ,
ADD `mcbp` DECIMAL( 10, 2 ) NOT NULL AFTER `fcohr` ,
ADD `mchr` INT( 2 ) NOT NULL AFTER `mcbp` ,
ADD `cobp` DECIMAL( 10, 2 ) NOT NULL AFTER `mchr` ,
ADD `cohr` INT( 2 ) NOT NULL AFTER `cobp` ,
ADD `labconf` DECIMAL( 10, 2 ) NOT NULL AFTER `cohr` ,
ADD `cancelfee` DECIMAL( 10, 2 ) NOT NULL AFTER `labconf` ;

ALTER TABLE `tbl_manual_calc` CHANGE `urineNata` `urineNata` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `nataLabCnfrm` `nataLabCnfrm` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `oralFluidNata` `oralFluidNata` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `SyntheticCannabinoids` `SyntheticCannabinoids` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `labScrenning` `labScrenning` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `RtwScrenning` `RtwScrenning` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `mobileScreenBasePrice` `mobileScreenBasePrice` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `mobileScreenHr` `mobileScreenHr` INT( 2 ) NOT NULL ,
CHANGE `travelBasePrice` `travelBasePrice` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `travelType` `travelType` INT( 2 ) NOT NULL ;


ALTER TABLE `tbl_client` ADD `industry` VARCHAR(100) NOT NULL AFTER `szNoOfSites`;
ALTER TABLE `tbl_client` ADD `abn` bigint(15) NOT NULL AFTER `industry`;



ALTER TABLE `ds_user` ADD `abn` BIGINT(15) NOT NULL AFTER `szName`;

ALTER TABLE `tbl_client` ADD `industry` VARCHAR(100) NOT NULL AFTER `szNoOfSites`;
ALTER TABLE `tbl_client` ADD `abn` VARCHAR(100) NOT NULL AFTER `industry`;



ALTER TABLE `ds_user` ADD `abn` VARCHAR(100) NOT NULL AFTER `szName`;