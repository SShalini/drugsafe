<div class="page-content-wrapper">
        <div class="page-content">
          
            <div id="page_content" class="row">
                <div class="col-md-12">
<!--                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/inventory/drugtestkitlist">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Drug Test Kit List</span>
                        </li>
                    </ul>-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Stock Request List</span>
                            </div>
                           
                        </div>
                        <?php
                        
                        if(!empty($reqQtyListAray))
                        {
                           
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th> Image </th>
                                        <th> Product Code</th>
                                        <th> Product Category</th>
                                        <th> Descreption</th>
                                        <th> Cost</th>
                                        <th> Requested Quantity </th>
                                        <th> Processed Quantity </th>
                                        <th> Action</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                    if($reqQtyListAray)
                                    {   $i = 0;
                                        foreach($reqQtyListAray as $reqQtyListData)
                                        {
                                          
                                           $productDataAry = $this->Inventory_Model->getProductDetailsById($reqQtyListData['iProductId']);
                                           $productCategortDataAry = $this->StockMgt_Model->getCategoryDetailsById($productDataAry['szProductCategory']);
                                           $QtyAssignListAry = $this->StockMgt_Model->getQtyAssignListById($reqQtyListData['iProductId']); 
                                          if($QtyAssignListAry)
                                            {
                                                $total='';
                                               foreach($QtyAssignListAry as $QtyAssignListdata)
                                               {
                                                   $total+=$QtyAssignListdata['szQuantityAssigned'];
                                               }
                                            }                            
                                         
                                        ?>
                                        <tr>
                                             <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $productDataAry['szProductImage']; ?>" width="60" height="60"/>
                                                  
                                            </td>
                                            
                                            <td> <?php echo $productDataAry['szProductCode'];?> </td>
                                            <td> <?php echo $productCategortDataAry['szName']?> </td>
                                            <td> <?php echo $productDataAry['szProductDiscription'];?> </td>
                                            <td> <?php echo $productDataAry['szProductCost'];?> </td>
                                            <td> <?php echo $reqQtyListData['szQuantity'];?>  </td>
                                            <td> <?php echo ($total > 0 ? $total : 'N/A')?></td>
                                            
                                           
                                            <td>
                                                 <a class="btn btn-circle btn-icon-only btn-default" id="quantityStatus" title="Allot Quantity"  onclick="allotReqQtyAlert(<?php echo $productDataAry['id'];?>,<?php echo $reqQtyListData['szQuantity'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-mail-reply" aria-hidden="true"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <?php 
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                             <?php
                            $i++;  
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