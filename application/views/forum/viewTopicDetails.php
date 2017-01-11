
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

                        <?php
                        
                        if(!empty($forumTopicDataAry))
                        {
                          $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $forumTopicDataAry['0']['idUser']);
                          $forumDataArr = $this->Forum_Model->getForumDetailsById($idForum);
                         
                            ?>
                  <!-- somewhere deep start -->
     <div class="row">
    <div class="center-block col-md-16 Forum">
       
    <h4><i class="icon-equalizer "> </i>  <?php echo $forumDataArr['szForumTitle'];?></h4>
    </div>
  </div>

  <!-- somewhere deep end -->      
                        
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-hover ">
                                <thead>
                                    <tr>
                                       <th style="color:#1bbc9b" ><h3> <?php echo $forumTopicDataAry['0']['szTopicTitle']?></h3> </th>
                               
                              
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($forumTopicDataAry as $forumTopicData)
                                        {  
                                         
                                            
                                            ?>
                                        <tr>
                                            
                                            <td> <?php echo $forumTopicData['szTopicDescreption'];?> </td>
                                     
                                        </tr>
                                        <?php
                                        $i++;
                                        }
                                   ?>
                                        
                                </tbody>
                            </table>
                             </div>
                        </div>
  <p><?php echo $franchiseeDetArr1['szName']?></p>
                             <?php
                            
                        }
                        else
                        {
                            echo "";
                        }
                        ?>
        <hr style="border-top: dotted 1px;" />
        <!-- somewhere deep start -->
  <div class="row">
    <div class="center-block col-md-16 Reply">
     <i class="fa fa-comments"></i>  Comments
    </div>
  </div>
  <!-- somewhere deep end -->
  <?php   $commentsDataArr = $this->Forum_Model->getAllCommentsByTopicId($forumTopicDataAry['0']['id']); ?>
  <?php if(!empty($commentsDataArr)){?>
 
            
<div class="tab-content">

        <!-- TASK COMMENTS -->
        <div class="form-group">
                <div class="col-md-12">
                        <ul class="media-list">
                                
                                 <?php
                          
                   $i = 0;
                    foreach($commentsDataArr as $commentsData)
                    {
                     
              $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$commentsData['idCmnters']);
              $szImage = __BASE_IMAGES_URL__."/default_profile_image.jpg";
                        ?>
                        <li class="media">
                                        <a class="pull-left" href="javascript:;">
                                        <img class="todo-userpic"  src="<?php echo $szImage;?>" width="27px" height="27px">
                                        </a>
                                        <div class="media-body todo-comment">
                                            <?php if( $forumTopicDataAry['0']['isClosed']==0){?>
                                             <div class="dropdown">
                                                <button class="todo-comment-btn btn btn-circle btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                  <li><a onclick="replyToCmntsAlert(<?php echo $commentsData['id'];?>);" href="javascript:void(0);">&nbsp; Reply &nbsp;</a></li>
                                                  <li><a onclick="replyToCmntsAlert(<?php echo $commentsData['id'];?>);" href="javascript:void(0);">&nbsp; Edit &nbsp;</a></li>
                                                  <li><a onclick="cmntDelete(<?php echo $commentsData['id'];?>);" href="javascript:void(0);">&nbsp; Delete &nbsp;</a></li>
                                                </ul>
                                              </div> 
                                            <?php }?>
                                            
                                                <p class="todo-comment-head">
                                                        <span class="todo-comment-username"><?php echo $franchiseeDetArr1['szName']?></span> &nbsp; <span class="todo-comment-date">18 Sep 2014 at 9:22am</span>
                                                </p>
                                                <p class="todo-text-color">
                                                         <?php echo $commentsData['szCmnt'] ?> <br>
                                                </p>
                                                 <!-- Nested media object -->
                                                   <?php
                                                    $replyDataArr = $this->Forum_Model->getAllReplyByCmntsId($commentsData['id']); 
                                                          $i = 0;
                                                         foreach($replyDataArr as $replyData)
                                                          { 
                                                            
                                                             $splitTimeStamp = explode(" ",$replyData['dtReplyOn']);
                                                             $date1 = $splitTimeStamp[0];
                                                            $time1 = $splitTimeStamp[1];
                                                           
                                                          $date= explode('-', $date1);
                                                          $time=  explode(':', $time1);
                                                          
                                                          $monthNum  = $date['1'];
                                                         
                                                          $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                                          $monthName = $dateObj->format('M'); // March
                                                         
                                                            $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$replyData['idReplier']);
                                                           ?>
                                                 <div class="media">
                                                       
                                                        <div class="media-body">
                                                            
                                                               <div class="row">
                                                                    <div class="col-md-4 todo-comment-head">
                                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="todo-comment-username"><b style="color: #1bbc9b"><?php echo $franchiseeDetArr1['szName']?></b> </span> &nbsp; <span class="todo-comment-date"><?php echo $date['2'];?> <?php echo $monthName;?>  <?php  echo $date['0'];?> at 4:30pm</span>
<!--                                                              <button class="todo-comment-btn btn btn-circle btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                              <span class="caret"></span></button>-->
                                                                 </div>  
                                                                     <?php if( $forumTopicDataAry['0']['isClosed']==0){?>
                                                            <div class="dropdown col-md-3">
                                                              <button class="todo-comment-btn btn btn-circle btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                                <span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                           
                                                            <li><a onclick="replyToCmntsAlert(<?php echo $commentsData['id'];?>);" href="javascript:void(0);">&nbsp; Edit &nbsp;</a></li>
                                                            <li><a onclick="replyDelete(<?php echo $replyData['id'];?>);" href="javascript:void(0);">&nbsp; Delete &nbsp;</a></li>
                                                          </ul>
                                                        </div> 
                                                                     <?php }?>
                                                               
                                                                   </div>
                                                            <div class="row">
                                                                <p class="todo-text-color">
                                                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $replyData['szReply'] ?>
                                                                </p>
                                                                </div>
                                                        </div>
                                                </div>
                                                          <?php }?>
                                        </div>
                                </li>
                               
                                  <?php
                    $i++;
                    }
               ?>
                        </ul>
                </div>
        </div>
        <!-- END TASK COMMENTS -->
      
</div>
   <?php } else {
    echo "";
 } ?>
    <?php if( $forumTopicDataAry['0']['isClosed']==0){?>
   <div class="row reply-editor">
    <form class="form-horizontal" id="replyData" action="<?=__BASE_URL__?>/forum/viewTopicDetails " name="replyData" method="post">
   <div class="form-group <?php if(form_error('replyData[szForumLongDiscription]')){?>has-error<?php }?>">
   
    <div class="col-md-12">
      <div class="input-group">

<textarea  name="replyData[szForumLongDiscription]" id="szForumLongDiscription" class="form-control"  value=""  rows="5" placeholder="Long Description" onfocus="remove_formError(this.id,'true')" ><?php echo set_value('replyData[szForumLongDiscription]'); ?></textarea>

</div> 
          <?php
if(form_error('replyData[szForumLongDiscription]')){?>
<span class="help-block pull-left"><span><?php echo form_error('replyData[szForumLongDiscription]');?></span>
</span><?php }?>

      </div>

  </div>
        <div class="col-md-1">
   <input type="submit" class="btn green-meadow" value="SAVE" name="replyData[submit]">
        </div>
    </form>
   </div>
    <?php }?>
         
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div><script>
CKEDITOR.replace( 'szForumLongDiscription' );
$(document).ready(function() {
   CKEDITOR.config.removePlugins = 'Save,Print,Preview,Find,About,Maximize,ShowBlocks,Bold';
});
</script>
<div id="popup_box"></div>
