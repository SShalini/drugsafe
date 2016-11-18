<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reporting_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('StockMgt_Model');
            $this->load->model('Reporting_Model');
        
	}
        public function index()
	{
            $is_user_login = is_user_login($this);
            if($is_user_login)
            {
  
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;

            }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }

        } 
        
         function allstockreqlist()
        {
           $is_user_login = is_user_login($this);
           
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
             $count = $this->Admin_Model->getnotification();
             $allReqQtyAray =$this->Reporting_Model->getAllQtyRequestDetails();
 
                    $data['allReqQtyAray'] = $allReqQtyAray;
                    $data['szMetaTagTitle'] = "All Stock Requests";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Reporting";
                    $data['subpageName'] = "All_Stock_Requests";
                    $data['notification'] = $count;
                    $data['data'] = $data;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/StockRequestList');
            $this->load->view('layout/admin_footer');
        }

    
      
    }      
    
?>