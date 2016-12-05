<div class="page-content-wrapper">
    <div class="page-content">
        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo __BASE_URL__;?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <?php
                     if($_SESSION['drugsafe_user']['iRole']=='1')
                    {
                        ?>
                       <li>
                           <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                           <i class="fa fa-circle"></i>
                       </li>
                        <?php

                    }
                    ?>

                    <?php if(!empty($clientChildDetailsAray)){?>
                        <li>
                            <a onclick="viewClientDetails(<?php echo $clientChildDetailsAray['id'];?>);" href="javascript:void(0);"><?php echo $clientChildDetailsAray['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                    <?php } ?>
                    <li>
                        <a onclick="viewClientDetails(<?php echo $clientDetailsAray['id'];?>);" href="javascript:void(0);"><?php echo $clientDetailsAray['szName'];?></a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                         <?php  if(empty($_POST['clientData']['clientType'])){?>
                            <span class="active">Edit Client</span>
                              <?php } else {?>
                         <span class="active">Edit Site</span>
                                <?php }?>

                    </li>

                </ul>
                   
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <?php  if(empty($_POST['clientData']['clientType'])){?>
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit Client</span>
                          <?php } else {?>
                     <span class="caption-subject font-red-sunglo bold uppercase">Edit Site</span>
                            <?php }?>

                    </div>
                    <!--<div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php /*echo base_url();*/?>franchisee/clientList');">
                                &nbsp;Client List
                            </button>
                        </div>
                    </div>-->
                </div>

                <div class="portlet-body">

                    <form class="form-horizontal" id="clientData" action="<?=__BASE_URL__?>/franchisee/editClient" name="clientData" method="post">
                        <div class="form-body">

                             <?php 
                             if(empty($_POST['clientData']['clientType'])){?>
                             <div class="form-group <?php if(!empty($arErrorMessages['szBusinessName'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Business Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szBusinessName" class="form-control" type="text" value="<?php echo $_POST['clientData']['szBusinessName'] ;?>" placeholder="Business Name" onfocus="remove_formError(this.id,'true')" name="clientData[szBusinessName]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szBusinessName'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szBusinessName'];?>
                                    </span>
                                    <?php }?>
                                </div>


                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szName'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szName" class="form-control" type="text" value="<?php echo $_POST['clientData']['szName'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[szName]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szName'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szName'];?>
                                    </span>
                                    <?php }?>
                                </div>


                            </div>

                            <div class="form-group <?php if(!empty($arErrorMessages['szEmail'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Primary Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szEmail" class="form-control" type="text" value="<?php echo $_POST['clientData']['szEmail'] ;?>" placeholder="Primary Email" onfocus="remove_formError(this.id,'true')" name="clientData[szEmail]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['szEmail'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szEmail'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szContactNumber'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Primary Phone</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szContactNumber" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactNumber'] ;?>" placeholder="Primary Phone" onfocus="remove_formError(this.id,'true')" name="clientData[szContactNumber]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szContactNumber'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szContactNumber'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                             <div class="form-group <?php if(!empty($arErrorMessages['szNoOfSites'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">No Of Sites</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szNoOfSites" class="form-control" type="text" value="<?php echo $_POST['clientData']['szNoOfSites'] ;?>" placeholder="No Of Sites" onfocus="remove_formError(this.id,'true')" name="clientData[szNoOfSites]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szNoOfSites'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szNoOfSites'];?>
                                    </span>
                                <?php }?>
                                </div>
                            </div>
                            <?php } else{?>
                             <div class="form-group <?php if(!empty($arErrorMessages['szName'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Company Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szName" class="form-control" type="text" value="<?php echo $_POST['clientData']['szName'] ;?>" placeholder="Company Name" onfocus="remove_formError(this.id,'true')" name="clientData[szName]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szName'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szName'];?>
                                    </span>
                                    <?php }?>
                                </div>


                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['per_form_complete'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Name of Person Completing Form</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="per_form_complete" class="form-control" type="text" value="<?php echo $_POST['clientData']['per_form_complete'] ;?>" placeholder="Name of Person Completing Form" onfocus="remove_formError(this.id,'true')" name="clientData[per_form_complete]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['per_form_complete'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['per_form_complete'];?>
                                    </span>
                                    <?php }?>
                                </div>


                            </div>

                              <div class="form-group <?php if(!empty($arErrorMessages['szEmail'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Company Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szEmail" class="form-control" type="text" value="<?php echo $_POST['clientData']['szEmail'] ;?>" placeholder="Company Email" onfocus="remove_formError(this.id,'true')" name="clientData[szEmail]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['szEmail'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szEmail'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szContactNumber'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Company Phone Number </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szContactNumber" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactNumber'] ;?>" placeholder="Company Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[szContactNumber]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szContactNumber'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szContactNumber'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>

                            <?php } ?>
                             <!--<div id="clientType" class="form-group <?php /*if(!empty($arErrorMessages['clientType'])){*/?>has-error<?php /*}*/?>">
                                <label class="col-md-3 control-label">Client Type</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control" name="clientData[clientType]" id="clientType" Placeholder="Client Type" onfocus="remove_formError(this.id,'true')" onchange="getParenDetails(<?php /*echo $idfranchisee;*/?>,this.value);">
                                            <option value=''>Client Type</option>
                                            <option value='0' <?php /*echo (sanitize_post_field_value($_POST['clientData']['clientType']) == '0' ? "selected" : "");*/?>>Parent</option>
                                            <option value='1' <?php /*echo (sanitize_post_field_value($_POST['clientData']['clientType']) > '0' ? "selected" : "");*/?>>Child</option>
                                        </select>
                                    </div>
                                    <?php /*if(!empty($arErrorMessages['clientType'])){*/?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php /*echo $arErrorMessages['clientType'];*/?>
                                    </span>
                                <?php /*}*/?>
                                </div>
                            </div>
                            <?php
/*                                    if($_POST['clientData']['clientType']>0)
                            {
                                */?>
                                <div id="parenitIdedit" class="form-group <?php /*if(!empty($arErrorMessages['szParentId'])){*/?>has-error<?php /*}*/?>">
                                <label class="col-md-3 control-label">Parent Client</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control required" name="clientData[szParentId]" id="szParentId" onfocus="remove_formError(this.id,'true')">

                                            <?php
/*                                                        if(!empty($parentClient))
                                                {
                                                    foreach($parentClient as $parentClientData)
                                                    {
                                                        */?>
                                                            <option value="<?/*=trim($parentClientData['id'])*/?>" <?/*=(sanitize_post_field_value($_POST['clientData']['clientType']) == trim($parentClientData['id']) ? "selected" : "")*/?>><?/*=trim($parentClientData['szName'])*/?></option>
                                                        <?php
/*                                                            }
                                                }
                                            */?>
                                        </select>
                                    </div>
                                    <?php /*if(!empty($arErrorMessages['szParentId'])){*/?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php /*echo $arErrorMessages['szParentId'];*/?>
                                    </span>
                                <?php /*}*/?>
                                </div>

                            </div>
                                 --><?php
/*
                            }

                            */?>
                            <?php if($_POST['clientData']['clientType'] > 0){?>
                                <input id="szParentId" class="form-control" type="hidden" value="<?php echo $_POST['clientData']['clientType'];?>" name="clientData[szParentId]">
                            <?php }else{ ?>
                                <input id="szParentId" class="form-control" type="hidden" value="0" name="clientData[szParentId]">
                               <input id="szOldNoOfSites" class="form-control" type="hidden" value="<?php echo $_POST['clientData']['szNoOfSites'] ;?>" name="clientData[szOldNoOfSites]">
                            <?php } ?>
                                 <?php if(empty($_POST['clientData']['clientType'])){?>
                                 <div class="subCaption">
                        <i class="icon-equalizer font-green-meadow"></i>
                        <span class="caption-subject font-green-meadow bold uppercase">Contact Details</span>
                    </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['szContactEmail'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szContactEmail" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactEmail'] ;?>" placeholder="Contact Email" onfocus="remove_formError(this.id,'true')" name="clientData[szContactEmail]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['szContactEmail'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szContactEmail'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szContactPhone'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Phone</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szContactPhone" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactPhone'] ;?>" placeholder="Contact Phone" onfocus="remove_formError(this.id,'true')" name="clientData[szContactPhone]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szContactPhone'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szContactPhone'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['szContactMobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Mobile</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szContactMobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactMobile'] ;?>" placeholder="Contact Mobile" onfocus="remove_formError(this.id,'true')" name="clientData[szContactMobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szContactMobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szContactMobile'];?>
                                    </span>
                                <?php }?>
                                </div>
                                 <?php }?>
                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szAddress'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szAddress" class="form-control" type="text" value="<?php echo $_POST['clientData']['szAddress'] ;?>" placeholder="Address" onfocus="remove_formError(this.id,'true')" name="clientData[szAddress]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['szAddress'])){?>
                                        <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                            <?php echo $arErrorMessages['szAddress'];?>
                                    </span>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szCountry'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Country</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control required" name="clientData[szCountry]" id="szCountry" Placeholder="Country" onfocus="remove_formError(this.id,'true')">
                                            <option value=''>Select</option>
                                            <?php
                                                if(!empty($countryAry))
                                                {
                                                    foreach($countryAry as $countryDetails)
                                                    {
                                                        ?>
                                                         <option value="<?=trim($countryDetails['name'])?>" <?=(sanitize_post_field_value($_POST['clientData']['szCountry']) == trim($countryDetails['name']) ? "selected" : "")?>><?=trim($countryDetails['name'])?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <?php if(!empty($arErrorMessages['szCountry'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szCountry'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>

                                <div class="form-group <?php if(!empty($arErrorMessages['szState'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">State</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <select class="form-control required" name="clientData[szState]" id="szState"  Placeholder="State" onfocus="remove_formError(this.id,'true')">
                                            <option value=''>Select</option>
                                            <?php
                                                if(!empty($stateAry))
                                                {
                                                    foreach($stateAry as $stateDetails)
                                                    {
                                                        ?>
                                                         <option value="<?=trim($stateDetails['name'])?>" <?=(sanitize_post_field_value($_POST['clientData']['szState']) == trim($stateDetails['name']) ? "selected" : "")?>><?=trim($stateDetails['name'])?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <?php if(!empty($arErrorMessages['szState'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szState'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['szCity'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> City</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szCity" class="form-control" type="text" value="<?php echo $_POST['clientData']['szCity'] ;?>" placeholder="City" onfocus="remove_formError(this.id,'true')" name="clientData[szCity]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['szCity'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szCity'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>

                             <div class="form-group <?php if(!empty($arErrorMessages['szZipCode'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">ZIP/Postal Code</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="szZipCode" class="form-control" type="text" value="<?php echo $_POST['clientData']['szZipCode'] ;?>" placeholder="ZIP/Postal Code" onfocus="remove_formError(this.id,'true')" name="clientData[szZipCode]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['szZipCode'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['szZipCode'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                          <?php if(!empty($_POST['clientData']['clientType']))
                              {?>

                               <!-- BEGIN CONTACT DETAILS PORTLET-->
                                    <div class="portlet box green-meadow ">
                                        <div class="portlet-title">
                                                <div class="caption">
                                                     <i class="icon-equalizer "></i>
                                                   Contact Details     
                                                </div>
                                                <div class="tools">
                                                <a href="javascript:;" class="collapse-sec collapsed" data-toggle="collapse" data-target="#contact-details">
                                                </a>


                                                </div>
                                        </div>

                                <div class="portlet-body collapse" id="contact-details">
                                   <table class="table table-hover">
                                       <hr>
                             <div class="font-green-meadow text">Who will be responsible for Scheduling ? If you would like us to manage the scheduling , write "Drugsafe".</div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['sp_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="sp_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['sp_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[sp_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['sp_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['sp_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['sp_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="sp_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['sp_mobile'] ;?>" placeholder="Contact Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[sp_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['sp_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['sp_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['sp_email'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="sp_email" class="form-control" type="text" value="<?php echo $_POST['clientData']['sp_email'] ;?>" placeholder="Contact Email" onfocus="remove_formError(this.id,'true')" name="clientData[sp_email]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['sp_email'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['sp_email'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                        <hr>
                             <div class="font-green-meadow text">Would anyone else be involved in Scheduling ? </div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['iis_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="iis_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['iis_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[iis_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['iis_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['iis_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['iis_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="iis_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['iis_mobile'] ;?>" placeholder="Contact Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[iis_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['iis_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['iis_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['iis_email'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="iis_email" class="form-control" type="text" value="<?php echo $_POST['clientData']['iis_email'] ;?>" placeholder="Contact Email" onfocus="remove_formError(this.id,'true')" name="clientData[iis_email]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['iis_email'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['iis_email'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                <hr>
                             <div class="font-green-meadow text">   Who is to receive the confirmatory lab results ? </div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['rlr_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="rlr_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['rlr_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[rlr_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['rlr_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['rlr_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['rlr_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="rlr_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['rlr_mobile'] ;?>" placeholder="Contact Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[rlr_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['rlr_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['rlr_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['rlr_email'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="rlr_email" class="form-control" type="text" value="<?php echo $_POST['clientData']['rlr_email'] ;?>" placeholder="Contact Email" onfocus="remove_formError(this.id,'true')" name="clientData[rlr_email]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['rlr_email'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['rlr_email'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                <hr>
                             <div class="font-green-meadow text">  Are there any other people Who are to receive the confirmatory lab results ? </div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['orlr_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="orlr_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['orlr_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[orlr_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['orlr_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['orlr_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['orlr_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="orlr_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['orlr_mobile'] ;?>" placeholder="Contact Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[orlr_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['orlr_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['orlr_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['orlr_email'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Contact Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="orlr_email" class="form-control" type="text" value="<?php echo $_POST['clientData']['orlr_email'] ;?>" placeholder="Contact Email" onfocus="remove_formError(this.id,'true')" name="clientData[orlr_email]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['orlr_email'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['orlr_email'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                                        </table>

                                        </div>
                                </div> 
                                <!-- END CONTACT DETAILS PORTLET-->
                              <!-- BEGIN CONTACT DETAILS PORTLET-->
                                    <div class="portlet box green-meadow">
                                        <div class="portlet-title">
                                                <div class="caption">
                                                     <i class="icon-equalizer "></i>
                                                   ON SITE SCREENING INFORMATION     
                                                </div>
                                                <div class="tools">
                                                        <a href="javascript:;" class="collapse-sec collapsed" data-toggle="collapse" data-target="#onsite">
                                                        </a>


                                                </div>
                                        </div>

                                <div id="onsite" class="portlet-body collapse">
                                   <table class="table table-hover">
                                       <hr>
                             <div class="font-green-meadow text"> Primary Site Contact (Assist with donar selection and supervise/manage donar if required).</div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['psc_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="psc_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['psc_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[psc_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['psc_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['psc_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['psc_phone'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Landline Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="psc_phone" class="form-control" type="text" value="<?php echo $_POST['clientData']['psc_phone'] ;?>" placeholder="Landline Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[psc_phone]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['psc_phone'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['psc_phone'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['psc_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Mobile Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="psc_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['psc_mobile'] ;?>" placeholder="Mobile Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[psc_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['psc_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['psc_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                        <hr>
                             <div class="font-green-meadow text"> Secondary Site Contact (in the event that the primary site contact is unavailable). </div>
                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['ssc_name'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Contact Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="ssc_name" class="form-control" type="text" value="<?php echo $_POST['clientData']['ssc_name'] ;?>" placeholder="Contact Name" onfocus="remove_formError(this.id,'true')" name="clientData[ssc_name]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['ssc_name'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['ssc_name'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['ssc_phone'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Landline Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="ssc_phone" class="form-control" type="text" value="<?php echo $_POST['clientData']['ssc_phone'] ;?>" placeholder="Landline Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[ssc_phone]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['ssc_phone'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['ssc_phone'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['ssc_mobile'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Mobile Phone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="ssc_mobile" class="form-control" type="text" value="<?php echo $_POST['clientData']['ssc_mobile'] ;?>" placeholder="Mobile Phone Number" onfocus="remove_formError(this.id,'true')" name="clientData[ssc_mobile]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['ssc_mobile'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['ssc_mobile'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>

                               <hr>
                                  <div class="form-group <?php if(!empty($arErrorMessages['instructions'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label"> Any special instruction for Drugsafe staff (directions,instructions etc) </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <textarea  name="clientData[instructions]" id="instructions" class="form-control"  value="<?php echo $_POST['clientData']['ssc_mobile'] ;?>"  rows="5" placeholder=" Any special instruction for Drugsafe staff " onfocus="remove_formError(this.id,'true')" ><?php echo set_value('clientData[instructions]'); ?></textarea>
                                    </div>
                                    <?php if(!empty($arErrorMessages['instructions'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['instructions'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                  <div class="form-group <?php if(!empty($arErrorMessages['site_people'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">How many people on site ?</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="site_people" class="form-control" type="text" value="<?php echo $_POST['clientData']['site_people'] ;?>" placeholder="People on site" onfocus="remove_formError(this.id,'true')" name="clientData[site_people]">
                                    </div>
                                    <?php if(!empty($arErrorMessages['site_people'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['site_people'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                            <div class="form-group <?php if(!empty($arErrorMessages['test_count'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">How many to test ?</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="test_count" class="form-control" type="text" value="<?php echo $_POST['clientData']['test_count'] ;?>" placeholder="Test Count" onfocus="remove_formError(this.id,'true')" name="clientData[test_count]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['test_count'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['test_count'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['initial_testing_req'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Initial Testing Requirements </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline "><input type="radio" id ="initial_testing_req" value="0" name="clientData[initial_testing_req]"  <?php if(trim($_POST['clientData']['initial_testing_req']=='0')){?>checked<?php }?> > Random</label>
                                      <label class="radio-inline"><input type="radio" id ="initial_testing_req" value="1" name="clientData[initial_testing_req]" <?php if(trim($_POST['clientData']['initial_testing_req']=='1')){?>checked<?php }?> > Blanket</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['initial_testing_req'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['initial_testing_req'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['ongoing_testing_req'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Ongoing Testing Requirements </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline"><input type="radio" id="ongoing_testing_req" value="0" name="clientData[ongoing_testing_req]" <?php if(trim($_POST['clientData']['ongoing_testing_req']=='0')){?>checked<?php }?>> Random</label>
                                      <label class="radio-inline"><input type="radio" id="ongoing_testing_req" value="1" name="clientData[ongoing_testing_req]" <?php if(trim($_POST['clientData']['ongoing_testing_req']=='1')){?>checked<?php }?>> Blanket</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['ongoing_testing_req'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['ongoing_testing_req'];?>
                                    </span>
                                <?php }?>
                                </div>



                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['site_visit'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">How many times would you like Drugsafe to visit your site and test per year ?</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="site_visit" class="form-control" type="text" value="<?php echo $_POST['clientData']['site_visit'] ;?>" placeholder="Site Visit" onfocus="remove_formError(this.id,'true')" name="clientData[site_visit]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['site_visit'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['site_visit'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                <div class="form-group <?php if(!empty($arErrorMessages['onsite_service'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">What type of service would you like on-site ?</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline"><input type="radio" id="onsite_service" value="0" checked name="clientData[onsite_service]" <?php if(trim($_POST['clientData']['onsite_service']=='0')){?>checked<?php }?>> Mobile Clinic </label>
                                      <label class="radio-inline"><input type="radio" id="onsite_service" value="1" name="clientData[onsite_service]" <?php if(trim($_POST['clientData']['onsite_service']=='1')){?>checked<?php }?>> In-house</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['onsite_service'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['onsite_service'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['start_time'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Preffered start time</label>
                                <div class="col-md-6">
                                      <div class="input-icon">
                                                    <i class="fa fa-clock-o"></i>
                                                    <input type="text" class="form-control timepicker timepicker-default"id="start_time" value="<?php echo $_POST['clientData']['start_time'] ;?>" name="clientData[start_time]" onfocus="remove_formError(this.id,'true')">
                                            </div>
                                     <?php if(!empty($arErrorMessages['start_time'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['start_time'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                <div class="form-group <?php if(!empty($arErrorMessages['power_access'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Access to power for our Mobile</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline"><input type="radio" id="power_access" value="0" name="clientData[power_access]"  <?php if(trim($_POST['clientData']['power_access']=='0')){?>checked<?php }?>> Yes</label>
                                      <label class="radio-inline"><input type="radio"  id="power_access" value="1" checked  name="clientData[power_access]"  <?php if(trim($_POST['clientData']['power_access']=='1')){?>checked<?php }?>> No</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['power_access'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['power_access'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['risk_assessment'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Is a risk assessment required prior to working on-site ? </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline"><input type="radio"  id="risk_assessment" value="0" name="clientData[risk_assessment]" <?php if(trim($_POST['clientData']['risk_assessment']=='0')){?>checked<?php }?>> Yes</label>
                                      <label class="radio-inline"><input type="radio" id="risk_assessment" value="1" name="clientData[risk_assessment]"  <?php if(trim($_POST['clientData']['risk_assessment']=='1')){?>checked<?php }?>> No</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['risk_assessment'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['risk_assessment'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['req_comp_induction'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Are our people required to complete an induction?</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <label class="radio-inline"><input type="radio" id="req_comp_induction" value="0" name="clientData[req_comp_induction]"  <?php if(trim($_POST['clientData']['req_comp_induction']=='0')){?>checked<?php }?>> Yes</label>
                                      <label class="radio-inline"><input type="radio" id="req_comp_induction" value="1" name="clientData[req_comp_induction]"  <?php if(trim($_POST['clientData']['req_comp_induction']=='1')){?>checked<?php }?>> No</label>
                                    </div>
                                     <?php if(!empty($arErrorMessages['req_comp_induction'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['req_comp_induction'];?>
                                    </span>
                                <?php }?>
                                </div>
                                 </div>
                                  <div class="form-group <?php if(!empty($arErrorMessages['randomisation'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Randomization process</label>
                                <div class="col-md-6">
                                    <div class="input-group">

                                        <label><input type="radio"id="randomisation" value="0" name="clientData[randomisation]" <?php if(trim($_POST['clientData']['randomisation']=='0')){?>checked<?php }?>> Marble selection (% split)-not accurate</label>


                                        <label><input type="radio" id="randomisation" value="1"name="clientData[randomisation]" <?php if(trim($_POST['clientData']['randomisation']=='1')){?>checked<?php }?>> Drugsafe given names then select via algorythm</label>


                                        <label><input type="radio" id="randomisation" value="2" name="clientData[randomisation]" <?php if(trim($_POST['clientData']['randomisation']=='2')){?>checked<?php }?>> Client does randomization</label>

                                    </div>
                                     <?php if(!empty($arErrorMessages['randomisation'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['randomisation'];?>
                                    </span>
                                <?php }?>
                                </div>

                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['req_ppe'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Required PPE</label>
                                <div class="col-md-6">
                                    <div class="input-group">

                                      <div class="checkbox"> 

                                        <label><input type="checkbox" id="req_ppe1" value="1"  name="req_ppe[]"<?php if(in_array("1", $req_ppe_ary)){?> checked<?php }?>> High Vis Work Wear</label>
                                      </div>
                                       <div class="checkbox">
                                        <label><input type="checkbox" id="req_ppe2" value="2"  name="req_ppe[]"<?php if(in_array("2", $req_ppe_ary)){?>checked<?php }?>> Head Protection</label>
                                      </div>
                                       <div class="checkbox">
                                        <label><input type="checkbox" id="req_ppe3" value="3"  name="req_ppe[]"<?php if(in_array("3", $req_ppe_ary)){?>checked<?php }?>> Face/Eye Protection</label>
                                      </div>
                                        <div class="checkbox">
                                        <label><input type="checkbox" id="req_ppe4" value="4"  name="req_ppe[]"<?php if(in_array("4", $req_ppe_ary)){?>checked<?php }?>> Safety Boots</label>
                                      </div>
                                      <div class="checkbox">
                                        <label><input type="checkbox" id="req_ppe5"  name="req_ppe[]" value="5"<?php if(in_array("5", $req_ppe_ary)){?>checked<?php }?>> Long Sleev Clothing</label>
                                      </div>
                                    </div>
                                     <?php if(!empty($arErrorMessages['req_ppe'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['req_ppe'];?>
                                    </span>
                                <?php }?>
                                </div>
                            </div>
                                 <div class="form-group <?php if(!empty($arErrorMessages['paperwork'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">who would be responsible for all the Paperwork at the time of testing ?</label>
                                <div class="col-md-6">
                                    <div class="input-group">

                                        <label><input type="radio" id="paperwork" value="0" name="clientData[paperwork]" checked  onclick="showHideTextbox('0');"<?php if(trim($_POST['clientData']['paperwork']=='0')){?>checked<?php }?>> Leave onsite with site contact</label>
                                        <label><input type="radio" id="paperwork" value="1" name="clientData[paperwork]" onclick="showHideTextbox('1');"<?php if(trim($_POST['clientData']['paperwork']=='1')){?>checked<?php }?>> Return to Drugsafe for filing</label>
                                        <label><input type="radio" id="paperwork" value="2" name="clientData[paperwork]" onclick="showHideTextbox('2');"<?php if(trim($_POST['clientData']['paperwork']=='2')){?>checked<?php }?>> Return to Drugsafe and and emailed to specific contact</label>

                                      </div>
                                    </div>
                                     <?php if(!empty($arErrorMessages['paperwork'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['paperwork'];?>
                                    </span>
                                <?php }?>
                                </div>
                               <div class="text" id="text" <?php if(trim($_POST['clientData']['paperwork']=='2')){?>style="display:block;"<?php }else{?>style="display:none;"<?php }?>> 
                                <div class="form-group <?php if(!empty($arErrorMessages['specify_contact'])){?>has-error<?php }?>">
                                <label class="col-md-4 control-label">Specify Contact</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <input id="specify_contact" class="form-control div1" type="text" value="<?php echo $_POST['clientData']['specify_contact'] ;?>" placeholder="Specify Contact" onfocus="remove_formError(this.id,'true')" name="clientData[specify_contact]">
                                    </div>
                                     <?php if(!empty($arErrorMessages['specify_contact'])){?>
                                    <span class="help-block pull-left">
                                        <i class="fa fa-times-circle"></i>
                                        <?php echo $arErrorMessages['specify_contact'];?>
                                    </span>
                                <?php }?>
                                </div>
                                 </div>

                            </div>

                                       </table>
                                    </div>
                                </div> 
                                    <!-- END CONTACT DETAILS PORTLET-->      
                              <?php } ?>    
                                 <input id="franchiseeId" class="form-control" type="hidden" value="<?php echo $_POST['clientData']['franchiseeId'] ;?>" name="clientData[franchiseeId]">
                                 <input id="clientType" class="form-control" type="hidden" value="<?php echo $_POST['clientData']['clientType'] ;?>" name="clientData[clientType]">
                                 <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role" onfocus="remove_formError(this.id,'true')" name="clientData[iRole]">
                                 <div class="form-actions">
                                 <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <?php if($flag==1){?> 
                                         <a href="<?=__BASE_URL__?>/franchisee/viewClientDetails" class="btn default uppercase" type="button">Cancel</a>
                                        <?php } else {?> 
                                          <a href="<?=__BASE_URL__?>/franchisee/clientList" class="btn default uppercase" type="button">Cancel</a>
                                        <?php } ?> 
                                        <input type="submit" class="btn green-meadow" value="SAVE" name="clientData[submit]">
                                    </div>
                                 </div>
                                 </div>
                                 </div>
                        </form>

                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
</div>
