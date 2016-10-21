<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
     <div class="portlet light bordered about-text" id="user_info">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">
                    <?php 
                    if($clientDetailsAray['clientType']=='0')
                    {
                        echo "Headquarters";
                    }
                    else
                    {
                       echo "Details";
                    }
                   ?>
                    
                </span>
            </div>
        </div>
        <div class="portlet-body alert">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Address</lable>
                        </div>
                        <div class="col-sm-8">
                          <p><?php echo $clientDetailsAray['szAddress'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>ZIP/Postal Code</lable>
                        </div>
                        <div class="col-sm-8">
                         <p><?php echo $clientDetailsAray['szZipCode'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>City</lable>
                        </div>
                        <div class="col-sm-8">
                           <p><?php echo $clientDetailsAray['szCity'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>State</lable>
                        </div>
                        <div class="col-sm-8">
                          <p><?php echo $clientDetailsAray['szState'];?></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4 text-info bold">
                            <lable>Country</lable>
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
                            <lable>Total No of Child</lable>
                        </div>
                        <div class="col-sm-8">
                          <p><?php 
                          if($childClientDetailsAray)
                          {
                               echo count($childClientDetailsAray); 
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
    <?php
     if($clientDetailsAray['clientType']=='0')
    {
         ?>
                    
                    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Child Client</span>
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
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                       $i = 0;
                                        foreach($childClientDetailsAray as $childClientDetailsData)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td> CL-<?php echo $childClientDetailsData['id'];?> </td>
                                            <td> <?php echo $childClientDetailsData['szName']?> </td>
                                            <td> <?php echo $childClientDetailsData['szEmail'];?> </td>
                                             <td> <?php echo $childClientDetailsData['szContactNumber'];?> </td>
                                            
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
<div id="popup"></div>
