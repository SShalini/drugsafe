
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
                        <a href="<?php echo __BASE_URL__;?>/ordering/manualcalform">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    
                    <li>
                        <span class="active">Automatic Calculated Result</span>
                    </li>
                </ul>
                
                <div class="portlet light bordered about-text" id="user_info">
                    <?php 
                            $DrugtestidArr  = array_map('intval', str_split($Drugtestid));
                           if(in_array(1, $DrugtestidArr)||in_array(2, $DrugtestidArr)||in_array(3, $DrugtestidArr)){
                           $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($sosid));  
                         ?>    
                      <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                 
                    <?php 
                       echo "Automatic Calculated Result";

                   ?>
                    &nbsp; &nbsp;
     
                </span>
            </div>
            
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php 
                        $Val1=$countDoner*__RRP_1__;
                        $Val2=$countDoner*__RRP_2__;
                        $Val3=$countDoner*__RRP_3__;
                        ?>
                        <div class="col-sm-8 text-info bold">
                            <lable>Total :</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $ValTotal=$Val1+$Val2+$Val3;?> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Royalty fees:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $Royaltyfees=$ValTotal*0.1; ?> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $GST = $ValTotal*0.1; ?> </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Total  before Royalty and Inc GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $TotalbeforeRoyalty=$ValTotal+$Royaltyfees-$GST; ?> </p>
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Total  after royalty and Inc GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $TotalafterRoyalty=$ValTotal+$GST; ?> </p>
                        </div>
                    </div>
                  

                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Net Total after royalty and exl GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $NetTotal =$ValTotal-$Royaltyfees;?></p>
                        </div>
                    </div>
                    
                </div>
              
             </div>
            
        </div>
                           <?php }?>
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                 
                    <?php 
                       echo "Manual Calculations Result";

                   ?>
                    &nbsp; &nbsp;
<!--                    <a class="btn btn-circle btn-icon-only btn-default" title="Edit Manual Cal Data" onclick="editOperationManagerDetails('<?php echo $operationManagerAray['id'];?>','2');" href="javascript:void(0);">
                        <i class="fa fa-pencil"></i> 
                    </a>-->
                </span>
            </div>
            
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Total Other Trevenu Streams:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php 
                            $mobileScreen = $data['mobileScreenBasePrice']*$data['mobileScreenHr'];
                            $travel = $data['travelBasePrice']*$data['travelHr'];
                           echo $TotalTrevenu = $data['urineNata']+$data['nataLabCnfrm']+$data['oralFluidNata']+$data['SyntheticCannabinoids']+$data['labScrenning']+$data['RtwScrenning']+$mobileScreen+$travel;
                            ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Royalty fees:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $Royaltyfees = ( $TotalTrevenu*0.1);
                                    ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php 
                           echo $GST=($TotalTrevenu*0.1);
                            ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Total  before Royalty and Inc GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php
                           echo $Total1=  $TotalTrevenu+$GST;
                             ?></p>
                        </div>
                    </div>
               
             
                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Total  after royalty and Inc GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php 
                         echo $Total2=  $TotalTrevenu-$Royaltyfees+$GST;
                            ?></p>
                        </div>
                    </div>
                  

                    <div class="row">
                        <div class="col-sm-8 text-info bold">
                            <lable>Net Total after royalty and exl GST:</lable>
                        </div>
                        <div class="col-sm-2">
                            <p>$<?php echo $Total1-$Total2;?></p>
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