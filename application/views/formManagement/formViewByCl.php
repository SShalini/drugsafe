
<script type='text/javascript'>
    $(function() {

        $("#szSearchname").customselect();

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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-meadow"></i>
                            <?php  
                            
                                   $franchiseeId = $clientlistArr[0]['franchiseeId'];
                                   $this->session->set_userdata('franchiseeId',$franchiseeId);
                                   $franchiseeId = $this->session->userdata('franchiseeId');
                            
                            $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$franchiseeId);?>
                           
                            <span class="caption-subject font-green-meadow ">Plese select  <?php echo $userDataAry['szName'];?> 's client to display their related sites.</span>
                        </div>
                      </div>
                    <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/formManagement/viewForm" name="szSearchClientRecord" method="post">

                                  <div class="search col-md-3">
                                      <select class="form-control custom-select" name="szSearchClRecord" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Name</option>
                                          <?php
                                         foreach($clientlistArr as $clientList)
                                          {
                                              $selected = ($clientList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientList['id'].'" >'.$clientList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                               
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                                   <input type="hidden" name="iflag[flag]" id="flag" value="2"/> 
                                   <?php  
                                  
                                   ?>
                                   <input type="hidden" name="idFr[idFr]" id="idFr" value="<?php echo $franchiseeId ;?>"/> 
                                   
                           </form>
                          </div>
                <?php  if($data['value']==2){?>
                 
              <div class="row">  
                <h4>Not Found </h4>
                  </div>
                      <?php }?>  
         <?php  if(!empty($clientAry)){?>
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