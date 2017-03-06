<script type='text/javascript'>
    $(function() {
         $("#szSearchfr").customselect();
         $("#szSearchStatus").customselect();
    });
</script>
<div id="loader"></div>
<div class="page-content-wrapper">
        <div class="page-content">
            <?php 
            if(!empty($_SESSION['drugsafe_user_message']))
            {
                    if(trim($_SESSION['drugsafe_user_message']['type']) == "success")
                    {
                    ?>
                        <div class="alert alert-success">
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
                              <a href="<?php echo __BASE_URL__; ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <?php
                        if(!empty($_POST['szSearch3'])){
                        if(($_SESSION['drugsafe_user']['iRole']==1)|| ($_SESSION['drugsafe_user']['iRole']==5) ){
                            $userArray = $this->Admin_Model->getUserDetailsByEmailOrId('',$_POST['szSearch3']);?>
                         <li>
                           
                             <a href="<?php echo __BASE_URL__; ?>/prospect/franchiseeProspectRecord"><?php echo $userArray['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                             
                        <?php }} ?>
                        <li>
                            <span class="active">SALES CRM Summary Report</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">SALES CRM Summary Report</span>
                            </div>
                            <div class="actions">
                              
                                 <?php
                        if(!empty($recordAry))
                        { 
                    
                            ?>
                           
                               
                                 <a onclick="ViewpdfSalesCrmReport('<?php echo $_POST['szSearchfr'];?>','<?php echo $_POST['szSearch2'];?>','<?php echo $_POST['szSearch3'];?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                    <i class="fa fa-file-pdf-o"></i> View Pdf </a>
                                
                               <a onclick="ViewexcelSalesCrmReport('<?php echo $_POST['szSearchfr'];?>','<?php echo $_POST['szSearch2'];?>','<?php echo $_POST['szSearch3'];?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                    <i class="fa fa-file-excel-o"></i> View Xls </a>
                         
                    <?php    } 
                    ?>
                            </div>
                        </div>
                   
                       
                         <div class="row">
                              <form class="form-horizontal" id="szSearchField" action="<?=__BASE_URL__?>/prospect/prospect_summary_report" name="szSearchField" method="post">

                                 
                                   <div class="col-md-3">
                       
                        <div class="form-group <?php if (!empty($arErrorMessages['szSearchfr']) != '') { ?>has-error<?php } ?>">
                            <select class="form-control custom-select" name="szSearchfr" id="szSearchfr" onchange="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Name</option>
                                        <?php if($_SESSION['drugsafe_user']['iRole']==1 ){
                                       $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,false); 
                                   }
                                   if($_SESSION['drugsafe_user']['iRole']==5 ){
                                       $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,$_SESSION['drugsafe_user']['id']); 
                                   }
                                       ?>   
                                       <?php
                                          foreach($searchOptionArr as $searchOptionList)
                                          {
                                              $selected = ($searchOptionList['id'] == $_POST['szSearchfr'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$searchOptionList['id'].'"' . $selected . ' >'.$searchOptionList['szName'].'</option>';
                                          }
                                          ?>
                           </select>
                             <?php
                               if(form_error('szSearchfr')){?>
                               <span class="help-block pull-left"><span><?php echo form_error('szSearchfr');?></span>
                             </span><?php }?> 
                        </div>
                    </div>
                    <div class="col-md-1">
                         
                           </div>
                                <div class="search col-md-3">
                                   
                                      <select class="form-control custom-select" name="szSearch2" id="szSearchStatus" onfocus="remove_formError(this.id,'true')">
                                         
                                        <option value=''>Status</option>
                                        <option value="1" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("1") ? "selected" : ""); ?>>
                                            Pre Discovery 
                                        </option>
                                        <option value="2" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("2") ? "selected" : ""); ?>>
                                           Discovery Meeting
                                        </option>
                                        <option value="3" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("3") ? "selected" : ""); ?>>
                                          In Progress  
                                        </option>
                                        <option value="4" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("4") ? "selected" : ""); ?>>
                                          Non Convertible 
                                        </option>
                                        <option value="5" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("5") ? "selected" : ""); ?>>
                                          Contact Later 
                                        </option>
                                         <option value="6" <?php echo(sanitize_post_field_value($_POST['szSearch2']) == trim("6") ? "selected" : ""); ?>>
                                         Closed Sale
                                        </option>
                                  
                                      </select>
                                  </div>
<!--                                  <div class="search col-md-1"> </div>-->
                                  <div class="col-md-1">
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                           </div>
                           </form>
                          </div>
                      
                          <?php
                          if(!empty($_POST))
                        {
                        if(!empty($recordAry))
                        { 
                    
                            ?>
                             <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Sr No.</th>
                                        <th>Franchisee Name</th>
                                        <th>Business Name</th>
                                         <th>Contact Name</th>
                                        <th> Email</th>
                                        <th> Status </th>
                                        <th> Status Updated On </th>
                                        <th> View Notes </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($recordAry)
                                    {   $i = 0;
                                        foreach($recordAry as $recordDetailsData)
                                        {
                                            $franchiseeNameArray = $this->Admin_Model->getUserDetailsByEmailOrId('', $recordDetailsData['iFranchiseeId']);
                                      
                                        
                                           $i++;
                                        ?>
                                        <tr>
                                            <td> <?php echo $i;?> </td>
                                            <td> <?php echo $franchiseeNameArray['szName']?> </td>
                                            <td> <?php echo $recordDetailsData['szBusinessName']?> </td>
                                            <td> <?php echo $recordDetailsData['szName']?> </td>
                                            <td> <?php echo $recordDetailsData['szEmail'];?> </td>
                                            
                                            <td>
                                                                    <?php if ($recordDetailsData['status'] == 1) { ?>

                                                                        <p title="Order Status"
                                                                           class="label label-sm label-warning">
                                                                            Pre Discovery 
                                                                        </p>
                                                                        <?php
                                                                    }
                                                                    if ($recordDetailsData['status'] == 2) {
                                                                        ?>
                                                                        <p title="Order Status"
                                                                           class="label label-sm label-primary">
                                                                             Discovery Meeting
                                                                        </p>
                                                                        <?php
                                                                    }
                                                                   
                                                                    if ($recordDetailsData['status'] == 3) {
                                                                        ?>
                                                                        <p title="Order Status"
                                                                           class="label label-sm label-info">
                                                                             In Progress
                                                                        </p>
                                                                        <?php
                                                                    }
                                                                    if ($recordDetailsData['status'] == 4) {
                                                                        ?>
                                                                        <p title="Order Status"
                                                                           class="label label-sm label-danger">
                                                                              Non Convertible
                                                                        </p>
                                                                        <?php
                                                                    }
                                                                    if ($recordDetailsData['status'] == 5) {
                                                                        ?>
                                                                        <p title="Order Status"
                                                                           class="label label-sm label-info">
                                                                             Contact Later 
                                                                        </p>
                                                                        <?php
                                                                    }
                                                                  
                                                                    if ($recordDetailsData['status'] == 6) {
                                                                        ?>
                                                                        <p title="Order Status"
                                                                           class="label label-sm label-success">
                                                                             Closed Sale
                                                                        </p>
                                                                        <?php
                                                                    }

                                                                    ?></td>
                                                        
                                                     <td>  <?php 
                                                    if(($recordDetailsData['dt_last_updated_status']) == '0000-00-00 00:00:00'){
                                                      echo "N/A";  
                                                    }
                                                    else{
                                                      echo date('d M Y',strtotime($recordDetailsData['dt_last_updated_status'])) . ' at '.date('h:i A',strtotime($recordDetailsData['dt_last_updated_status']));   
                                                    }
                                                     ?> </td>
                                           <td>
                                            
                                                <a class="btn btn-circle btn-icon-only btn-default" id="NotesView" title="View Notes" onclick="viewProspectMeetingNotes(<?php echo $recordDetailsData['id'];?>);" href="javascript:void(0);">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
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
                        }
                        ?>
                           <?php  if(!empty($prospectDetailsAry)){?>
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