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
            $drugTestKitAray =$this->Inventory_Model->viewDrugTestKitList();
            $marketingMaterialAray =$this->Inventory_Model->viewMarketingMaterialList();
            
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
       function editModelStock()
        {

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
             $validate = $this->input->post('editModelStockValue');
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('editModelStockValue[szProductCategory]', 'Product Category', 'required');
            $this->form_validation->set_rules('editModelStockValue[szProduct]', 'Product', 'required');
            $this->form_validation->set_rules('editModelStockValue[szModelStockVal]', 'Model Stock Value', 'required|numeric');
           
            
            if ($this->form_validation->run() == FALSE)
            {
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
                if( $this->StockMgt_Model->insertModelStockValue($idfranchisee,$validate))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Marketing Material Info! </strong> Marketing Material added successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    header("Location:" . __BASE_URL__ . "/inventory/marketingMaterialList");
                    die;
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

              $result =   "<select class=\"form-control input-large select2me\" name=\"editModelStockValue[szProduct]\" id=\"szProduct\" Placeholder=\"Product\" onfocus=\"remove_formError(this.id,'true')\">";
          	foreach ($productAry as $productDetails)
          	{
               
             	$result .= "<option value='".$productDetails['id']."'>".$productDetails['szProductCode']."</option>";
         	}
         	$result .= "</select>";
     	}
     	else
     	{
     		 $result =   "<select class=\"form-control input-large select2me\" name=\"editModelStockValue[szProduct]\" id=\"szProduct\" Placeholder=\"Product\" onfocus=\"remove_formError(this.id,'true')\">";
                 $result .= "<option value=''>".Select."</option>";
                 $result .= "</select>";
     	}
      	echo $result;           
  	}
        
    }      
    
?>