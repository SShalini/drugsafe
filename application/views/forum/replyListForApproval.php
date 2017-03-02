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
                        <div class="alert alert-success">
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
                            <span class="active">Comment/Reply List</span>
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Comment/Reply List</span>
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
                                      
                                        $TopicsArr =$this->Forum_Model->viewTopicListByTopicId($cmntData['idTopic']); 

                                        ?>
                                        <tr>
                                          
                                              <td> <?php echo $TopicsArr['szTopicTitle']?> </td>
                                              <?php

                                              $retval = $cmntData['szCmnt'];
                                              $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $cmntData['szCmnt']);
                                              $string = str_replace("\n", " ", $string);
                                              $array = explode(" ", $string);
                                              if (count($array)<=15)
                                              {
                                                  $retval = $string;
                                              }
                                              else
                                              {
                                                  array_splice($array, 15);
                                                  $retval = implode(" ", $array)." ...";
                                                  $retval .= '<a onclick="showComment('.$cmntData['id'].');" href="javascript:void(0);" >Read more</a>';
                                              }
                                               ?>
                                            
                                              
                                              <td><?php echo $retval;  ?></td>
                                         
                                                <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Approve" onclick="approveComment('<?php echo $cmntData['id'];?>');" href="javascript:void(0);">
                                                    <i class="fa fa-check"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" id="ForumStatus" title="Unapprove" onclick="unapproveComment(<?php echo $cmntData['id'];?>);" href="javascript:void(0);"></i>
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
                                        
                                       
                                        ?>
                                        <tr>
                                          
                                              <td> <?php echo $TopicsArr['szTopicTitle']?> </td>
                                             

                                           <?php
                                           $replytext = $replyData['szReply'];
                                           $replystring = preg_replace('/(?<=\S,)(?=\S)/', ' ', $replyData['szReply']);
                                           $replystring = str_replace("\n", " ", $replystring);
                                           $arrayrep = explode(" ", $replystring);
                                           if (count($arrayrep)<=15)
                                           {
                                               $replytext = $replystring;
                                           }
                                           else
                                           {
                                               array_splice($arrayrep, 15);
                                               $replytext = implode(" ", $arrayrep)." ...";
                                               $replytext .= '<a onclick="showReply('.$replyData['id'].');" href="javascript:void(0);" >Read more</a>';
                                           }
                                               ?>
                                            
                                              
                                              <td><?php echo $replytext;  ?></td>
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
   
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div id="popup_box"></div>