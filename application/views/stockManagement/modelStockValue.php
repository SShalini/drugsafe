<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
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
     <div class="portlet box green-meadow">
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
                <?php 
        
            if(!empty($_SESSION['drugsafe_tab_status']))
            {
                if($_SESSION['drugsafe_tab_status']==1){
                  $drActive ='active'; 
                }
                else{
                  $mrActive ='active';   
                }
           $this->session->unset_userdata('drugsafe_tab_status');
            }
        else {
               $drActive ='active'; 
     
 }
            ?>
                <li class=" <?php echo $drActive?> ">
                        <a href="#tab1" data-toggle="tab">Drug Test Kit List</a>
                </li>
                 <li class="<?php echo $mrActive?>">
                        <a href="#tab2" data-toggle="tab">Marketing Material List</a>
                </li>
            </ul>
                 <div class="tab-content">
                     <div class="tab-pane <?php echo $drActive?>" id="tab1">
                        <div id="page_content" class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold uppercase">Drug Test Kit</span>
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
                                                    <th>  Descreption</th>
                                                    <th> Cost</th>
                                                    <th> Model Stock Value </th>
                                                    <th> Action </th>
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
                                                        <td>  <?php echo $drugTestKitDataArr[$i]['szModelStockVal'];?></td>
                                                        <td>
                                                            <?php if(empty($drugTestKitDataArr[$i]['szModelStockVal']) && ($drugTestKitDataArr[$i]['szModelStockVal'] != '0')){?>
                                                            <a class="btn btn-circle btn-icon-only btn-default" title="Edit Model Stock Value" onclick="addModelStockValue(<?php echo $drugTestKitData['id'];?>);" href="javascript:void(0);">
                                                                <i class="fa fa-plus"></i> 
                                                            </a>
                                                            <?php }else{?>
                                                             <a class="btn btn-circle btn-icon-only btn-default" title="Edit Model Stock Value" onclick="editModelStockValue(<?php echo $drugTestKitData['id'];?>);" href="javascript:void(0);">
                                                                <i class="fa fa-pencil"></i> 
                                                            </a>
                                                            <?php }?>
                                                            
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
<div class="tab-pane <?php echo $mrActive?>" id="tab2">
    <div id="page_content" class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Marketing Material</span>
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
                                <th>  Descreption</th>
                                <th>  Cost</th>
                                <th> Model Stock Value </th>
                                <th> Action </th>
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
                                    <td> $<?php echo $marketingMaterialData['szProductCost'];?> </td>
                                    <td>  <?php echo $marketingMaterialDataArr[$i]['szModelStockVal'];?></td>
                                                        <td>
                                                            <?php if(empty($marketingMaterialDataArr[$i]['szModelStockVal'])){?>
                                                            <a class="btn btn-circle btn-icon-only btn-default" title="Add Model Stock Value" onclick="addModelStockValue(<?php echo $marketingMaterialData['id'];?>);" href="javascript:void(0);">
                                                                <i class="fa fa-plus"></i> 
                                                            </a>
                                                            <?php }else{?>
                                                             <a class="btn btn-circle btn-icon-only btn-default" title="Edit Model Stock Value" onclick="editModelStockValue(<?php echo $marketingMaterialData['id'];?>);" href="javascript:void(0);">
                                                                <i class="fa fa-pencil"></i> 
                                                            </a>
                                                            <?php }?>
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
<div id="popup_box"></div>       
 </div>
 </div>
</div>   
</div>
</div>
</div>
