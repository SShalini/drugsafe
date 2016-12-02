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
                        <li>
                            <a href="<?php echo __BASE_URL__;?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>

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
                                <span class="active">Sites</span>
                            </li>
                        <?php } ?>
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
                  <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $clientDetailsAray['id'];?>','<?php echo $clientDetailsAray['franchiseeId'];?>','<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>');" href="javascript:void(0);">
                    <i class="fa fa-pencil"></i> 
                  </a>  
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
                    if($clientDetailsAray['clientType']=='0')
                    {
                        ?>
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
                    }else{
                    ?>
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
                            <p><?php echo $clientDetailsAray['szEmail'];?></p>
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
                                $countChildClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails(false,$idClient,false,false);
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
                            <p><?php echo $clientDetailsAray['szState'];?></p>
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
                </div> 
                
             </div>
            <?php
            if($clientDetailsAray['clientType']!='0')
             
            {   
           
         
            ?>
             <!-- BEGIN CONTACT DETAILS PORTLET-->
            <div class="portlet box green-meadow">
                <div class="portlet-title">
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
               <div class="font-green-meadow bold">Who will be responsible for Scheduling ? If you would like us to manage the scheduling , write "Drugsafe".</div>  
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow bold">   Who is to receive the confirmatory lab results ? </div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['sp_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['sp_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['sp_email'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['rlr_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['rlr_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['rlr_email'];?></p>
                        </div>
                    </div>
                     </div>
                         </div>
                <hr>
               <div class="row">
            <div class="col-md-6">   
              <div class="font-green-meadow bold">Would anyone else be involved in Scheduling ? </div> 
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow bold">  Are there any other people Who are to receive the confirmatory lab results ? </div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['iis_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['iis_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['iis_email'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['orlr_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['orlr_mobile'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Email:</lable>
                        </div>
                        <div class="col-sm-4">
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
                <div class="portlet-title">
                        <div class="caption">
                             <i class="icon-equalizer "></i>
                            ON SITE SCREENING INFORMATION
                        </div>
                        <div class="tools">
                                <a href="javascript:;" class="collapse-sec collapsed" data-toggle="collapse" data-target="#onsite">
                                </a>
                        </div>
                </div>
                                        
                <div id="onsite" class="portlet-body collapse">
                   <table class="table table-hover">
                <hr>
              <div class="row">
            <div class="col-md-6">   
               <div class="font-green-meadow bold">Primary Site Contact (Assist with donar selection and supervise/manage donar if required).</div>  
              </div>  
             <div class="col-md-6"> 
                 <div class="font-green-meadow bold">Secondary Site Contact (in the event that the primary site contact is unavailable).</div> 
              </div>
                 </div>
                <hr>
                 <div class="row">
                 <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['psc_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Landline Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['psc_phone'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Mobile Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['psc_mobile'];?></p>
                        </div>
                    </div>
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Contact Name:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['ssc_name'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Landline Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['ssc_phone'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Mobile Phone Number:</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['ssc_mobile'];?></p>
                        </div>
                    </div>
                     </div>
                         </div>
                <hr>
               
                 <div class="row">
                 <div class="col-md-6">  
                 
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>How many people on site ? :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['site_people'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>How many to test ? :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['test_count'];?></p>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>What type of service would you like on-site ? :</lable>
                        </div>
                        <div class="col-sm-4">
                             <p><?php if($userDataAry['onsite_service']==0)  echo "Mobile Clinic ";  else echo "In-house";?></p>
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Access to power for our Mobile :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php if($userDataAry['power_access']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                    </div>
                         <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Are our people required to complete an induction ? :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php if($userDataAry['req_comp_induction']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Randomization process:</lable>
                        </div>
                        <div class="col-sm-4">
                             <p><?php if($userDataAry['randomisation']==0) { echo "Marble selection (% split)-not accurate";}  elseif($userDataAry['randomisation']==1) { echo "Drugsafe given names then select via algorythm";} else {echo "Client does randomization";}?></p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>who would be responsible for all the Paperwork at the time of testing ? :</lable>
                        </div>
                        <div class="col-sm-4">
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
                         <div class="col-sm-8 text-info ">
                            <lable>Any special instruction for Drugsafe staff (directions,instructions etc):</lable>
                        </div>
                         <div class="col-sm-4">
                            <p><?php echo $userDataAry['instructions'];?></p>
                        </div>
                    </div>
                    
                     
                     </div>
                     <div class="col-md-6">  
                 <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Initial Testing Requirements :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php if($userDataAry['initial_testing_req']==0)  echo "Random";  else echo "Blanket";?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Ongoing Testing Requirements :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php if($userDataAry['ongoing_testing_req']==0)  echo "Random";  else echo "Blanket";?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>How many times would you like Drugsafe to visit your site and test per year ?</lable>

                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['site_visit'];?></p>
                        </div>
                    </div>
                          <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Preffered start time :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $userDataAry['start_time'];?></p>
                        </div>
                    </div>
                          <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Is a risk assessment required prior to working on-site ? :</lable>
                        </div>
                        <div class="col-sm-4">
                           <p><?php if($userDataAry['risk_assessment']==0)  echo "Yes";  else echo "No";?></p>
                        </div>
                          </div>
                       <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Required PPE :</lable>
                        </div>
                        <div class="col-sm-4">
                            <p><?php 
                            $req_ppe_ary = explode(",", $userDataAry['req_ppe']);
                             if(in_array("1", $req_ppe_ary)){
                             echo "High Vis Work Wear" ; }
                             if(in_array("2", $req_ppe_ary)){
                             echo " Head Protection" ;  } 
                              if(in_array("3", $req_ppe_ary)){
                               echo " Face/Eye Protection" ;  } 
                               if(in_array("4", $req_ppe_ary)){
                               echo " Safety Boots" ;  }
                              if(in_array("5", $req_ppe_ary)){
                                 echo "  Long Sleev Clothing" ;  
                               }
                            ?></p>
                        </div>
                    </div>
                         <?php if($userDataAry['paperwork']==2){?>
                     <div class="row">
                        <div class="col-sm-8 text-info ">
                            <lable>Specify Contact:</lable>
                        </div>
                        <div class="col-sm-4">
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
                    if($_SESSION['drugsafe_user']['iRole']=='1')
                    {
                        if($clientDetailsAray['szNoOfSites'] > $count){
                        ?>
                        <button class="btn btn-sm green-meadow" onclick="addClientData(<?php echo $franchiseeArr['id']; ?>,<?php echo $clientDetailsAray['id']; ?>,'<?php echo __URL_FRANCHISEE_CLIENTRECORD__ ;?>');">
                        &nbsp;Add Site
                        </button>
                        <?php
                    }}
                    else 
                    {
                        ?>
                        <button class="btn btn-sm green-meadow" onclick="addClientData(<?php echo $franchiseeArr['id']; ?>,<?php echo $clientDetailsAray['id']; ?>,'<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__;?>');">
                        &nbsp;Add Site
                        </button>
                        <?php
     
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
                          <div class="search col-md-3">
                            <input type="text" name="szSearchClDetails" id="szSearchClDetails" class="form-control input-square-right " placeholder="Id,Name Or Email " value="<?=sanitize_post_field_value($_POST['szSearchClDetails'])?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                           </form>
                          </div>
                    <div class="row">
                <div class="table-responsive">
                   <table id="sample_1" class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" role="grid" aria-describedby="sample_1_info">
                        <thead>
                            <tr>
                                <th> Id </th>
				<th> Company Name </th>
                                <th> Company Email </th>
                                <th>Company Phone Number</th>
                                <th> Created By</th>
                                <th> Updated By</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                       $i = 0;
                                        foreach($childClientDetailsAray as $childClientDetailsData)
                                        {
                                           
                                        ?>
                                        <tr>
                                            <td> CL-<?php echo $childClientDetailsData['id'];?> </td>
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
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $childClientDetailsData['id'];?>',<?php echo $childClientDetailsData['franchiseeId'];?>,'<?php echo __URL_FRANCHISEE_VIEWCLIENTDETIALS__  ;?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Client Details" onclick="viewClientDetails(<?php echo $childClientDetailsData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Client" onclick="clientDelete('<?php echo $childClientDetailsData['id'];?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__ ;?>');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>

                                                </a>
                                                
                                               
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
            ?>
                <p>No Client Found.</p>
            <?php
            }
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