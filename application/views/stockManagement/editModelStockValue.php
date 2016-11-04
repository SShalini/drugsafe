<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green-meadow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer "></i>&nbsp; &nbsp;
                            <span class="caption-subject  bold uppercase">Edit Model Stock Value</span>
                        </div>
                        <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                              
                        </div>
                    </div>
                    <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                        <form action=""  id="editModelStockValue" name="editModelStockValue" method="post" class="form-horizontal form-row-sepe">
                            <div class="form-body">
                                <h4 class="form-section"></h4>
                                <div class="form-group <?php if(form_error('editModelStockValue[szProductCategory]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Product Category</label>
                                        <div class="col-md-4">
                                            <select class="form-control input-large select2me" name="editModelStockValue[szProductCategory]" id="szProductCategory" Placeholder="Category" onchange="getProductListing(this.value);"  onfocus="remove_formError(this.id,'true')">
                                                   <option value=''>Product Category</option>
                                                    <option value='1' <?php echo (set_value('editModelStockValue[szProductCategory]') == '1' ? "selected" : "");?>>Drug Test Kits</option>
                                                    <option value='2' <?php echo (set_value('editModelStockValue[szProductCategory]') == '2' ? "selected" : "");?>>Marketing Material</option>
                                            </select>
                                          <?php
                                            if(form_error('editModelStockValue[szProductCategory]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('editModelStockValue[szProductCategory]');?></span>
                                            </span><?php }?>  
                                        </div>
                                </div>
                                <div class="form-group <?php if(form_error('editModelStockValue[szProduct]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Product</label>
                                        <div class="col-md-4">
                                            <div id="product_container">
                                                 <select class="form-control input-large select2me" name="editModelStockValue[szProduct]" id="szProduct" Placeholder="Product" onfocus="remove_formError(this.id,'true')">
                                                    <option value="">Select</option>
                                                 </select>
                                             </div>
                                          
                                           <?php
                                            if(form_error('editModelStockValue[szProduct]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('editModelStockValue[szProduct]');?></span>
                                            </span><?php }?>   
                                        </div>
                                </div>
                               
                                <div class="form-group <?php if(form_error('editModelStockValue[szModelStockVal]')){?>has-error<?php }?>">
                                    <label class="control-label col-md-3">Model Stock value</label>
                                        <div class="col-md-4">
                                           <div class="input-group">
                                                <input id="szModelStockVal" class="form-control input-large select2me" type="text" value="<?php echo set_value('editModelStockValue[szModelStockVal]'); ?>" placeholder="Model Stock Value" onfocus="remove_formError(this.id,'true')" name="editModelStockValue[szModelStockVal]">
                                            </div>
                                          <?php
                                            if(form_error('editModelStockValue[szModelStockVal]')){?>
                                            <span class="help-block pull-left"><span><?php echo form_error('editModelStockValue[szModelStockVal]');?></span>
                                            </span><?php }?> 
                                        </div>
                                </div>  
                                
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <a href="<?=__BASE_URL__?>/admin/franchiseeList" class="btn default uppercase" type="button">Cancel</a>
                                    <input type="submit" class="btn green-meadow" value="Save" name="editModelStockValue[submit]">
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