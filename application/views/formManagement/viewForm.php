
<script type='text/javascript'>
    $(function() {
//        $("#szSearch").customselect();
        $("#szSearchname").customselect();
//        $("#szSearchemail").customselect();
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
    <?php print_r($_POST['iflag']['flag']);?>
        <div id="page_content" class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <?php if(empty($clientlistArr) && $_POST['iflag']['flag'] !=2 && $_POST['iflag']['flag'] !=3){?>
                      <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-meadow"></i>
                            <span class="caption-subject font-green-meadow ">Plese select a Franchisee to display their related clients.</span>
                        </div>
                      </div>
                      <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/formManagement/viewForm" name="szSearchClientRecord" method="post">

                                  <div class="search col-md-3">
                                      <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Franchisee Name</option>
                                          <?php
                                           $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,false);
                                         foreach($searchOptionArr as $searchOptionList)
                                          {
                                              $selected = ($searchOptionList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$searchOptionList['id'].'" >'.$searchOptionList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>

                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                                   <input type="text" name="iflag[flag]" id="flag" value="1"/> 
                           </form>
                          </div>
                    
                    <?php }  ?>
                      <?php if($_POST['iflag']['flag']==1){
                    if (!empty($clientlistArr)) {
                      $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $_POST['szSearchClRecord2']);     
                      ?>  
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-meadow"></i>
                            <span class="caption-subject font-green-meadow ">Plese select <?php echo $franchiseeDetArr1['szName']?>'s client to display their related sites.</span>
                        </div>
                      </div>
                    <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/formManagement/viewForm" name="szSearchClientRecord" method="post">

                                  <div class="search col-md-3">
                                      <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Client Name</option>
                                          <?php
                                         foreach($clientlistArr as $clientList)
                                          {
                                              $selected = ($clientList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$clientList['id'].'" >'.$clientList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                               
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                                   <input type="text" name="iflag[flag]" id="flag" value="2"/> 
                           </form>
                          </div>

                        <?php

                    } else {
                        echo "Not Found";
                    } 
                      }
                      if($_POST['iflag']['flag']==2){
                     if (!empty($childClientDetailsAray)) {
                      $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $_POST['szSearchClRecord2']);     
                      ?>  
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-green-meadow"></i>
                            <span class="caption-subject font-green-meadow ">Plese select <?php echo $franchiseeDetArr1['szName']?>'s site to display their related  form data.</span>
                        </div>
                      </div>
                    <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?=__BASE_URL__?>/formManagement/viewForm" name="szSearchClientRecord" method="post">

                                  <div class="search col-md-3">
                                      <select class="form-control custom-select" name="szSearchClRecord2" id="szSearchname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Site Name</option>
                                          <?php
                                         foreach($childClientDetailsAray as $childClientDetailsList)
                                          {
                                              $selected = ($childClientDetailsList['id'] == $_POST['szSearchClRecord2'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$childClientDetailsList['id'].'" >'.$childClientDetailsList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                               
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                                   <input type="text" name="iflag[flag]" id="flag" value="3"/> 
                           </form>
                          </div>
                   <?php      } else {
                        echo "Not Found";
                    } 
                      } 
             if($_POST['iflag']['flag']==3) {
                    if (!empty($sosRormDetailsAry)) {

                        ?>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Test Record</span>
                        </div>
                        </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                               
                                    <th>Test Date</th>
                                    <th>ServiceCommencedOn</th>
                                    <th>ServiceConcludedOn</th>
                                    <th>Action</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                foreach ($sosRormDetailsAry as $sosRormDetailsData) {
                                    ?>
                                    <tr>
                                       
                                        <td> <?php echo $sosRormDetailsData['testdate']; ?> </td>
                                        <td> <?php echo $sosRormDetailsData['ServiceCommencedOn'] ?> </td>
                                        <td> <?php echo $sosRormDetailsData['ServiceConcludedOn']; ?> </td>
                                        <td> 
                                         <a class="btn btn-circle btn-icon-only btn-default" id="userStatus"
                                               title="View SoS Form Details"
                                               onclick="viewSosFormDetails(<?php echo $sosRormDetailsData['Clientid']; ?>,<?php echo $sosRormDetailsData['id']; ?>);"
                                               href="javascript:void(0);"></i>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
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

                    } else {
                        echo "Not Found";
             } }
                    ?>
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