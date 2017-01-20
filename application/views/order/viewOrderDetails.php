<div class="page-content-wrapper">
    <div class="page-content">
        <?php
        if (!empty($_SESSION['drugsafe_user_message'])) {
            if (trim($_SESSION['drugsafe_user_message']['type']) == "success") {
                ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['drugsafe_user_message']['content']; ?>
                </div>
            <?php }
            if (trim($_SESSION['drugsafe_user_message']['type']) == "error") {
                ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['drugsafe_user_message']['content']; ?>
                </div>
            <?php }
            $this->session->unset_userdata('drugsafe_user_message');
        }
        ?>

        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">

                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Order List</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">
                   
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">
                                    Order List
                                </span>
                            </div>
                
                        </div>
                    <div class="row">
                      <form id="orderSearchForm" id="orderSearchForm" method="post">

                <div class="row">
                    <div class="col-md-4">
                       
                        <div class="form-group input-group customerlist">
                                <span class="input-group-addon">
                                    <i class="fa fa-dot-circle-o"></i>
                                </span>
                            <select class="form-control custom-select" name="szSearch2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Name</option>
                                          <?php
                                          foreach($allfranchisee as $franchiseeIdList)
                                          {
                                              $selected = ($franchiseeIdList['id'] == $_POST['szSearch2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$franchiseeIdList['id'].'"' . $selected . ' >'.$franchiseeIdList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div
                            class="form-group <?php if ($kOrder->arErrorMessages['order_number'] != '') { ?> has-error <?php } ?>">

                            <div class="form-group">
                                <input type="text" class="form-control" name="searchArr[order_number]" id="enddt"
                                       placeholder="Order Number"
                                       value="<?php echo $_POST['searchArr']['order_number'] ?>">
                                <?php if ($kOrder->arErrorMessages['order_number'] != '') { ?>
                                    <span
                                        class="help-block"><?php echo $kOrder->arErrorMessages['order_number']; ?></span>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-select" name="szSearch2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Name</option>
                                          <?php
                                          foreach($allfranchisee as $franchiseeIdList)
                                          {
                                              $selected = ($franchiseeIdList['id'] == $_POST['szSearch2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$franchiseeIdList['id'].'"' . $selected . ' >'.$franchiseeIdList['szName'].'</option>';
                                          }
                                          ?>
                           </select>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div
                            class="form-group <?php if ($kOrder->arErrorMessages['startcreatedon'] != '') { ?> has-error <?php } ?>">
                            <div class="form-group" data-date="<?php echo date('d/m/Y') ?>"
                                 data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control date1" name="searchArr[startcreatedon]"
                                       id="enddt" placeholder="Start Order Date"
                                       value="<?php echo $_POST['searchArr']['startcreatedon'] ?>">
                                <?php if ($kOrder->arErrorMessages['startcreatedon'] != '') { ?>
                                    <span
                                        class="help-block"><?php echo $kOrder->arErrorMessages['startcreatedon']; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div
                            class="form-group <?php if ($kOrder->arErrorMessages['endcreatedon'] != '') { ?> has-error <?php } ?>">
                            <div class="form-group" data-date="<?php echo date('d/m/Y') ?>"
                                 data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control date1" name="searchArr[endcreatedon]"
                                       id="endcreatedon" placeholder="End Order Date"
                                       value="<?php echo $_POST['searchArr']['endcreatedon'] ?>">
                                <?php if ($kOrder->arErrorMessages['endcreatedon'] != '') { ?>
                                    <span
                                        class="help-block"><?php echo $kOrder->arErrorMessages['endcreatedon']; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn green-meadow uppercase bold" type="button" onclick="getOrderSearch();"><i
                                    class="fa fa-search"></i> Search
                            </button>
                            &nbsp;
                            <!--<button class="btn red uppercase bold" type="button" onclick="resetClientSearch();"><i class="fa fa-refresh"></i>Reset</button>-->
                        </div>
                    </div>


                </div>


            </form>   
                    </div>
                        <div class="portlet-body alert">
                       <div class="row">
                            <div class="col-md-12 col-sm-12">
                                    <div class="portlet green-meadow box">
                                            <div class="portlet-title">
                                                    <div class="caption">
                                                            <i class="fa fa-users"></i>View Order List
                                                    </div>
                                                   
                                            </div>
                                         <?php
                        
                        if(!empty($validOrdersDetailsAray))
                        {
                           ?>
                        
                                            <div class="portlet-body">
                                                    <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             #
                                                                    </th>
                                                                    <th>
                                                                             Order No
                                                                    </th>
                                                                    <th>
                                                                             Franchisee 
                                                                    </th>
                                                                    <th>
                                                                             Order Date
                                                                    </th>
                                                                    <th>
                                                                             Status
                                                                    </th>
                                                                    <th>
                                                                             Order Details
                                                                    </th>
                                                                    <th>
                                                                             Edit Order
                                                                    </th>
                                                                   
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                    <?php
                                           
                                              
                                             $i = 0;
                                                foreach($validOrdersDetailsAray as $validOrdersDetailsData)
                                                { 
                                                    $i++ ;
                                                   $productDataArr = $this->Inventory_Model->getProductDetailsById($validOrdersDetailsData['productid']);
                                                   $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $validOrdersDetailsData['franchiseeid']);
                                                
                                                    $splitTimeStamp = explode(" ",$validOrdersDetailsData['createdon']);
                                                             $date1 = $splitTimeStamp[0];
                                                             $time1 = $splitTimeStamp[1];
                                                           
                                                           $x=  date("g:i a", strtotime($time1));
                                                     
                                                          $date= explode('-', $date1);
                                                        
                                                          
                                                          $monthNum  = $date['1'];
                                                         
                                                          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                                          $monthName = $dateObj->format('M');
                                                   ?>
                                                            <tr>
                                                                    <td><?php echo $i; ?> </td>
                                                                    <td>
                                                                           #0000<?php echo $validOrdersDetailsData['orderid'];?> 
                                                                    </td>
                                                                    <td>
                                                                           <?php echo $franchiseeDetArr1['szName'];?> 
                                                                    </td>
                                                                    <td>
                                                                       <?php echo $date['2'];?> <?php echo $monthName;?>  <?php  echo $date['0'];?> at <?php echo $x;?>
                                                                    </td>
                                                        <td>
                                     <?php if($validOrdersDetailsData['status']==0){?>
                                       
                                        <a title="Order Status" class="label label-sm label-warning">
                                            Ordered
                                        </a>
                                        <?php
                                    }
                                    if($validOrdersDetailsData['status']==1){
                                        ?>
                                        <a title="Order Status" class="label label-sm label-success">
                                            Pending
                                        </a>
                                        <?php
                                    }
                                  if($validOrdersDetailsData['status']==2){
                                        ?>
                                        <a title="Order Status" class="label label-sm label-info">
                                            Dispatched
                                        </a>
                                        <?php
                                    }
                                   
                                   if($validOrdersDetailsData['status']==3){
                                        ?>
                                        <a title="Order Status" class="label label-sm label-danger">
                                            Canceled
                                        </a>
                                        <?php
                                    }

                                    ?></td>
                                    
                                                                    <td>
                                                                         <a class="btn btn-circle btn-icon-only btn-default" title="View Order Details" onclick="view_order_details('<?php echo $validOrdersDetailsData['orderid'];?>')" href="javascript:void(0);">
                                                                         <i class="fa fa-eye"></i> 
                                                                      </a>
                                                                    </td>
                                                                    <td>
                                                                      <a class="btn btn-circle btn-icon-only btn-default" title="Edit franchisee Data" onclick="editFranchiseeDetails('<?php echo $franchiseeData['id'];?>',<?php echo $operationManagerAray['id'];?>);" href="javascript:void(0);">
                                                                         <i class="fa fa-pencil"></i> 
                                                                      </a>
                                                                    </td>
                                                                    
                                                            </tr>
                                                          <?php
                                         
                                              }
                                            
                                             
                                           ?>
                                                            </tbody>
                                                            </table>
                                                    </div>
                                            </div>
                        <?php }?>
                                    </div>
                            </div>
                    </div>
                            </div>
                          
               
                    </div>

                        </div>
         
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>
