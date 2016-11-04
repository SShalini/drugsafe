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
       
        
    }      
    
?>