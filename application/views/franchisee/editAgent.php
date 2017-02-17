<div class="page-content-wrapper">
    <div class="page-content">
        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <?php 
                        $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$idAgent);
                        $ClientDataAry = $this->Franchisee_Model->viewAgentEmployeeDetails($idAgent);
                          //$clientDetailsDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$ClientDataAry['clientType']);
                    ;?>
                        <li>
                            <a onclick="viewClient(<?php echo $franchiseeArr['id']; ?>);"
                               href="javascript:void(0);"><?php echo $clientDetailsDataAry['szName']; ?></a>
                        </li>
                        <li>
                            <span class="active">Edit Agent/Employee</span>
                        </li>
                    
                </ul>
				
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                           
                                <span class="caption-subject font-red-sunglo bold uppercase">Edit Agent/Employee</span>
                          
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" id="agentData"
                              action="<?php echo __BASE_URL__ ?>/franchisee/editAgentEmployee" name="agentData" method="post">
                         
                            <div class="form-body">
                                
                                    <div
                                        class="form-group <?php if(form_error('agentData[szBusinessName]')){?>has-error<?php }?>">
                                        <label class="col-md-4 control-label"> Business Name</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szBusinessName" class="form-control" type="text"
                                                       value="<?php echo set_value('agentData[szBusinessName]'); ?>"
                                                       placeholder="Business Name"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="agentData[szBusinessName]">
                                            </div>
                                            <?php
                                            if(form_error('agentData[szBusinessName]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szBusinessName]');?></span>
                                            </span><?php }?>
                                        </div>


                                    </div>
                                
                                <div
                                        class="form-group <?php if(form_error('agentData[abn]')){?>has-error<?php }?>">
                                        <label class="col-md-4 control-label">ABN</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="abn" class="form-control" type="text"
                                                       value="<?php echo set_value('agentData[abn]'); ?>"
                                                       placeholder="ABN"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="agentData[abn]">
                                            </div>
                                           <?php
                                            if(form_error('agentData[abn]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[abn]');?></span>
                                            </span><?php }?>
                                        </div>


                                    </div>
                                    <div
                                        class="form-group <?php if(form_error('agentData[szName]')){?>has-error<?php }?>">
                                        <label class="col-md-4 control-label"> Contact Name</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="szName" class="form-control" type="text"
                                                       value="<?php echo set_value('agentData[szName]'); ?>"
                                                       placeholder="Contact Name"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="agentData[szName]">
                                            </div>
                                         <?php
                                            if(form_error('agentData[szName]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szName]');?></span>
                                            </span><?php }?>
                                        </div>


                                    </div>

                                    <div
                                        class="form-group  <?php if(form_error('agentData[szEmail]')){?>has-error<?php }?>">
                                        <label class="col-md-4 control-label"> Primary Email</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <input id="szEmail" class="form-control" type="text"
                                                       value="<?php echo set_value('agentData[szEmail]'); ?>"
                                                       placeholder="Primary Email"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="agentData[szEmail]">
                                            </div>
                                           <?php
                                            if(form_error('agentData[szEmail]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szEmail]');?></span>
                                            </span><?php }?>
                                        </div>

                                    </div>
                                    <div
                                        class="form-group  <?php if(form_error('agentData[szContactNumber]')){?>has-error<?php }?>">
                                        <label class="col-md-4 control-label">Primary Phone</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                                </span>
                                                <input id="szContactNumber" class="form-control" type="text"
                                                       value="<?php echo set_value('agentData[szContactNumber]'); ?>"
                                                       placeholder="Primary Phone"
                                                       onfocus="remove_formError(this.id,'true')"
                                                       name="agentData[szContactNumber]">
                                            </div>
                                           <?php
                                            if(form_error('agentData[szEmail]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szEmail]');?></span>
                                            </span><?php }?>
                                        </div>

                                    </div>
                              
                                 <div class="form-group <?php if(form_error('agentData[industry]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label">Industry</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-industry"></i>
                                                </span>
                                             <select class="form-control custom-select" name="agentData[industry]" id="szIndustry" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Select</option>
                                          <?php
                                          foreach($allIndustry as $industryList)
                                          {
                                              $selected = ($industryList['id'] == $_POST['agentData']['industry'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$industryList['id'].'"' . $selected . ' >'.$industryList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                        </div>
                                        <?php
                                            if(form_error('agentData[industry]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[industry]');?></span>
                                            </span><?php }?>
                                    </div>

                                </div>
     
                                <div
                                    class="form-group <?php if(form_error('agentData[szAddress]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label">Address</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                                </span>
                                            <input id="szAddress" class="form-control" type="text"
                                                   value="<?php echo set_value('agentData[szAddress]'); ?>"
                                                   placeholder="Address" onfocus="remove_formError(this.id,'true')"
                                                   name="agentData[szAddress]">
                                        </div>
                                      <?php
                                            if(form_error('agentData[szAddress]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szAddress]');?></span>
                                            </span><?php }?>
                                    </div>
                                </div>
                                 
                                   <div class="form-group <?php if(form_error('agentData[szCountry]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label">Country</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag"></i>
                                                </span>
                                         <input id="szCountry" class="form-control read-only" type="text"
                                                   value="Australia"
                                                   placeholder="Country" onfocus="remove_formError(this.id,'true')"
                                                   name="agentData[szCountry]" readonly> 
                                        </div>
                                       <?php
                                            if(form_error('agentData[szCountry]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szCountry]');?></span>
                                            </span><?php }?>
                                    </div>

                                </div>

                                <div class="form-group <?php if(form_error('agentData[szState]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label">State</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag-checkered"></i>
                                                </span>
                                            <select class="form-control " name="agentData[szState]" id="szState"
                                                    Placeholder="State" onfocus="remove_formError(this.id,'true')">
                                                <option value=''>Select</option>

                                                <option value="Australian Capital Territory" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Australian Capital Territory") ? "selected" : ""); ?>>Australian Capital Territory</option>
                                                <option value="New South Wales" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("New South Wales") ? "selected" : ""); ?>>New South Wales</option>
                                                <option value="Northern Territory" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Northern Territory") ? "selected" : ""); ?>>Northern Territory</option>
                                                <option value="Queensland" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Queensland") ? "selected" : ""); ?>>Queensland</option>
                                                <option value="South Australia" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("South Australia") ? "selected" : ""); ?> >South Australia</option>
                                                <option value="Tasmania" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Tasmania") ? "selected" : ""); ?>>Tasmania</option>
                                                <option value="Victoria" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Victoria") ? "selected" : ""); ?>>Victoria</option>
                                                <option value="Western Australia" <?php echo (sanitize_post_field_value($_POST['agentData']['szState']) == trim("Western Australia") ? "selected" : ""); ?>>Western Australia </option>


                                            </select>
                                        </div>
                                      <?php
                                            if(form_error('agentData[szState]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szState]');?></span>
                                            </span><?php }?>
                                    </div>

                                </div>
                                <div
                                    class="form-group <?php if(form_error('agentData[szCity]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label"> City</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                                </span>
                                            <input id="szCity" class="form-control" type="text"
                                                   value="<?php echo set_value('agentData[szCity]'); ?>"
                                                   placeholder="City" onfocus="remove_formError(this.id,'true')"
                                                   name="agentData[szCity]">
                                        </div>
                                        <?php
                                            if(form_error('agentData[szState]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szState]');?></span>
                                            </span><?php }?>
                                    </div>

                                </div>
                                <div
                                    class="form-group <?php if(form_error('agentData[szZipCode]')){?>has-error<?php }?>">
                                    <label class="col-md-4 control-label">ZIP/Postal Code</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-area-chart"></i>
                                                </span>
                                            <input id="szZipCode" class="form-control" type="text"
                                                   value="<?php echo set_value('agentData[szZipCode]'); ?>"
                                                   placeholder="ZIP/Postal Code"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="agentData[szZipCode]">
                                        </div>
                                        <?php
                                            if(form_error('agentData[szZipCode]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('agentData[szZipCode]');?></span>
                                            </span><?php }?>
                                    </div>

                                </div>

                               
                                <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role"
                                       onfocus="remove_formError(this.id,'true')" name="agentData[iRole]">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            
                                            <a href="<?=__BASE_URL__?>/franchisee/agentRecord" class="btn default uppercase" type="button">Cancel</a>
                                          
                                            <input type="submit" class="btn green-meadow" value="SAVE"
                                                   name="agentData[submit]">

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