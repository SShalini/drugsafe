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
                        <a href="<?php echo __BASE_URL__; ?>/ordering/sitesRecord">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Automatic Calculated Details</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">
                    <?php
                   
                    $DrugtestidArr = array_map('intval', str_split($Drugtestid));
                    
                    if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                        $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($sosid));

                        ?>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">
                                    Automatic Calculated Result
                                </span>
                            </div>
                             <div class="actions">
                                <a onclick="calcDetailspdf('<?php echo $idsite;?>','<?php echo $Drugtestid;?>','<?php echo $sosid;?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                <i class="fa fa-file-pdf-o"></i> View Pdf </a>
                                
                                 <a onclick="backSiteRecord('<?php echo $freanchId;?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                Back </a>
                            </div>
                         

                        </div>
                        <div class="portlet-body alert">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php
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
                                        /*$Val1=$countDoner*__RRP_1__;
                                              $Val2=$countDoner*__RRP_2__;
                                              $Val3=$countDoner*__RRP_3__;*/
                                        //echo $Val1.'---'.$Val2.'---'.$Val3.'---'.$countDoner;
                                        ?>
                                        <div class="col-sm-8 text-info bold">
                                            <lable>Total :</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php //$ValTotal=$Val1+$Val2+$Val3;
                                                echo number_format($ValTotal, 2, '.', ','); ?> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 text-info bold">
                                            <lable>Royalty fees:</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php $Royaltyfees = $ValTotal * 0.1;
                                                $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                                                echo number_format($Royaltyfees, 2, '.', ',');?> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 text-info bold">
                                            <lable>GST:</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php $GST = $ValTotal * 0.1;
                                                $GST = number_format($GST, 2, '.', '');
                                                echo number_format($GST, 2, '.', ',');?> </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 text-info bold">
                                            <lable>Total before Royalty and Inc GST:</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php $TotalbeforeRoyalty = $ValTotal + $GST;
                                                $TotalbeforeRoyalty = number_format($TotalbeforeRoyalty, 2, '.', '');
                                                echo number_format($TotalbeforeRoyalty, 2, '.', ',');?> </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 text-info bold">
                                            <lable>Total after royalty and Inc GST:</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php $TotalafterRoyalty = $ValTotal - $Royaltyfees + $GST;
                                               $TotalafterRoyalty = number_format($TotalafterRoyalty, 2, '.', '');
                                                echo number_format($TotalafterRoyalty, 2, '.', ',');?> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 text-info bold">
                                            <lable>Net Total after royalty and exl GST:</lable>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>$<?php $NetTotal = $ValTotal - $Royaltyfees;
                                                $NetTotal = number_format($NetTotal, 2, '.', '');
                                                echo number_format($NetTotal, 2, '.', ',');?></p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    <?php } ?>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                    Manual Calculations Result
                             </span>
                        </div>

                    </div>
                    <div class="portlet-body alert">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total "Other Trevenu Streams:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $mobileScreen = $data['mobileScreenBasePrice'] * $data['mobileScreenHr'];

                                            $travel = $data['travelBasePrice'] * $data['travelHr'];

                                            $TotalTrevenu = $data['urineNata'] + $data['nataLabCnfrm'] + $data['oralFluidNata'] + $data['SyntheticCannabinoids'] + $data['labScrenning'] + $data['RtwScrenning'] + $mobileScreen + $travel;


                                            $TotalTrevenu = number_format($TotalTrevenu, 2, '.', '');
                                            echo number_format($TotalTrevenu, 2, '.', ',');?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Royalty fees:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php $RoyaltyfeesManual = ($TotalTrevenu * 0.1);
                                            $RoyaltyfeesManual=  number_format($RoyaltyfeesManual, 2, '.', '');
                                            echo number_format($RoyaltyfeesManual, 2, '.', ',');?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $GSTmanual = ($TotalTrevenu * 0.1);
                                            $GSTmanual = number_format($GSTmanual, 2, '.', '');
                                            echo number_format($GSTmanual, 2, '.', ',');?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total before Royalty and Inc GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $Total1 = $TotalTrevenu + $GSTmanual;
                                            $Total1 = number_format($Total1, 2, '.', '');
                                            echo number_format($Total1, 2, '.', ',');?></p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total after royalty and Inc GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $Total2 = $TotalTrevenu - $RoyaltyfeesManual + $GSTmanual;
                                            $Total2 = number_format($Total2, 2, '.', '');
                                            echo number_format($Total2, 2, '.', ',');?></p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Net Total after royalty and exl GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php echo number_format($TotalTrevenu - $GSTmanual, 2, '.', ','); ?></p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                Proforma Invoice Totals
                            </span>
                        </div>

                    </div>
                    <div class="portlet-body alert">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total Invoice amount:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $totalinvoiceAmt = $ValTotal + $TotalTrevenu;
                                            echo number_format($totalinvoiceAmt, 2, '.', ','); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total Royalty fees:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $totalRoyalty = $Royaltyfees + $RoyaltyfeesManual;
                                            echo number_format($totalRoyalty, 2, '.', ','); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $totalGst = $GST + $GSTmanual;
                                            echo number_format($totalGst, 2, '.', ','); ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total before Royalty and Inc GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $totalRoyaltyBefore = $Total1 + $TotalbeforeRoyalty;
                                            echo number_format($totalRoyaltyBefore, 2, '.', ','); ?></p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Total after royalty and Inc GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php
                                            $totalRoyaltyAfter = $Total2 + $TotalafterRoyalty;
                                            echo number_format($totalRoyaltyAfter, 2, '.', ','); ?></p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8 text-info bold">
                                        <lable>Net Total after royalty and exl GST:</lable>
                                    </div>
                                    <div class="col-sm-2">
                                        <p>$<?php echo number_format($totalinvoiceAmt - $totalGst, 2, '.', ','); ?></p>
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