<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Edit Franchisee</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm blue" onclick="redirect_url('<?php echo base_url();?>admin/franchiseeList');">
                                        &nbsp;List Franchisee
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form class="form-horizontal" id="addFranchisee" action="<?=__BASE_URL__?>/admin/editFranchisee" name="addFranchisee" method="post">
                                <div class="form-body">
                                    <div class="form-group <?php if(!empty($arErrorMessages['szName'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szName" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szName'] ;?>" placeholder="Name" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szName]">
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szName'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szName'];?>
                                            </span>
                                        <?php }?>
                                        
                                    </div>
                                    
                                    <div class="form-group <?php if(!empty($arErrorMessages['szEmail'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szEmail" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szEmail'] ;?>" placeholder="Email" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szEmail]">
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szEmail'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szEmail'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                    <div class="form-group <?php if(!empty($arErrorMessages['szContactNumber'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label"> Contact No</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szContactNumber" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szContactNumber'] ;?>" placeholder="Contact Number" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szContactNumber]">
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szContactNumber'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szContactNumber'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                    <div class="form-group <?php if(!empty($arErrorMessages['szCountry'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">Country</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <select class="form-control required" name="addFranchisee[szCountry]" id="szCountry"  onchange="getStateListingProfile(this.value);"  Placeholder="Country" onfocus="remove_formError(this.id,'true')">
                                                    <option value=''>Select</option>
                                                    <?php
                                                        if(!empty($countryAry))
                                                        {
                                                            foreach($countryAry as $countryDetails)
                                                            {
                                                                ?>
                                                                 <option value="<?=trim($countryDetails['name'])?>" <?=(sanitize_post_field_value($_POST['addFranchisee']['szCountry']) == trim($countryDetails['name']) ? "selected" : "")?>><?=trim($countryDetails['name'])?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szCountry'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szCountry'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                     <div class="form-group <?php if(!empty($arErrorMessages['szState'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">State</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <div id="state_container">
                                                <input type="text" class="form-control" id="szState" name="addFranchisee[szState]" placeholder="State" value="<?=sanitize_post_field_value($_POST['addFranchisee']['szState'])?>" onfocus="remove_formError(this.id,'true')">
                                                    </div>
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szState'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szState'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                    <div class="form-group <?php if(!empty($arErrorMessages['szCity'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label"> City</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szCity" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szCity'] ;?>" placeholder="City" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szCity]">
                                            </div>
                                        </div>
                                         <?php if(!empty($arErrorMessages['szCity'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szCity'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                    
                                     <div class="form-group <?php if(!empty($arErrorMessages['szZipCode'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">ZIP/Postal Code</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szZipCode" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szZipCode'] ;?>" placeholder="ZIP/Postal Code" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szZipCode]">
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szZipCode'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szZipCode'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                    
                                     <div class="form-group <?php if(!empty($arErrorMessages['szAddress'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">Address</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szAddress" class="form-control" type="text" value="<?php echo $_POST['addFranchisee']['szAddress'] ;?>" placeholder="Address" onfocus="remove_formError(this.id,'true')" name="addFranchisee[szAddress]">
                                            </div>
                                        </div>
                                        <?php if(!empty($arErrorMessages['szAddress'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szAddress'];?>
                                            </span>
                                        <?php }?>
                                    </div>
                                   <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role" onfocus="remove_formError(this.id,'true')" name="addFranchisee[iRole]">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            <input type="submit" class="btn green" value="Save" name="addFranchisee[submit]">
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
