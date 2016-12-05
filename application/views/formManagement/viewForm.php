   <div class="page-content-wrapper">
        <div class="page-content">
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

            <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Form Management </span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Form Management </span>
                            </div>
                            
                        </div>
                     
                       
                         <div class="row">
                              <form class="form-horizontal" id="szSearchField" action="<?=__BASE_URL__?>/admin/franchiseeList" name="szSearchField" method="post">
                          <div class="search col-md-3">
                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?=sanitize_post_field_value($_POST['szSearch'])?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                           </form>
                          </div>
                             <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Franchisee Name</th>
                                        <th> Client Name </th>
                                        <th> Site Name</th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                        <tr>
                                            <td>Shalini singh</td>
                                            <td> Shalini singh </td>
                                            <td> Test </td>
                                           <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="sosForm" title="View SOS Form" onclick="viewSosFormDetails('224');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>

                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default"  id="cocForm" title="View COC Form"  onclick="viewUserDetails('<?php echo $franchiseeData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-eye"></i> 
                                                </a>
                                                
                                                
                                            </td>
                                        </tr>
                                        
                                </tbody>
                            </table>
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
<div id="popup_box"></div>