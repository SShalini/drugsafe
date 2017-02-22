<div class="page-content-wrapper">
        <div class="page-content">
            <div id="page_content" class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Region List</span>
                            </div>
                             <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-sm green-meadow" onclick="redirect_url('<?php echo base_url();?>admin/addRegion');">
                                        &nbsp;Add New Region
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        
                        if(!empty($getAllRegion))
                        {
                           
                            ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> Id.</th>
                                        <th> Region Name</th>
                                        <th> State</th>
                                        <th> Region Code</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $i = 0;
                                        foreach($getAllRegion as $getAllRegionData)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td> <?php echo $i;?> </td>
                                            <td> <?php echo $getAllRegionData['regionName']?> </td>
                                            <td> <?php echo $getAllRegionData['name'];?> </td>
                                            <td> <?php echo $getAllRegionData['regionCode'];?> </td>
                                            <td>
                                                <?php
                                                if($getAllRegionData['assign']=='0')
                                                {
                                                    ?>
                                                        <a class="btn btn-circle btn-icon-only btn-default" title="Edit Region Data" onclick="editRegionDetails('<?php echo $getAllRegionData['id'];?>');" href="javascript:void(0);">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>
                                                        <a class="btn btn-circle btn-icon-only btn-default" id="userStatus" title="Delete Region" onclick="franchiseeDelete(<?php echo $getAllRegionData['id'];?>);" href="javascript:void(0);"></i>
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                    <?php
                                                    
                                                }
                                                ?>
                                                
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                   ?>
                                </tbody>
                            </table>
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