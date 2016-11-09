<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StockMgt_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('StockMgt_Model');
        
	}
        public function index()
	{
            $is_user_login = is_user_login($this);
            if($is_user_login)
            {
  
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/stock_management/modelstockvalue");
                    die;

            }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }

        } 

        function ModelStock()
        {
         
            $idfranchisee = $this->input->post('idfranchisee');
            $flag = $this->input->post('flag');
           
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                
                echo "SUCCESS||||";
                echo "modelstockvalue";
            }
            
        }
        function modelstockvalue()
        {
            $is_user_login = is_user_login($this);

            // redirect to franchisee list if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
          
             $idfranchisee = $this->session->userdata('idfranchisee');
             $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);

             $drugTestKitAray =$this->StockMgt_Model->viewDrugTestKitList();
         
             $fr_value_data = array();
             foreach ($drugTestKitAray as $drugTestKitdata){
                $drugTestKitDataArr = $this->StockMgt_Model->getStockValueDetailsById($idfranchisee,$drugTestKitdata['id']);
                array_push($fr_value_data, $drugTestKitDataArr);
        
             }

            $marketingMaterialAray =$this->StockMgt_Model->viewMarketingMaterialList();
  
            $mr_value_data = array();
            foreach ($marketingMaterialAray as $marketingMaterialdata){
                $marketingMaterialDataArr = $this->StockMgt_Model->getStockValueDetailsById($idfranchisee,$marketingMaterialdata['id']);
                array_push($mr_value_data,$marketingMaterialDataArr);
             }

                    $data['drugTestKitDataArr'] = $fr_value_data;
                    $data['marketingMaterialDataArr'] = $mr_value_data;
                    $data['marketingMaterialAray'] = $marketingMaterialAray;
                    $data['drugTestKitAray'] = $drugTestKitAray;
                    $data['idfranchisee'] = $idfranchisee;
                    $data['franchiseeArr'] = $franchiseeArr;
                    $data['szMetaTagTitle'] = "Model Stock Value";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Model_Stock_Value";
                 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/modelStockValue');
            $this->load->view('layout/admin_footer');
        }
        
       function addModelStock()
        {
           $idProduct = $this->input->post('idProduct');
          $this->session->set_userdata('$idProduct',$idProduct);
            {
                echo "SUCCESS||||";
                echo "addmodelstockvalue";
            }
 
        }
        function addmodelstockvalue()
        {
            $is_user_login = is_user_login($this);

            // redirect to franchisee list if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idfranchisee = $this->session->userdata('idfranchisee');
            $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);
            
            $validate = $this->input->post('addModelStockValue');

            $idProduct = $this->session->userdata('$idProduct');
            //$modelStockDataAry = $this->StockMgt_Model->getModelstockDetailsById($idfranchisee,$idProduct);
          
            $productDataAry = $this->StockMgt_Model->getProductsDetailsById($idProduct);
         
            $idCategory = $productDataAry['szProductCategory'];
           
           
            $CategoryDataAry = $this->StockMgt_Model->getCategoryDetailsById($idCategory);
 
            $frdata = array();
            $frdata   =  array_merge($productDataAry,$CategoryDataAry);

            $this->load->library('form_validation');
            $this->form_validation->set_rules('addModelStockValue[szName]', 'Product Category', 'required');
            $this->form_validation->set_rules('addModelStockValue[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('addModelStockValue[szModelStockVal]', 'Model Stock Value', 'required|numeric');
           
            
            if ($this->form_validation->run() == FALSE)
            {
                $_POST['addModelStockValue'] = $frdata;
                $data['franchiseeArr'] = $franchiseeArr;
                $data['productDataAry'] = $productDataAry;
                $data['idProduct'] = $idProduct;
                $data['szMetaTagTitle'] = "Add Model Stock Value";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Add_Model_Stock_Value";
                
            $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/addModelStockValue');
            $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->StockMgt_Model->insertModelStockValue($idfranchisee,$validate,$idProduct))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Model Stock Value Info! </strong> Model Stock Value added successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    
                    if($idCategory==1){
                    $drActive= $idCategory;   
                    $this->session->set_userdata('drugsafe_tab_status', $drActive); 
                    header("Location:" . __BASE_URL__ . "/stock_management/modelstockvalue");
                    die;
                    }
                    else{
                    $mrActive= $idCategory                  ; 
                    $this->session->set_userdata('drugsafe_tab_status', $mrActive);
                    header("Location:" . __BASE_URL__ . "/stock_management/modelstockvalue");
                    die;  
                    }
                }
            }
        }

              function editModelStock()
        {
           $idProduct = $this->input->post('idProduct');
           $this->session->set_userdata('$idProduct',$idProduct);
            {
                echo "SUCCESS||||";
                echo "editmodelstockvalue";
            }
 
        }
        function editmodelstockvalue()
        {
        
            $is_user_login = is_user_login($this);

            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idfranchisee = $this->session->userdata('idfranchisee');
            $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);
            
           
            $idProduct = $this->session->userdata('$idProduct');
            $modelStockDataAry = $this->StockMgt_Model->getStockValueDetailsById($idfranchisee,$idProduct);
            $productDataAry = $this->StockMgt_Model->getProductsDetailsById($idProduct);
            $idCategory = $productDataAry['szProductCategory'];
           
            $CategoryDataAry = $this->StockMgt_Model->getCategoryDetailsById($idCategory);
 
            $frdata = array();
            $frdata   =  array_merge($modelStockDataAry, $productDataAry,$CategoryDataAry);

          
            $this->load->library('form_validation');
            $this->form_validation->set_rules('editModelStockValue[szName]', 'Product Category', 'required');
            $this->form_validation->set_rules('editModelStockValue[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('editModelStockValue[szModelStockVal]', 'Model Stock Value', 'required|numeric');
           
            
            if ($this->form_validation->run() == FALSE)
            {
                
                $_POST['editModelStockValue'] = $frdata;
                $data['idProduct'] = $idProduct;
                $data['productDataAry'] = $productDataAry;
                $data['franchiseeArr'] = $franchiseeArr;
                
                
                $data['szMetaTagTitle'] = "Edit Model Stock Value";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Edit_Model_Stock_Value";
                
            $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/editModelStockValue');
            $this->load->view('layout/admin_footer');
            }
            else
            {
               $data_validate = $this->input->post('editModelStockValue');
           
                if( $this->StockMgt_Model->updateModelStockVal($data_validate,$idProduct))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Model Stock Value Info! </strong> Model Stock Value Updated successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    if($idCategory==1){ 
                        
                    $drActive= $idCategory;   
                    $this->session->set_userdata('drugsafe_tab_status', $drActive); 
                    header("Location:" . __BASE_URL__ . "/stock_management/modelstockvalue");
                    die;
                    }
                    else{
                    $mrActive= $idCategory                  ; 
                    $this->session->set_userdata('drugsafe_tab_status', $mrActive);
                    header("Location:" . __BASE_URL__ . "/stock_management/modelstockvalue");
                    die;  
                    }
                }
            }
        }
         function productStock()
        {
         
            $idfranchisee = $this->input->post('idfranchisee');
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                echo "SUCCESS||||";
                echo "productstockqty";
            }
            
        }
        function productstockqty()
        {
            $is_user_login = is_user_login($this);

            // redirect to franchisee list if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
          
             $idfranchisee = $this->session->userdata('idfranchisee');
             $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);
             $drugTestKitAray =$this->StockMgt_Model->viewDrugTestKitList();
           
         
             $fr_qty_data = array();
              foreach ($drugTestKitAray as $drugTestKitdata){
                $drugTestKitDataArr = $this->StockMgt_Model->getProductQtyDetailsById($idfranchisee,$drugTestKitdata['id']);
                array_push($fr_qty_data, $drugTestKitDataArr);
        
             }
  
                    $marketingMaterialAray =$this->StockMgt_Model->viewMarketingMaterialList();
                    $mr_qty_data = array();
                    foreach ($marketingMaterialAray as $marketingMaterialdata){
                    $marketingMaterialDataArr = $this->StockMgt_Model->getProductQtyDetailsById($idfranchisee,$marketingMaterialdata['id']);
                    array_push($mr_qty_data,$marketingMaterialDataArr);
             }

                    $data['drugTestKitDataArr'] = $fr_qty_data;
                    $data['marketingMaterialDataArr'] = $mr_qty_data;
                    $data['marketingMaterialAray'] = $marketingMaterialAray;
                    $data['drugTestKitAray'] = $drugTestKitAray;
                    $data['franchiseeArr'] = $franchiseeArr;
                    $data['idfranchisee'] = $idfranchisee;
                    $data['szMetaTagTitle'] = "Product_Stock_Management";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Product_Stock_Management";
                 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/productStockMgt');
            $this->load->view('layout/admin_footer');
        }  
        function addProductStock()
        {
           $idProduct = $this->input->post('idProduct');
           $this->session->set_userdata('$idProduct',$idProduct);
            {
                echo "SUCCESS||||";
                echo "addProductStockqty";
            }
 
        }
        function addProductStockqty()
        {
            $is_user_login = is_user_login($this);

            // redirect to franchisee list if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idfranchisee = $this->session->userdata('idfranchisee');
            $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);
            
            $validate = $this->input->post('addProductStockQty');
           
   
            $idProduct = $this->session->userdata('$idProduct');
          
          
            $productDataAry = $this->StockMgt_Model->getProductsDetailsById($idProduct);
         
            $idCategory = $productDataAry['szProductCategory'];
           
           
            $CategoryDataAry = $this->StockMgt_Model->getCategoryDetailsById($idCategory);
 
            $frdata = array();
            $frdata   =  array_merge($productDataAry,$CategoryDataAry);

            $this->load->library('form_validation');
            $this->form_validation->set_rules('addProductStockQty[szName]', 'Product Category', 'required');
            $this->form_validation->set_rules('addProductStockQty[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('addProductStockQty[szQuantity]', 'Quantity', 'required|numeric');
           
            
            if ($this->form_validation->run() == FALSE)
            {
                $_POST['addProductStockQty'] = $frdata;
                $data['idProduct'] = $idProduct;
                $data['franchiseeArr'] = $franchiseeArr;
                $data['productDataAry'] = $productDataAry;
                $data['szMetaTagTitle'] = "Add_Product_Stock_Quantity";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Add_Product_Stock_Quantity";
                
           $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/addProductStockQty');
            $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->StockMgt_Model->insertProductStockQuantity($idfranchisee,$validate,$idProduct))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Product Stock Quantity Info! </strong> Product Stock Quantity added successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    
                    if($idCategory==1){
                    $drActive= $idCategory;   
                    $this->session->set_userdata('drugsafe_tab_status', $drActive); 
                    header("Location:" . __BASE_URL__ . "/stock_management/productstockqty");
                    die;
                    }
                    else{
                    $mrActive= $idCategory                  ; 
                    $this->session->set_userdata('drugsafe_tab_status', $mrActive);
                    header("Location:" . __BASE_URL__ . "/stock_management/productstockqty");
                    die;  
                    }
                }
            }
        }
        
         function editProductStock()
        {
            $idProduct = $this->input->post('idProduct');
            $flag = $this->input->post('flag');
            
            {
                 $this->session->set_userdata('flag',$flag);
                 $this->session->set_userdata('$idProduct',$idProduct);
                
                echo "SUCCESS||||";
                echo "editproductstockqty";
            }
 
        }
        function editproductstockqty()
        {
        
            $is_user_login = is_user_login($this);

            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idfranchisee = $this->session->userdata('idfranchisee');
            $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$idfranchisee);
            $flag = $this->session->userdata('flag');
            
            $idProduct = $this->session->userdata('$idProduct');
            $modelStockDataAry = $this->StockMgt_Model->getProductQtyDetailsById($idfranchisee,$idProduct);
            $productDataAry = $this->StockMgt_Model->getProductsDetailsById($idProduct);
           
            $idCategory = $productDataAry['szProductCategory'];
           
            $CategoryDataAry = $this->StockMgt_Model->getCategoryDetailsById($idCategory);
 
            $frdata = array();
            $frdata   =  array_merge($modelStockDataAry, $productDataAry,$CategoryDataAry);

          
            $this->load->library('form_validation');
            $this->form_validation->set_rules('editProductStockQty[szName]', 'Product Category', 'required');
            $this->form_validation->set_rules('editProductStockQty[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('editProductStockQty[szQuantity]', 'Quantity', 'required|numeric');
           
             
            if ($this->form_validation->run() == FALSE)
            {
              
                 $_POST['editProductStockQty'] = $frdata;
                 $data['idProduct'] = $idProduct;
                 $data['flag'] = $flag;
                 $data['productDataAry'] = $productDataAry;
                 $data['franchiseeArr'] = $franchiseeArr;
               
 
                $data['szMetaTagTitle'] = "Edit Model Stock Value";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Edit_Product_Stock_Quantity";
                
            $this->load->view('layout/admin_header',$data);
            $this->load->view('stockManagement/editProductStockQty');
            $this->load->view('layout/admin_footer');
            }
            else
            {
               $data_validate = $this->input->post('editProductStockQty');
      
           
                if( $this->StockMgt_Model->updateProductStockQty($data_validate,$idProduct))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Product Stock Quantity Info! </strong> Product Stock Quantity Updated successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    if($idCategory==1){ 
                        
                    $drActive= $idCategory;   
                    $this->session->set_userdata('drugsafe_tab_status', $drActive); 
                    header("Location:" . __BASE_URL__ . "/stock_management/productstockqty");
                    die;
                    }
                    else{
                    $mrActive= $idCategory                  ; 
                    $this->session->set_userdata('drugsafe_tab_status', $mrActive);
                    header("Location:" . __BASE_URL__ . "/stock_management/productstockqty");
                    die;  
                    }
                }
            }
        }
    }      
    
?>