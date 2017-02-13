<div class="page-content-wrapper">
    <div class="page-content">
       

        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">

                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Revenue Summery</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                    Revenue Summery
                                </span>
                        </div>
                        <?php if(!empty($allfranchisee)){?>
                            <div class="actions">

                                <a onclick="ViewpdfRevenueSummery('<?php echo $_POST['dtStart'];?>','<?php echo $_POST['dtEnd'];?>')" href="javascript:void(0);" class=" btn green-meadow">
                                    <i class="fa fa-file-pdf-o"></i> View Pdf </a>

                                <a onclick="ViewexcelRevenueSummery('<?php echo $_POST['dtStart'];?>','<?php echo $_POST['dtEnd'];?>')" href="javascript:void(0);" class=" btn green-meadow">
                                    <i class="fa fa-file-excel-o"></i> View Xls </a>

                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="portlet-body totalpr alert">
                        <div class="row">
                            <form name="revenueSearchForm" id="revenueSearchForm"
                                  action="<?= __BASE_URL__ ?>/reporting/view_revenue_summery" method="post">
                                <div class="row">
                                   
                                    <div class="col-md-3">
                                        <div class="form-group <?php if (!empty($arErrorMessages['dtStart']) != '') { ?>has-error<?php } ?>">
                                            <div class="input-group input-medium date date-picker"
                                                 data-date-format="dd/mm/yyyy">

                                                <input type="text" id="dtStart" class="form-control"
                                                       value="<?php echo set_value('dtStart'); ?>" readonly
                                                       placeholder="Start Revenue Date"
                                                       onfocus="remove_formError(this.id,'true')" name="dtStart">
                                                <span class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                               </span>
                                            </div>
                                            <!-- /input-group -->
                                            <?php
                                            if (form_error('dtStart')) {
                                                ?>
                                                <span class="help-block pull-left">
                                                <span><?php echo form_error('dtStart'); ?></span>
                                                </span><?php } ?>
                                            <?php if (!empty($arErrorMessages['dtStart'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['dtStart']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div
                                            class="form-group <?php if (!empty($arErrorMessages['dtEnd']) != '') { ?>has-error<?php } ?>">
                                            <div class="input-group input-medium date date-picker"
                                                 data-date-format="dd/mm/yyyy">

                                                <input type="text" id="szSearch5" class="form-control"
                                                       value="<?php echo set_value('dtEnd'); ?>" readonly
                                                       placeholder="End Revenue Date"
                                                       onfocus="remove_formError(this.id,'true')" name="dtEnd">
                                                <span class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                               </span>
                                            </div>
                                            <!-- /input-group -->
                                            <?php
                                            if (form_error('dtEnd')) {
                                                ?>
                                                <span class="help-block pull-left">
                                                <span><?php echo form_error('dtEnd'); ?></span>
                                                </span><?php } ?>
                                            <?php if (!empty($arErrorMessages['dtEnd'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['dtEnd']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn green-meadow" type="submit"><i
                                                    class="fa fa-search"></i> Search
                                            </button>
                                            &nbsp;
                                        </div>
                                    </div>
                                 </div>
                             </form>
                        </div>
                    </div>
                    <?php
                    if($_POST['dtStart']!='' && $_POST['dtEnd']!='')
                    {
                        
                    if (!empty($allfranchisee)) {
                        
                      
                    ?>
                    <div class="portlet-body alert">
                        <div class="row">
                            <div>
                                <div class="portlet green-meadow box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-users"></i>Revenue Summery

                                        </div>

                                    </div>
                                </div> 
                                <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Franchisee Name 
                                                    </th>
                                                    <th>
                                                        Total Revenue
                                                    </th>
                                                    <th>
                                                        Royalty Fees
                                                    </th>
                                                    <th>
                                                        Net Profit
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
						$i = 1;
						foreach($allfranchisee as $allfranchiseeData)
						{
                                                    
                                                    $getAdmindetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$allfranchiseeData);
                                                    
						    //$getClientDeatils=$this->Webservices_Model->getclientdetails($allfranchiseeData);
                                                     $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '',$allfranchiseeData);
                                                    $id=array();
                                                    foreach($getClientDeatils as $getClientData)
                                                    {   
                                                        array_push($id, $getClientData['clientId']);
                                                    }
							                      						
                                                    $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
                                                    $sosId=array();
                                                    foreach($getSosDetails as $getSosData)
                                                    {   
                                                        array_push($sosId, $getSosData['id']);
                                                    }
													
                                                    if(!empty($sosId))
                                                    {
                                                        $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
                                                    }
													$totalRevenu='';
                                                    $totalRoyaltyfees='';
                                                    $totalNetProfit='';
						    foreach ($getManualCalcStartToEndDate as $getManualCalcData) {
														
                                                        $getClientId=$this->Form_Management_Model->getSosDetailBySosId($getManualCalcData['sosid']);
                                                        $getClientDetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$getClientId['Clientid']);
                                                        $DrugtestidArr = array_map('intval', str_split($getClientId['Drugtestid']));
                                                        if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                                                            $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($getManualCalcData['sosid']));
                                                        }
                                                        $ValTotal = 0;
														
                                                        if (in_array(1, $DrugtestidArr)) {
                                                            $ValTotal = number_format($ValTotal + $countDoner * __RRP_1__, 2, '.', '');
                                                        }
                                                        if (in_array(2, $DrugtestidArr)) {
                                                            $ValTotal = number_format($ValTotal + $countDoner * __RRP_2__, 2, '.', '');
                                                        }
                                                        if (in_array(3, $DrugtestidArr)) {
                                                            $ValTotal = number_format($ValTotal + $countDoner * __RRP_3__, 2, '.', '');
                                                        }
                                                        $Royaltyfees = $ValTotal * 0.1;
                                                        $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                                                        $Royaltyfees= number_format($Royaltyfees, 2, '.', ',');
                                                    
                                                        $NetTotal = $ValTotal - $Royaltyfees;
                                                        $NetTotal = number_format($NetTotal, 2, '.', '');
                                                        $NetTotal = number_format($NetTotal, 2, '.', ',');
                                                            
                                                        $totalRevenu=$totalRevenu+$ValTotal;
														$totalRevenu = number_format($totalRevenu, 2, '.', '');
                                                        $totalRevenu=number_format($totalRevenu, 2, '.', ',');
														
                                                        $totalRoyaltyfees=$totalRoyaltyfees+$Royaltyfees;
														$totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', '');
                                                        $totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', ',');
														
                                                        $totalNetProfit=$totalNetProfit+$NetTotal;
														$totalNetProfit = number_format($totalNetProfit, 2, '.', '');
                                                        $totalNetProfit = number_format($totalNetProfit, 2, '.', ',');
                                                        
						   }
                                                    ?>
                                                    <tr>
                                                        <td> <?php echo $i++;?></td>
                                                        <td>
                                                         <?php echo $getAdmindetails['szName'];?>
                                                        </td>
                                                        <td>
                                                           <?php echo $totalRevenu;?>
                                                           
                                                        </td>
                                                        <td>
                                                          <?php echo $totalRoyaltyfees;?>
                                                           
                                                        </td>
                                                        <td>
                                                           <?php echo $totalNetProfit;?>
                                                        </td>
                                                       
                                                 </tr>
                                                
                                                    <?php

                                                }
												


                                                ?>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else
                {
                    echo "<h4>No record found</h4>";
                }
                    }
                ?>

            </div>

        </div>

    </div>

</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>