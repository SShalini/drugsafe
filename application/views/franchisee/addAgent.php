<div class="page-content-wrapper">
    <div class="page-content">
        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                   <?php  $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$idclient);
                        ?>
                      
                      

                   
                        <li>
                            <a onclick="viewClientDetails(<?php echo $clientDetailsAray['id']; ?>);"
                               href="javascript:void(0);"><?php echo $userDataAry['szName']; ?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Add Agent/Employee</span>
                        </li>
                    
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                           
                                <span class="caption-subject font-red-sunglo bold uppercase">Add Agent/Employee</span>
                          
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" id="clientData"
                              action="<?php echo __BASE_URL__ ?>/franchisee/addAgentEmployee" name="clientData" method="post">
                         
                            <div class="form-body">
                                
                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szBusinessName'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label"> Business Name</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szBusinessName" class="form-control" type="text"
                                                       value="<?php echo $_POST['clientData']['szBusinessName']; ?>"
                                                       placeholder="Business Name"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="clientData[szBusinessName]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szBusinessName'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szBusinessName']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>


                                    </div>
                                <div
                                        class="form-group <?php if (!empty($arErrorMessages['abn'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label">ABN</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="abn" class="form-control" type="text"
                                                       value="<?php echo $_POST['clientData']['abn']; ?>"
                                                       placeholder="ABN"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="clientData[abn]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['abn'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['abn']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>


                                    </div>
                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szName'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label"> Contact Name</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szName" class="form-control" type="text"
                                                       value="<?php echo $_POST['clientData']['szName']; ?>"
                                                       placeholder="Contact Name"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="clientData[szName]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szName'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szName']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>


                                    </div>

                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szEmail'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label"> Primary Email</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <input id="szEmail" class="form-control" type="text"
                                                       value="<?php echo $_POST['clientData']['szEmail']; ?>"
                                                       placeholder="Primary Email"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="clientData[szEmail]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szEmail'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szEmail']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szContactNumber'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label">Primary Phone</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                                </span>
                                                <input id="szContactNumber" class="form-control" type="text"
                                                       value="<?php echo $_POST['clientData']['szContactNumber']; ?>"
                                                       placeholder="Primary Phone"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="clientData[szContactNumber]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szContactNumber'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szContactNumber']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                              
                                 <div class="form-group <?php if (!empty($arErrorMessages['industry']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label">Industry</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-industry"></i>
                                                </span>
                                            <select class="form-control " name="clientData[industry]" id="industry"
                                                    Placeholder="Industry" onfocus="remove_formError(this.id,'true')">
                                                <option value=''>Select</option>

                                                <option value="Agriculture, Forestry and Fishing" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Agriculture, Forestry and Fishing") ? "selected" : ""); ?>>Agriculture, Forestry and Fishing </option>
                                                <option value="Mining" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Mining") ? "selected" : ""); ?>>Mining </option>
                                                <option value="Manufacturing" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Manufacturing") ? "selected" : ""); ?>>Manufacturing </option>
                                                <option value="Electricity, Gas and Water Supply" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Electricity, Gas and Water Supply") ? "selected" : ""); ?>>Electricity, Gas and Water Supply </option>
                                                <option value="Construction" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Construction") ? "selected" : ""); ?> >Construction</option>
                                                <option value="Wholesale Trade" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Wholesale Trade") ? "selected" : ""); ?>>Wholesale Trade </option>
                                                <option value="Transport and Storage " <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Transport and Storage ") ? "selected" : ""); ?>>Transport and Storage </option>
                                                <option value="Communication Services" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Communication Services") ? "selected" : ""); ?>>Communication Services </option>
                                                <option value="Property and Business Services" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Property and Business Services") ? "selected" : ""); ?>>Property and Business Services </option>
                                                <option value="Government Administration and Defence" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Government Administration and Defence") ? "selected" : ""); ?>>Government Administration and Defence</option>
                                                <option value="Education" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Education") ? "selected" : ""); ?>>Education  </option>
                                                <option value="Health and Community Services" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Health and Community Services") ? "selected" : ""); ?>>Health and Community Services </option>
                                                 <option value="Other" <?php echo (sanitize_post_field_value($_POST['clientData']['industry']) == trim("Other") ? "selected" : ""); ?>>Other</option>

                                            </select>
                                        </div>
                                        <?php if (!empty($arErrorMessages['industry'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['industry']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>
     
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szAddress'])) { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label">Address</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                                </span>
                                            <input id="szAddress" class="form-control" type="text"
                                                   value="<?php echo $_POST['clientData']['szAddress']; ?>"
                                                   placeholder="Address" onfocus="remove_formError(this.id,'true')"
                                                   name="clientData[szAddress]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szAddress'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szAddress']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                                 
                                   <div class="form-group <?php if (!empty($arErrorMessages['szCountry']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label">Country</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag"></i>
                                                </span>
                                         <input id="szCountry" class="form-control read-only" type="text"
                                                   value="Australia"
                                                   placeholder="Country" onfocus="remove_formError(this.id,'true')"
                                                   name="clientData[szCountry]" readonly> 
                                        </div>
                                        <?php if (!empty($arErrorMessages['szCountry'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szCountry']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>

                                <div class="form-group <?php if (!empty($arErrorMessages['szState']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label">State</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag-checkered"></i>
                                                </span>
                                            <select class="form-control " name="clientData[szState]" id="szState"
                                                    Placeholder="State" onfocus="remove_formError(this.id,'true')">
                                                <option value=''>Select</option>

                                                <option value="Australian Capital Territory" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Australian Capital Territory") ? "selected" : ""); ?>>Australian Capital Territory</option>
                                                <option value="New South Wales" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("New South Wales") ? "selected" : ""); ?>>New South Wales</option>
                                                <option value="Northern Territory" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Northern Territory") ? "selected" : ""); ?>>Northern Territory</option>
                                                <option value="Queensland" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Queensland") ? "selected" : ""); ?>>Queensland</option>
                                                <option value="South Australia" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("South Australia") ? "selected" : ""); ?> >South Australia</option>
                                                <option value="Tasmania" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Tasmania") ? "selected" : ""); ?>>Tasmania</option>
                                                <option value="Victoria" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Victoria") ? "selected" : ""); ?>>Victoria</option>
                                                <option value="Western Australia" <?php echo (sanitize_post_field_value($_POST['clientData']['szState']) == trim("Western Australia") ? "selected" : ""); ?>>Western Australia </option>


                                            </select>
                                        </div>
                                        <?php if (!empty($arErrorMessages['szState'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szState']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szCity'])) { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label"> City</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                                </span>
                                            <input id="szCity" class="form-control" type="text"
                                                   value="<?php echo $_POST['clientData']['szCity']; ?>"
                                                   placeholder="City" onfocus="remove_formError(this.id,'true')"
                                                   name="clientData[szCity]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szCity'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szCity']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szZipCode'])) { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label">ZIP/Postal Code</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-area-chart"></i>
                                                </span>
                                            <input id="szZipCode" class="form-control" type="text"
                                                   value="<?php echo $_POST['clientData']['szZipCode']; ?>"
                                                   placeholder="ZIP/Postal Code"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="clientData[szZipCode]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szZipCode'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szZipCode']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>

                               
                                <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role"
                                       onfocus="remove_formError(this.id,'true')" name="clientData[iRole]">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            
                                            <a href="<?=__BASE_URL__?>/franchisee/clientRecord" class="btn default uppercase" type="button">Cancel</a>
                                          
                                            <input type="submit" class="btn green-meadow" value="SAVE"
                                                   name="clientData[submit]">

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