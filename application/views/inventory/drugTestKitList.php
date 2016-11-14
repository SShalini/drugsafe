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
                            <a href="<?php echo __BASE_URL__;?>/inventory/drugtestkitlist">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Drug Test Kit List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Drug Test Kit</span>
                            </div>
                            <?php 
                            if($_SESSION['drugsafe_user']['iRole']==1){
                            ?>
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>inventory/addDrugTestKit');">
                                        &nbsp;Add Drug Test Kit
                                    </button>
                                </div>
                        </div>
                            <?php }?>    
                           
                        </div>
                        <?php
                        
                        if(!empty($drugTestKitAray))
                        {
                           
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Image </th>
                                        <th> Product Code</th>
                                        <th>  Descreption</th>
                                        <th>  Cost</th>
                                        <?php
                                        if($_SESSION['drugsafe_user']['iRole']==1){
                                        ?>
                                        <th> Actions </th>
                                       <?php }else{?>
                                        <th>  Model Stock Value</th>
                                        <th>  Available Stock Quantity</th>
                                        <th>  Action</th>
                                       <?php }?> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($drugTestKitAray as $drugTestKitData)
                                        {     
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $drugTestKitData['szProductImage']; ?>" width="60" height="60"/>    
                                            </td>
                                            <td> <?php echo $drugTestKitData['szProductCode']?> </td>
                                            <td> <?php echo $drugTestKitData['szProductDiscription'];?> </td>
                                            <td> $<?php echo $drugTestKitData['szProductCost'];?> </td>
                                            <?php
                                           if($_SESSION['drugsafe_user']['iRole']==1){
                                             ?>
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editProduct('<?php echo $drugTestKitData['id'];?>','1');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="drugTestKitStatus" title="Delete Drug-Test Kit Details" onclick="productDeleteAlert(<?php echo $drugTestKitData['id'];?>,'1');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                        <?php }else{?>
                                          <td><?php echo($drugTestKitDataArr[$i]['szModelStockVal'] > 0 ? $drugTestKitDataArr[$i]['szModelStockVal'] : 'N/A')?></td>
                                          <td><?php echo($drugTestKitQtyDataArr[$i]['szQuantity'] > 0 ? $drugTestKitQtyDataArr[$i]['szQuantity'] : 'N/A')?></td>
                                          <td>          
                                              <a class="btn btn-circle btn-icon-only btn-default" id="drugTestKitStatus" title="Request Quantity" onclick="requestQuantityAlert('<?php echo $drugTestKitData['id'];?>','1');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                              </a>
                                          </td> 
                                        <?php } 
                                        
                                        ?>  
                                        </tr>
                                        <?php
                                        $i++;
                                        }
                                   ?>
                                        
                                </tbody>
                            </table>
                        </div>
                             <?php
                            
                        }
                        else
                        {
                            echo "Not Found";
                        }
                        ?>
                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div id="popup_box"></div>