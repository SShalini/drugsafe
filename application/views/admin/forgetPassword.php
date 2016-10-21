<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content">

         <!-- BEGIN FORGOT PASSWORD FORM -->
             <form class="login-form" id="forgetPassword" name="forgetPassword" method="post" autocomplete="off" action="<?php echo __BASE_URL__;?>/admin/admin_forgetPassword">
                 
                 <h3 class="form-title font-green">Password Recovery</h3>
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
                    <span class="form-title">Forget Password ?</span>
                    <span class="form-subtitle">Enter your e-mail to reset it.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="drugSafeForgotPassword[szEmail]" value="" >
                </div>
                <div class="form-actions">
                    
                    <a href="<?=__BASE_URL__?>/admin/login" class="btn btn-default" type="button">Cancel</a>
                    <button type="submit" class="btn red btn-form-submit btn-success">Submit</button>
                </div>
            </form>
         <!-- END FORGOT PASSWORD FORM -->
</div>