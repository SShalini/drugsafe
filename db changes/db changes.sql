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

ALTER TABLE `ds_user` CHANGE `abn` `abn` BIGINT(12) NOT NULL;
ALTER TABLE `ds_orders` ADD `last_changed` DATETIME NOT NULL AFTER `createdon`;
ALTER TABLE `ds_orders` ADD `dispatched_price` DECIMAL( 10, 2 ) NOT NULL AFTER `price`;
ALTER TABLE `ds_orders` CHANGE `last_changed` `last_changed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

/*Shalni*/
ALTER TABLE `tbl_client` ADD `agentId` INT(11) NOT NULL AFTER `clientId`;

/* swapnil changes 08-02-2017*/
ALTER TABLE `tbl_manual_calc` ADD `dtCreatedOn` DATE NOT NULL AFTER `cancelfee`;

ALTER TABLE `tbl_manual_calc` ADD `dtUpdatedOn` DATE NOT NULL AFTER `dtCreatedOn`;

ALTER TABLE `tbl_manual_calc` ADD `dtUpdatedOn` DATE NOT NULL AFTER `dtCreatedOn`;
ALTER TABLE `ds_orders` CHANGE `status` `status` TINYINT( 1 ) NOT NULL DEFAULT '1';


/* swapnil changes 20-02-2017*/
ALTER TABLE `ds_user` CHANGE `szState` `userCode` VARCHAR(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `ds_user` ADD `reginolId` INT NOT NULL AFTER `userCode`;
CREATE TABLE `drugsafe`.`tbl_operation_state_maping` ( `id` INT NOT NULL AUTO_INCREMENT , `operationId` INT NOT NULL , `stateId` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/* swapnil changes 21-02-2017 */
INSERT INTO `tbl_states` (`id`, `name`, `country_id`) VALUES
(2, 'Australian Capital Territory', 101),
(3, 'New South Wales', 101),
(4, 'Northern Territory', 101),
(5, 'Queensland', 101),
(6, 'South Australia', 101),
(7, 'Tasmania', 101),
(8, 'Victoria', 101),
(9, 'Western Australia', 101);

CREATE TABLE `tbl_region` (
  `id` int(11) NOT NULL,
  `stateId` int(11) NOT NULL,
  `regionCode` int(11) NOT NULL,
  `regionName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `tbl_region` ADD PRIMARY KEY (`id`);
ALTER TABLE `tbl_region` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tbl_region` ADD `assign` TINYINT NOT NULL AFTER `regionName`;

CREATE TABLE IF NOT EXISTS `ds_agentmapping` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `franchiseeid` int(6) NOT NULL,
  `agentid` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 <!--swapnil 23-02-17 -->
CREATE TABLE `tbl_discount` (
  `id` int(11) NOT NULL,
  `percentage` int(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `tbl_discount` ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_discount` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ds_user` ADD `franchiseCide` INT(6) NOT NULL AFTER `regionId`;
ALTER TABLE `ds_user` CHANGE `franchiseCide` `franchiseCode` INT(6) NOT NULL;
ALTER TABLE `tbl_client` ADD `clientCode` INT(6) NOT NULL AFTER `clientType`;

CREATE TABLE IF NOT EXISTS `ds_corpfrmapping` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `corpfrid` int(6) NOT NULL,
  `franchiseeid` int(6) NOT NULL,
  `clientid` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `ds_user` ADD `franchiseetype` TINYINT(1) NOT NULL DEFAULT '0' AFTER `franchiseCode`;

ALTER TABLE `tbl_client` ADD `discountid` INT(6) NOT NULL AFTER `clientCode`;
ALTER TABLE `tbl_discount` CHANGE `percentage` `percentage` DECIMAL(5,2) NOT NULL;

INSERT INTO `tbl_states` (`id`, `name`, `country_id`) VALUES
(2, 'NSW/ACT', 101),
(3, 'VIC', 101),
(4, 'QLD', 101),
(5, 'SA', 101),
(6, 'WA', 101),
(7, 'TAS', 101),
(8, 'NT', 101);
ALTER TABLE `tbl_discount` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ds_user` ADD `franchiseCide` INT(50) NOT NULL AFTER `regionId`;
ALTER TABLE `ds_user` CHANGE `franchiseCide` `franchiseCode` INT(50) NOT NULL;

ALTER TABLE `tbl_prospect` ADD `szCreatedBy` INT(11) NOT NULL AFTER `dt_last_updated_meeting`;

ALTER TABLE `tbl_prospect` ADD `L_G_Channel` VARCHAR(15) NOT NULL AFTER `status`, ADD `szNoOfSites` INT(11) NOT NULL AFTER `L_G_Channel`;
ALTER TABLE `tbl_prospect` ADD `dt_last_updated_status` DATETIME NOT NULL AFTER `szCreatedBy`;
ALTER TABLE `tbl_prospect` CHANGE `L_G_Channel` `L_G_Channel` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `tbl_prospect` ADD `szState` INT( 4 ) NOT NULL AFTER `szAddress` ;
ALTER TABLE `tbl_prospect` ADD `clientcreated` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `dt_last_updated_status` ;

UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szEmail,<br/>Your request for creating new password is Accepted.Please use temporary Password for login.<br/><br/>szLink<br/><br/><br/><br/>Kind regards,<br/>Drug Safe Communities</p></p>' WHERE `tbl_email_cms`.`id` = 1;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 2;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug Safe Communities !<br /> <br/> <br/> <br/> Please click on the link to login in to Drug Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 3;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear Admin, <br /> <br /> <br /> <br /> <br /> szName Send a Request for Quantity,<br /> <br/> <br/> <br/> Here is all the detailed data send by him : <br/><br/> Product Name - szProductCode <br/> Requested Quantity - szQuantity <br/><br/> You can assign Product on clicking this url. <br/> <br/> szHttpsLink <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 4;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 5;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug Safe Communities : <br/><br/> Link<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 6;
UPDATE `tbl_email_cms` SET `sectionDescription` = ' <br/> <br />  Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 7;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug Safe Communities!<br /> <br/> <br/> <br/> You can login on drugsafe app with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 8;

UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> You can login on drugsafe app with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 8;
UPDATE `tbl_email_cms` SET `sectionDescription` = ' <br/> <br />  Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 7;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug-Safe Communities : <br/><br/> Link<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 6;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug-Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 5;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear Admin, <br /> <br /> <br /> <br /> <br /> szName Send a Request for Quantity,<br /> <br/> <br/> <br/> Here is all the detailed data send by him : <br/><br/> Product Name - szProductCode <br/> Requested Quantity - szQuantity <br/><br/> You can assign Product on clicking this url. <br/> <br/> szHttpsLink <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 4;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities !<br /> <br/> <br/> <br/> Please click on the link to login in to Drug-Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 3;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> Please click on the link to login in to Drug-Safe Communities : <br/><br/> Link <br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 2;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szEmail,<br/>Your request for creating new password is Accepted.Please use temporary Password for login.<br/><br/>szLink<br/><br/><br/><br/>Kind regards,<br/>Drug-Safe Communities</p></p>' WHERE `tbl_email_cms`.`id` = 1;
ALTER TABLE `ds_orders` ADD `isReceived` TINYINT(1) NOT NULL AFTER `validorder`;

ALTER TABLE `ds_sos` ADD `sign1` TINYINT( 1 ) NOT NULL ,
ADD `sign2` TINYINT( 1 ) NOT NULL ;
ALTER TABLE `ds_coc` ADD `signcoc1` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `signcoc2` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `signcoc3` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `signcoc4` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `signcoc5` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `signcoc6` TINYINT( 1 ) NOT NULL DEFAULT '0';
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'Agent/Employee New Password Email', '__NEW_PASSWORD_FOR_AGENT/EMP__', 'Agent/Employee New Password ', '<p>Dear szName,<br/>Your Password has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'Client New Email', '__NEW_EMAIL_FOR_CLIENT__', 'Client New Email', '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
ALTER TABLE `ds_doner` ADD `otherdrug` VARCHAR( 255 ) NOT NULL AFTER `drug` ;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br />ssKind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 10;
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'Operation Manager New Email', '__NEW_EMAIL_FOR_OPERATION_MANAGER__', 'Operation Manager New Email', '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br />ssKind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'Franchisee New Email', '__NEW_EMAIL_FOR_FRANCHISEE__', 'Franchisee New Email', '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br />ssKind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'Site New Email', '__NEW_EMAIL_FOR_SITE__', 'Site New Email', '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br />ssKind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_email_cms` (`id`, `szFriendlyName`, `sectionTitle`, `subject`, `sectionDescription`, `iActive`, `atCreatedOn`, `atUpdatedOn`) VALUES (NULL, 'AgentNew Email', '__NEW_EMAIL_FOR_AGENT__', 'Agent New Email', '<p>Dear szName,<br/>Your Email has been changed successfully.<br/><br/> You can login with following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br />ssKind regards,<br /> Drug-Safe Communities.</p>', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> You can login on Drug-Safe Communities Mobile Application with the following login details. <br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 8;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities!<br /> <br/> <br/> <br/> You can login on Drug-Safe Communities Mobile Application with the following login details.<br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 6;
UPDATE `tbl_email_cms` SET `sectionDescription` = '<p>Dear szName, <br /> <br /> <br /> <br /> <br /> Welcome to Drug-Safe Communities !<br /> <br/> <br/> <br/> You can login on Drug-Safe Communities Mobile Application with the following login details.<br/> <br/> Email - szEmail <br/> Password - szPassword <br/> <br /> Kind regards,<br /> Drug-Safe Communities.</p>' WHERE `tbl_email_cms`.`id` = 3;