<script type='text/javascript'>
    $(function() {
        $("#szSearchCtName").customselect();
    });
</script>
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
                            <a href="<?php echo __BASE_URL__;?>/forum/categoriesList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Category List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Category List</span>
                            </div>
                           
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>forum/addCategory');">
                                        &nbsp;Add Category
                                    </button>
                                </div>
                        </div>
                             
                           
                        </div>
                        <?php
                        
                        if(!empty($categoriesAray))
                        {
                           
                            ?>
                        
                          <div class="row">
                           <form class="form-horizontal" id="szSearchCategory" action="<?=__BASE_URL__?>/forum/categoriesList " name="szSearchCategory" method="post">
                          <div class="search col-md-3">
                              <select class="form-control custom-select" name="szSearchCtName" id="szSearchCtName" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Category Name</option>
                                  <?php
                                  foreach($categoriesListAray as $categoriesItem)
                                  {
                                      $selected = ($categoriesItem['szName'] == $_POST['szSearchCtName'] ? 'selected="selected"' : '');
                                      echo '<option value="'.$categoriesItem['szName'].'" >'.$categoriesItem['szName'].'</option>';
                                  }
                                  ?>
                              </select>
                          </div>
                               <div class="col-md-1">
                           <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                               </div>
                           </form>
                          </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id </th>
                                        <th> Category Name</th>
                                        <th> Category Descreption</th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($categoriesAray as $categoriesData)
                                        {  
                                            ?>
                                        <tr>
                                            <td> <?php echo $categoriesData['id']?> </td>
                                            <td> <?php echo $categoriesData['szName'];?> </td>
                                            <td> <?php echo $categoriesData['szDiscription'];?> </td>
                                           
                                          
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Ccategory Details" onclick="editCategory('<?php echo $categoriesData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="drugTestKitStatus" title="Delete Drug-Test Kit Details" onclick="deleteCategoryAlert(<?php echo $categoriesData['id'];?>);" href="javascript:void(0);"></i>
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
                        </div>
                             <?php
                            
                        }
                        else
                        {
                            echo "Not Found";
                        }
                        ?>
                        <?php  if(!empty($categoriesAray)){?>
		<div class="row">
                  
                    <div class="col-md-7 col-sm-7">
                        <div class="dataTables_paginate paging_bootstrap_full_number">
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
	    	
                 
            </div>
    	<?php }?>
                
           
                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div id="popup_box"></div>