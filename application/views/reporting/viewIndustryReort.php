<script type='text/javascript'>
    $(function() {
 $("#szIndustry").customselect();
 $("#szTestType").customselect();
});
</script>
<div class="page-content-wrapper">
    <div class="page-content">
       

        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">

                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Industry Report</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                    Industry Report
                                </span>
                        </div>
                        <?php if(!empty($getSosAndClientDetils)){?>
                            <div class="actions">

                                <a onclick="industryReportPdf('<?php echo $_POST['dtStart'];?>','<?php echo $_POST['dtEnd'];?>','<?php echo $_POST['szIndustry'];?>','<?php echo $_POST['szTestType'];?>')" href="javascript:void(0);" class=" btn green-meadow">
                                    <i class="fa fa-file-pdf-o"></i> View Pdf </a>

                                <a onclick="industryReportXls('<?php echo $_POST['dtStart'];?>','<?php echo $_POST['dtEnd'];?>','<?php echo $_POST['szIndustry'];?>','<?php echo $_POST['szTestType'];?>')" href="javascript:void(0);" class=" btn green-meadow">
                                    <i class="fa fa-file-excel-o"></i> View Xls </a>

                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="portlet-body totalpr alert">
                        <div class="row">
                            <form name="revenueSearchForm" id="revenueSearchForm"
                                  action="<?= __BASE_URL__ ?>/reporting/view_industry_report" method="post">
                                <div class="row">
                                   
                                    <div class="col-md-4">
                                        <div class="form-group <?php if (!empty($arErrorMessages['dtStart']) != '') { ?>has-error<?php } ?>">
                                            <div class="input-group input-medium date date-picker"
                                                 data-date-format="dd/mm/yyyy">

                                                <input type="text" id="dtStart" class="form-control"
                                                       value="<?php echo set_value('dtStart'); ?>" readonly
                                                       placeholder="Start Date"
                                                       onfocus="remove_formError(this.id,'true')" name="dtStart">
                                                <span class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                               </span>
                                            </div>
                                            <!-- /input-group -->
                                            <?php
                                            if (form_error('dtStart')) {
                                                ?>
                                                <span class="help-block pull-left">
                                                <span><?php echo form_error('dtStart'); ?></span>
                                                </span><?php } ?>
                                            <?php if (!empty($arErrorMessages['dtStart'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['dtStart']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div
                                            class="form-group <?php if (!empty($arErrorMessages['dtEnd']) != '') { ?>has-error<?php } ?>">
                                            <div class="input-group input-medium date date-picker"
                                                 data-date-format="dd/mm/yyyy">

                                                <input type="text" id="szSearch5" class="form-control"
                                                       value="<?php echo set_value('dtEnd'); ?>" readonly
                                                       placeholder="End Date"
                                                       onfocus="remove_formError(this.id,'true')" name="dtEnd">
                                                <span class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                               </span>
                                            </div>
                                            <!-- /input-group -->
                                            <?php
                                            if (form_error('dtEnd')) {
                                                ?>
                                                <span class="help-block pull-left">
                                                <span><?php echo form_error('dtEnd'); ?></span>
                                                </span><?php } ?>
                                            <?php if (!empty($arErrorMessages['dtEnd'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['dtEnd']; ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                     <div class="search col-md-4">
                                     <div class="form-group <?php if (!empty($arErrorMessages['szIndustry']) != '') { ?>has-error<?php } ?>">
                                      <select class="form-control custom-select" name="szIndustry" id="szIndustry" onfocus="remove_formError(this.id,'true')">
                                          <option value="">Industry</option>
                                          <?php
                                          foreach($allIndustry as $industryList)
                                          {
                                              $selected = ($industryList['id'] == $_POST['szIndustry'] ? 'selected="selected"' : '');
                                              echo '<option value="'.$industryList['id'].'"' . $selected . ' >'.$industryList['szName'].'</option>';
                                          }
                                          ?>
                                      </select>
                                          <?php
                                            if (form_error('szIndustry')) {
                                                ?>
                                                <span class="help-block pull-left">
                                                <span><?php echo form_error('szIndustry'); ?></span>
                                                </span><?php } ?>
                                            <?php if (!empty($arErrorMessages['szIndustry'])) { ?>
                                                <span class="help-block pull-left">
                                                <i class="fa fa-times-circle"></i>
                                                    <?php echo $arErrorMessages['szIndustry']; ?>
                                            </span>
                                            <?php } ?>
                                    </div>
                                  </div>
                                    </div>
                                <div class="row">
                                     <div class="col-md-4">
                                     <div class="form-group <?php if (!empty($arErrorMessages['szTestType']) != '') { ?>has-error<?php } ?>">
                                        <select class="form-control custom-select" name="szTestType" id="szTestType" onfocus="remove_formError(this.id,'true')">
                                             <option value="">Select</option>
                                            <option value="A" <?php if($_POST['szTestType'] == 'A') echo"selected"; ?>>Alcohol</option>
                                            <option value="U" <?php if($_POST['szTestType'] == 'U') echo"selected"; ?>>Urine AS/NZA 4308:2001/ As/NZA 4308:2008</option>
                                            <option value="O" <?php if($_POST['szTestType'] == 'O') echo"selected"; ?>>Oral Fluid AS 4760:2006</option>
                                        </select> 
                                    </div>
                                  </div>
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn green-meadow" type="submit"><i
                                                    class="fa fa-search"></i> Search
                                            </button>
                                            &nbsp;
                                        </div>
                                    </div>
                                 </div>
                             </form>
                        </div>
                    </div>
                    <?php
                    if($_POST['dtStart']!='' && $_POST['dtEnd']!='')
                    {
                        
                    if (!empty($getSosAndClientDetils)) {
                        
                      
                    ?>
                    <div class="portlet-body alert">
                        <div class="row">
                            <div>
                                <div class="portlet green-meadow box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-users"></i>Industry Report
                                       </div>

                                    </div>
                                </div> 
                                <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        
                                                    </th>
                                                     <th>
                                                        
                                                    </th>
                                                    <?php
                                                    foreach($getSosAndClientDetils as $getSosAndClientData)
                                                    {
                                                        ?>
                                                        <th>
                                                            <?php
                                                               $industryname=$this->Admin_Model->getIndustryNameByid($getSosAndClientData['industry']);
                                                               echo $industryname['szName'];
                                                            ?>
                                                            
                                                        </th>
                                                        <?php
                                                    }
                                                    ?>
                                                   
                                                </tr>
                                                </thead>
                                                <?php
                                                if($_POST['szTestType']=='' || $_POST['szTestType']=='A')
                                                {
                                                   
                                                    ?>
                                                <tbody>
                                                    <tr>
                                                        <td>Alchohol</td>
                                                        <td>Total Donors</td>
                                                        <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalAlcohol']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                    ?>
                                                            
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td>Positive Result</td>
                                                         <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalPositiveAlcohol']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                    ?>
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td>Negative Result</td>
                                                        <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalNegativeAlcohol']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                }
                                                 if($_POST['szTestType']=='' || $_POST['szTestType']=='U')
                                                {
                                                     ?>
                                                    <tbody>
                                                    <tr>
                                                        <td>Urine AS/NZA 4308:2001/ As/NZA 4308:2008</td>
                                                        <td>Total Donors</td>
                                                        <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalDonarUrine']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td>Positive Result</td>
                                                         <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalDonarUrine'] -  $getSosAndClientData['totalNegativeUrine']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                         <td></td>
                                                        <td>Negative Result</td>
                                                         <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalNegativeUrine']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                }
                                                if($_POST['szTestType']=='' || $_POST['szTestType']=='O')
                                                {
                                                    ?>
                                                <tbody>
                                                    <tr>
                                                        <td>Oral Fluid AS 4760:2006</td>
                                                        <td>Total Donors</td>
                                                        <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalDonarOral'];?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td>Positive Result</td>
                                                         <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalDonarOral'] -  $getSosAndClientData['totalNegativeOral']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                         <td></td>
                                                        <td>Negative Result</td>
                                                         <?php
                                                        foreach($getSosAndClientDetils as $getSosAndClientData)
                                                        {
                                                        ?>
                                                            <td><?php echo $getSosAndClientData['totalNegativeOral']; ?></td>
                                                             
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                     <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                                
                                                
                                            </table>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else
                {
                    echo "<h4>No record found</h4>";
                }
                    }
                ?>

            </div>

        </div>

    </div>

</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>