<div class="page-content-wrapper">
        <div class="page-content">
             <?php
            if(!empty($_SESSION['drugsafe_user_message'])){
                if(trim($_SESSION['drugsafe_user_message']['type']) == "success"){
                    ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                    </div>
                <?php }
                if(trim($_SESSION['drugsafe_user_message']['type']) == "error") {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                    </div>
                <?php }
                $this->session->unset_userdata('drugsafe_user_message');
            }
            ?>
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                            <i class="fa fa-circle"></i>
                        </li>

                        <?php if($clientDetailsAray['clientType'] > '0'){?>
                            <li>
                                <a onclick="viewClientDetails(<?php echo $ParentOfChild['id'];?>);" href="javascript:void(0);"><?php echo $ParentOfChild['szName'];?></a>
                                <i class="fa fa-circle"></i>
                            </li>
                        <?php } ?>
                        <li>
                            <a onclick="viewClientDetails(<?php echo $clientDetailsAray['id'];?>);" href="javascript:void(0);"><?php echo $clientDetailsAray['szName'];?></a>
                        </li>
                        <?php if($clientDetailsAray['clientType'] == '0'){?>
                            <li>
                                <i class="fa fa-circle"></i>
                                <span class="active">Sites</span>
                            </li>
                        <?php } ?>
                    </ul>
     <div class="portlet light bordered about-text" id="user_info">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                 
                    <?php 
                    /*if($clientDetailsAray['clientType']=='0')
                    {
                        echo $clientDetailsAray['szName']."'s Headquarters";
                    }
                    else
                    {*/
                       echo $clientDetailsAray['szName']."'s Details";
//                    }
                   ?>
                    &nbsp; &nbsp;
                  <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $clientDetailsAray['id'];?>','<?php echo $clientDetailsAray['franchiseeId'];?>','1');" href="javascript:void(0);">
                    <i class="fa fa-pencil"></i> 
                  </a>  
                </span>
            </div>
            <!--<div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php /*echo base_url();*/?>franchisee/clientList');">
                        &nbsp;Client List
                    </button>
                </div>
            </div>-->
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Name:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szName'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Contact No:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szContactNumber'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>City:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szCity'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Country:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szCountry'];?></p>
                        </div>
                    </div>
                    <?php
                    if($clientDetailsAray['clientType']=='0')
                    {
                        ?>
                        <div class="row">
                            <div class="col-sm-4 text-info bold">
                                <lable>Total No of Child:</lable>
                            </div>
                            <div class="col-sm-8">
                                <p><?php
                                    $count='0';
                                    if($childClientDetailsAray)
                                    {
                                        $count=count($childClientDetailsAray);
                                    }
                                    echo $count;
                                    ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Email Id:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szEmail'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Address:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szAddress'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>State:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szState'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ZIP/Postal Code:</lable>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $clientDetailsAray['szZipCode'];?></p>
                        </div>
                    </div>
                </div> 
             </div>
        </div>
     </div>
    <?php
     if($clientDetailsAray['clientType']=='0')
    {
         ?>           
       <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">SITES</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <button class="btn btn-sm green-meadow" onclick="addClientData(<?php echo $franchiseeArr['id']; ?>,<?php echo $clientDetailsAray['id']; ?>,'1');">
                        &nbsp;Add Site
                    </button>
                </div>
            </div>
            
        </div>
        <div class="portlet-body">
            <?php        
            if($childClientDetailsAray)
            {
            ?>
                <div class="table-responsive">
                   <table id="sample_1" class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" role="grid" aria-describedby="sample_1_info">
                        <thead>
                            <tr>
                                <th> Id </th>
				<th> Name </th>
                                <th> Email </th>
                                <th>Contact No</th>
                                <th> Created By</th>
                                <th> Updated By</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                       $i = 0;
                                        foreach($childClientDetailsAray as $childClientDetailsData)
                                        {
                                           
                                        ?>
                                        <tr>
                                            <td> CL-<?php echo $childClientDetailsData['id'];?> </td>
                                            <td> <?php echo $childClientDetailsData['szName']?> </td>
                                            <td> <?php echo $childClientDetailsData['szEmail'];?> </td>
                                             <td> <?php echo $childClientDetailsData['szContactNumber'];?> </td>
                                             <td><?php echo $franchiseeDataArr[$i]['szName']; ?> </td>
                                             <td><?php echo $updateByDataArr[$i]['szName']; ?> </td>
                                               <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data" onclick="editClient('<?php echo $childClientDetailsData['id'];?>',<?php echo $childClientDetailsData['franchiseeId'];?>,'1');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Client Details" onclick="viewClientDetails(<?php echo $childClientDetailsData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Client" onclick="clientDelete(<?php echo $childClientDetailsData['id'];?>);" href="javascript:void(0);"></i>
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
            ?>
                <p>No Client Found.</p>
            <?php
            }
            ?>
        </div>
    </div>           
          <?php   
    }
    ?>    
</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>