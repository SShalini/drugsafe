<script type='text/javascript'>
    $(function() {
//        $("#szSearch").customselect();
        $("#szSearchname").customselect();
//        $("#szSearchemail").customselect();
//        $("#szSearchOperationmanager").customselect();

    });
</script>
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
                      <?php if($_SESSION['drugsafe_user']['iRole'] == '5'){ ?>
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/admin/franchiseeList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                      <?php } else{?>
                         <li>
                            <a href="<?php echo __BASE_URL__;?>/admin/operationManagerList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                      <?php }?>
                        <li>
                            <span class="active">Franchisee List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">franchisee List</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow"  onclick="addFranchiseeData('','1');" href="javascript:void(0);">
                                        &nbsp;Add New Franchisee
                                    </button>
                                </div>
                            </div>
                        </div>
                     
                        <?php
                        if(!empty($franchiseeAray))
                        {
                            ?>
                         <div class="row">
                              <form class="form-horizontal" id="szSearchField" action="<?=__BASE_URL__?>/admin/franchiseeList" name="szSearchField" method="post">
<!--                          <div class="search col-md-2">
                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
                              <select class="form-control custom-select" name="szSearch1" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Franchisee Id</option>
                                  <?php
                                      foreach($allfranchisee as $franchiseeIdList)
                                      {
                                          $selected = ($franchiseeIdList['id'] == $_POST['szSearch1'] ? 'selected="selected"' : '');
                                          echo '<option value="'.$franchiseeIdList['id'].'" >FR-'.$franchiseeIdList['id'].'</option>';
                                      }
                                  ?>
                              </select>
                          </div>
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>-->
<!--                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>-->
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?/*//=sanitize_post_field_value($_POST['szSearch'])*/?><!--">-->
                                      <select class="form-control custom-select" name="szSearch2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Name</option>
                                          <?php
                                          foreach($allfranchisee as $franchiseeIdList)
                                          {
                                              $selected = ($franchiseeIdList['id'] == $_POST['szSearch2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$franchiseeIdList['id'].'"' . $selected . ' >'.$franchiseeIdList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
<!--                                  <?php if($_SESSION['drugsafe_user']['iRole']==1){?> 
                                  <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                           <!--<button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  <div class="search col-md-2">
                                                                  <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?/*//=sanitize_post_field_value($_POST['szSearch'])*/?>">
                                      <select class="form-control custom-select" name="szSearch3" id="szSearchOperationmanager" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Operation Manager</option>
                                          <?php
                                          foreach($allfranchisee as $franchiseeIdList)
                                          {  
                                              $operationManagerDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $franchiseeIdList['operationManagerId']);
                                         
                                              $selected = ($franchiseeIdList['id'] == $_POST['szSearch3'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$franchiseeIdList['id'].'" >'.$operationManagerDetArr['szName'].'</option>';
                                         
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <?php }?>
                               <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <div class="search col-md-2">
                                                                  <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?//=sanitize_post_field_value($_POST['szSearch'])?>">
                                      <select class="form-control custom-select" name="szSearch" id="szSearchemail" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Email</option>
                                          <?php
                                          foreach($allfranchisee as $franchiseeIdList)
                                          {
                                              $selected = ($franchiseeIdList['id'] == $_POST['szSearch'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$franchiseeIdList['id'].'" >'.$franchiseeIdList['szEmail'].'</option>';
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
                                        <?php if($_SESSION['drugsafe_user']['iRole']==1){?>
                                        <th> Operation Manager </th>
                                        <?php }?>
                                        <th> Contact No </th>
                                        <th> Address </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($franchiseeAray)
                                    {   $i = 0;
                                        foreach($franchiseeAray as $franchiseeData)
                                        {
                                            $operationManagerId = $this->Franchisee_Model->getOperationManagerId($franchiseeData['id']);
                                            $operationManagerDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $operationManagerId['operationManagerId']);
                                           
                                         ?>
                                        <tr>
                                            <td> FR-<?php echo $franchiseeData['id'];?> </td>
                                            <td> <?php echo $franchiseeData['szName']?> </td>
                                            <td> <?php echo $franchiseeData['szEmail'];?> </td>
                                             <?php if($_SESSION['drugsafe_user']['iRole']==1){?>
                                            <td> <?php echo $operationManagerDetArr['szName'];?> </td>
                                            <?php }?>
                                            <td> <?php echo $franchiseeData['szContactNumber'];?> </td>
                                            <td> <?php echo $franchiseeData['szCity'];?> </td>
                                           <td>
<!--                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd" title="Add Client" onclick="addClientData(<?php echo $franchiseeData['id'];?>,'','','1');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>-->
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit franchisee Data" onclick="editFranchiseeDetails('<?php echo $franchiseeData['id'];?>','<?php echo $operationManagerId['operationManagerId'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
<!--                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Client List" onclick="viewClient(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>-->
                                                <a class="btn btn-circle btn-icon-only btn-default" id="modelStoclVal" title="Model Stock Value Management" onclick="viewModelStockValMgt(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-cube" aria-hidden="true"></i>
                                                </a>
                                               <?php 
                                                $drugTestKitListAray =$this->Inventory_Model->viewDrugTestKitList(false,false,false,1);
                                           
                                        if(!empty($drugTestKitListAray)){
                                            foreach($drugTestKitListAray as $drugTestKitListData)
                                            {
                                                $drugTestKitDataArr[$drugTestKitListData['id']] = $this->StockMgt_Model->getStockValueDetailsByProductId($franchiseeData['id'],$drugTestKitListData['id']);   
                                               
                                            }
                                          $emptyArr = false;
                                           foreach($drugTestKitDataArr as $key => $val) {
                                           if(empty($val)){
                                             $emptyArr = true;
                                          }
                                            }
                                            
                                            if($emptyArr != true){
                                         
                                    ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="productStoclMgt" title="Product Stock  Management" onclick="viewProductStockMgt(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </a>
                                        <?php } }
                                                $clientDetailsAray = $this->Franchisee_Model->getClientCountId($franchiseeData['id']);
                                                
                                              // print_r($clientDetailsAray);
                                                if(empty($clientDetailsAray)){
                                               ?>  
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Franchisee" onclick="franchiseeDelete(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                 <?php 
                                                }
                                               ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        
                                        }
                                         $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                                 </div>
                             <?php
                            
                        }
                        else
                        {
                            echo "Not Found";
                        }
                        ?>
                           <?php  if(!empty($franchiseeAray)){?>
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
</div>
<div id="popup_box"></div>