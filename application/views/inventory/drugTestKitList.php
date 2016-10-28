<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Drug Test Kit</span>
                            </div>
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>inventory/addDrugTestKit');">
                                        &nbsp;Add Test Kit
                                    </button>
                                </div>
                        </div>
                            
                           
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
                                        <th> Product Descreption</th>
                                        <th> Product Cost</th>
                                        <th> Actions </th>
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
                                            <td> <?php echo $drugTestKitData['szProductCost'];?> </td>
                                            
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editProduct('<?php echo $drugTestKitData['id'];?>','1');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                 <a class="btn btn-circle btn-icon-only btn-default" id="drugTestKitStatus" title="Delete Drug-Test Kit Details" onclick="productDeleteAlert(<?php echo $drugTestKitData['id'];?>,'1');" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>

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