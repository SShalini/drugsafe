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
                            <span class="active">Operation Manager List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Operation Manager List</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>admin/addOperationManager');">
                                        &nbsp;Add New Operation Manager
                                    </button>
                                </div>
                            </div>
                        </div>
                     
                        <?php
                        if(!empty($operationManagerAray))
                        { 
                    
                            ?>
                         <div class="row">
                              <form class="form-horizontal" id="szSearchField" action="<?=__BASE_URL__?>/admin/operationManagerList" name="szSearchField" method="post">
                           <div class="search col-md-3">
<!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?=sanitize_post_field_value($_POST['szSearch'])?>">-->
                          <select class="form-control custom-select" name="szSearch1" id="szSearch" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Operation Manager Id</option>
                                  <?php
                                      foreach($allOperationManager as $operationManagerIdList)
                                      {
                                          $selected = ($operationManagerIdList['id'] == $_POST['szSearch1'] ? 'selected="selected"' : '');
                                          echo '<option value="'.$operationManagerIdList['id'].'" >om-'.$operationManagerIdList['id'].'</option>';
                                      }
                                  ?>
                              </select>
                          </div>
                                    <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <div class="search col-md-3">
                                   
                                      <select class="form-control custom-select" name="szSearch2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Operation Manager Name</option>
                                          <?php
                                          foreach($allOperationManager as $operationManagerIdList)
                                          {
                                              $selected = ($operationManagerIdList['id'] == $_POST['szSearch2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$operationManagerIdList['id'].'" >'.$operationManagerIdList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                               <div class="col-md-1" style="text-align: center; padding: 5px 0px;">OR</div>
                                  <div class="search col-md-3">
                                      <!--                            <input type="text" name="szSearch" id="szSearch" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="--><?//=sanitize_post_field_value($_POST['szSearch'])?><!--">-->
                                      <select class="form-control custom-select" name="szSearch" id="szSearchemail" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Operation Manager Email</option>
                                          <?php
                                          foreach($allOperationManager as $operationManagerIdList)
                                          {
                                              $selected = ($operationManagerIdList['id'] == $_POST['szSearch'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$operationManagerIdList['id'].'" >'.$operationManagerIdList['szEmail'].'</option>';
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
                                        <th> Contact No </th>
                                        <th> Address </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($operationManagerAray)
                                    {   $i = 0;
                                        foreach($operationManagerAray as $operationManagerData)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td> OM-<?php echo $operationManagerData['id'];?> </td>
                                            <td> <?php echo $operationManagerData['szName']?> </td>
                                            <td> <?php echo $operationManagerData['szEmail'];?> </td>
                                            <td> <?php echo $operationManagerData['szContactNumber'];?> </td>
                                            <td> <?php echo $operationManagerData['szCity'];?> </td>
                                           <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="addFranchisee" title="Add Franchisee" onclick="addFranchiseeData(<?php echo $operationManagerData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit franchisee Data" onclick="editOperationManagerDetails('<?php echo $operationManagerData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="OperationManagerView" title="View Franchisee List" onclick="viewFranchisee(<?php echo $operationManagerData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="OperationManagerStatus" title="Delete Operation Manager" onclick="operationManagerDelete(<?php echo $operationManagerData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        <?php 
                                        }
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
                           <?php  if(!empty($operationManagerAray)){?>
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

