<?php
if($mode == '__DELETE_FRANCHISEE_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Franchisee Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Deleting this franchisee record will delete all the client records (main client and site records) associated with this client ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteFranchiseeConfirmation('<?php echo $idfranchisee;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_FRANCHISEE_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Franchisee</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Franchisee has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/admin/franchiseeList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__DELETE_CLIENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Client Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Client?</p>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteClientConfirmation('<?php echo $idClient;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_CLIENT_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="clientStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Client Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Client has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__.$url;?>" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__DELETE_PRODUCT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="productStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Product</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="deleteProductConfirmation('<?php echo $idProduct;?>','<?php  echo $flag ?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_PRODUCT_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="productStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Product</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Products has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <?php if ($flag==1){?>
                    <a href="<?php echo __BASE_URL__;?>/inventory/drugTestKitList" class="btn dark btn-outline">Close</a>
                    <?php }elseif($flag==2){?>
                     <a href="<?php echo __BASE_URL__;?>/inventory/marketingMaterialList" class="btn dark btn-outline">Close</a>
                      <?php }else{?>
                     <a href="<?php echo __BASE_URL__;?>/inventory/consumableslist" class="btn dark btn-outline">Close</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__REQUEST_QUANTITY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="requestQuantityStatus" class="modal fade" tabindex="-2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Request Quantity</span> </h4>
                        </div>
                   
                </div>
                       </div>
                <div class="modal-body">
                      <form action=""  id="requestQuantityForm" name="requestQuantity" method="post" class="form-horizontal form-row-sepe">
                       <div class="form-body">
                           <div class="form-group <?php if(form_error('requestQuantity[szQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Request Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szQuantity" class="form-control input-large select2me input-square-right required  " type="text" value="<?php echo set_value('requestQuantity[szQuantity]'); ?>" placeholder="Request Quantity" onfocus="remove_formError(this.id,'true')" name="requestQuantity[szQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('requestQuantity[szQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('requestQuantity[szQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                </div>
                      </form>
                         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="requestQuantityConfirmation('<?php echo $idProduct;?>','<?php  echo $flag ?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__REQUEST_QUANTITY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="requestQuantityStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Request Quantity</span> </h4>
                        </div>
                   
                </div>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Requested Quantity has been successfully send  .</p>
                </div>
                <div class="modal-footer">
                    <?php
                    if($flag==1)
                    {
                        ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/drugtestkitlist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                    elseif($flag==2)
                    {
                       ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/marketingmateriallist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                     else
                    {
                       ?>
                          <a href="<?php echo __BASE_URL__;?>/inventory/consumableslist" class="btn dark btn-outline">Close</a>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__ALLOT_QUANTITY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="allotQuantityStatus" class="modal fade" tabindex="-2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Allot Quantity</span> </h4>
                        </div>
                    </div>
                       </div>
                <div class="modal-body">
                      <form action=""  id="allotQuantityForm" name="allotQuantity" method="post" class="form-horizontal form-row-sepe">
                       <div class="form-body">
                          <div class="form-group <?php if(form_error('allotQuantity[szReqQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-4">Request Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szReqQuantity" class="form-control input-large select2me read-only" readonly type="text" value="<?php echo set_value('szReqQuantity'); ?>" placeholder="Requested Quantity" onfocus="remove_formError(this.id,'true')" name="allotQuantity[szReqQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('allotQuantity[szReqQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('allotQuantity[szReqQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                           <div class="form-group <?php if(form_error('allotQuantity[szAddMoreQuantity]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-4">Assign Quantity</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szAddMoreQuantity" class="form-control input-large select2me " type="text" value="<?php echo set_value('allotQuantity[szAddMoreQuantity]'); ?>" placeholder="Assign Quantity" onfocus="remove_formError(this.id,'true')" name="allotQuantity[szAddMoreQuantity]">
                                            </div>
                                          <?php
                                            if(form_error('allotQuantity[szAddMoreQuantity]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('allotQuantity[szAddMoreQuantity]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div> 
                        </div>
                      </form>
                         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="allotQuantityConfirmation('<?php echo $idProduct;?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__ALLOT_QUANTITY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="allotQuantityStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                       <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase"> Allot Quantity</span> </h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i>  Quantity has been assigned successfully .</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/stock_management/viewproductlist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_OPERATION_MANAGER_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="operationManagerStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Operation Manager Records</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Deleting this operation manager record will delete all the franchisee and client records (main client and site records) associated with this operation manager ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deleteOperationManagerConfirmation('<?php echo $idOperationManager;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_OPERATION_MANAGER_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="operationManagerStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Operation Manager</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Operation Manager has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/admin/operationManagerList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_CATEGORY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="CategoryStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="deleteCategoryConfirmation('<?php echo $idCategory;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_CATEGORY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="categoryStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Category</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Category has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/categoriesList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_FORUM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="forumStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Forum</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Forum?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="deleteForumConfirmation('<?php echo $id;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_FORUM_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="forumStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Forum</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Forum has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/forumList" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__REPLY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="replyStatus" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
<!--                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Reply</h4><br>
                </div>-->
           
                  <form action=""  id="replyData" name="replyData" method="post" class="form-horizontal  ">
                       <div class="form-body ">
                            <p class="alert alert-info mdl_align" ><i class="fa fa-reply"></i> Please Type your reply below the given box.</p>
                          
                           <hr>
                         <div class="form-group <?php if(form_error('replyData[szReply]')){?>has-error<?php }?>">
                                        <label class="col-md-1 control-label"> </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                               
                                                 <textarea  name="replyData[szReply]" id="szReply" class="form-control"  value=""  rows="7" cols="250"  placeholder="Reply" onfocus="remove_formError(this.id,'true')" ><?php echo set_value('replyData[szReply]'); ?></textarea>
                                              
                                            </div>
                                              <?php
                                            if(form_error('replyData[szReply]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('replyData[szReply]');?></span>
                                            </span><?php }?>
                                        </div>
                                    </div>

                        </div>
                        
                      </form>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="replyToCmntConfirmation('<?php echo $idCmnt;?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php
}if($mode == '__REPLY_CONFIRM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="replyStatusConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Reply To Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Reply has been posted successfully .</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewTopicDetails" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__COMMENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>


<div id="showComment" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php   $cmntDataArr = $this->Forum_Model->getAllCommentsByCmntId($idComment);
                
                  $TopicsArr =$this->Forum_Model->viewTopicListByTopicId($cmntDataArr['idTopic']); 
                   $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$cmntDataArr['idCmnters']);
                 
                   
                    $splitTime = explode(" ",$cmntDataArr['cmntDate']);
                    $Cmntdate = $splitTime[0];
                    $time = $splitTime[1];

                      $Cmnttime=  date("g:i a", strtotime($time));

                     $NewdateComment= explode('-', $Cmntdate);

                     $CnmtmonthNum  = $NewdateComment['1'];

                     $dateObj   = DateTime::createFromFormat('!m', $CnmtmonthNum);
                     $CmntmonthName = $dateObj->format('M');
                  ?>
                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase">Comment</span> </h4>
                        </div>
                 
                </div>
                
                <div>
                     <h4 class="text_cmnt"><b> Topic - <?php echo $TopicsArr['szTopicTitle']?>  </b></h4>
                </div>
                  <div class="modal-body">
                      <h4 class="alert alert-success"> <?php  echo $cmntDataArr['szCmnt'] ;?> </h4>
                               <span class="todo-comment-username cmntDetais"><?php echo $franchiseeDetArr1['szName']?></span> &nbsp; <span class="todo-comment-date"><?php echo $NewdateComment['2'];?> <?php echo $CmntmonthName;?>  <?php  echo $NewdateComment['0'];?> at <?php echo $Cmnttime;?></span>
                </div>
               
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>

    
    <?php
}

if($mode == '__SHOW_REPLY_POPUP__')
{
    echo "SUCCESS||||";
    ?>

    <div id="showReply" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php    $replyDataArr = $this->Forum_Model->getAllReplyByCmntsId($idReply,2); 
            
                $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('',$replyDataArr['0']['idReplier']);
                $cmntDataArr = $this->Forum_Model->getAllCommentsByCmntId($replyDataArr['0']['idCmnt']); 
                
                $splitTimeStamp = explode(" ",$replyDataArr['0']['dtReplyOn']);
                $date1 = $splitTimeStamp[0];
                $time1 = $splitTimeStamp[1];

              $x=  date("g:i a", strtotime($time1));

             $date= explode('-', $date1);


             $monthNum  = $date['1'];

             $dateObj   = DateTime::createFromFormat('!m', $monthNum);
             $monthName = $dateObj->format('M');
                ?>
                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <div class="caption">
                             <h4>   <i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span  class="caption-subject font-red-sunglo bold uppercase">Reply</span> </h4>
                        </div>
                 
                </div>
                
                <div>
                      <h4 class="text_cmnt"><b> Comment </b></h4>
                      <h4 class="text_cmntData"><?php echo $cmntDataArr['szCmnt']?>  </h4>
                </div>
                  <div class="modal-body">
                      <div class="text_cmnt"><h4><b> Reply </b></h4></div>
                      <p class="alert alert-success">  <?php  echo $replyDataArr['0']['szReply'] ;?></p>
                      <span class="todo-comment-username"><?php echo $franchiseeDetArr1['szName']?> </span> &nbsp; <span class="todo-comment-date"><?php echo $date['2'];?> <?php echo $monthName;?>  <?php  echo $date['0'];?> at <?php echo $x;?></span>
                </div>
               
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__APPROVE_REPLY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="approveReplyAlert" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Approve Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to approved this reply?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="approveReplyConfirmation('<?php echo $idReply;?>'); return false;" class="btn green"><i class="fa fa-check"></i> Approve</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__REPLY_APPROVE_CONFIRM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="approveReplyConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Approve Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Reply has been successfully approved.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__UNAPPROVE_REPLY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="unapproveReplyAlert" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Unapprove Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to unapproved this reply?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="unapproveReplyConfirmation('<?php echo $idReply;?>'); return false;" class="btn green"><i class="fa fa-times"></i> Unapprove</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__REPLY_UNAPPROVE_CONFIRM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="unapproveReplyConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Unapprove Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Reply has been successfully unapproved.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_REPLY_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="replyDelete" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Reply?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="replyDeleteConfirmation('<?php echo $idReply;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_REPLY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="replyDeleteConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Reply</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Reply has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewTopicDetails" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_COMMENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="cmntDelete" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Comment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="cmntDeleteConfirmation('<?php echo $idCmnt;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_COMMENT_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="cmntDeleteConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Comment has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewTopicDetails" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__TOPIC_CLOSE_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="closeTopic" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Topic Close</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to close the selected Topic?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="closeTopicConfirmation('<?php echo $idTopic;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Submit </button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__TOPIC_CLOSE_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="closeTopicConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Close Topic</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Topic has been successfully closed.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewForum" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__EDIT_REPLY_POPUP__')
{ 
    echo "SUCCESS||||";
    
    ?>
    <div id="replyEdit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
<!--                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Reply</h4><br>
                </div>-->
           
                  <form action=""  id="replyData" name="replyData" method="post" class="form-horizontal  ">
                       <div class="form-body ">
                            <p class="alert alert-info mdl_align" ><i class="fa fa-pencil"></i> Reply Edit</p>
                          
                           <hr>
                         <div class="form-group <?php if(form_error('replyData[szReply]')){?>has-error<?php }?>">
                                        <label class="col-md-1 control-label"> </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                               
                                                <textarea  name="replyData[szReply]" id="szReply" class="form-control"  value="<?php echo $szReply ;?>"  rows="7" cols="250"  placeholder="Reply" onfocus="remove_formError(this.id,'true')" ><?php echo $szReply ;?></textarea>
                                              
                                            </div>
                                              <?php
                                            if(form_error('replyData[szReply]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('replyData[szReply]');?></span>
                                            </span><?php }?>
                                        </div>
                                    </div>

                        </div>
                        
                      </form>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="replyEditConfirmation('<?php echo $idReply;?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php
}if($mode == '__EDIT_REPLY_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="replyEditConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Reply </h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Reply has been edited successfully .</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewTopicDetails" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__APPROVE_COMMENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="approveCommentAlert" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Approve Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to approved this comment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="approveCommentConfirmation('<?php echo $idComment;?>'); return false;" class="btn green"><i class="fa fa-check"></i> Approve</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__COMMENT_APPROVE_CONFIRM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="approveCommentConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Approve Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Comment has been successfully approved.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
 
<?php }
if($mode == '__UNAPPROVE_COMMENT_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="unapproveCommentAlert" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Unapprove Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to unapproved this Comment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    
                    <button type="button" onclick="unapproveCommentConfirmation('<?php echo $idComment;?>'); return false;" class="btn green"><i class="fa fa-times"></i> Unapprove</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__COMMENT_UNAPPROVE_CONFIRM_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="unapproveCommentConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Unapprove Comment</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Comment has been successfully unapproved.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/approvallist" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

if($mode == '__EDIT_COMMENT_POPUP__')
{ 
    echo "SUCCESS||||";
  
    ?>
    <div id="commentEdit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
<!--                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Reply</h4><br>
                </div>-->
           
                  <form action=""  id="commentData" name="commentData" method="post" class="form-horizontal  ">
                       <div class="form-body ">
                            <p class="alert alert-info mdl_align" ><i class="fa fa-pencil"></i> Comment Edit</p>
                          
                           <hr>
                         <div class="form-group <?php if(form_error('commentData[szComment]')){?>has-error<?php }?>">
                                        <label class="col-md-1 control-label"> </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <textarea  name="commentData[szComment]" id="szComment" class=" ckeditor" rows="7" cols="250"  placeholder="Reply" onfocus="remove_formError(this.id,'true')" ><?php echo $szComment ;?></textarea>
                                            </div>
                                              <?php
                                            if(form_error('commentData[szComment]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('commentData[szComment]');?></span>
                                            </span><?php }?>
                                        </div>
                                    </div>

                        </div>
                        
                      </form>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="commentEditConfirmation('<?php echo $idComment;?>'); return false;" class="btn green">Submit</button>
                </div>
            </div>
        </div>
    </div>
<script>
CKEDITOR.replace( 'szComment' );
</script>

    <?php
}if($mode == '__EDIT_COMMENT_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="commentEditConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Comment </h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Comment has been edited successfully .</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewTopicDetails" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__DELETE_TOPIC_POPUP__')
{
    echo "SUCCESS||||";
    ?>
    <div id="deleteTopic" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Topic </h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Are you sure you want to delete the selected Topic?</p>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" onclick="topicDeleteConfirmation('<?php echo $idTopic;?>'); return false;" class="btn green"><i class="fa fa-user-times"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if($mode == '__DELETE_TOPIC_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="topicDeleteConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Deleted Topic</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Selected Topic has been successfully deleted.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo __BASE_URL__;?>/forum/viewForum/" class="btn dark btn-outline">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
if($mode == '__PLACE_ORDER_POPUP_CONFIRM__')
{
    echo "SUCCESS||||";
    ?>
    <div id="orderplaceconfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Place Order</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success"><i class="fa fa-check"></i> Your Order has been successfully placed.</p>
                </div>
                <div class="modal-footer">
                    <?php if($flag==1){
                    $this->session->unset_userdata('quantity');
                    $this->session->unset_userdata('flag');
                    $this->session->unset_userdata('idProduct');

                    ?>
                    <a href="<?php echo __BASE_URL__;?>/order/drugtestkit/" class="btn dark btn-outline">Close</a>
                    <?php } if($flag==2){
                     $this->session->unset_userdata('quantity');
                     $this->session->unset_userdata('flag');
                     $this->session->unset_userdata('idProduct');
                        ?>
                    <a href="<?php echo __BASE_URL__;?>/order/marketingmaterial/" class="btn dark btn-outline">Close</a>
                    <?php } if($flag==3){
                    $this->session->unset_userdata('quantity');
                    $this->session->unset_userdata('flag');
                    $this->session->unset_userdata('idProduct');
                        ?>
                    <a href="<?php echo __BASE_URL__;?>/order/consumables/" class="btn dark btn-outline">Close</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

  ?>
