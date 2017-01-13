
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
                        <?php $categoriesListAray =$this->Forum_Model->viewCategoriesListByCatId($forumDetailsAry['0']['idCategory']); 
                       ?>
                         <li>
                            <a href="<?php echo __BASE_URL__;?>/forum/forumList"><?php echo $categoriesListAray['szName']; ?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                         <li>
                            <a onclick=""
                               href="javascript:void(0);"><?php echo $forumDetailsAry['0']['szForumTitle']; ?>'s Details</a>
                            
                        </li>
                     
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                              <h2>  <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $forumDetailsAry['0']['szForumTitle']?></span></h2>
                            </div>
                           
                        </div>
                        <?php
                        
                        if(!empty($forumDetailsAry))
                        {
                            ?>
                        
                        
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-hover ">
                                <thead>
                                   
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($forumDetailsAry as $forumDetailsData)
                                        {  
                                       
                                            
                                            ?>
                                        <tr>
                                            <td>
                                                <img class="file_preview_image" src="<?php echo __BASE_USER_PRODUCT_IMAGES_URL__; ?>/<?php echo $forumDetailsData['szforumImage']; ?>" width="60" height="60"/>    
                                            </td>
                                         
                                            <td> <?php echo $forumDetailsData['szForumLongDiscription'];?> </td>
                                     
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
                            echo "";
                        }
                        ?>
          <hr>
           <?php
                        
                        if(!empty($forumTopicDataAry))
                        {
                            ?>
                        
                        
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-hover ">
                                <thead>
                                    <tr>
                                        <th style="width: 300px">Topic</th>
                                        <th style="width: 100px">Status </th>
                                        <th style="width: 100px">Comments </th>
                                        <th style="width: 100px">Action</th>
                              
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($forumTopicDataAry as $forumTopicData)
                                        {  
                                           
                                        $commentsDataArr = count($this->Forum_Model->getAllCommentsByTopicId($forumTopicData['id'])); 
                                            
                                            ?>
                                        <tr>
                                            <td> <?php echo $forumTopicData['szTopicTitle'];?> </td> 
                                            <?php if($forumTopicData['isClosed']==1)
                                            {?>
                                                  <td style="color: #e73d4a">Close</td> 
                                       <?php      }
                                            else{ ?>
                                             <td style="color: #1bbc9b">Open</td>  
                                                   
                                            <?php         }
                                                
                                                
                                                ?>
                                          
                                            <td> <?php echo $commentsDataArr;?> </td> 
                                            <td> <a class="btn btn-circle btn-icon-only btn-default" title="View Topic Details" onclick="viewTopicDetails('<?php echo $forumTopicData['id'];?>','<?php echo $forumTopicData['idForum'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-eye"></i> 
                                             </a>
                                            <?php if($forumTopicData['isClosed']==0 && $forumTopicData['idUser']==$_SESSION['drugsafe_user']['id'] ){ ?>
                                            <a class="btn btn-circle btn-icon-only btn-default" title=" Topic Close" onclick="closeTopic('<?php echo $forumTopicData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-times-circle"></i> 
                                             </a>
                                            <?php }?>   
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
                            echo "";
                        }
                        ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div id="popup_box"></div>