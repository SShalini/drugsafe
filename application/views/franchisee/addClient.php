<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Add Client</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>franchisee/clientList');">
                                        &nbsp;List Client
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="portlet-body">
                            <form class="form-horizontal" id="clientData" action="<?=__BASE_URL__?>/franchisee/addClient" name="clientData" method="post">
                                <div class="form-body">
                                    <div class="form-group <?php if(!empty($arErrorMessages['szName'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label"> Name</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szName" class="form-control" type="text" value="<?php echo $_POST['clientData']['szName'] ;?>" placeholder="Name" onfocus="remove_formError(this.id,'true')" name="clientData[szName]">
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
                                        <label class="col-md-3 control-label"> Email</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szEmail" class="form-control" type="text" value="<?php echo $_POST['clientData']['szEmail'] ;?>" placeholder="Email" onfocus="remove_formError(this.id,'true')" name="clientData[szEmail]">
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
                                        <label class="col-md-3 control-label"> Contact No</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szContactNumber" class="form-control" type="text" value="<?php echo $_POST['clientData']['szContactNumber'] ;?>" placeholder="Contact Number" onfocus="remove_formError(this.id,'true')" name="clientData[szContactNumber]">
                                            </div>
                                             <?php if(!empty($arErrorMessages['szContactNumber'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szContactNumber'];?>
                                            </span>
                                        <?php }?>
                                        </div>
                                       
                                    </div>
                                    <div id="clientType" class="form-group <?php if(!empty($arErrorMessages['szClientType'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">Client Type</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <select class="form-control" name="clientData[szClientType]" id="szClientType" Placeholder="Client Type" onfocus="remove_formError(this.id,'true')" onchange="getParenDetails(<?php echo $idfranchisee;?>,this.value);" required />
                                                    <option value=''>Client Type</option>
                                                    <option value='1' <?=(sanitize_post_field_value($_POST['clientData']['szClientType']) == '1' ? "selected" : "")?>>Parent</option>
                                                    <option value='2' <?=(sanitize_post_field_value($_POST['clientData']['szClientType']) == '2' ? "selected" : "")?>>Child</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($arErrorMessages['szClientType'])){?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szClientType'];?>
                                            </span>
                                        <?php }?>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group <?php if(!empty($arErrorMessages['szAddress'])){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">Address</label>
                                        <div class="col-md-5">
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
                                        <label class="col-md-3 control-label">Country</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <select class="form-control required" name="clientData[szCountry]" id="szCountry"  onchange="getStateListingProfileclient(this.value);"  Placeholder="Country" onfocus="remove_formError(this.id,'true')">
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
                                        <label class="col-md-3 control-label">State</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <div id="state_container">
                                                    <select class="form-control required" id="szState" name="clientData[szState]" placeholder="State" onfocus="remove_formError(this.id,'true')">";
                                                        <option value=''>Select</option>
         	                             </select>
                                                    
                                                </div>
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
                                        <label class="col-md-3 control-label"> City</label>
                                        <div class="col-md-5">
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
                                        <label class="col-md-3 control-label">ZIP/Postal Code</label>
                                        <div class="col-md-5">
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
                                    

                                   <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role" onfocus="remove_formError(this.id,'true')" name="clientData[iRole]">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">

<!--                                            <input type="submit" class="btn green btn-success" value="Save" name="clientData[submit]">-->

                                            <input type="submit" class="btn green-meadow" value="Save" name="clientData[submit]">

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
