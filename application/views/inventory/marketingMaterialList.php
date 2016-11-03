<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Marketing Material</span>
                            </div>
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>inventory/addMarketingMaterial');">
                                        &nbsp;Add Marketing Material
                                    </button>
                                </div>
                        </div>
                            
                            
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
                                        <th> Product Descreption</th>
                                        <th> Product Cost</th>
                                       
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($marketingMaterialAray as $marketingMaterialData)
                                        {
                                          
                                        ?>
                                        <tr>
                                           <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $marketingMaterialData['szProductImage']; ?>" width="60" height="60"/>
                                                  
                                            </td>
                                            <td> <?php echo $marketingMaterialData['szProductCode']?> </td>
                                            <td> <?php echo $marketingMaterialData['szProductDiscription'];?> </td>
                                            <td> <?php echo $marketingMaterialData['szProductCost'];?> </td>
                                           
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editMarketingDetails('<?php echo $marketingMaterialData['id'];?>','2');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="MarketingMaterialStatus" title="Delete Client" onclick="productDeleteAlert(<?php echo $marketingMaterialData['id'];?>);" href="javascript:void(0);"></i>
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

<div id="popup_box"></div>