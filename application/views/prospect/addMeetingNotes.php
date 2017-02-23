<div class="page-content-wrapper">
    <div class="page-content">
        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                       <a href="<?php echo __BASE_URL__;?>">Home</a>
                       <i class="fa fa-circle"></i>
                    </li>
                    <li>
                       <span class="active">Add Meeting Note</span>
                    </li>
                </ul>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Add Meeting Note</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                            </div>
                        </div>
                    </div>
                        <div class="portlet-body">
                            <form class="form-horizontal" id="meetingNotesData" action="<?php echo __BASE_URL__?>/prospect/add_meeting_notes" name="meetingNotesData" method="post">
                                <div class="form-body">
                                    <div class="form-group <?php if(form_error('meetingNotesData[szDiscription]')){?>has-error<?php }?>">
                                        <label class="col-md-3 control-label">Meeting Description</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-file-text"></i>
                                                </span>
                                                 <textarea  name="meetingNotesData[szDiscription]" id="szDiscription" class="form-control"  value=""  rows="5" placeholder="Meeting Description" onfocus="remove_formError(this.id,'true')" ><?php echo set_value('meetingNotesData[szTopicDiscription]'); ?></textarea>
                                              
                                            </div>
                                              <?php
                                            if(form_error('meetingNotesData[szDiscription]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('meetingNotesData[szDiscription]');?></span>
                                            </span><?php }?>
                                        </div>
                                    </div>
                      
                                    </div>
                                    <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                             <a href="<?= __BASE_URL__ ?>/prospect/prospectRecord" class="btn default uppercase"
                                           type="button">Cancel</a>
                                            <input type="submit" class="btn green-meadow" value="SAVE" name="meetingNotesData[submit]">
                                        </div>
                                    </div>
                                    </div>
                                    
                            </form>
                        </div>
                </div>
            </div> 
        </div>
    </div>
</div>
</div>