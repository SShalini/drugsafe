<div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                     <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                     <li class="sidebar-toggler-wrapper hide">
                                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                                <div class="sidebar-toggler"> </div>
                                <!-- END SIDEBAR TOGGLER BUTTON -->
                     </li>
                    
                       
                             <?php if($_SESSION['drugsafe_user']['iRole']==1){?>
                            <li class="nav-item start <?php if(trim($pageName)=='Franchisee_List'){?>active open<?php }?>">
                                <a href="<?php echo __BASE_URL__;?>/admin/franchiseeList" class="nav-link nav-toggle">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="title">Franchisee List</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                           <?php }?> 
                             <?php if($_SESSION['drugsafe_user']['iRole']==2){?>
                            <li class="nav-item start <?php if(trim($pageName)=='Client_List'){?>active open<?php }?>">
                                <a href="<?php echo __BASE_URL__;?>/franchisee/clientList" class="nav-link nav-toggle">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="title">Client List</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                           <?php }?> 
                             <li class="nav-item start <?php if(trim($pageName)=='Inventory'){?>active open<?php }?>">
                                <a href="javascript:void(0);" class="nav-link nav-toggle">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="title">Inventory </span>
                                   <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" <?php if($subpageName=='Inventory'){ ?> style="display: block;" <?php } ?> >
                                    
				<li class="nav-item  <?php if($subpageName=='add_Product'){ ?> active open <?php } ?>">
                                    <a class="nav-link " href="<?php echo __BASE_URL__;?>/inventory/addProduct">
                                        <span class="title">Add Product</span>
                                    </a>
                                </li>
                                <li class="nav-item  <?php if($subpageName=='Drug_Test_Kit_List'){ ?> active open <?php } ?>">
                                    <a class="nav-link " href="<?php echo __BASE_URL__;?>/inventory/drugtestkitlist">
                                        <span class="title">Drug Test Kit List</span>
                                    </a>
                                </li>
                                
				<li class="nav-item  <?php if($subpageName=='Marketing_Material_List'){ ?> active open <?php } ?>">
                                    <a class="nav-link " href="<?php echo __BASE_URL__;?>/inventory/marketingmateriallist">
                                        <span class="title">Marketing Material List</span>
                                    </a>
                                </li>
                                </ul>
                                 
				
                              
                            </li>
                        </ul>
                     </div>  
           
                   </div>