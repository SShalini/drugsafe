<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green-meadow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer "></i>&nbsp; &nbsp;
                            <span class="caption-subject  bold uppercase">Add Model Stock Value</span>
                        </div>
                        <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                              
                        </div>
                    </div>
                   
                    <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                        <form action=""  id="addModelStockValue" name="addModelStockValue" method="post" class="form-horizontal form-row-sepe">
                            <div class="form-body">
                         
                                <h4 class="form-section"></h4>
                                <div class="form-group <?php if(form_error('addModelStockValue[szName]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Product Category</label>
                                        <div class="col-md-4">
                                            <input id="szName" class="form-control input-large select2me read-only" type="text" value="<?php echo set_value('addModelStockValue[szName]'); ?>" placeholder="Category" onfocus="remove_formError(this.id,'true')" name="addModelStockValue[szName]">
                                          <?php
                                            if(form_error('addModelStockValue[szName]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('addModelStockValue[szName]');?></span>
                                            </span><?php }?>  
                                        </div>
                                </div>
                                <div class="form-group <?php if(form_error('addModelStockValue[szProductCode]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Product</label>
                                        <div class="col-md-4">
                                            <div id="product_container">
                                                 <input id="szProductCode" class="form-control input-large select2me read-only" type="text" value="<?php echo set_value('addModelStockValue[szProductCode]'); ?>" placeholder="Product Code" onfocus="remove_formError(this.id,'true')" name="addModelStockValue[szProductCode]">
                                             </div>
                                          
                                           <?php
                                            if(form_error('addModelStockValue[szProductCode]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('addModelStockValue[szProductCode]');?></span>
                                            </span><?php }?>   
                                        </div>
                                </div>
                               
                                <div class="form-group <?php if(form_error('addModelStockValue[szModelStockVal]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Model Stock value</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szModelStockVal" class="form-control input-large select2me" type="text" value="<?php echo set_value('addModelStockValue[szModelStockVal]'); ?>" placeholder="Model Stock Value" onfocus="remove_formError(this.id,'true')" name="addModelStockValue[szModelStockVal]">
                                            </div>
                                          <?php
                                            if(form_error('addModelStockValue[szModelStockVal]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('addModelStockValue[szModelStockVal]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div>  
                                
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <a href="<?=__BASE_URL__?>/stock_management/modelstockvalue" class="btn default uppercase" type="button">Cancel</a>
                                    <input type="submit" class="btn green-meadow" value="Save" name="addModelStockValue[submit]">
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