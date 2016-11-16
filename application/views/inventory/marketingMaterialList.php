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
                            <a href="<?php echo __BASE_URL__;?>/inventory/marketingmateriallist">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Marketing Material List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Marketing Material</span>
                            </div>
                             <?php 
                            if($_SESSION['drugsafe_user']['iRole']==1){
                            ?>
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>inventory/addMarketingMaterial');">
                                        &nbsp;Add Marketing Material
                                    </button>
                                </div>
                        </div>
                           <?php }?>       
                            
                        </div>
                        <?php
                        
                        if(!empty($marketingMaterialAray))
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
                                        foreach($marketingMaterialAray as $marketingMaterialData)
                                        {
                                              $idfranchisee = $_SESSION['drugsafe_user']['id'];
                                             $marketingMaterialDataArr = $this->StockMgt_Model->getStockValueDetailsById($idfranchisee,$marketingMaterialData['id']);
                                             $marketingMaterialQtyDataArr = $this->StockMgt_Model->getProductQtyDetailsById($idfranchisee,$marketingMaterialData['id']);
                                          
                                        ?>
                                        <tr>
                                           <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $marketingMaterialData['szProductImage']; ?>" width="60" height="60"/>
                                                  
                                            </td>
                                            <td> <?php echo $marketingMaterialData['szProductCode']?> </td>
                                            <td> <?php echo $marketingMaterialData['szProductDiscription'];?> </td>
                                            <td>$<?php echo $marketingMaterialData['szProductCost'];?> </td>
                                            <?php
                                           if($_SESSION['drugsafe_user']['iRole']==1){
                                             ?>
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editMarketingDetails('<?php echo $marketingMaterialData['id'];?>','2');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="MarketingMaterialStatus" title="Delete Client" onclick="productDeleteAlert(<?php echo $marketingMaterialData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>

                                                </a>
  
                                            </td>
                                             <?php }else{?>
                                            <td><?php echo($marketingMaterialDataArr['szModelStockVal'] > 0 ?$marketingMaterialDataArr['szModelStockVal'] : 'N/A')?></td>
                                            <td><?php echo($marketingMaterialQtyDataArr['szQuantity'] > 0 ? $marketingMaterialQtyDataArr['szQuantity'] : 'N/A')?></td>
                                           <td>          
                                              <a class="btn btn-circle btn-icon-only btn-default" id="marketingMaterialStatus" title="Request Quantity" onclick="requestQuantityAlert('<?php echo $marketingMaterialData['id'];?>','2');" href="javascript:void(0);">
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

<div id="popup_box"></div>