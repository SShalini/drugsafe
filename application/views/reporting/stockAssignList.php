<div class="page-content-wrapper">
        <div class="page-content">
          
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/reporting/stockassignlist">Home</a>
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
                      
                        if(!empty($allQtyAssignAray))
                        {
                           
                            ?>
                            <div class="actions">
                                <a href="<?php echo __BASE_URL__;?>/reporting/pdfstockassignlist" target="_blank" class=" btn btn-circle btn green-meadow">
                                <i class="fa fa-eye"></i> View Pdf </a>
                                <a href="javascript:;" class=" btn btn-circle btn green-meadow">
                                <i class="fa fa-eye"></i> View Xls </a>
                            </div>
                              <?php
                        }
                            ?>
                        </div>
                        
                        <?php
                      
                        if(!empty($allQtyAssignAray))
                        {
                           
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id </th>
                                        <th> Franchisee</th>
                                        <th> Product Code </th>
                                        <th> Quantity Assigned</th>
                                        <th> Assigned On </th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                    if($allQtyAssignAray)
                                    {   $i = 0;
                                       
                                        foreach($allQtyAssignAray as $allQtyAssignData)
                                        {
                                        
                                           $productDataAry = $this->Inventory_Model->getProductDetailsById($allQtyAssignData['iProductId']);
                                          
                                           $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$allQtyAssignData['iFranchiseeId']);
                                        
                                          
                                        ?>
                                        <tr>
                                            <td> FR-<?php echo $allQtyAssignData['iFranchiseeId'];?> </td>
                                            <td> <?php echo $franchiseeArr['szName']?> </td>
                                            <td> <?php echo $productDataAry['szProductCode'];?> </td>
                                            <td> <?php echo $allQtyAssignData['szQuantityAssigned'];?> </td>
                                            <td> <?php echo date('d/m/Y h:i:s A',strtotime($allQtyAssignData['dtAssignedOn']))?>  </td>

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
                        <?php  if(!empty($allQtyAssignAray)){?>
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

