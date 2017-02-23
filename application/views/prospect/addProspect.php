 <div class="page-content-wrapper">
    <div class="page-content">
        <div id="page_content" class="row">

            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                          <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">Add Prospect</span>
                    </li>
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Add Prospect</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn btn-sm green-meadow"
                                        onclick="redirect_url('<?php echo base_url(); ?>prospect/prospectRecord');">
                                    &nbsp; Prospect List
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" id="addprospect"
                              action="<?= __BASE_URL__ ?>/prospect/addprospect" name="addprospect" method="post">
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
                                                       value="<?php echo $_POST['addprospect']['szBusinessName']; ?>"
                                                       placeholder="Business Name"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[szBusinessName]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szBusinessName'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szBusinessName']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>


                                    </div>
                                <div class="form-group <?php if (!empty($arErrorMessages['abn'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label">ABN</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="abn" class="form-control" type="text"
                                                       value="<?php echo $_POST['addprospect']['abn']; ?>"
                                                       placeholder="ABN"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[abn]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['abn'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['abn']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>


                                    </div>   
                                <div  class="form-group <?php if (!empty($arErrorMessages['szName']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label"> Contact Name</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                            <input id="szName" class="form-control" type="text"
                                                   value="<?php echo $_POST['addprospect']['szName']; ?>"
                                                   placeholder="Contact Name" onfocus="remove_formError(this.id,'true')"
                                                   name="addprospect[szName]"/>

                                        </div>
                                        <?php if (!empty($arErrorMessages['szName'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szName']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                                 <div class="form-group <?php if (!empty($arErrorMessages['szEmail'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label"> Primary Email</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <input id="szEmail" class="form-control" type="text"
                                                       value="<?php echo $_POST['addprospect']['szEmail']; ?>"
                                                       placeholder="Primary Email"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[szEmail]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szEmail'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szEmail']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                               
                                <div class="form-group <?php if (!empty($arErrorMessages['szContactNo']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-4 control-label"> Primary Phone</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                                </span>
                                            <input id="szContactNo" class="form-control" type="text"
                                                   value="<?php echo $_POST['addprospect']['szContactNo']; ?>"
                                                   placeholder="Primary Phone Number"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="addprospect[szContactNo]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szContactNo'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szContactNo']; ?>
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
                                            <select class="form-control " name="addprospect[industry]" id="industry"
                                                    Placeholder="Industry" onfocus="remove_formError(this.id,'true')">
                                               
                                                 <option value=''>Select</option>
                                                    <?php
                                                     $industryListArr =$this->Admin_Model->viewAllIndustryList();
                                                        if(!empty($industryListArr))
                                                        {
                                                            foreach ($industryListArr as $industryListDetails) 
                                                            {
                                                                ?>
                                                             <option value="<?php echo trim($industryListDetails['id']); ?>" <?php echo(sanitize_post_field_value($_POST['addprospect']['industry']) == trim($industryListDetails['id']) ? "selected" : ""); ?>><?php echo trim($industryListDetails['szName']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
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
                                  <div class="subCaption">
                                        <i class="icon-equalizer font-green-meadow"></i>
                                        <span
                                            class="caption-subject font-green-meadow bold uppercase">Contact Details</span>
                                    </div>

                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szContactEmail'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label"> Contact Email</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <input id="szContactEmail" class="form-control" type="text"
                                                       value="<?php echo $_POST['addprospect']['szContactEmail']; ?>"
                                                       placeholder="Contact Email"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[szContactEmail]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szContactEmail'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szContactEmail']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szContactPhone'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label">Contact Phone</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                                </span>
                                                <input id="szContactPhone" class="form-control" type="text"
                                                       value="<?php echo $_POST['addprospect']['szContactPhone']; ?>"
                                                       placeholder="Contact Phone"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[szContactPhone]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szContactPhone'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szContactPhone']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div
                                        class="form-group <?php if (!empty($arErrorMessages['szContactMobile'])) { ?>has-error<?php } ?>">
                                        <label class="col-md-4 control-label">Contact Mobile</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-mobile-phone"></i>
                                                </span>
                                                <input id="szContactMobile" class="form-control" type="text"
                                                       value="<?php echo $_POST['addprospect']['szContactMobile']; ?>"
                                                       placeholder="Contact Mobile"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="addprospect[szContactMobile]">
                                            </div>
                                            <?php if (!empty($arErrorMessages['szContactMobile'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szContactMobile']; ?>
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
                                                   value="<?php echo $_POST['addprospect']['szAddress']; ?>"
                                                   placeholder="Address" onfocus="remove_formError(this.id,'true')"
                                                   name="addprospect[szAddress]">
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
                                                   name="addprospect[szCountry]" readonly> 
                                        </div>
                                        <?php if (!empty($arErrorMessages['szCountry'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szCountry']; ?>
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
                                                   value="<?php echo $_POST['addprospect']['szCity']; ?>"
                                                   placeholder="City" onfocus="remove_formError(this.id,'true')"
                                                   name="addprospect[szCity]">
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
                                                   value="<?php echo $_POST['addprospect']['szZipCode']; ?>"
                                                   placeholder="ZIP/Postal Code"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="addprospect[szZipCode]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szZipCode'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szZipCode']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>

                            </div>
                           
                            <div class="form-actions">
                                <div class="row">

                                    <div class="col-md-offset-3 col-md-4">
                                        <a href="<?= __BASE_URL__ ?>/prospect/prospectRecord" class="btn default uppercase"
                                           type="button">Cancel</a>
                                        <input type="submit" class="btn green-meadow" value="SAVE"
                                               name="addprospect[submit]">
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>