<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
 <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo __BASE_URL__;?>">
<!--               <h1 class="site-title">Drug Safe</h1>-->
                <img src="<?php echo __BASE_URL__;?>/images/logo.png" />
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
       
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" id="loginAry" action="<?php echo __BASE_URL__;?>/admin/admin_login" name="loginAry" method="post">    
               <?php 
            if(!empty($_SESSION['drugsafe_user_message']))
            {
                    if(trim($_SESSION['drugsafe_user_message']['type']) == "success")
                    {
                    ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                        </div>
                    <?php

                    }
                    if(trim($_SESSION['drugsafe_user_message']['type']) == "error")
                    {
                    ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                        </div>
                    <?php
                    }
                    $this->session->unset_userdata('drugsafe_user_message');
            }
            ?>

                <div class="form-title">
                    <!--<span class="form-title"><h3>Welcome.</h3></span>
                    <span class="form-subtitle">Please login.</span>-->
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group <?php if(!empty($arErrorMessages['szEmail']) != ''){?>has-error<?php }?>">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid input-square-right required email registered-admin-email " type="email" autocomplete="off" placeholder="Email Address" name="adminLogin[szEmail]" id="szEmail" value="<?php echo $_POST['adminLogin']['szEmail'];?>"/>
                    <?php if(!empty($arErrorMessages['szEmail']) != ''){?>
                <span class="help-block pull-left">
                        <i class="fa fa-times-circle"></i>
                        <?php echo $arErrorMessages['szEmail'];?>
                </span>
            <?php }?> 
                </div>
                
                <div class="form-group <?php if(!empty($arErrorMessages['szPassword']) != ''){?>has-error<?php }?>">
               <label class="control-label visible-ie8 visible-ie9">Password</label>
              <input class="form-control form-control-solid placeholder-no-fix input-square-right required " type="password" autocomplete="off" placeholder="Password" name="adminLogin[szPassword]" id="szPassword" value="<?php echo $_POST['adminLogin']['szPassword'];?>" /> 
            <?php if(!empty($arErrorMessages['szPassword']) != ''){?>
                <span class="help-block pull-left">
                    <i class="fa fa-times-circle"></i>
                    <?php echo $arErrorMessages['szPassword'];?>
                </span>
            <?php }?>
        </div>
               
                
                <div class="form-actions">
                     <button type="button" class="btn red btn-block uppercase btn-form-submit">Login</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme check">
                            <input type="checkbox" name="adminLogin[iRemember]" value="1" <?php if((int)$_POST['adminLogin']['iRemember'] == 1){?>checked="true"<?php }?>>Remember me </label>
                    </div>
                    
                    <div class="pull-right forget-password-block">
                         <a href="<?php echo __BASE_URL__;?>/admin/admin_forgetPassword" id="forget-password" class="forget-password" >Forgot Password?</a>
                    </div>
                </div>
                
                
            </form>
</div>