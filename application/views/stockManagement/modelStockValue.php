<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
  <div class="page-content">
     <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer "></i>&nbsp; &nbsp;
                <span class="caption-subject  bold uppercase">Model Stock Value Management</span>
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>  
            </div>
        </div>
    <div class="portlet-body">
        <div class="tabbable tabbable-tabdrop">
            <ul class="nav nav-tabs">
                <li class="active">
                        <a href="#tab1" data-toggle="tab">Drug Test Kit List</a>
                </li>
                <li>
                        <a href="#tab2" data-toggle="tab">Marketing Material List</a>
                </li>
            </ul>
                 <div class="tab-content">
                     <div class="tab-pane active" id="tab1">
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
                                                    &nbsp;Add Drug Test Kit
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
                 <div id="popup_box"></div>   
            </div>
<div class="tab-pane" id="tab2">
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
   echo "sr delete this";
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
<div id="popup_box"></div>       
 </div>
 </div>
</div>   
</div>
</div>
</div>
