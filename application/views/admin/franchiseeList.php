   <div class="page-content-wrapper">
        <div class="page-content">
            <?php 
            if(!empty($_SESSION['drugsafe_user_message']))
            {
                    if(trim($_SESSION['drugsafe_user_message']['type']) == "success")
                    {
                    ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                        </div>
                    <?php

                    }
                    if(trim($_SESSION['drugsafe_user_message']['type']) == "error")
                    {
                    ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['drugsafe_user_message']['content'];?>
                        </div>
                    <?php
                    }
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
                            <span class="active">Franchisee List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">franchisee List</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>admin/addFranchisee');">
                                        &nbsp;Add New franchisee
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php
                        if(!empty($franchiseeAray))
                        {
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id.</th>
                                        <th> Name</th>
                                        <th> Email</th>
                                        <th> Contact No </th>
                                        <th> Address </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($franchiseeAray)
                                    {   $i = 0;
                                        foreach($franchiseeAray as $franchiseeData)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td> FR-<?php echo $franchiseeData['id'];?> </td>
                                            <td> <?php echo $franchiseeData['szName']?> </td>
                                            <td> <?php echo $franchiseeData['szEmail'];?> </td>
                                            <td> <?php echo $franchiseeData['szContactNumber'];?> </td>
                                            <td> <?php echo $franchiseeData['szCity'];?> </td>
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userAdd" title="Add Client" onclick="addClientData(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit franchisee Data" onclick="viewUserDetails('<?php echo $franchiseeData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="View Client List" onclick="viewClient(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Franchisee" onclick="franchiseeDelete(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="modelStoclVal" title="Model Stock Value Management" onclick="viewModelStockValMgt(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-cube" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="productStoclMgt" title="Product Stock  Management" onclick="viewProductStockMgt(<?php echo $franchiseeData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                             <?php
                            
                        }
                        else
                        {
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