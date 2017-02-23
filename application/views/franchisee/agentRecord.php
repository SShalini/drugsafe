<script type='text/javascript'>
    $(function() {

       $("#szSearchClientname").customselect();
    });
</script>
<div class="page-content-wrapper">
        <div class="page-content">
            <?php if(isset($_SESSION['addagentsucess'])){ ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['addagentsucess'];
                    unset($_SESSION['addagentsucess']);?>
                </div>
            <?php }?>
             <div id="page_content" class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo __BASE_URL__;?>/franchisee/clientRecord">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
						<li>
                           Agent/Employee Record
                        </li>
                    </ul>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase"> Agent/Employee Record</span>
                            </div>
                           
                            <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>franchisee/addAgentEmployee');">
                                        &nbsp;Add Agent/Employee

                                    </button>
                                </div>
                        </div>
                        </div>
                        <div class="row">
                              <form class="form-horizontal" id="szSearchClientRecord" action="<?php echo base_url();?>franchisee/agentRecord" name="szSearchClientRecord" method="post">
                    
                                  
                                  <div class="search col-md-3">
                                        <div id='szClient'>                         
                                      <select class="form-control custom-select" name="szSearchClRecord" id="szSearchClientname" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Agent/Employee Name</option>
                                          <?php
                                          foreach($agentListArray as $agentList)
                                          {
                                              $selected = ($agentList['id'] == $_POST['szSearchClRecord'] ? 'selected="selected"' : '');
                                              
                                              echo '<option value="'.$agentList['id'].'"' . $selected . ' >'.$agentList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                            </div>
                                  </div>
                              
                                  <div class="col-md-1">
                                      <button class="btn green-meadow" type="submit" ><i class="fa fa-search"></i></button>
                                  </div>
                           </form>
                          </div>
                        <?php
                        
                        if(!empty($agentRecordArray))
                        {?>
                        <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id </th>
                                        <th> Agent/Employee Name </th>
                                        <th> Contact Email</th>
                                        <th> Contact Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                     
                                        foreach($agentRecordArray as $agentRecordData)
                                        {  
                                            ?>
                                        <tr>
                                            <td>AG-<?php echo $agentRecordData['id'];?></td>
                                            <td><?php echo $agentRecordData['szName'];?></td>
                                            <td> <?php echo $agentRecordData['szEmail'];?> </td>
                                            <td> <?php echo $agentRecordData['szContactNumber'];?> </td><td>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="Edit Agent" onclick="editAgentEmployeeDetails('<?php echo $agentRecordData['id']; ?>');" href="javascript:void(0);">
                                                    <i class="fa fa-pencil"></i> 
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" title="assign Client" onclick="assignClientAgent('<?php echo $agentRecordData['id']; ?>');" href="javascript:void(0);">
                                                    <i class="fa fa-tasks"></i> 
                                                </a>
						<?php
						if($agentRecordData['clientType']=='0')
						{?>
						    <a class="btn btn-circle btn-icon-only btn-default" title="assign Client" onclick="agentEmployeeDelete('<?php echo $agentRecordData['agentId']; ?>');" href="javascript:void(0);">
                                                        <i class="fa fa-trash"></i> 
                                                    </a>
						<?php
						}
						?>
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
                     </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div id="popup_box"></div>