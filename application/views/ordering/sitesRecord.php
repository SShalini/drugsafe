<script type='text/javascript'>
    $(function () {

        $("#szSearchname").customselect();

    });
</script>
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
                    <?php
                    if (!empty($_POST['szSearchClRecord2'])) {
                        $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('', $_POST['szSearchClRecord2']);

                        ?>
                        <li>
                            <a onclick=""
                               href="javascript:void(0);"><?php echo $userDataAry['szName']; ?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Sites Record</span>
                        </li>
                    <?php } else {
                        ?>
                        <li>
                            <span class="active">Select Franchisee</span>
                        </li>
                    <?php } ?>
                </ul>

                <div class="portlet light bordered">


                    <?php
                    if (($_SESSION['drugsafe_user']['iRole'] == '1') || ($_SESSION['drugsafe_user']['iRole'] == '5' )) {
                        if($_SESSION['drugsafe_user']['iRole'] == '5'){
                          $searchOptionArr = $this->Admin_Model->viewFranchiseeList(false,$_SESSION['drugsafe_user']['id']);
                        }else{
                        $searchOptionArr = $this->Admin_Model->viewFranchiseeList(false, false);
                        }
                        ?>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-green-meadow"></i>
                                <span class="caption-subject font-green-meadow ">Plese select a Franchisee to display their related client's sites.</span>
                            </div>
                        </div>
                        <div class="row">
                            <form class="form-horizontal" id="szSearchClientRecord"
                                  action="<?= __BASE_URL__ ?>/ordering/sitesRecord" name="szSearchClientRecord"
                                  method="post">
                                <div class="search col-md-3">
                                    <select class="form-control custom-select" name="szSearchClRecord2"
                                            id="szSearchname"
                                            onfocus="remove_formError(this.id,'true')">
                                        <option value="">Franchisee Name</option>
                                        <?php
                                        foreach ($searchOptionArr as $searchOptionList) {
                                            $selected = ($searchOptionList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                            echo '<option value="' . $searchOptionList['id'] . '"' . $selected . '>' . $searchOptionList['szName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn green-meadow" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                    if (!empty($_POST['szSearchClRecord2'])) { ?>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Proforma Invoices</span>
                            </div>
                        </div>
                        <?php if (!empty($sosRormDetailsAry)) {
                            $i = 0;
                            $j = 0;
                            foreach ($sosRormDetailsAry as $sosRormDetailsData => $sosRormDetailsDataArr) {

                                foreach ($sosRormDetailsDataArr as $sosRormDetailsData) {
                                    $ClirntDetailsDataAry = $this->Franchisee_Model->getParentClientDetailsId($sosRormDetailsData['Clientid']);
                                    $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('', $ClirntDetailsDataAry['clientType']);
                                    $drugtestidArr = explode(',', $sosRormDetailsData['Drugtestid']);
                                    $drugtestArr = implode('', $drugtestidArr);
                                    if(empty($drugtestArr)){
                                      $drugtestArr = '0';  
                                    }
                                    $manualCalcDetails = $this->Ordering_Model->getManualCalculationBySosId($sosRormDetailsData['id']);
                                    if ((!empty($manualCalcDetails) && $_SESSION['drugsafe_user']['iRole'] == '1') || ($_SESSION['drugsafe_user']['iRole'] == '2')) {
                                        if ($j == 0) { ?>
                                            <div class="row tabrow">
                                            <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Proforma Invoice #</th>
                                                <th> Id.</th>
                                                <th> Client Name</th>
                                                <th> Test Date</th>
                                                <th> Service Commenced </th>
                                                <th> Service Concluded </th>
                                                <th> Proforma Invoice Date</th>
                                                <th> Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                        <?php }
                                        ?>
                                        <tr>
                                              <td><?php echo (!empty($manualCalcDetails['id'])?'#'.sprintf(__FORMAT_NUMBER__, $manualCalcDetails['id']):'N/A');?> </td>
                                            <td> CL-<?php echo $sosRormDetailsData['Clientid']; ?> </td>
                                            <td> <?php echo $userDataAry['szName'] ?> </td>
                                            <td> <?php echo date('d/m/Y', strtotime($sosRormDetailsData['testdate']));; ?> </td>
                                            <td> <?php echo $sosRormDetailsData['ServiceCommencedOn']; ?> </td>
                                            <td> <?php echo $sosRormDetailsData['ServiceConcludedOn']; ?> </td>
                                            <td><?php echo ((!empty($manualCalcDetails['dtCreatedOn']) && $manualCalcDetails['dtCreatedOn'] != '0000-00-00') ?date('d/m/Y',strtotime($manualCalcDetails['dtCreatedOn'])):'N/A');?> </td>
                                            <td>

                                                <?php
                                                if (empty($manualCalcDetails) && $_SESSION['drugsafe_user']['iRole'] == '2') {
                                                    ?>
                                                    <a class="btn btn-circle btn-icon-only btn-default"
                                                       id="viewCalcForm" title="generate Form"
                                                       onclick="viewCalcform(<?php echo $sosRormDetailsData['Clientid']; ?>,<?php echo $drugtestArr; ?>,<?php echo $sosRormDetailsData['id']; ?>);"
                                                       href="javascript:void(0);"></i>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    <?php
                                                } else {
                                                    if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                                                        ?>
                                                        <a class="btn btn-circle btn-icon-only btn-default"
                                                           id="editCalcForm" title="Edit Calc Form"
                                                           onclick="editCalcForm(<?php echo $sosRormDetailsData['Clientid']; ?>,<?php echo $drugtestArr; ?>,<?php echo $sosRormDetailsData['id']; ?>,<?php echo $manualCalcDetails['id']; ?>);"
                                                           href="javascript:void(0);"></i>
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <a class="btn btn-circle btn-icon-only btn-default"
                                                       id="viewDetils" title="View Calc Details"
                                                       onclick="viewCalcDetails(<?php echo $sosRormDetailsData['Clientid']; ?>,<?php echo $drugtestArr; ?>,<?php echo $sosRormDetailsData['id']; ?>);"
                                                       href="javascript:void(0);"></i>
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <?php

                                                }
                                                ?>


                                            </td>
                                        </tr>
                                        <?php
                                        $j++;
                                    }
                                }
                                $i++;
                            }

                            ?>
                            </tbody>
                            </table>
                            <?php
                            if ($j == 0 && $_SESSION['drugsafe_user']['iRole'] == '1') {
                                echo "No invoice found";
                            }
                            ?>
                            </div>
                            </div>
                            <?php

                        } else {
                            echo "No invoice found";
                        }
                    }
                    ?>
                    <?php if (!empty($clientAry)) { ?>
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