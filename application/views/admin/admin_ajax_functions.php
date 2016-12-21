<?php
if($mode == '__DELETE_FRANCHISEE_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Franchisee Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Deleting this franchisee record will delete all the client records (main client and site records) associated with this client ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteFranchiseeConfirmation('<?php echo $idfranchisee;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_FRANCHISEE_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Franchisee</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Franchisee has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/admin/franchiseeList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__DELETE_CLIENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Client Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Client?</p>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteClientConfirmation('<?php echo $idClient;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_CLIENT_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Client Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Client has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__.$url;?>" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__DELETE_PRODUCT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="productStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Product</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="deleteProductConfirmation('<?php echo $idProduct;?>','<?php  echo $flag ?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_PRODUCT_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="productStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Product</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Products has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <?php if ($flag==1){?>
                    <a href="<?php echo __BASE_URL__;?>/inventory/drugTestKitList" class="btn dark btn-outline">Close</a>
                    <?php }elseif($flag==2){?>
                     <a href="<?php echo __BASE_URL__;?>/inventory/marketingMaterialList" class="btn dark btn-outline">Close</a>
                      <?php }else{?>
                     <a href="<?php echo __BASE_URL__;?>/inventory/consumableslist" class="btn dark btn-outline">Close</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__REQUEST_QUANTITY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="requestQuantityStatus" class="modal fade" tabindex="-2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Request Quantity</span> </h4>
                        </div>
                   
                </div>
                       </div>
                <div class="modal-body">
                      <form action=""  id="requestQuantityForm" name="requestQuantity" method="post" class="form-horizontal form-row-sepe">
                       <div class="form-body">
                           <div class="form-group <?php if(form_error('requestQuantity[szQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Request Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szQuantity" class="form-control input-large select2me input-square-right required  " type="text" value="<?php echo set_value('requestQuantity[szQuantity]'); ?>" placeholder="Request Quantity" onfocus="remove_formError(this.id,'true')" name="requestQuantity[szQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('requestQuantity[szQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('requestQuantity[szQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                </div>
                      </form>
                         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="requestQuantityConfirmation('<?php echo $idProduct;?>','<?php  echo $flag ?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__REQUEST_QUANTITY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="requestQuantityStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Request Quantity</span> </h4>
                        </div>
                   
                </div>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Requested Quantity has been successfully send  .</p>
                </div>
                <div class="modal-footer">
                    <?php
                    if($flag==1)
                    {
                        ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/drugtestkitlist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                    elseif($flag==2)
                    {
                       ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/marketingmateriallist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                     else
                    {
                       ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/consumableslist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__ALLOT_QUANTITY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="allotQuantityStatus" class="modal fade" tabindex="-2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Allot Quantity</span> </h4>
                        </div>
                   
                </div>
                       </div>
                <div class="modal-body">
                      <form action=""  id="allotQuantityForm" name="allotQuantity" method="post" class="form-horizontal form-row-sepe">
                       <div class="form-body">
                          <div class="form-group <?php if(form_error('allotQuantity[szReqQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-4">Request Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szReqQuantity" class="form-control input-large select2me read-only" readonly type="text" value="<?php echo set_value('szReqQuantity'); ?>" placeholder="Requested Quantity" onfocus="remove_formError(this.id,'true')" name="allotQuantity[szReqQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('allotQuantity[szReqQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('allotQuantity[szReqQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                           <div class="form-group <?php if(form_error('allotQuantity[szAddMoreQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-4">Assign Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szAddMoreQuantity" class="form-control input-large select2me " type="text" value="<?php echo set_value('allotQuantity[szAddMoreQuantity]'); ?>" placeholder="Assign Quantity" onfocus="remove_formError(this.id,'true')" name="allotQuantity[szAddMoreQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('allotQuantity[szAddMoreQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('allotQuantity[szAddMoreQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                </div>
                      </form>
                         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="allotQuantityConfirmation('<?php echo $idProduct;?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__ALLOT_QUANTITY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="allotQuantityStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Allot Quantity</span> </h4>
                        </div>
                   
                </div>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i>  Quantity has been assigned successfully .</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/stock_management/viewproductlist" class="btn dark btn-outline">Close</a>
                   
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_OPERATION_MANAGER_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="operationManagerStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Operation Manager Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Deleting this operation manager record will delete all the franchisee and client records (main client and site records) associated with this operation manager ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteOperationManagerConfirmation('<?php echo $idOperationManager;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_OPERATION_MANAGER_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="operationManagerStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Operation Manager</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Operation Manager has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/admin/operationManagerList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_CATEGORY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="CategoryStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="deleteCategoryConfirmation('<?php echo $idCategory;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_CATEGORY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="categoryStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Category</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Category has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/categoriesList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
?>