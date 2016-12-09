<script type='text/javascript'>
    $(function() {
        $("#szSearch").customselect();
        $("#szSearchname").customselect();
        $("#szSearchemail").customselect();
    });
</script>
<div class="page-content-wrapper">
    <div class="page-content">
        <?php
        if (!empty($_SESSION['drugsafe_user_message'])) {
            if (trim($_SESSION['drugsafe_user_message']['type']) == "success") {
                ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['drugsafe_user_message']['content']; ?>
                </div>
            <?php }
            if (trim($_SESSION['drugsafe_user_message']['type']) == "error") {
                ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['drugsafe_user_message']['content']; ?>
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
                    <li>
                        <span class="active">Client List</span>
                    </li>
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
                       echo "franchisee Details";
//                    }
                   ?>
                    &nbsp; &nbsp;
                    <?php  $operationManagerIdArr = $this->Admin_Model->getoperationManagerId($franchiseeArr['id']);
               ?>
                    <a class="btn btn-circle btn-icon-only btn-default" title="Edit franchisee Data" onclick="editFranchiseeDetails('<?php echo $franchiseeArr['id'];?>','<?php echo $operationManagerIdArr['operationManagerId'];?>');" href="javascript:void(0);">
                        <i class="fa fa-pencil"></i> 
                    </a>
                </span>
            </div>
            
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szName'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact No:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szContactNumber'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>City:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szCity'];?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Country:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szCountry'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Email Id:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szEmail'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Address:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szAddress'];?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>State:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szState'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ZIP/Postal Code:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $franchiseeArr['szZipCode'];?></p>
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
                            <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $franchiseeArr['szName'];?>'s Client List</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">

                                
                            </div>
                        </div>
                    </div>

                    <?php

                    if (!empty($clientAry)) {
                        ?>
                     <div class="row">
                              <form class="form-horizontal" id="szSearchClientList" action="<?=__BASE_URL__?>/franchisee/clientList" name="szSearchClientList" method="post">
                                                           <div class="search col-md-3">
                                  
                                      <select class="form-control custom-select" name="szSearchClRecord" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Id</option>
                                          <?php
                                          foreach($clientlistArr as $clientIdList)
                                          {
                                              $selected = ($clientIdList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientIdList['id'].'" >CL-'.$clientIdList['id'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                      <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Name</option>
                                          <?php
                                          foreach($clientlistArr as $clientIdList)
                                          {
                                              $selected = ($clientIdList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientIdList['id'].'" >'.$clientIdList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?//=sanitize_post_field_value($_POST['szSearch'])?><!--">-->
                                      <select class="form-control custom-select" name="szSearchClRecord1" id="szSearchemail" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Email</option>
                                          <?php
                                          foreach($clientlistArr as $clientIdList)
                                          {
                                              $selected = ($clientIdList['id'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientIdList['id'].'" >'.$clientIdList['szEmail'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                           </form>
                          </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> Id.</th>
                                    <th> Name</th>
                                    <th> Email</th>
                                    <th> No of sites</th>
                                    <th> Contact No</th>
                                    <th> Created By</th>
                                    <th> Updated By</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                foreach ($clientAry as $clientData) {
                                    ?>
                                    <tr>
                                        <td> CL-<?php echo $clientData['id']; ?> </td>
                                        <td> <?php echo $clientData['szName'] ?> </td>
                                        <td> <?php echo $clientData['szEmail']; ?> </td>
                                        <td>
                                            <?php
                                                $childClientDetailsAray =$this->Franchisee_Model->viewChildClientDetails($clientData['id'],false,false,false);
                                                echo count($childClientDetailsAray);
                                            ?>
                                            

                                        </td>
                                        <td> <?php echo $clientData['szContactNumber']; ?> </td>
                                       
                                        <td><?php echo $franchiseeDataArr[$i]['szName']; ?> </td>
                                        <td>
                                            <?php 
                                            if($clientData['szLastUpdatedBy'])
                                            {
                                               $updateByDataArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['szLastUpdatedBy']);
                                                echo $updateByDataArr['szName'];
                                            }
                                            else
                                            {
                                               echo "N/A";
                                            }
                                           
                                            ?> 
                                        </td>
                                        
                                       
                                        <td>
                                            <?php
                                            if ($clientData['clientType'] == '0') {
                                              if($clientData['szNoOfSites'] > count($childClientDetailsAray)){
                                                ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd"
                                                   title="Add Site"
                                                   onclick="addClientData(<?php echo $idfranchisee; ?>,<?php echo $clientData['id']; ?>);"
                                                   href="javascript:void(0);">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                              <?php }} ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data"
                                               onclick="editClient('<?php echo $clientData['id']; ?>','<?php echo $idfranchisee; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>','1');"
                                               href="javascript:void(0);">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="View Client Details"
                                               onclick="viewClientDetails(<?php echo $clientData['id']; ?>);"
                                               href="javascript:void(0);">
                                                <i class="fa fa-eye" aria-hidden="true"></i>

                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="Delete Client"
                                               onclick="clientDelete('<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                               href="javascript:void(0);">
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

                    } else {
                        echo "Not Found";
                    }
                    ?>
         <?php  if(!empty($clientAry)){?>
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
<div id="popup_box"></div>