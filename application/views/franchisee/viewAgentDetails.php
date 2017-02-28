
<div class="page-content-wrapper">
        <div class="page-content">
             <?php
            if(!empty($_SESSION['drugsafe_user_message'])){
                if(trim($_SESSION['drugsafe_user_message']['type']) == "success"){
                    ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                    </div>
                <?php }
                if(trim($_SESSION['drugsafe_user_message']['type']) == "error") {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                    </div>
                <?php }
                $this->session->unset_userdata('drugsafe_user_message');
            }
            ?>
            
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                         <?php
                    if($_SESSION['drugsafe_user']['iRole'] == '2'){
                     ?>
                  
                    <li>
                        <a href="<?php echo __BASE_URL__;?>/franchisee/clientRecord">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                      <?php } else {?>
                    
                    <li>
                        <a href="<?php echo __BASE_URL__;?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                      <?php  } ?>
                 
                     <?php
                   
                     $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$franchiseeid);
                     ?>
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/franchisee/agentRecord" ><?php echo $franchiseeDetArr['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                         <li>
                            <a onclick="" href="javascript:void(0);"><?php echo $recordArr['0']['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                              
                                <span class="active">Details</span>
                            </li>
                         <?php
                    
                     ?>
                     <?php
                    if($_SESSION['drugsafe_user']['iRole'] == '5'){
                     ?>
                         <li>
                            <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                         <?php
                    }
                     ?>
                        <?php if($clientDetailsAray['clientType'] > '0'){?>
                            <li>
                                <a onclick="viewClientDetails(<?php echo $ParentOfChild['id'];?>);" href="javascript:void(0);"><?php echo $ParentOfChild['szName'];?></a>
                                <i class="fa fa-circle"></i>
                            </li>
                        <?php } ?>
                        <li>
                            <a onclick="viewClientDetails(<?php echo $clientDetailsAray['id'];?>);" href="javascript:void(0);"><?php echo $clientDetailsAray['szName'];?></a>
                        </li>
                        <?php if($clientDetailsAray['clientType'] == '0'){?>
                            <li>
                                <i class="fa fa-circle"></i>
                                <span class="active">Agent/Employee</span>
                            </li>
                        <?php } ?>
                    </ul>
     <div class="portlet light bordered about-text" id="user_info">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                <?php
                      echo $recordArr['0']['szName']."'s Details";
?>
                    &nbsp; &nbsp;
                   <?php  if($_SESSION['drugsafe_user']['iRole']=='2'){?>
                  <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $clientDetailsAray['id'];?>','<?php echo $clientDetailsAray['franchiseeId'];?>','<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>');" href="javascript:void(0);">
                    <i class="fa fa-pencil"></i> 
                  </a> 
                <?php }?>
                </span>
            </div>
        </div>
        
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-6">
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>  Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szName'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable> Email:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szEmail'];?></p>
                        </div>
                    </div>
                  <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Address:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szAddress'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>State:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szState'];?></p>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ZIP/Postal Code:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szZipCode'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ABN:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['abn'];?></p>
                        </div>
                    </div>
                     
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact Number:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szContactNumber'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Country:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szCountry'];?></p>
                        </div>
                    </div>
                  <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>City:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $recordArr['0']['szCity'];?></p>
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
<div id="popup_box"></div>