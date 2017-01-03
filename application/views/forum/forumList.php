<script type='text/javascript'>
    $(function() {
        $("#szSearchforumTitle").customselect();
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
                            <a href="<?php echo __BASE_URL__;?>/forum/forumList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Forum List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Forum List</span>
                            </div>
                            <?php 
                            if($_SESSION['drugsafe_user']['iRole']==1 || $_SESSION['drugsafe_user']['iRole']==5){
                            ?>
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>forum/addforum');">
                                        &nbsp;Add Forum
                                    </button>
                                </div>
                        </div>
                            <?php }?>    
                           
                        </div>
                        <?php
                        
                        if(!empty($forumDataAray))
                        {
                       
                            ?>
                        
                          <div class="row">
                           <form class="form-horizontal" id="szSearchforumData" action="<?=__BASE_URL__?>/forum/forumList " name="szSearchforumData" method="post">
                          <div class="search col-md-3">
<!--                            <input type="text" name="szSearchProdCode" id="szSearchProdCode" class="form-control input-square-right " placeholder="Product Code" value="--><?//=sanitize_post_field_value($_POST['szSearchProdCode'])?><!--">-->
                              <select class="form-control custom-select" name="szSearchforumTitle" id="szSearchforumTitle" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Forum Title</option>
                                  <?php
                                  foreach($forumDataSearchAray as $forumDataSearchList)
                                  {
                                      $selected = ($forumDataSearchList['szForumTitle'] == $_POST['szSearchforumTitle'] ? 'selected="selected"' : '');
                                      echo '<option value="'.$forumDataSearchList['szForumTitle'].'" >'.$forumDataSearchList['szForumTitle'].'</option>';
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
                                        <th> Image </th>
                                        <th> Forum Title</th>
                                        <th> Short Descreption </th>
                                        <th> Long Descreption </th>
                                        
                                       
                                        <th> Actions </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($forumDataAray as $forumDataData)
                                        {  
                                          
                                          
                                            
                                            ?>
                                        <tr>
                                            <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $forumDataData['szforumImage']; ?>" width="60" height="60"/>    
                                            </td>
                                            <td> <?php echo $forumDataData['szForumTitle']?> </td>
                                            <td> <?php echo $forumDataData['szForumDiscription'];?> </td>
                                            <td><?php echo $forumDataData['szForumLongDiscription'];?> </td>
                                           
                                          
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Forum Details" onclick="editForum('<?php echo $forumDataData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="ForumStatus" title="Delete Forum Details " onclick="forumDeleteAlert(<?php echo $forumDataData['id'];?>);" href="javascript:void(0);"></i>
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
                        <?php  if(!empty($forumDataAray)){?>
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