<script type='text/javascript'>
    $(function() {
        $("#szSearchProdCode").customselect();
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
                          <div class="row">
                              <form class="form-horizontal" id="szSearchMarketingMaterialList" action="<?=__BASE_URL__?>/order/marketingmaterial" name="szSearchMarketingMaterialList" method="post">
                          <div class="search col-md-3">
<!--                            <input type="text" name="szSearchProductCode" id="szSearchProductCode" class="form-control input-square-right " placeholder="Product Code" value="--><?//=sanitize_post_field_value($_POST['szSearchProductCode'])?><!--">-->
                              <select class="form-control custom-select" name="szSearchProductCode" id="szSearchProdCode" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Product Code</option>
                                  <?php
                                  foreach($marketingMaterialListAray as $marketItem)
                                  {
                                      $selected = ($marketItem['szProductCode'] == $_POST['szSearchProdCode'] ? 'selected="selected"' : '');
                                      echo '<option value="'.$marketItem['szProductCode'].'" ' . $selected . '>'.$marketItem['szProductCode'].'</option>';
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
                                        <th> Image </th>
                                        <th> Product Code</th>
                                        <th>  Descreption</th>
                                        <th>  Cost</th>
                                        <th>  Expiry Date</th>
                                     
                                        <th>  Action</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($marketingMaterialAray as $marketingMaterialData)
                                        {
                                             $idfranchisee = $_SESSION['drugsafe_user']['id'];
                                             $marketingMaterialDataArr = $this->StockMgt_Model->getStockValueDetailsById($idfranchisee,$marketingMaterialData['iProductId']);
                                             //$marketingMaterialQtyDataArr = $this->StockMgt_Model->getProductQtyDetailsById($idfranchisee,$marketingMaterialData['id']);
                                          
                                        ?>
                                        <tr>
                                           <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $marketingMaterialData['szProductImage']; ?>" width="60" height="60"/>
                                                  
                                            </td>
                                            <td> <?php echo $marketingMaterialData['szProductCode']?> </td>
                                            <td> <?php echo $marketingMaterialData['szProductDiscription'];?> </td>
                                            <td>$<?php echo $marketingMaterialData['szProductCost'];?> </td>
                                            <td>
						<input type="number"min="1"  class="form-control btn-xs " name="order_customer_name">
					   </td>
                                            <td>
                                              
                                                <a class="btn btn-circle btn-icon-only btn-default" id="MarketingMaterialStatus" title="Delete Marketing Material Details" onclick="productDeleteAlert(<?php echo $marketingMaterialData['id'];?>,'2');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>

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
                            echo "Not Found";
                        }
                        ?>
                     
                              <?php  if(!empty($marketingMaterialAray)){?>
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
<div id="popup_box"></div>