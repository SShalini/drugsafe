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
                            <a href="<?php echo __BASE_URL__;?>/forum/categoriesList">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                       
                        <li>
                            <span class="active">Reply List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Reply List</span>
                            </div>
                            <?php 
                            if($_SESSION['drugsafe_user']['iRole']==1 || $_SESSION['drugsafe_user']['iRole']==5){
                            ?>
                        
                            <?php }?>    
                           
                        </div>
                        <?php
                        
                        if(!empty($replyDataArr)||!empty($cmntDataArr))
                        {
                            
                      
                            ?>
                        
                          <div class="row">
                           <form class="form-horizontal" id="szSearchforumData" action="<?=__BASE_URL__?>/forum/forumList " name="szSearchforumData" method="post">
                          <div class="search col-md-3">
<!--                            <input type="text" name="szSearchProdCode" id="szSearchProdCode" class="form-control input-square-right " placeholder="Product Code" value="--><?//=sanitize_post_field_value($_POST['szSearchProdCode'])?><!--">-->
                              <select class="form-control custom-select" name="szSearchforumTitle" id="szSearchforumTitle" onfocus="remove_formError(this.id,'true')">
                                  <option value="">Forum Title</option>
                                  <?php
                                  foreach($replyDataArr as $replyData)
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
                                       
                                        <th style="width: 180px">Topic</th>
                                        <th style="width: 220px">Comment/Reply</th>
                                       <th style="width: 80px"> Actions </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    if(!empty($cmntDataArr)){
                                     $i = 0;
                                       foreach($cmntDataArr as $cmntData)
                                        {  
                                       
                                          $textwithoutP=str_ireplace('<p>',' ',$cmntData['szCmnt']);
                                           $newtextwithoutP=str_ireplace('</p>',' ',$textwithoutP);  
                                       
                                    
                                        $TopicsArr =$this->Forum_Model->viewTopicListByTopicId($cmntData['idTopic']); 
                                        
//                                        $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$replyData['idReplier']);
                                          
//                                            $splitTimeStamp = explode(" ",$replyData['dtReplyOn']);
//                                            $date1 = $splitTimeStamp[0];
//                                            $time1 = $splitTimeStamp[1];
//                                            $ReplyTime=  date("g:i a", strtotime($time1));
//                                            $date= explode('-', $date1);
//                                            $monthNum  = $date['1'];
//                                            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
//                                            $monthName = $dateObj->format('M'); 
                                        ?>
                                        <tr>
                                          
                                              <td> <?php echo $TopicsArr['szTopicTitle']?> </td>
                                              <?php 
                                                $text = $cmntsArr['szCmnt'];
                                                $newtext = wordwrap($text, 8, "\n", true);
                                                $x =  preg_split('/\s+/', $newtext);
                                               ?>
                                              
                                              
                                              <td><?php echo $x['0']; ?>... <a href="javascript:void(0);" onclick="showComment('<?php echo $newtextwithoutP ;?>');" >Read more</a></td>
                                               <?php 
                                                $reply = $replyData['szReply'];
                                                $replytext = wordwrap($reply,16, "\n", true);
                                                $reply =  preg_split('/\s+/', $replytext);
                                               ?>
<!--                                              <td> <?php echo $reply['0'];?>...<a onclick="showReply('<?php echo $replyData['szReply'];?>');" href="javascript:void(0);">Read more</a></td> </td>-->
<!--                                              <td> <?php echo $franchiseeDetArr1['szName']?> </td>-->
<!--                                              <td> <?php echo  $date['2'];?> <?php echo $monthName;?>  <?php  echo $date['0'];?> at <?php echo $ReplyTime;?></td>-->
                                        
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Approve" onclick="approveComment('<?php echo $cmntData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-check"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="ForumStatus" title="Unapprove" onclick="unapproveReply(<?php echo $cmntData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                      
                                        </tr>
                                        <?php
                                        $i++;
                                        }   
                                    }
                                   if(!empty($replyDataArr)){
                                      $i = 0;
                                      
                                       foreach($replyDataArr as $replyData)
                                        {
                                       
                                        $cmntsArr =$this->Forum_Model->viewCmntListByCmntId($replyData['idCmnt']); 
                                        $TopicsArr =$this->Forum_Model->viewTopicListByTopicId($cmntsArr['idTopic']); 
                                        
                                        $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$replyData['idReplier']);
                                          
                                            $splitTimeStamp = explode(" ",$replyData['dtReplyOn']);
                                            $date1 = $splitTimeStamp[0];
                                            $time1 = $splitTimeStamp[1];
                                            $ReplyTime=  date("g:i a", strtotime($time1));
                                            $date= explode('-', $date1);
                                            $monthNum  = $date['1'];
                                            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                            $monthName = $dateObj->format('M'); 
                                        ?>
                                        <tr>
                                          
                                              <td> <?php echo $TopicsArr['szTopicTitle']?> </td>
                                              <?php 
                                                $text = $cmntsArr['szCmnt'];
                                                $newtext = wordwrap($text, 8, "\n", true);
                                                $x =  preg_split('/\s+/', $newtext);
                                               ?>
<!--                                              <td> <?php echo $x['0']; ?>... <a onclick="showComment('<?php echo $cmntsArr['szCmnt'];?>');" href="javascript:void(0);">Read more</a></td>-->
                                               <?php 
                                                $reply = $replyData['szReply'];
                                                $replytext = wordwrap($reply,16, "\n", true);
                                                $reply =  preg_split('/\s+/', $replytext);
                                               ?>
                                          <td><?php echo $reply['0'];?>...<a onclick="showReply('<?php echo $replyData['szReply'];?>');" href="javascript:void(0);">Read more</a> </td>
<!--                                              <td> <?php echo $franchiseeDetArr1['szName']?> </td>-->
<!--                                              <td> <?php echo  $date['2'];?> <?php echo $monthName;?>  <?php  echo $date['0'];?> at <?php echo $ReplyTime;?></td>-->
                                        
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Approve" onclick="approveReply('<?php echo $replyData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-check"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="ForumStatus" title="Unapprove" onclick="unapproveReply(<?php echo $replyData['id'];?>);" href="javascript:void(0);"></i>
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                      
                                        </tr>
                                        <?php
                                        $i++;
                                        }  
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