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
                                <lable>Total No of Agent:</lable>
                            </div>
                            <div class="col-sm-8">
                                <p><?php
                                
                                   $agentSearchDetailsAray = $this->Franchisee_Model->viewAgentDetails($clientDetailsAray['id']);
                                           
                                        
                              
                                    $count='0';
                                    if($agentSearchDetailsAray)
                                    {
                                        $count=count($agentSearchDetailsAray);
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
           
        </div>
     </div>
              
       <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Agent/Employee</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <?php
                   
                    if($_SESSION['drugsafe_user']['iRole']=='5'){
                       if($clientDetailsAray['szNoOfSites'] > $count){
                        ?>
                        <button class="btn btn-sm green-meadow" onclick="addClientData(<?php echo $franchiseeArr['id']; ?>,<?php echo $clientDetailsAray['id']; ?>,'<?php echo __URL_FRANCHISEE_CLIENTRECORD__ ;?>');">
                        &nbsp;Agent/Employee
                        </button>
                        <?php
                    }  
                    }
                    if($_SESSION['drugsafe_user']['iRole']=='2')
                    {
                        if($clientDetailsAray['szNoOfSites'] > $count){
                        ?>
                        <button class="btn btn-sm green-meadow"  onclick="addAgentEmployeeDetails(<?php echo  $clientDetailsAray['id']; ?>,'3');">
                        &nbsp; Add Agent/Employee
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
            if($agentDetailsAray)
            {
            ?>
            
             <div class="row">
                           <form class="form-horizontal" id="szSearchClientDetailsList" action="<?=__BASE_URL__?>/franchisee/viewClientAgentDetails" name="szSearchClientDetailsList" method="post">
                          <!--<div class="search col-md-3">
                            <input type="text" name="szSearchClDetails" id="szSearchClDetails" class="form-control input-square-right " placeholder="Id,Name Or Email " value="<?/*=sanitize_post_field_value($_POST['szSearchClDetails'])*/?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
<!--                               <div class="search col-md-3">
                                                               <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
                                   <select class="form-control custom-select" name="szSearchClRecord" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                       <option value="">Client Id</option>
                                       <?php
                                       foreach($agentSearchDetailsAray as $agentSearchDetailsList)
                                       {
                                           $selected = ($agentSearchDetailsList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                           echo '<option value="'.$agentSearchDetailsList['id'].'" >CL-'.$agentSearchDetailsList['id'].'</option>';
                                       }
                                       ?>
                                   </select>
                               </div>
                               <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
                               <!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                               <div class="search col-md-3">
                                   <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                   <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                       <option value="">Contact Name</option>
                                       <?php
                                         foreach($agentSearchDetailsAray as $agentSearchDetailsList)
                                       {
                                           $selected = ($agentSearchDetailsList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                           echo '<option value="'.$agentSearchDetailsList['id'].'" ' . $selected . '>'.$agentSearchDetailsList['szName'].'</option>';
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
                                <th> Id </th>
				<th> Contact Name </th>
                                <th> Contact Email </th>
                                <th> Contact Phone Number</th>
                                <th> Created By</th>
                                <th> Updated By</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
						 
                                       $i = 0;
                                        foreach($agentDetailsAray as $agentDetailsData)
                                        {
                                           
                                        ?>
                                        <tr>
                                            <td> AG-<?php echo $agentDetailsData['agentId'];?> </td>
                                            <td> <?php echo $agentDetailsData['szName']?> </td>
                                            <td> <?php echo $agentDetailsData['szEmail'];?> </td>
                                             <td> <?php echo $agentDetailsData['szContactNumber'];?> </td>
                                              <td>
                                        <?php
                                        if($agentDetailsData['szCreatedBy'])
                                        {
                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$agentDetailsData['szCreatedBy']);
                                            echo $franchiseeDetArr['szName'];
                                        }
                                        ?>
                                        
                                        </td>
                                        <td>
                                            <?php 
                                            if($agentDetailsData['szLastUpdatedBy'])
                                            {
                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$agentDetailsData['szLastUpdatedBy']);
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
                                              
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Site" onclick="editAgentEmployeeDetails('<?php echo $agentDetailsData['agentId']; ?>','2');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                    <?php }  ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Agent Details" onclick="viewAgentEmployeeDetails('<?php echo $agentDetailsData['agentId']; ?>','2');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <?php
                                              if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                                    $id =   $childClientDetailsData['id'];
                                                   $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetailsByClientId($id);
                                                     if(empty($sosRormDetailsAry)) {
                                               ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAgent" title="Delete Agent/Employee" onclick="agentDelete('<?php echo $agentDetailsData['agentId'];?>');" href="javascript:void(0);"></i>
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
            
                <p>No Agent Found.</p>
            <?php
            }else{ ?>
                
              <p>No Agent Found.</p>   
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
</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>