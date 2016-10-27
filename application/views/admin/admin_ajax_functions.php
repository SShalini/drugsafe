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
                    <h4 class="modal-title">Delete Franchisee</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Franchisee?</p>
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
                    <h4 class="modal-title">Delete Client</h4>
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
                    <h4 class="modal-title">Deleted Client</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Client has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/franchisee/clientList" class="btn dark btn-outline">Close</a>
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
                    <?php }else{?>
                     <a href="<?php echo __BASE_URL__;?>/inventory/marketingMaterialList" class="btn dark btn-outline">Close</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
?>
