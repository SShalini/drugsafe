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
                        <span class="active">Tax Invoice</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">
                   
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">
                                  Services Provided
                                </span>
                            </div>
                             <div class="actions">
                                <a onclick="taxInvoicepdf()" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                <i class="fa fa-file-pdf-o"></i> View Pdf </a>
                                
                                 <a onclick="backSiteRecord('<?php echo $freanchId;?>')" href="javascript:void(0);" 
                                   class=" btn green-meadow">
                                Back </a>
                            </div>
                         

                        </div>

                   <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                     <tr>
                                        <th>System Calculation</th>
                                        <th>No of Donors</th>
                                        <th>RRP</th>
                                        <th>$ Value </th>
                                     </tr>
                                </thead>
                                <tbody>
                                   
                                        <tr>
                                            <td>URINE AS/NZA 4308/2001</td>
                                            <td>1</td>
                                            <td>$75.00</td>
                                            
                                            <td>$75.00 </td>
                                      
                                            
                                        </tr>
                                       
                                </tbody>
                            </table>
                        </div>
                      <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Base Price </th>
                                        <th>No of Hours</th>
                                        <th>$ Value </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        <tr>
                                            <td>Single Field Collection Officer (FCO)</td>
                                            <td>$25.00</td>
                                            <td>5</td>
                                            <td> $125.00 </td>
                                        </tr>
                                         <tr>
                                            <td>Mobile Clinic</td>
                                            <td>$5.00</td>
                                            <td>5</td>
                                            
                                            <td> $25.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                            <td>Call Out (including an alcohol & drug screen)</td>
                                            <td>$5.00</td>
                                            <td>5</td>
                                            
                                            <td> $25.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                            <td>Drug-Safe Communities mobile clinic screening</td>
                                            <td>$5.00</td>
                                            <td>5</td>
                                            <td> $12.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                            <td>Travel – When > 100 km return trip from DSC base</td>
                                            <td>$5.00</td>
                                            <td>5</td>
                                            
                                            <td> $25.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                              <td colspan="3">Synthetic Cannabinoids screening</td>
                                            
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                              <td colspan="3">Urine NATA Laboratory screening</td>   
                                            <td> $55.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                             <td colspan="3">NATA Laboratory confirmation</td>
                                          
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                             <td colspan="3">Oral Fluid NATA Laboratory confirmation</td>
                                         
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                             <td colspan="3">Synthetic Cannabinoids or Designer Drugs, per sample. - Laboratory screening</td>
                                         
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                             <td colspan="3">Synthetic Cannabinoids or Designer Drugs, per sample. - Laboratory confirmation</td>
                                         
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                              <td colspan="3">Return to work (RTW) screening</td>
                                         
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                         <tr>
                                             <td colspan="3">Cancellation Fee</td>
                                            
                                            <td> $5.00 </td>
                                      
                                            
                                        </tr>
                                       
                                </tbody>
                            </table>
                        </div>
<!--test cmmit-->
                      <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              
                                <tbody>
                                   
                                        <tr>
                                             <th width="900 px;">Discounts</th>
                                            <td>$26.95</td>
                                      
                                        </tr>
                                        <tr>
                                             <th width="900 px;">Sub Total (Exc GST)</th>
                                             <td>$358.05</td>
                                      
                                        </tr>
                                        <tr>
                                          <th width="900 px;">GST</th>
                                           <td>$35.81</td>
                                       
                                        </tr>
                                        <tr>
                                            <th width="900 px;">Invoice Amount (INC GST)</th>
                                            <td>$393.86</td>
                                      
                                        </tr>
                                       
                                </tbody>
                            </table>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>