<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Change Password</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                           <form class="form-horizontal" id="drugsafeChangePassword" action="<?=__BASE_URL__?>/admin/changePassword" name="drugsafeChangePassword" method="post">
                                <div class="form-body">
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">Current Password</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <input type="password" name="drugsafeChangePassword[szOldPassword]" id="szOldPassword" class="form-control input-square-right required" placeholder="Current Password" > 
                                            </div>
                                                               
                                                            </div>
                                                            <?php if(!empty($arErrorMessages['szOldPassword']) != ''){?>
                                                                <span class="help-block pull-left">
                                                                    <i class="fa fa-times-circle"></i>
                                                                    <?php echo $arErrorMessages['szOldPassword'];?>
                                                                </span>
                                                            <?php }?>
                                                        </div>
                                    
                                                    <div class="form-group <?php if(!empty($arErrorMessages['szPassword']) != ''){?>has-error<?php }?>">
                                                            <label class="col-md-3 control-label">New Password</label>
                                                            <div class="col-md-4">
                                                                 <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input type="password" name="drugsafeChangePassword[szPassword]" id="szPassword" class="form-control input-square-right required" placeholder="New Password"> 
                                            </div>
                                                               
                                                            </div>
                                                            <?php if(!empty($arErrorMessages['szPassword']) != ''){?>
                                                                <span class="help-block pull-left">
                                                                    <i class="fa fa-times-circle"></i>
                                                                    <?php echo $arErrorMessages['szPassword'];?>
                                                                </span>
                                                            <?php }?>
                                                        </div>
                                                    <div class="form-group <?php if(!empty($arErrorMessages['szConfirmPassword']) != ''){?>has-error<?php }?>">
                                                            <label class="col-md-3 control-label">Confirm Password</label>
                                                            <div class="col-md-4">
                                                                   <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                  <input type="password" name="drugsafeChangePassword[szConfirmPassword]" id="szConfirmPassword" class="form-control input-square-right required re-match" placeholder="Confirm Password" > 
                                            </div>
                                                             
                                                            </div>
                                                            <?php if(!empty($arErrorMessages['szConfirmPassword']) != ''){?>
                                                                <span class="help-block pull-left">
                                                                    <i class="fa fa-times-circle"></i>
                                                                    <?php echo $arErrorMessages['szConfirmPassword'];?>
                                                                </span>
                                                            <?php }?>
                                                        </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                           <a href="<?=__BASE_URL__?>/admin/dashboard" class="btn default uppercase" type="button">Cancel</a>
                                                                <input class="btn green uppercase btn-form-submit" type="submit" value="Submit"/>
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
