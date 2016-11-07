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

        function ModelStock()
        {
         
            $idfranchisee = $this->input->post('idfranchisee');
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                echo "SUCCESS||||";
                echo "modelstockvalue";
            }
            
        }
        function modelstockvalue()
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
            $drugTestKitAray =$this->StockMgt_Model->viewDrugTestKitList();
         
            $frdata = array();
             foreach ($drugTestKitAray as $drugTestKitdata){
                $drugTestKitDataArr = $this->StockMgt_Model->getProductDetailsById($idfranchisee,$drugTestKitdata['id']);
                array_push($frdata, $drugTestKitDataArr);
        
             }

            $marketingMaterialAray =$this->StockMgt_Model->viewMarketingMaterialList();
  
            $mrdata = array();
             foreach ($marketingMaterialAray as $marketingMaterialdata){
               
                $marketingMaterialDataArr = $this->StockMgt_Model->getProductDetailsById($idfranchisee,$marketingMaterialdata['id']);

                array_push($mrdata,$marketingMaterialDataArr);
             }

            $data['drugTestKitDataArr'] = $frdata;
            $data['marketingMaterialDataArr'] = $mrdata;

            $data['marketingMaterialAray'] = $marketingMaterialAray;
            $data['drugTestKitAray'] = $drugTestKitAray;
            $data['idfranchisee'] = $idfranchisee;
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

            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idfranchisee = $this->session->userdata('idfranchisee');
            
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
        function getProductsByCategory($szProductCategory='')
 	{  
            if(trim($szProductCategory) != '')
            {
                $_POST['szProductCategory'] = $szProductCategory; 
            }
            
            $productAry = $this->StockMgt_Model->getProductsByCategory(trim($_POST['szProductCategory']));
           
      	if(!empty($productAry))
     	{

              $result =   "<select class=\"form-control input-large select2me\" name=\"addModelStockValue[szProduct]\" id=\"szProduct\" Placeholder=\"Product\" onfocus=\"remove_formError(this.id,'true')\">";
          	foreach ($productAry as $productDetails)
          	{
               
             	$result .= "<option value='".$productDetails['id']."'>".$productDetails['szProductCode']."</option>";
         	}
         	$result .= "</select>";
     	}
     	else
     	{
     		 $result =   "<select class=\"form-control input-large select2me\" name=\"addModelStockValue[szProduct]\" id=\"szProduct\" Placeholder=\"Product\" onfocus=\"remove_formError(this.id,'true')\">";
                 $result .= "<option value=''>".Select."</option>";
                 $result .= "</select>";
     	}
      	echo $result;           
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
            $idProduct = $this->session->userdata('$idProduct');
            $modelStockDataAry = $this->StockMgt_Model->getModelstockDetailsById($idfranchisee,$idProduct);
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
    }      
    
?>