<div class="page-content-wrapper">
        <div class="page-content">
          
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/reporting/frstockassignlist">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                        <li>
                            <span class="active"> Stock Assignments</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Stock Assignments</span>
                            </div>
                            <?php
                      
                        if(!empty($frAllQtyAssignAray))
                        {
                           
                            ?>
                            <div class="actions">
                                <a href="<?php echo __BASE_URL__;?>/reporting/pdf_fr_stockassignlist" target="_blank" class=" btn green-meadow">
                                <i class="fa fa-eye"></i> View Pdf </a>
                                <a href="<?php echo __BASE_URL__;?>/reporting/excelfr_stockassignlist" class=" btn green-meadow">
                                <i class="fa fa-eye"></i> View Xls </a>
                            </div>
                              <?php
                        }
                            ?>
                        </div>
                        
                        <?php
                      
                        if(!empty($frAllQtyAssignAray))
                        {
                      
                         
                            ?>
                          <div class="row">
                           <form class="form-horizontal" id="szSearchFrReqAssignList" action="<?=__BASE_URL__?>/reporting/frstockassignlist " name="szSearchFrReqAssignList" method="post">
                          <div class="search col-md-3">
                            <input type="text" name="szSearchFrReqAssignList" id="szSearchFrReqAssignList" class="form-control input-square-right " placeholder= "Product Code " value="<?=sanitize_post_field_value($_POST['szSearchFrReqAssignList'])?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                           </form>
                          </div>
                    <div class="row">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                       
                                        <th> Product Code </th>
                                        <th> Quantity Assigned</th>
                                        <th> Quantity Adjusted</th>
                                        <th> Available Quantity</th>
                                        <th> Assigned On </th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                    if($frAllQtyAssignAray)
                                    {   $i = 0;
                                       
                                        foreach($frAllQtyAssignAray as $frAllQtyAssignData)
                                        {
//                                    
                                        ?>
                                        <tr>
                                          
                                            <td> <?php echo $frAllQtyAssignData['szProductCode'];?> </td>
                                            <td> <?php echo $frAllQtyAssignData['szQuantityAssigned'];?> </td>
                                            <td> <?php echo $frAllQtyAssignData['quantityDeducted'];?> </td>
                                            <td> <?php echo $frAllQtyAssignData['szTotalAvailableQty'];?> </td>
                                            <td> <?php echo date('d/m/Y h:i:s A',strtotime($frAllQtyAssignData['dtAssignedOn']))?>  </td>

                                        </tr>
                                        <?php 
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                             <?php
                            $i++;  
                        }
                        else
                        {
                            echo "Not Found";
                        }
                        ?>
                        <?php  if(!empty($frAllQtyAssignAray)){?>
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
</div>
<div id="popup_box"></div>


