<script type='text/javascript'>
    $(function() {
      $("#szSearch1").customselect();
      $("#szSearch2").customselect();
      $("#szSearch3").customselect();
      $("#szSearch4").customselect();
      $("#szSearch5").customselect();
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
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Inventory Report</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">
                   
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">
                                   Client Comparison Report
                                </span>
                            </div>
                             <?php
                            if(!empty($validPendingOrdersDetailsAray))
                        { 
                           $this->session->unset_userdata('franchiseeId');
                           $this->session->unset_userdata('productCode');
                           $this->session->unset_userdata('prodCategory');
           
                                
                           
                            ?>
                          
                            <div class="actions">
                               
                                 <a onclick="ViewpdfInventoryReport('<?php echo $_POST['szSearch1'];?>','<?php echo $_POST['szSearch2'];?>','<?php echo $_POST['szSearch3'];?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                    <i class="fa fa-file-pdf-o"></i> View Pdf </a>
                                
                               <a onclick="ViewexcelInventoryReport('<?php echo $_POST['szSearch1'];?>','<?php echo $_POST['szSearch2'];?>','<?php echo $_POST['szSearch3'];?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                    <i class="fa fa-file-excel-o"></i> View Xls </a>
                                    
                            </div>
                            <?php
                        }
                            ?>
                        </div>
                        
                   
                      <form name="orderSearchForm" id="orderSearchForm" action="<?=__BASE_URL__?>/reporting/inventoryReport" method="post">
                 <div class="row">
                    
                    <div class="col-md-3">
                       <?php     $allFrDetailsSearchAray = $this->Admin_Model->viewFranchiseeList();?>
                        <div class="form-group <?php if (!empty($arErrorMessages['szSearch1']) != '') { ?>has-error<?php } ?>">
                            <select class="form-control custom-select" name="szSearch1" id="szSearch1" onblur="remove_formError(this.id,'true')" onchange="getClientListByFrIdData(this.value);">
                                          <option value="">Franchisee Name</option>
                                          <?php
                                          foreach($allFrDetailsSearchAray as $allFrDetailsSearchList)
                                          {
                                              $selected = ($allFrDetailsSearchList['id'] == $_POST['szSearch1'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$allFrDetailsSearchList['id'].'"'.$selected.' >'.$allFrDetailsSearchList['szName'].'</option>';
                                          }
                                          ?>
                           </select>
                             <?php
                               if(form_error('szSearch1')){?>
                               <span class="help-block pull-left"><span><?php echo form_error('szSearch1');?></span>
                             </span><?php }?> 
                        </div>
                    </div>
                    <div class="col-md-1">  </div>
                       <div class="col-md-3">
                       <div class="form-group ">
                           <div id="szSearch2">
                            <input type="text" class="form-control" id="szSearch2" name="szSearch2" placeholder="Company Name/site" value="" onfocus="remove_formError(this.id,'true')" onchange="getSiteListByClientIdData(this.value);">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                       
                           </div>
                     <div class="col-md-3" >
                          
                        <div class="form-group ">
                           <div id="szSearch3">
                            <input type="text" class="form-control" id="szSearch3" name="szSearch3" placeholder="Company Name/site" value="" onfocus="remove_formError(this.id,'true')">
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class="row">  
                         <div class="col-md-3">
                        <div class="form-group <?php if (!empty($arErrorMessages['szSearch4']) != '') { ?>has-error<?php } ?>">
                            
                              <select class="form-control custom-select" name="szSearch4" id="szSearch4" onblur="remove_formError(this.id,'true')">
                                                <option value=''>Test Type</option>
                                                <option value="A" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("1") ? "selected" : ""); ?>>Alcohol</option>
                                                <option value="U" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("2") ? "selected" : ""); ?>>Urine AS/NZA 4308:2001</option>
                                                <option value="O" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("3") ? "selected" : ""); ?>>Oral Fluid AS 4760:2006</option>
                                                <option value="AZ" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("1") ? "selected" : ""); ?>>As/NZA 4308:2008</option>
                             </select>
                            <?php
                               if(form_error('szSearch4')){?>
                               <span class="help-block pull-left"><span><?php echo form_error('szSearch4');?></span>
                             </span><?php }?>  
                           
                        </div>
                    </div>
                    <div class="col-md-1">
                       
                           </div>
                           <div class="col-md-3">
                        <div class="form-group <?php if (!empty($arErrorMessages['szSearch5']) != '') { ?>has-error<?php } ?>">
                            
                              <select class="form-control custom-select" name="szSearch5" id="szSearch5" onblur="remove_formError(this.id,'true')">
                                               <option value=''>Compare Data</option>           
                                               <option value="U" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("2") ? "selected" : ""); ?>>Monthly</option>
                                               <option value="O" <?php echo (sanitize_post_field_value($_POST['szSearch4']) == trim("3") ? "selected" : ""); ?>>Yearly</option>
                                               
                             </select>
                            <?php
                               if(form_error('szSearch5')){?>
                               <span class="help-block pull-left"><span><?php echo form_error('szSearch5');?></span>
                             </span><?php }?>  
                           
                        </div>
                    </div>
                   
                <div class="col-md-1">
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                               </div>
               
                </div> 
            </form>  
                    
                <?php
                if(!empty($validPendingOrdersDetailsAray) || !empty($_POST['szSearch2']) || !empty($_POST['szSearch1']) ){
                if(!empty($validPendingOrdersDetailsAray)) 
                {
                ?>      
                    <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                    <th>
                                         #
                                    </th>
                                    <th>
                                         Category
                                    </th>
                                    <th>
                                          Product Code 
                                    </th>
                                    <th>
                                          In Stock  
                                    </th>
                                    <th>
                                         Requested
                                    </th>
                                  
                            </thead>
                            <tbody>
                                     <?php         $i = 0;
                                                foreach($validPendingOrdersDetailsAray as $validPendingOrdersDetailsData)
                                                { 
                                                    $i++ ;
                                                   $productcatAry = $this->Order_Model->getCategoryDetailsById(trim($validPendingOrdersDetailsData['szProductCategory']));
                                                   ?>
                            <tr>
                                    <td><?php echo $i; ?> </td>
                                    <td>
                                         <?php echo $productcatAry['szName'];?> 
                                    </td>
                                    <td>
                                         <?php echo $validPendingOrdersDetailsData['szProductCode'] ;?>
                                    </td>
                                    <td>  <?php echo $validPendingOrdersDetailsData['szAvailableQuantity'] ;?> </td>
                                     <td>  <?php echo $validPendingOrdersDetailsData['quantity'] ;?> </td>
                                    

                                </tr>
                              <?php
                                         
                                              }
                                            
                                             
                                           ?>
                            </tbody>
                            </table>
                    </div>        
                </div>
                      <?php } else {
                          
                            echo "Not Found";    
                           }
                           
                            }?> 
                  </div>
   
                   
                        </div>
         
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>
