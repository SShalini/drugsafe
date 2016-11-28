<div class="page-content-wrapper">
    <div class="page-content">

        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo __BASE_URL__; ?>/reporting/allstockreqlist">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                    <li>
                        <span class="active">All Stock Request List</span>
                    </li>
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">All Stock Request List</span>
                        </div>
                        <?php
                        if (!empty($allReqQtyAray)) {

                            ?>

                            <div class="actions">
                                <a href="<?php echo __BASE_URL__;?>/reporting/pdfstockreqlist" target="_blank" class=" btn green-meadow">
                                <i class="fa fa-eye"></i> View Pdf </a>
                                <!--<a href="<?php /*echo __BASE_URL__;*/?>/reporting/excelstockreqlist" target="_blank" class=" btn green-meadow">
                                <i class="fa fa-eye"></i> View Xls </a>-->
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                    <?php

                    if (!empty($allReqQtyAray)) {

                        ?>
                        <div class="row">
                            <form class="form-horizontal" id="szSearchQtyReqList"
                                  action="<?= __BASE_URL__ ?>/reporting/allstockreqlist " name="szSearchQtyReqList"
                                  method="post">
                                <div class="search col-md-3">
                                    <input type="text" name="szSearchQtyReqList" id="szSearchQtyReqList"
                                           class="form-control input-square-right "
                                           placeholder="Id,Franchisee,Product Code"
                                           value="<?= sanitize_post_field_value($_POST['szSearchQtyReqList']) ?>">

                                </div>
                                <button class="btn green-meadow" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>

                                        <th> Id</th>
                                        <th> Franchisee</th>
                                        <th> Product Code</th>
                                        <th> Quantity Request</th>
                                        <th> Requested On</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($allReqQtyAray) {
                                        $i = 0;

                                        foreach ($allReqQtyAray as $allReqQtyData) {
                                            ?>
                                            <tr>
                                                <td> FR-<?php echo $allReqQtyData['iFranchiseeId']; ?> </td>
                                                <td> <?php echo $allReqQtyData['szName'] ?> </td>
                                                <td> <?php echo $allReqQtyData['szProductCode']; ?> </td>
                                                <td> <?php echo $allReqQtyData['szQuantity']; ?> </td>
                                                <td> <?php echo date('d/m/Y h:i:s A', strtotime($allReqQtyData['dtRequestedOn'])) ?>  </td>


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
                    } else {
                        echo "Not Found";
                    }
                    ?>
                    <?php if (!empty($allReqQtyAray)) { ?>
                        <div class="row">

                            <div class="col-md-7 col-sm-7">
                                <div class="dataTables_paginate paging_bootstrap_full_number">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>


                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>