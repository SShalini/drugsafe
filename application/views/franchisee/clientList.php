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
                        <a href="<?php echo __BASE_URL__;?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a onclick="viewClient(<?php echo $franchiseeArr['id'];?>);" href="javascript:void(0);"><?php echo $franchiseeArr['szName'];?></a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">Client List</span>
                    </li>
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $franchiseeArr['szName'];?>'s Client List</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">

                                <!--<button class="btn btn-sm green-meadow" onclick="addClientData(<?php /*echo $idfranchisee;*/ ?>);" href="javascript:void(0);">

                                        &nbsp;Add New Client
                                    </button>-->
                            </div>
                        </div>
                    </div>

                    <?php

                    if (!empty($clientAry)) {

                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> Id.</th>
                                    <th> Name</th>
                                    <th> Email</th>
                                    <th> Client Type</th>
                                    <th> Contact No</th>
                                    <th> Created By</th>
                                    <th> Updated By</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                foreach ($clientAry as $clientData) {
                                    ?>
                                    <tr>
                                        <td> CL-<?php echo $clientData['id']; ?> </td>
                                        <td> <?php echo $clientData['szName'] ?> </td>
                                        <td> <?php echo $clientData['szEmail']; ?> </td>
                                        <td>

                                            <?php
                                            if ($clientData['clientType'] == '0') {
                                                echo "Parent";
                                            } else {
                                                echo "Child";
                                            }
                                            ?>

                                        </td>
                                        <td> <?php echo $clientData['szContactNumber']; ?> </td>
                                       
                                        <td><?php echo $franchiseeDataArr[$i]['szName']; ?> </td>
                                        <td><?php echo $updateByDataArr[$i]['szName']; ?> </td>
                                       
                                        <td>
                                            <?php
                                            if ($clientData['clientType'] == '0') { ?>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd"
                                                   title="Add Child Client"
                                                   onclick="addClientData(<?php echo $idfranchisee; ?>,<?php echo $clientData['id']; ?>);"
                                                   href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                            <?php } ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" title="Edit Client Data"
                                               onclick="editClient('<?php echo $clientData['id']; ?>',<?php echo $idfranchisee; ?>);"
                                               href="javascript:void(0);">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="View Client Details"
                                               onclick="viewClientDetails(<?php echo $clientData['id']; ?>);"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-eye" aria-hidden="true"></i>

                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="Delete Client"
                                               onclick="clientDelete(<?php echo $clientData['id']; ?>);"
                                               href="javascript:void(0);"></i>
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

                    } else {
                        echo "Not Found";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="popup_box"></div>