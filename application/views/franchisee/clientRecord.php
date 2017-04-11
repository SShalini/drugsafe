<script type='text/javascript'>
    $(function () {
        $("#szSearchname").customselect();
        $("#szSearchClientname").customselect();
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

                    <?php
                    if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                        ?>

                        <li>
                            <a href="<?php echo __BASE_URL__; ?>/franchisee/clientRecord">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                    <?php } elseif ($_SESSION['drugsafe_user']['iRole'] == '5') { ?>
                        <li>
                            <a href="<?php echo __BASE_URL__; ?>/admin/franchiseeList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <?php
                    } else { ?>
                        <li>
                            <a href="<?php echo __BASE_URL__; ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <?php
                        if (!empty($clientAry)) {


                            $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientAry['0']['franchiseeId']);
                            ?>
                            <li>
                                <a onclick=""
                                   href="javascript:void(0);"><?php echo $franchiseeDetArr1['szName']; ?></a>

                                <i class="fa fa-circle"></i>
                            </li>

                        <?php } ?>
                    <?php } ?>

                    <li>
                        <span class="active">Client Record</span>
                    </li>
                </ul>

                <div class="portlet light bordered">
                    <?php if ($_SESSION['drugsafe_user']['iRole'] == '1') { ?>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-green-meadow"></i>
                                <span class="caption-subject font-green-meadow ">Plese select a Franchisee to display their related clients.</span>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Client Record</span>
                            </div>
                            <?php
                            if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                                ?>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <button class="btn btn-sm green-meadow"
                                                onclick="addClientData('<?php echo $idfranchisee;?>','','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>','2');"
                                                href="javascript:void(0);">
                                            &nbsp;Add New Client
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php
                    if (($_SESSION['drugsafe_user']['iRole'] == '5')||($_SESSION['drugsafe_user']['iRole'] == '1')) {
                        ?>
                        <div class=" search row">
                            <form class="form-horizontal" id="szSearchClientRecord"
                                  action="<?= __BASE_URL__ ?>/franchisee/clientRecord" name="szSearchClientRecord"
                                  method="post">

                                <div class=" col-md-3 clienttypeselect">

                                    <select class="form-control custom-select" name="szSearchClRecord2"
                                            id="szSearchname" onblur="remove_formError(this.id,'true')"
                                            onchange="getClientListByFrId(this.value);">
                                        <option value="">Franchisee Name</option>
                                    
                                        <?php
                                         if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                           $searchOptionArr =$this->Admin_Model->viewFranchiseeList();
                                            }
                                            else{
                                                      $operationManagerId = $_SESSION['drugsafe_user']['id'];
                                                     $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,$operationManagerId);
                                            }
                                        foreach ($searchOptionArr as $searchOptionList) {

                                            $selected = ($searchOptionList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                            echo '<option value="' . $searchOptionList['id'] . '"' . $selected . ' >' . $searchOptionList['szName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class=" col-md-3 clienttypeselect">
                                    <div id='szClient'>
                                        <select class="form-control custom-select" name="szSearchClRecord1"
                                                id="szSearchClientname" onfocus="remove_formError(this.id,'true')">
                                            <option value="">Client Name</option>
                                            <?php
                                            foreach ($clientlistArr as $clientList) {
                                                $selected = ($clientList['szName'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');

                                                echo '<option value="' . $clientList['szName'] . '"' . $selected . ' >' . $clientList['szName'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn green-meadow" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <?php

                        if (!empty($clientAry) || !empty($corpuserDetailsArr)) {
                            ?>
                    
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-red-sunglo"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">Client Record</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th> Client Code</th>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <?php
                                            if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                ?>
                                                <th> Franchisee</th>
                                                <?php

                                            }
                                            ?>

                                            <th> No. of sites</th>
                                            <th> Contact No.</th>
                                            <th> Created By</th>
                                            <th> Updated By</th>
                                            <th> Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if(!empty($clientAry)) {
                                            foreach ($clientAry as $clientData) {
                                                $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($clientData['id']);

                                                ?>
                                                <tr>
                                                    <td> <?php echo(!empty($franchiseecode['userCode']) ? $franchiseecode['userCode'] : 'N/A'); ?> </td>
                                                    <td> <?php echo $clientData['szName']; ?> </td>
                                                    <td> <?php echo $clientData['szEmail']; ?> </td>
                                                    <?php
                                                    if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                        ?>
                                                        <td>
                                                            <?php
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['franchiseeId']);
                                                            echo $franchiseeDetArr['szName'];
                                                            ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td>
                                                        <?php
                                                        $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($clientData['id']);
                                                        echo count($childClientDetailsAray);
                                                        ?>


                                                    </td>
                                                    <td> <?php echo $clientData['szContactNumber']; ?> </td>

                                                    <td>
                                                        <?php
                                                        if ($clientData['szCreatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['szCreatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($clientData['szLastUpdatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['szLastUpdatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        } else {
                                                            echo "N.A";
                                                        }

                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                                                            ?>
                                                            <?php
                                                            if ($clientData['clientType'] == '0') {
                                                                if ($clientData['szNoOfSites'] > count($childClientDetailsAray)) {
                                                                    ?>

                                                                    <a class="btn btn-circle btn-icon-only btn-default"
                                                                       id="userAdd"
                                                                       title="Add Site"
                                                                       onclick="addClientData(<?php echo $clientData['franchiseeId']; ?>,'<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>');"
                                                                       href="javascript:void(0);"></i>
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>

                                                                    </a>
                                                                <?php }
                                                            }
                                                            ?>
                                                            <a class="btn btn-circle btn-icon-only btn-default"
                                                               title="Edit Client Data"
                                                               onclick="editClient('<?php echo $clientData['id']; ?>','<?php echo $clientData['franchiseeId']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>','1');"
                                                               href="javascript:void(0);">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <?php
                                                        } ?>
                                                        <a class="btn btn-circle btn-icon-only btn-default"
                                                           id="userStatus"
                                                           title="View Client Details"
                                                           onclick="viewClientDetails(<?php echo $clientData['id']; ?>,<?php echo $idfranchisee; ?>);"
                                                           href="javascript:void(0);"></i>
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <?php
                                                        if ($_SESSION['drugsafe_user']['iRole'] == '2') {

                                                            ?>
                                                            <a class="btn btn-circle btn-icon-only btn-default"
                                                               id="userStatus"
                                                               title="Delete Client"
                                                               onclick="clientDelete('<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>');"
                                                               href="javascript:void(0);"></i>
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            </a>

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        if(!empty($corpuserDetailsArr)) {
                                            $displyedClient = array();
                                            foreach ($corpuserDetailsArr as $CorpclientData) {
                                                if (!in_array($CorpclientData['id'], $displyedClient)){
                                                    array_push($displyedClient,$CorpclientData['id']);
                                                $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($CorpclientData['id']);
                                                $showdata = true;
                                                if(isset($_POST['szSearchClRecord1']) && !empty($_POST['szSearchClRecord1'])){
                                                    $showdata = false;
                                                    if($_POST['szSearchClRecord1'] == $CorpclientData['szName']){
                                                        $showdata  = true;
                                                    }
                                                }
                                                if($showdata) {
                                                    ?>
                                                    <tr>
                                                        <td> <?php echo(!empty($franchiseecode['userCode']) ? $franchiseecode['userCode'] : 'N/A'); ?> </td>
                                                        <td> <?php echo $CorpclientData['szName']; ?> </td>
                                                        <td> <?php echo $CorpclientData['szEmail']; ?> </td>
                                                        <?php
                                                        if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                            ?>
                                                            <td>
                                                                <?php
                                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['franchiseeId']);
                                                                echo $franchiseeDetArr['szName'];
                                                                ?>
                                                            </td>
                                                            <?php
                                                        }
                                                        ?>

                                                        <td>
                                                            <?php
                                                            $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($CorpclientData['id']);
                                                            echo count($childClientDetailsAray);
                                                            ?>


                                                        </td>
                                                        <td> <?php echo $CorpclientData['szContactNumber']; ?> </td>

                                                        <td>
                                                            <?php
                                                            if ($CorpclientData['szCreatedBy']) {
                                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['szCreatedBy']);
                                                                echo $franchiseeDetArr['szName'];
                                                            }
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($CorpclientData['szLastUpdatedBy']) {
                                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['szLastUpdatedBy']);
                                                                echo $franchiseeDetArr['szName'];
                                                            } else {
                                                                echo "N.A";
                                                            }

                                                            ?>
                                                        </td>

                                                        <td>

                                                            <a class="btn btn-circle btn-icon-only btn-default"
                                                               id="userStatus"
                                                               title="View Client Details"
                                                               onclick="viewClientDetails(<?php echo $CorpclientData['id']; ?>,<?php echo $idfranchisee; ?>,'1');"
                                                               href="javascript:void(0);"></i>
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php

                        } else {
                            echo "Not Found";
                        }


                    } else {

                        if (!empty($clientAry) || !empty($corpuserDetailsArr)) {

                    ?>
                    <div class="row">
                        <form class="form-horizontal" id="szSearchClientRecord"
                              action="<?= __BASE_URL__ ?>/franchisee/clientRecord" name="szSearchClientRecord"
                              method="post">

                            <div class="search col-md-3 clienttypeselect">

                                <select class="form-control custom-select" name="szSearchClRecord1"
                                        id="szSearchname"
                                        onfocus="remove_formError(this.id,'true')">
                                    <option value="">Client Name</option>
                                    <?php
                                    foreach ($clientlistArr as $clientIdList) {
                                        $selected = ($clientIdList['szName'] == $_POST['szSearchClRecord1'] ? 'selected="selected"' : '');
                                        echo '<option value="' . $clientIdList['szName'] . '"' . $selected . ' >' . $clientIdList['szName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <button class="btn green-meadow" type="submit"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>


                    <div id="page_content" class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th> Client Code</th>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <?php
                                            if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                ?>
                                                <th> Franchisee</th>
                                            <?php } ?>

                                            <th> No. of sites</th>
                                            <th> Contact No.</th>
                                            <th> Created By</th>
                                            <th> Updated By</th>
                                            <th> Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($clientAry)){
                                            foreach ($clientAry as $clientData) {
                                                $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($clientData['id']);
                                                $addEditClientDet = false;
                                                if ($clientData['szNoOfSites'] > 0) {
                                                    $addEditClientDet = true;
                                                }
                                                ?>
                                                <tr>
                                                    <td> <?php echo(!empty($franchiseecode['userCode']) ? $franchiseecode['userCode'] : 'N/A'); ?> </td>
                                                    <td> <?php echo $clientData['szName'] ?> </td>
                                                    <td> <?php echo $clientData['szEmail']; ?> </td>
                                                    <?php
                                                    if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                        ?>
                                                        <td>
                                                            <?php
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['franchiseeId']);
                                                            echo $franchiseeDetArr['szName'];
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td>
                                                        <?php
                                                        $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($clientData['id']);
                                                        echo count($childClientDetailsAray);
                                                        ?>


                                                    </td>
                                                    <td> <?php echo $clientData['szContactNumber']; ?> </td>

                                                    <td>
                                                        <?php
                                                        if ($clientData['szCreatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['szCreatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($clientData['szLastUpdatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientData['szLastUpdatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        } else {
                                                            echo "N.A";
                                                        }

                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                                                            ?>
                                                            <?php
                                                            if ($clientData['clientType'] == '0') {
                                                                if (($clientData['szNoOfSites'] > count($childClientDetailsAray)) && $addEditClientDet) {
                                                                    ?>

                                                                    <a class="btn btn-circle btn-icon-only btn-default"
                                                                       id="userAdd"
                                                                       title="Add Site"
                                                                       onclick="addClientData(<?php echo $clientData['franchiseeId']; ?>,'<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>');"
                                                                       href="javascript:void(0);"></i>
                                                                        <i class="fa fa-plus"
                                                                           aria-hidden="true"></i>

                                                                    </a>
                                                                <?php }
                                                            }
                                                            if ($addEditClientDet) {
                                                                ?>

                                                                <a class="btn btn-circle btn-icon-only btn-default"
                                                                   title="Edit Client Data"
                                                                   onclick="editClient('<?php echo $clientData['id']; ?>','<?php echo $clientData['franchiseeId']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>');"
                                                                   href="javascript:void(0);">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            <?php }
                                                        } ?>
                                                        <a class="btn btn-circle btn-icon-only btn-default"
                                                           id="userStatus"
                                                           title="View Client Details"
                                                           onclick="viewClientDetails(<?php echo $clientData['id']; ?>,<?php echo $idfranchisee; ?>);"
                                                           href="javascript:void(0);"></i>
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <?php
                                                        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
                                                            if (empty($childClientDetailsAray)) {
                                                                ?>
                                                                <a class="btn btn-circle btn-icon-only btn-default"
                                                                   id="userStatus"
                                                                   title="Delete Client"
                                                                   onclick="clientDelete('<?php echo $clientData['id']; ?>','<?php echo __URL_FRANCHISEE_CLIENTRECORD__; ?>');"
                                                                   href="javascript:void(0);"></i>
                                                                    <i class="fa fa-trash-o"
                                                                       aria-hidden="true"></i>
                                                                </a>

                                                            <?php }
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        if(!empty($corpuserDetailsArr)) {
                                            $displyedClient = array();
                                            foreach ($corpuserDetailsArr as $CorpclientData) {
                                                if (!in_array($CorpclientData['id'], $displyedClient)){
                                                    array_push($displyedClient,$CorpclientData['id']);
                                                    $franchiseecode = $this->Franchisee_Model->getusercodebyuserid($CorpclientData['id']);
                                                ?>
                                                <tr>
                                                    <td> <?php echo(!empty($franchiseecode['userCode']) ? $franchiseecode['userCode'] : 'N/A'); ?> </td>
                                                    <td> <?php echo $CorpclientData['szName']; ?> </td>
                                                    <td> <?php echo $CorpclientData['szEmail']; ?> </td>
                                                    <?php
                                                    if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                                                        ?>
                                                        <td>
                                                            <?php
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['franchiseeId']);
                                                            echo $franchiseeDetArr['szName'];
                                                            ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>

                                                    <td>
                                                        <?php
                                                        $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($CorpclientData['id']);
                                                        echo count($childClientDetailsAray);
                                                        ?>


                                                    </td>
                                                    <td> <?php echo $CorpclientData['szContactNumber']; ?> </td>

                                                    <td>
                                                        <?php
                                                        if ($CorpclientData['szCreatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['szCreatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($CorpclientData['szLastUpdatedBy']) {
                                                            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $CorpclientData['szLastUpdatedBy']);
                                                            echo $franchiseeDetArr['szName'];
                                                        } else {
                                                            echo "N.A";
                                                        }

                                                        ?>
                                                    </td>

                                                    <td>

                                                        <a class="btn btn-circle btn-icon-only btn-default"
                                                           id="userStatus"
                                                           title="View Client Details"
                                                           onclick="viewClientDetails(<?php echo $CorpclientData['id']; ?>,<?php echo $idfranchisee; ?>,'1');"
                                                           href="javascript:void(0);"></i>
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php

                        } else {
                            echo "Not Found";
                        }
                        ?>
                        </div>
                        </div>
                        <div id="popup_box"></div>
                    <?php } ?>
                    <div class="row">
                        <?php if (!empty($clientAry)) { ?>
                            <div class="col-md-7 col-sm-7">
                                <div class="dataTables_paginate paging_bootstrap_full_number">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>