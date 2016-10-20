
<div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title">
            Change Password
        </h3>
            <form class="form-horizontal" id="drugsafeChangePassword" action="<?=__BASE_URL__?>/admin/changePassword" name="drugsafeChangePassword" method="post">
                <div class="container">
                    <div class="page-content-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-sidebar">
                                  
                                </div>
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="portlet light <?php if(!empty($arErrorMessages['szOldPassword']) != ''){?>has-error<?php }?>">
                                                <div class="portlet-body form">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Current Password</label>
                                                            <div class="col-md-4">
                                                                <input type="password" name="drugsafeChangePassword[szOldPassword]" id="szOldPassword" class="form-control input-square-right required" placeholder="Current Password" > 
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
                                                                <input type="password" name="drugsafeChangePassword[szPassword]" id="szPassword" class="form-control input-square-right required" placeholder="New Password"> 
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
                                                                <input type="password" name="drugsafeChangePassword[szConfirmPassword]" id="szConfirmPassword" class="form-control input-square-right required re-match" placeholder="Confirm Password" > 
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
                                                            <div class="col-md-3 pull-right">
                                                                <a href="<?=__BASE_URL__?>/admin/dashboard" class="btn default uppercase" type="button">Cancel</a>
                                                                <input class="btn green uppercase btn-form-submit" type="submit" value="Submit"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
           </form>     
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
        </div>
</div>
