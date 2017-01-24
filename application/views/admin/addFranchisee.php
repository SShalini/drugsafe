
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
                        <span class="active">Add Franchisee</span>
                    </li>
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Add Franchisee</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn btn-sm green-meadow"
                                        onclick="redirect_url('<?php echo base_url(); ?>admin/franchiseeList');">
                                    &nbsp; Franchisee List
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" id="addfranchisee"
                              action="<?= __BASE_URL__ ?>/admin/addFranchisee" name="addfranchisee" method="post">
                            <div class="form-body">
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szName']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label"> Name</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                            <input id="szName" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szName']; ?>"
                                                   placeholder="Name" onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szName]"/>

                                        </div>
                                        <?php if (!empty($arErrorMessages['szName'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szName']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group <?php if (!empty($arErrorMessages['szEmail']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label"> Email</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                            <input id="szEmail" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szEmail']; ?>"
                                                   placeholder="Email" onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szEmail]">
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
                                    class="form-group <?php if (!empty($arErrorMessages['szContactNumber']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label"> Contact No</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                                </span>
                                            <input id="szContactNumber" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szContactNumber']; ?>"
                                                   placeholder="Contact Number"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szContactNumber]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szContactNumber'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szContactNumber']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>
                                <?php
                              
                                  if($_SESSION['drugsafe_user']['iRole']=='1'){
                                    if ($flag==1) {
                                        ?>
                                        <div
                                            class="form-group <?php if (!empty($arErrorMessages['operationManagerId'])) { ?>has-error<?php } ?>">
                                            <label class="col-md-3 control-label">Operation Manager</label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-male"></i>
                                                </span>
                                                    <select class="form-control" name="addFranchisee[operationManagerId]"
                                                            id="franchiseeId" Placeholder="Operation Manager"
                                                            onfocus="remove_formError(this.id,'true')">
                                                        <option value=''>Select</option>
                                                        <?php
                                                        $operationManagerAray =$this->Admin_Model->viewOperationManagerList();
                                                        if (!empty($operationManagerAray)) {
                                                            foreach ($operationManagerAray as $operationManagerDetails) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo trim($operationManagerDetails['id']); ?>" <?php echo(sanitize_post_field_value($_POST['addFranchisee']['operationManagerId']) == trim($operationManagerDetails['id']) ? "selected" : ""); ?>><?php echo trim($operationManagerDetails['szName']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <?php if (!empty($arErrorMessages['operationManagerId'])) { ?>
                                                    <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                        <?php echo $arErrorMessages['operationManagerId']; ?>
                                            </span>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <?php

                                    } else {
                                        ?>
                                <input id="operationManagerId" class="form-control" type="hidden"
                                               value="<?php echo $idOperationManager; ?>" name="addFranchisee[operationManagerId]">
                                        <?php
                                  }
                                  
                                    }else{
                                    ?>
                                <input id="operationManagerId" class="form-control" type="hidden"
                                               value="<?php echo $_SESSION['drugsafe_user']['id']; ?>" name="addFranchisee[operationManagerId]">
                                  <?php
                                  }
                                    ?>
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szAddress']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                                </span>
                                            <input id="szAddress" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szAddress']; ?>"
                                                   placeholder="Address" onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szAddress]">
                                        </div>
                                        <?php if (!empty($arErrorMessages['szAddress'])) { ?>
                                            <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                <?php echo $arErrorMessages['szAddress']; ?>
                                            </span>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div
                                    class="form-group <?php if (!empty($arErrorMessages['szCountry']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag"></i>
                                                </span>
                                             <input id="szCountry" class="form-control read-only" type="text"
                                                   value="Australia" readonly
                                                   placeholder="Country" onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szCountry]"> 
                                           
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
                                    class="form-group <?php if (!empty($arErrorMessages['szState']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label">State</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-flag-checkered"></i>
                                                </span>
                                            <select class="form-control " name="addFranchisee[szState]" id="szState"
                                                    Placeholder="State" onfocus="remove_formError(this.id,'true')">
                                                <option value=''>Select</option>
                                                
                                                        <option value="Australian Capital Territory" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Australian Capital Territory") ? "selected" : ""); ?>>Australian Capital Territory</option>
                                                        <option value="New South Wales" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("New South Wales") ? "selected" : ""); ?>>New South Wales</option>
                                                        <option value="Northern Territory" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Northern Territory") ? "selected" : ""); ?>>Northern Territory</option>
                                                        <option value="Queensland" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Queensland") ? "selected" : ""); ?>>Queensland</option>
                                                        <option value="South Australia" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("South Australia") ? "selected" : ""); ?> >South Australia</option>
                                                        <option value="Tasmania" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Tasmania") ? "selected" : ""); ?>>Tasmania</option>
                                                        <option value="Victoria" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Victoria") ? "selected" : ""); ?>>Victoria</option>
                                                        <option value="Western Australia" <?php echo (sanitize_post_field_value($_POST['addFranchisee']['szState']) == trim("Western Australia") ? "selected" : ""); ?>>Western Australia </option>
                                                       
                                                  
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
                                    class="form-group <?php if (!empty($arErrorMessages['szCity']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label"> City</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                                </span>
                                            <input id="szCity" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szCity']; ?>"
                                                   placeholder="City" onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szCity]"> 
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
                                    class="form-group <?php if (!empty($arErrorMessages['szZipCode']) != '') { ?>has-error<?php } ?>">
                                    <label class="col-md-3 control-label">ZIP/Postal Code</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-area-chart"></i>
                                                </span>
                                            <input id="szZipCode" class="form-control" type="text"
                                                   value="<?php echo $_POST['addFranchisee']['szZipCode']; ?>"
                                                   placeholder="ZIP/Postal Code"
                                                   onfocus="remove_formError(this.id,'true')"
                                                   name="addFranchisee[szZipCode]">
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
                            <input id="iRole" class="form-control" type="hidden" value="2" placeholder="Role"
                                   onfocus="remove_formError(this.id,'true')" name="addFranchisee[iRole]">
                            <div class="form-actions">
                                <div class="row">

                                    <div class="col-md-offset-3 col-md-4">
                                      <?php  if ($flag==1){ ?>
                                        <a href="<?= __BASE_URL__ ?>/admin/franchiseeList" class="btn default uppercase"
                                           type="button">Cancel</a>
                                        <?php } else {?>
                                         <a href="<?= __BASE_URL__ ?>/admin/operationManagerList" class="btn default uppercase"
                                           type="button">Cancel</a>
                                      <?php }?>
                                        <input type="submit" class="btn green-meadow" value="SAVE"
                                               name="addFranchisee[submit]">
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>