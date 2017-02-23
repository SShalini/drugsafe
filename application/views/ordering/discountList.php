<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Discount Percentage List</span>
                            </div>
                             <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>ordering/createDiscount');">
                                        &nbsp;Create Discount
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        
                        if(!empty($getAllDiscountAry))
                        {
                           
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> Discount Percentage</th>
                                        <th> Description</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($getAllDiscountAry as $getAllDiscountData)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td> <?php echo $i;?> </td>
                                            <td> <?php echo $getAllDiscountData['percentage']?>% </td>
                                            <td> <?php echo $getAllDiscountData['description'];?> </td>
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Discount Data" onclick="editDiscountDetails('<?php echo $getAllDiscountData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Discount" onclick="discountDelete(<?php echo $getAllDiscountData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
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