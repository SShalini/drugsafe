<script type='text/javascript'>
    $(function() {
        $("#szSearchname").customselect();
    });
</script>
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
                    if($_SESSION['drugsafe_user']['iRole'] == '1'){
                     ?>
                        <li>
                            <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                         <?php
                    }
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
                                <span class="active">Site's Detail</span>
                            </li>
                        <?php } else { ?>
                              <li>
                                <i class="fa fa-circle"></i>
                                <span class="active"> Details</span>
                            </li>
                      <?php }  ?>
                    </ul>
     <div class="portlet light bordered about-text" id="user_info">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                 
                    <?php 
                    /*if($clientDetailsAray['clientType']=='0')
                    {
                        echo $clientDetailsAray['szName']."'s Headquarters";
                    }
                    else
                    {*/
                       echo $clientDetailsAray['szName']."'s Details";
//                    }
                   ?>
                    &nbsp; &nbsp;
                   <?php  if($_SESSION['drugsafe_user']['iRole']=='2'){
                   if($clientDetailsAray['clientType'] == '0'){?>  
                  <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $clientDetailsAray['id'];?>','<?php echo $clientDetailsAray['franchiseeId'];?>','<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>');" href="javascript:void(0);">
                    <i class="fa fa-pencil"></i> 
                  </a> 
                   <?php } else { ?>
                    <a class="btn btn-circle btn-icon-only btn-default" title="Edit Site Data" onclick="editClient('<?php echo $clientDetailsAray['id'];?>','<?php echo $clientDetailsAray['franchiseeId'];?>','<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>');" href="javascript:void(0);">
                    <i class="fa fa-pencil"></i> 
                  </a>  
                   <?php } } ?>
                </span>
            </div>
            <!--<div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php /*echo base_url();*/?>franchisee/clientList');">
                        &nbsp;Client List
                    </button>
                </div>
            </div>-->
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-6">
                     <?php
                     if($clientDetailsAray['id']>0){
                         $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($clientDetailsAray['id']);
                     }
                    if($clientDetailsAray['clientType']=='0')
                    {

                        ?>
                        <div class="row">
                            <div class="col-sm-4 text-info bold">
                                <lable>Client Code:</lable>
                            </div>
                            <div class="col-sm-8">
                                <p><?php echo (!empty($franchiseecode['userCode'])?$franchiseecode['userCode']:'N/A');?></p>
                            </div>
                        </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable> Business Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szBusinessName'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Primary Email:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szEmail'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactEmail'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact Mobile:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactMobile'];?></p>
                        </div>
                    </div>
                     <?php
                        $discountcode = $this->Franchisee_Model->getDiscountList($clientDetailsAray['discountid']);
                        if(!empty($discountcode)){ ?>
                            <div class="row">
                                <div class="col-sm-4 text-info bold">
                                    <lable>Discount:</lable>
                                </div>
                                <div class="col-sm-8">
                                    <p><?php echo ($clientDetailsAray['discountid']>'0'?$discountcode[0]['percentage']:'0.00');?>%</p>
                                </div>
                            </div>
                        <?php }
                    }else{
                    ?>
                        <div class="row">
                            <div class="col-sm-4 text-info bold">
                                <lable>Site Code:</lable>
                            </div>
                            <div class="col-sm-8">
                                <p><?php echo (!empty($franchiseecode['userCode'])?$franchiseecode['userCode']:'N/A');?></p>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Company Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szName'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Company Email:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szEmail'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Company Phone Number:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactNumber'];?></p>
                        </div>
                    </div>
                   
                     <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>City:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szCity'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Country:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szCountry'];?></p>
                        </div>
                    </div>
                    <?php
                    if($clientDetailsAray['clientType']=='0')
                    {
                        ?>
                        <div class="row">
                            <div class="col-sm-4 text-info bold">
                                <lable>Total No of Sites:</lable>
                            </div>
                            <div class="col-sm-8">
                                <p><?php
                                $countChildClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($idClient,false,false);
                                    $count='0';
                                    if($countChildClientDetailsAray)
                                    {
                                        $count=count($countChildClientDetailsAray);
                                    }
                                    echo $count;
                                    ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-6">
                     <?php
                    if($clientDetailsAray['clientType']=='0')
                    { 
                        ?>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ABN:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['abn'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szName'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Primary Phone No:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactNumber'];?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact Phone No:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactPhone'];?></p>
                        </div>
                    </div>
                      <?php
                    }else{ 
                      
                      $userDataAry = $this->Franchisee_Model->getSiteDetailsById($idClient);   
                    ?>
                     <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Name of Person Completing Form:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $userDataAry['per_form_complete'];?></p>
                        </div>
                    </div>
                   
                    
                    
                   <?php
                    }
                    ?>
                    
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Address:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szAddress'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>State:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $getState['name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ZIP/Postal Code:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szZipCode'];?></p>
                        </div>
                    </div>
                    <?php if($clientDetailsAray['clientType']=='0'){?>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Industry:</lable>
                        </div>
                        <div class="col-sm-8">
                            <?php if($clientDetailsAray['industry']==1){
                                $value = 'Agriculture, Forestry and Fishing';
                            }
                            if($clientDetailsAray['industry']==2){
                                $value = 'Mining';
                            }
                            if($clientDetailsAray['industry']==3){
                                $value = 'Manufacturing';
                            }
                            if($clientDetailsAray['industry']==4){
                                $value = 'Electricity, Gas and Water Supply';
                            }if($clientDetailsAray['industry']==5){
                                $value = 'Construction';
                            }if($clientDetailsAray['industry']==6){
                                $value = 'Wholesale Trade';
                            }if($clientDetailsAray['industry']==7){
                                $value = 'Transport and Storage';
                            }if($clientDetailsAray['industry']==8){
                                $value = 'Communication Services';
                            }if($clientDetailsAray['industry']==9){
                                $value = 'Agriculture, Property and Business Services';
                            }if($clientDetailsAray['industry']==10){
                                $value = 'Agriculture, Government Administration and Defence';
                            }if($clientDetailsAray['industry']==11){
                                $value = 'Education';
                            }
                            if($clientDetailsAray['industry']==12){
                                $value = 'Health and Community Services';
                            }if($clientDetailsAray['industry']==13){
                                $value = 'Other';
                            }  ?>

                            <p><?php echo $value;?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div> 
                
             </div>
            <?php
            if($clientDetailsAray['clientType']!='0')
             
            {   
           
         
            ?>
             <!-- BEGIN CONTACT DETAILS PORTLET-->
            <div class="portlet box green-meadow">
                 <div class="portlet-title" data-toggle="collapse" data-target="#contact-details">
                    <div class="caption">
                        <i class="icon-equalizer "></i>
                        Contact Details
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse-sec collapsed" data-toggle="collapse" data-target="#contact-details">
                        </a>


                    </div>
                </div>
                                        
                <div class="portlet-body collapse" id="contact-details">
                   <table class="table table-hover">
                <hr>
              <div class="row">
            <div class="col-md-6">   
               <div class="font-green-meadow text bold ">Responsible for Scheduling. </div>  
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow text bold">   Receive the confirmatory lab results.  </div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6 ">
                            <p><?php echo $userDataAry['sp_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['sp_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['sp_email'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 bold text-style ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['rlr_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 bold text-style ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['rlr_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6  bold text-style ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['rlr_email'];?></p>
                        </div>
                    </div>
                     </div>
                         </div>
                <hr>
               <div class="row">
            <div class="col-md-6">   
              <div class="font-green-meadow text bold">Involved in Scheduling. </div> 
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow text bold">  Other people  receive the confirmatory lab results. </div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['iis_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['iis_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['iis_email'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['orlr_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['orlr_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['orlr_email'];?></p>
                        </div>
                    </div>
                     </div>
                     
                         </div>                    
                                    
                    </table>

                    </div>
            </div> 
            <!-- END CONTACT DETAILS PORTLET-->
            
                         <!-- BEGIN ON SITE SCREENING INFORMATION PORTLET-->
            <div class="portlet box green-meadow">
                <div class="portlet-title" data-toggle="collapse" data-target="#onsite">
                    <div class="caption">
                        <i class="icon-equalizer "></i>
                        ONSITE SCREENING INFORMATION
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="collapse-sec collapsed" data-toggle="collapse" data-target="#onsite">
                        </a>

                    </div>
                </div>
                                        
                <div id="onsite" class="portlet-body collapse">
                   <table class="table table-hover">
                <hr>
              <div class="row">
            <div class="col-md-6">   
               <div class="font-green-meadow text bold">Primary Site Contact.</div>  
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow bold text">Secondary Site Contact.</div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 text-style bold ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['psc_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Landline Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['psc_phone'];?></p>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-6 text-style bold">
                            <lable>Mobile Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['psc_mobile'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['ssc_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Landline Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['ssc_phone'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Mobile Phone Number:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['ssc_mobile'];?></p>
                        </div>
                    </div>
                     </div>
                         </div>
                <hr>
               
                 <div class="row">
                 <div class="col-md-6">  
                 
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>People on site:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['site_people'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Test Count :</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['test_count'];?></p>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Type of service preferred on-site:</lable>
                        </div>
                        <div class="col-sm-6">
                             <p><?php if($userDataAry['onsite_service']==0)  echo "Mobile Clinic ";  else echo "In-house";?></p>
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Access to power for our Mobile:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php if($userDataAry['power_access']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                    </div>
                         <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Our people required to complete an induction:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php if($userDataAry['req_comp_induction']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Randomization process:</lable>
                        </div>
                        <div class="col-sm-6">
                             <p><?php if($userDataAry['randomisation']==0) { echo "Marble selection (% split)-not accurate";}  elseif($userDataAry['randomisation']==1) { echo "Drugsafe given names then select via algorythm";} else {echo "Client does randomization";}?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Paperwork at the time of testing:</lable>
                        </div>
                        <div class="col-sm-6">
                             <p><?php 
                         
                             if($userDataAry['paperwork']==0){
                             echo "Leave onsite with site contact" ; }
                             if($userDataAry['paperwork']==1){
                             echo "Return to Drugsafe for filing" ;  } 
                              if($userDataAry['paperwork']==2){
                               echo "Return to Drugsafe and and emailed to specific contact" ;  } 
                            ?></p>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-sm-6 text-style bold">
                            <lable>Special instruction for Drugsafe staff:</lable>
                        </div>
                         <div class="col-sm-6">
                            <p><?php echo $userDataAry['instructions'];?></p>
                        </div>
                    </div>
                    
                     
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                       <div class="col-sm-6 text-style bold">
                            <lable>Initial Testing Requirements:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php if($userDataAry['initial_testing_req']==0)  echo "Random";  else echo "Blanket";?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Ongoing Testing Requirements:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php if($userDataAry['ongoing_testing_req']==0)  echo "Random";  else echo "Blanket";?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>No of times  Drugsafe  visit your site:</lable>

                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['site_visit'];?></p>
                        </div>
                    </div>
                          <div class="row">
                       <div class="col-sm-6 text-style bold">
                            <lable>Preferred start time:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['start_time'];?></p>
                        </div>
                    </div>
                          <div class="row">
                       <div class="col-sm-6 text-style bold">
                            <lable>Risk assessment required:</lable>
                        </div>
                        <div class="col-sm-6">
                           <p><?php if($userDataAry['risk_assessment']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                          </div>
                       <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Required PPE :</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php 
                            $req_ppe_ary = explode(",", $userDataAry['req_ppe']);
                             if(in_array("1", $req_ppe_ary)){
                             echo "High Vis Work Wear" ; }
                              ?></p>
                               <p><?php 
                             if(in_array("2", $req_ppe_ary)){
                             echo " Head Protection" ;  } 
                              ?></p>
                              <p><?php 
                              if(in_array("3", $req_ppe_ary)){
                               echo " Face/Eye Protection" ;  }
                                ?></p>
                               <p><?php 
                               if(in_array("4", $req_ppe_ary)){
                               echo " Safety Boots" ;  }
                                 ?></p>
                                <p><?php 
                              if(in_array("5", $req_ppe_ary)){
                                 echo "  Long Sleev Clothing" ;  
                               }
                            ?></p>
                        </div>
                    </div>
                         <?php if($userDataAry['paperwork']==2){?>
                     <div class="row">
                        <div class="col-sm-6 text-style bold">
                            <lable>Specify Contact:</lable>
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $userDataAry['specify_contact'];?></p>
                        </div>
                          </div> 
                         <?php }?>
                        
                     </div>
                         </div>                    
                          
                    </table>

                    </div>
            </div> 
            <!-- END ON SITE SCREENING INFORMATION PORTLET-->
            <?php
                }
             ?> 
        </div>
     </div>
    <?php
     if($clientDetailsAray['clientType']=='0')
    {
         ?>           
       <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">SITES</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <?php
                 
                    if($_SESSION['drugsafe_user']['iRole']=='2')
                    {
                        if($clientDetailsAray['szNoOfSites'] > $count){
                        ?>
                        <button class="btn btn-sm green-meadow" onclick="addClientData(<?php echo $franchiseeArr['id']; ?>,<?php echo $clientDetailsAray['id']; ?>,'<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__;?>');">
                        &nbsp;Add Site
                        </button>
                        <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
            
        </div>
        <div class="portlet-body">
            <?php        
            if($childClientDetailsAray)
            {
            ?>
            
             <div class="row">
                           <form class="form-horizontal" id="szSearchClientDetailsList" action="<?=__BASE_URL__?>/franchisee/viewClientDetails" name="szSearchClientDetailsList" method="post">
                          <!--<div class="search col-md-3">
                            <input type="text" name="szSearchClDetails" id="szSearchClDetails" class="form-control input-square-right " placeholder="Id,Name Or Email " value="<?/*=sanitize_post_field_value($_POST['szSearchClDetails'])*/?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
<!--                               <div class="search col-md-3">
                                                               <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
                                   <select class="form-control custom-select" name="szSearchClRecord" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                       <option value="">Client Id</option>
                                       <?php
                                       foreach($sitesArr as $sitesIdList)
                                       {
                                           $selected = ($sitesIdList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                           echo '<option value="'.$sitesIdList['id'].'" >CL-'.$sitesIdList['id'].'</option>';
                                       }
                                       ?>
                                   </select>
                               </div>
                               <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
                               <!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                               <div class="search col-md-3">
                                   <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                   <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                       <option value="">Company Name</option>
                                       <?php
                                       foreach($sitesArr as $sitesIdList)
                                       {
                                           $selected = ($sitesIdList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                           echo '<option value="'.$sitesIdList['id'].'" ' . $selected . '>'.$sitesIdList['szName'].'</option>';
                                       }
                                       ?>
                                   </select>
                               </div>
<!--                               <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
<!--                               <div class="search col-md-3">
                                                               <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
                                   <select class="form-control custom-select" name="szSearchClRecord1" id="szSearchemail" onfocus="remove_formError(this.id,'true')">
                                       <option value="">Company Email</option>
                                       <?php
                                       foreach($sitesArr as $sitesIdList)
                                       {
                                           $selected = ($sitesIdList['id'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');
                                           echo '<option value="'.$sitesIdList['id'].'" >'.$sitesIdList['szEmail'].'</option>';
                                       }
                                       ?>
                                   </select>
                               </div>-->
                               <div class="col-md-1">
                                   <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                               </div>
                           </form>
                          </div>
                    <div class="row">
                <div class="table-responsive">
                   <table id="sample_1" class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" role="grid" aria-describedby="sample_1_info">
                        <thead>
                            <tr>
                                <th width="190px;"> Site Code</th>
				<th width="90px;"> Company Name </th>
                                <th width="90px;"> Company Email </th>
                                <th width="90px;">Company Phone Number</th>
                                <th width="90px;"> Created By</th>
                                <th width="90px;"> Updated By</th>
                                <th width="50px;"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                       $i = 0;
                                        foreach($childClientDetailsAray as $childClientDetailsData)
                                        {
                                            $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($childClientDetailsData['id']);
                                        ?>
                                        <tr>
                                            <td><?php echo (!empty($franchiseecode['userCode'])?$franchiseecode['userCode']:'N/A');?></td>
                                            <td> <?php echo $childClientDetailsData['szName']?> </td>
                                            <td> <?php echo $childClientDetailsData['szEmail'];?> </td>
                                             <td> <?php echo $childClientDetailsData['szContactNumber'];?> </td>
                                              <td>
                                        <?php
                                        if($childClientDetailsData['szCreatedBy'])
                                        {
                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$childClientDetailsData['szCreatedBy']);
                                            echo $franchiseeDetArr['szName'];
                                        }
                                        ?>
                                        
                                        </td>
                                        <td>
                                            <?php 
                                            if($childClientDetailsData['szLastUpdatedBy'])
                                            {
                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$childClientDetailsData['szLastUpdatedBy']);
                                                echo $franchiseeDetArr['szName'];
                                            }
                                            else
                                            {
                                               echo "N/A";
                                            }
                                           
                                            ?> 
                                        </td>
                                         <td>
                                              <?php
                                              if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                               ?>
                                              
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Site" onclick="editClient('<?php echo $childClientDetailsData['id'];?>',<?php echo $childClientDetailsData['franchiseeId'];?>,'<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>','1');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                    <?php }  ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Site Details" onclick="viewClientDetails(<?php echo $childClientDetailsData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <?php
                                              if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                                    $id =   $childClientDetailsData['id'];
                                                   $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetailsByClientId($id);
                                                     if(empty($sosRormDetailsAry)) {
                                               ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Site" onclick="clientDelete('<?php echo $childClientDetailsData['id'];?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__ ;?>');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>

                                                </a>
                                                     <?php } }  ?>
                                               
                                            </td>
                                            
                                        </tr>
                                        <?php 
                                         $i++;
                                        }
                                   ?>
                        </tbody>
                    </table>
                </div>
                 
                          </div>
                       
            <?php 
            }
            else
            {
             if($clientDetailsAray['clientType']=='0'){
            ?>
            
                <p>No Site Found.</p>
            <?php
            }else{ ?>
                
              <p>No Client Found.</p>   
            <?php } }
            ?>
                         <?php  if(!empty($childClientDetailsAray)){?>
		<div class="row">
                  
                    <div class="col-md-7 col-sm-7">
                        <div class="dataTables_paginate paging_bootstrap_full_number">
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
	    	
                 
            </div>
    	<?php }?>
        </div>
    </div>           
          <?php   
    }
    ?>    
</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>