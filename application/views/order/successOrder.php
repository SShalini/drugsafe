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
                        <span class="active">Order Details</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">
                   
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">
                                    Order Details
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
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet green-meadow box">
                                        <div class="portlet-title">
                                                <div class="caption">
                                                        <i class="fa fa-cogs "></i>Order #
                                                </div>
                                        </div>
                                            <div class="portlet-body">
                                                    <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped">
                                                            <thead>
                                                             <tr>
                                                                    <th>  Image </th>
                                                                    <th>  Product Code</th>
                                                                    <th>  Descreption</th>
                                                                    <th>  Cost</th>
                                                                    <th>  Quantity</th>
                                                                    <th>  Price</th>
                                                                  
                                                             </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                    <td>
                                                                            <a href="javascript:;">
                                                                            Product 1 </a>
                                                                    </td>
                                                                    <td>
                                                                            <span class="label label-sm label-success">
                                                                            Available
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             2
                                                                    </td>
                                                                    <td>
                                                                             2.00$
                                                                    </td>
                                                                    <td>
                                                                             4%
                                                                    </td>
                                                                    <td>
                                                                             0.00$
                                                                    </td>
                                                                    <td>
                                                                             691.00$
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                    <td>
                                                                            <a href="javascript:;">
                                                                            Product 1 </a>
                                                                    </td>
                                                                    <td>
                                                                            <span class="label label-sm label-success">
                                                                            Available
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             2
                                                                    </td>
                                                                    <td>
                                                                             2.00$
                                                                    </td>
                                                                    <td>
                                                                             4%
                                                                    </td>
                                                                    <td>
                                                                             0.00$
                                                                    </td>
                                                                    <td>
                                                                             691.00$
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                    <td>
                                                                            <a href="javascript:;">
                                                                            Product 1 </a>
                                                                    </td>
                                                                    <td>
                                                                            <span class="label label-sm label-success">
                                                                            Available
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             2
                                                                    </td>
                                                                    <td>
                                                                             2.00$
                                                                    </td>
                                                                    <td>
                                                                             4%
                                                                    </td>
                                                                    <td>
                                                                             0.00$
                                                                    </td>
                                                                    <td>
                                                                             691.00$
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                    <td>
                                                                            <a href="javascript:;">
                                                                            Product 1 </a>
                                                                    </td>
                                                                    <td>
                                                                            <span class="label label-sm label-success">
                                                                            Available
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             345.50$
                                                                    </td>
                                                                    <td>
                                                                             2
                                                                    </td>
                                                                    <td>
                                                                             2.00$
                                                                    </td>
                                                                    <td>
                                                                             4%
                                                                    </td>
                                                                    <td>
                                                                             0.00$
                                                                    </td>
                                                                    <td>
                                                                             691.00$
                                                                    </td>
                                                            </tr>
                                                            </tbody>
                                                            </table>
                                                    </div>
                                            </div>
                                    </div>
                                                    </div>
										</div>
										<div class="row">
											<div class="col-md-6">
											</div>
											<div class="col-md-6">
												<div class="well">
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Sub Total:
														</div>
														<div class="col-md-3 value">
															 $1,124.50
														</div>
													</div>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Shipping:
														</div>
														<div class="col-md-3 value">
															 $40.50
														</div>
													</div>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Grand Total:
														</div>
														<div class="col-md-3 value">
															 $1,260.00
														</div>
													</div>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Total Paid:
														</div>
														<div class="col-md-3 value">
															 $1,260.00
														</div>
													</div>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Total Refunded:
														</div>
														<div class="col-md-3 value">
															 $0.00
														</div>
													</div>
													<div class="row static-info align-reverse">
														<div class="col-md-8 name">
															 Total Due:
														</div>
														<div class="col-md-3 value">
															 $1,124.50
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
</div>
<div id="popup_box"></div>