
<script type='text/javascript'>
    $(function() {
//        $("#szSearch").customselect();
        $("#szSearchname").customselect();
       $("#szSearchClientname").customselect();
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
                   
                    <?php
                    if($_SESSION['drugsafe_user']['iRole'] == '2'){
                     ?>
                  
                    <li>
                        <a href="<?php echo __BASE_URL__;?>/franchisee/clientRecord">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                      <?php } else {?>
                     <li>
                        <a href="<?php echo __BASE_URL__;?>/franchisee/clientRecord">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <?php
                           if(!empty($_POST['szSearchClRecord2'])){
                               $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$_POST['szSearchClRecord2']);
                          ?>
                     <li>
                           <a onclick=""
                               href="javascript:void(0);"><?php echo $userDataAry['szName'] ; ?></a>
                     
                        <i class="fa fa-circle"></i>
                    </li>
                           <?php }?>
                   
                      <?php  } ?>
                 
                    <li>
                        <span class="active">Client Record</span>
                    </li>
                </ul>
                
                <div class="portlet light bordered">
                    <?php if($_SESSION['drugsafe_user']['iRole'] == '1') {?>
                      <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-meadow"></i>
                            <span class="caption-subject font-green-meadow ">Plese select a Franchisee to display their related clients.</span>
                        </div>
                      </div>
                   <?php } else { ?>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Client Record</span>
                        </div>
                         <?php
                    if($_SESSION['drugsafe_user']['iRole'] == '2'){
                     ?>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn btn-sm green-meadow" onclick="addClientData('','','<?php echo __URL_FRANCHISEE_CLIENTRECORD__ ;?>','2');" href="javascript:void(0);">
                                    &nbsp;Add New Client
                                </button>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                   <?php } ?>
                    <?php
                    if($_SESSION['drugsafe_user']['iRole'] == '1'){
                     ?>
                      <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/franchisee/clientRecord" name="szSearchClientRecord" method="post">
<!--                        
                                  <div class="search col-md-3">
                                  
                                      <select class="form-control custom-select" name="szSearchClRecord" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Id</option>
                                          <?php
                                          $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,false);
                                          foreach($searchOptionArr as $searchOptionList)
                                          {
                                              $selected = ($searchOptionList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$searchOptionList['id'].'" >FR-'.$searchOptionList['id'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
                                  <!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                      <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <?php if(!empty($_POST['szSearchClRecord2'])){?>
                                          <option value=""><?php echo $searchOptionList['szName'];?></option>
                                          <?php } else {?>
                                           <option value="">Franchisee Name</option>
                                           <?php } ?>
                                          <?php
                                         foreach($searchOptionArr as $searchOptionList)
                                          {
                                              $selected = ($searchOptionList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$searchOptionList['id'].'" >'.$searchOptionList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                
                                <div class="col-md-1" style="text-align: center; padding: 5px 0px;"></div>
                                  <div class="search col-md-3">
                                                               
                                      <select class="form-control custom-select" name="szSearchClRecord1" id="szSearchClientname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Name</option>
                                          <?php
                                          foreach($clientlistArr as $clientList)
                                          {
                                              $selected = ($clientList['id'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientList['id'].'" >'.$clientList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                              
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                           </form>
                          </div>
                    
                      <?php
                   
                      if (!empty($clientAry)) {
                      ?>  
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Client Record</span>
                        </div>
                        </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> Id.</th>
                                    <th> Name</th>
                                    <th> Email</th>
                                    <?php
                                    if($_SESSION['drugsafe_user']['iRole']=='1')
                                    {
                                        ?>
                                         <th> Franchisee</th>
                                        <?php
                                        
                                    }
                                    ?>
                                    
                                    <th> No. of sites</th>
                                    <th> Contact No.</th>
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
                                        <?php
                                         if($_SESSION['drugsafe_user']['iRole']=='1')
                                         {
                                            ?>
                                            <td>
                                            <?php 
                                              $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['franchiseeId']);
                                              echo $franchiseeDetArr['szName'];
                                            ?>
                                            </td>  
                                            <?php
                                         }
                                        ?>
                                       
                                        <td>
                                            <?php
                                                $childClientDetailsAray =$this->Franchisee_Model->viewChildClientDetails($clientData['id']);
                                                echo count($childClientDetailsAray);
                                            ?>
                                            

                                        </td>
                                        <td> <?php echo $clientData['szContactNumber']; ?> </td>
                                       
                                        <td>
                                        <?php
                                        if($clientData['szCreatedBy'])
                                        {
                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['szCreatedBy']);
                                            echo $franchiseeDetArr['szName'];
                                        }
                                        ?>
                                        
                                        </td>
                                        <td>
                                            <?php 
                                            if($clientData['szLastUpdatedBy'])
                                            {
                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['szLastUpdatedBy']);
                                                echo $franchiseeDetArr['szName'];
                                            }
                                            else
                                            {
                                               echo "N.A";
                                            }
                                           
                                            ?> 
                                        </td>
                                       
                                        <td>
                                             <?php
                                            if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                            ?>
                                            <?php
                                            if ($clientData['clientType'] == '0') {
                                          if($clientData['szNoOfSites'] > count($childClientDetailsAray)){
                                                ?>
                                            
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd"
                                                   title="Add Site"
                                                   onclick="addClientData(<?php echo $clientData['franchiseeId']; ?>,'<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                                   href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                          <?php }} ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data"
                                               onclick="editClient('<?php echo $clientData['id']; ?>','<?php echo $clientData['franchiseeId']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                               href="javascript:void(0);">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php }?>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="View Client Details"
                                               onclick="viewClientDetails(<?php echo $clientData['id']; ?>);"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                             <?php  
                                             if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                         
                                             ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="Delete Client"
                                               onclick="clientDelete('<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>

                                             <?php  }?>
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
                      
                      
                                          } else {
                    
                  
                    if (!empty($clientAry)) {

                        ?>
                    
                    <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/franchisee/clientRecord" name="szSearchClientRecord" method="post">
<!--                        
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
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
                                  <!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                      <select class="form-control custom-select" name="szSearchClRecord1" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Name</option>
                                          <?php
                                          foreach($clientlistArr as $clientIdList)
                                          {
                                              $selected = ($clientIdList['id'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientIdList['id'].'" >'.$clientIdList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
<!--                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <div class="search col-md-3">
                                                                  <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
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
                                  </div>-->
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
                                    <?php
                                    if($_SESSION['drugsafe_user']['iRole']=='1')
                                    {
                                        ?>
                                         <th> Franchisee</th>
                                        <?php
                                        
                                    }
                                    ?>
                                    
                                    <th> No. of sites</th>
                                    <th> Contact No.</th>
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
                                        <?php
                                         if($_SESSION['drugsafe_user']['iRole']=='1')
                                         {
                                            ?>
                                            <td>
                                            <?php 
                                              $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['franchiseeId']);
                                              echo $franchiseeDetArr['szName'];
                                            ?>
                                            </td>  
                                            <?php
                                         }
                                        ?>
                                       
                                        <td>
                                            <?php
                                                $childClientDetailsAray =$this->Franchisee_Model->viewChildClientDetails($clientData['id']);
                                                echo count($childClientDetailsAray);
                                            ?>
                                            

                                        </td>
                                        <td> <?php echo $clientData['szContactNumber']; ?> </td>
                                       
                                        <td>
                                        <?php
                                        if($clientData['szCreatedBy'])
                                        {
                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['szCreatedBy']);
                                            echo $franchiseeDetArr['szName'];
                                        }
                                        ?>
                                        
                                        </td>
                                        <td>
                                            <?php 
                                            if($clientData['szLastUpdatedBy'])
                                            {
                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$clientData['szLastUpdatedBy']);
                                                echo $franchiseeDetArr['szName'];
                                            }
                                            else
                                            {
                                               echo "N.A";
                                            }
                                           
                                            ?> 
                                        </td>
                                       
                                        <td>
                                             <?php
                                            if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                            ?>
                                            <?php
                                            if ($clientData['clientType'] == '0') {
                                          if($clientData['szNoOfSites'] > count($childClientDetailsAray)){
                                                ?>
                                            
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd"
                                                   title="Add Site"
                                                   onclick="addClientData(<?php echo $clientData['franchiseeId']; ?>,'<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                                   href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                          <?php }} ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data"
                                               onclick="editClient('<?php echo $clientData['id']; ?>','<?php echo $clientData['franchiseeId']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                               href="javascript:void(0);">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php }?>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="View Client Details"
                                               onclick="viewClientDetails(<?php echo $clientData['id']; ?>);"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                             <?php
                                             if($_SESSION['drugsafe_user']['iRole'] == '2'){
                                                 if(empty($childClientDetailsAray)) {
                                             ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="Delete Client"
                                               onclick="clientDelete('<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__;?>');"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>

                                             <?php } }?>
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
                    } }
                    ?>
         <?php 
         
             ?>
		<div class="row">
                  <?php if(!empty($clientAry)){?>
                    <div class="col-md-7 col-sm-7">
                        <div class="dataTables_paginate paging_bootstrap_full_number">
                            <?php echo $this->pagination->create_links();?>
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