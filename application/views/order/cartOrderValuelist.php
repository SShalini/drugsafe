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
                            <a href="<?php echo __BASE_URL__;?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Order List </span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Order List </span>
                            </div>
                      
                         <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" title="Add To Cart" onclick="" href="javascript:void(0);">
                                    <i class="fa fa-cart-arrow-down"></i>
                                   
                                </a>
                             <?php  $totalOrdersArr =$this->Order_Model->getOrdersList();
                             
                                               $count=0;
                                               foreach($totalOrdersArr as $totalOrdersData){

                                                  $count++; 

                                                }?>
                              <span class="badge badge-danger"><?php echo $count;?></span>
                            </div>
                          </div>
                         
                        <?php
                        
                        if(!empty($totalOrdersAray))
                        {
                           ?>
                        
                           <div class="row">
                                <form class="form-horizontal" id="szSearchOrderList" action="<?=__BASE_URL__?>/order/orderList " name="szSearchOrderList" method="post">
                                    <div class="search col-md-3">
                                        <select class="form-control custom-select" name="szSearchProdCode" id="szSearchProdCode" onfocus="remove_formError(this.id,'true')">
                                            <option value="">Product Code</option>
                                            <?php
                                            foreach($totalOrdersSearchAray as $totalOrdersSearchData)
                                            {  $productDataSearchArr = $this->Inventory_Model->getProductDetailsById($totalOrdersSearchData['productid']);
                                                $selected = ($productDataSearchArr['id'] == $_POST['szSearchProdCode'] ? 'selected="selected"' : '');
                                                echo '<option value="'.$productDataSearchArr['id'].'" ' . $selected . ' >'.$productDataSearchArr['szProductCode'].'</option>';
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
                                <form class="form-horizontal" id="updateCart" action="<?= __BASE_URL__ ?>/order/updateCartData" name="updateCart" method="post">
                            <div class="form-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                          <tr>
                                                <th> Image </th>
                                                <th> Product Code</th>
                                                <th>  Descreption</th>
                                                <th>  Cost</th>
                                                <th style="width:60px;">  Quantity</th>
                                                 <th >  Price</th>
                                                <th>  Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                                $i = 1;
                                                $TotalPrice = 0;
                                                foreach($totalOrdersAray as $totalOrdersData)
                                                {   
                                                 
                                                   $productDataArr = $this->Inventory_Model->getProductDetailsById($totalOrdersData['productid']);
                                                  $price =  ($totalOrdersData['quantity'])*($productDataArr['szProductCost']);
                                                   $TotalPrice +=$price;
                                                   ?>
                                                <tr>
                                                    <td>
                                                        <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $productDataArr['szProductImage']; ?>" width="60" height="60"/>    
                                                    </td>
                                                    <td><?php echo $productDataArr['szProductCode']?> </td>
                                                    <td> <?php echo $productDataArr['szProductDiscription'];?> </td>
                                                    <td> $<?php echo $productDataArr['szProductCost'];?> </td>
                                                    <td>
                                                         <input type="number"min="1"  class="form-control btn-xs " name="order_quantity<?php echo $i;?>" value="<?php echo $totalOrdersData['quantity'];?>" id="order_quantity<?php echo $i;?>" >
                                                    </td>
                                                   <td> <?php echo $price;?> </td>
                                                    <td>
                                                        <a class="btn btn-circle btn-icon-only btn-default" title="Remove From Cart" onclick="DeleteOrder('<?php echo $totalOrdersData['id'];?>');" href="javascript:void(0);">
                                                            <i class="fa fa-times"></i> 
                                                        </a>
                                                    </td>
                                                </tr>
                                                 <input id="orderId" class="form-control" type="hidden"
                                               value="<?php echo $totalOrdersData['id']; ?>" name="order_id<?php echo $i;?>" id="order_id<?php echo $i;?>">
                                               <?php
                                             $i++;
                                              }
                                            
                                             
                                           ?>

                                        </tbody>
                                     </table>
                                     </div>
                            </div>
                        
                       
                             
                          <input id="count" class="form-control" type="hidden"
                                               value="<?php echo $count; ?>" name="count">
                           <div class="row ">
                          <div class="col-md-8">
                              </div>
                            <div class="col-md-4">
                            <lable> &nbsp;&nbsp;<b>Total Price :</b></lable>
                            &nbsp;
                             <?php echo $TotalPrice?>
                            </div>
                            </div>
                        
                        
                         <div class="row Ckbtn">
                          <div class="col-md-8">
                              </div>
                            <div class="col-md-4">
                           <button type="submit" class="btn green-meadow" name="submit"><i class="fa fa-cart-arrow-down"></i> Update Cart</button>  
                            &nbsp;
                             <button type="button" onclick="redirect_url('<?php echo base_url();?>order/drugtestkit');" class="btn green-meadow"><i class="fa fa-cart-arrow-down"></i> Continue Ordering</button>   
                            </div>
                            </div>
                       
                            <div class="row Ckbtn">
                                <div class="col-md-8">
                              </div>
                              <div class="col-md-2">
                                <button type="button" onclick="checkOutOrder('<?php echo $totalOrdersAray['0']['franchiseeid'];?>'); return false;" class="btn green-meadow"><i class="fa fa-check"></i> Checkout</button>   
                              </div> 
                            
                        </div>
                     </form>
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