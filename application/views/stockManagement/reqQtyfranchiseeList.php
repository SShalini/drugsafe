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
                            <a href="<?php echo __BASE_URL__;?>/stock_management/stockreqlist">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Request Franchisee List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Request Franchisee List</span>
                            </div>
                          
                        </div>

                        <?php
                        if(!empty($frReqQtyAray))
                        {
                            ?>
                        <div class="row">
                              <form class="form-horizontal" id="szReqRrSearchForm" action="<?=__BASE_URL__?>/stock_management/stockreqlist" name="szReqRrSearchForm" method="post">
                          <div class="search col-md-3">
                            <input type="text" name="szReqProdFrList" id="szReqProdFrList" class="form-control input-square-right " placeholder="Id Or Name Or Email" value="<?=sanitize_post_field_value($_POST['szReqProdFrList'])?>">
                          
                          </div>
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                           </form>
                          </div>
                             <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id.</th>
                                        <th> Franchisee</th>
                                        <th> Email</th>
                                        <th> Contact No. </th>
                                        <th> Address </th>
                                        <th> Quantity Requests </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($frReqQtyAray)
                                    {   $i = 0;
                                        foreach($frReqQtyAray as $frReqQtyArayData)
                                        {
                                          
                                            $franchiseeAray = $this->Admin_Model->getUserDetailsByEmailOrId('',$frReqQtyArayData['iFranchiseeId']);
                                            
                                            $reqQtyListAray =$this->StockMgt_Model->getRequestQtyList(false,$franchiseeAray['id'],false,false);
                                               $count=0;
                                               foreach($reqQtyListAray as $reqQtyListData){

                                                  $count++; 

                                                }
                                           
                                        ?>
                                        <tr>
                                            <td> FR-<?php echo $franchiseeAray['id'];?> </td>
                                            <td> <?php echo $franchiseeAray['szName']?> </td>
                                            <td> <?php echo $franchiseeAray['szEmail'];?> </td>
                                            <td> <?php echo $franchiseeAray['szContactNumber'];?> </td>
                                            <td> <?php echo $franchiseeAray['szCity'];?> </td>
                                           <td>
                                                
                                                <a class="btn btn-circle btn-icon-only btn-default" id="quantityStatus" title="View Quantity Requests" onclick="ViewReqProductList(<?php echo $franchiseeAray['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <!-- BEGIN NOTIFICATION  -->
                                       
                                                <span class="badge badge-danger"><?php echo $count ?></span>
                                                <!-- END NOTIFICATION  -->

                                               
                                            </td>
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
                       <?php  if(!empty($frReqQtyAray)){?>
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