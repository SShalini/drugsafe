<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('StockMgt_Model');
            $this->load->library('pagination');
        
	}
	
	public function index()
	{
            $is_user_login = is_user_login($this);
            if($is_user_login)
            {
                if($_SESSION['drugsafe_user']['iRole']=='1')
                {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;
                }
                else
                {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/franchisee/clientRecord");
                    die;
                }
            }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }

        } 
        public function admin_login()
	{
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if($is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
               die;
            }	
                $validate= $this->input->post('adminLogin');
            
                
                $iRemember = (int)$this->input->post('adminLogin[iRemember]');
//               print_r($iRemember);die;
              if($this->Admin_Model->validateAdminData($validate))
             {
               
                 $adminAry = $this->Admin_Model->adminLoginUser($validate);
                     if(!empty($adminAry)) {
                        if ((int) $iRemember == 1) {
                        set_customer_cookie($this, $adminAry);
                         
                        }
                       $user_session = $this->session->userdata('drugsafe_user');
                      if($user_session[iRole]==1)
                      {
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                        die;
                      }
                      else{
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/franchisee/clientRecord");
                        die;  
                      }
                    }
                
              
            }
                $data['szMetaTagTitle'] = "Admin Login";
                $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                $data['is_user_login'] = $is_user_login;
                
                $this->load->view('layout/login_header', $data);
                $this->load->view('admin/admin_login');
                $this->load->view('layout/login_footer');
	    
        }

        public function dashboard() {

            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
        $user_session = $this->session->userdata('drugsafe_user');


            $data['szMetaTagTitle'] = "Dashboard";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Admin_Dashboard";

            $this->load->view('layout/admin_header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('layout/admin_footer');
        }


          function logout()
        {
            logout($this);
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die();
        }
         function changePassword()
        {
            $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
             
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
		
            $data_validate = $this->input->post('drugsafeChangePassword');
   
            if($this->Admin_Model->validateUserData($data_validate))
            {

                    if($this->Admin_Model->updateChangePassword() )
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong>Password Recovery! </strong> Your new password successfully updated.";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);

                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                        die;
                    }
            }
        
            $data['szMetaTagTitle'] = "Change Password";
            $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Profile";
            $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('admin/changePassword');
        $this->load->view('layout/admin_footer');

        }
        function addFranchisee()
	{
            $validate= $this->input->post('addFranchisee'); 
//            $countryAry = $this->Admin_Model->getCountries();
//            $stateAry = $this->Admin_Model->getStatesByCountry(trim(Australia));
            $count = $this->Admin_Model->getnotification();
            if($this->Admin_Model->validateFranchiseeData($validate))
            {
              
                if($this->Admin_Model->insertFranchiseeDetails())
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>New Franchisee ! </strong> New franchisee added successfully.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;
                }
            }
           
                    $data['szMetaTagTitle'] = "Add Franchisee";
                    //$data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Franchisee_List";
//                    $data['countryAry'] = $countryAry;
//                    $data['stateAry'] = $stateAry;
                    $data['validate'] = $validate;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['notification'] = $count;
            
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/addFranchisee');
            $this->load->view('layout/admin_footer');
        }  
        function welweb(){
            $responsedata = array("code" => 200,"message"=>"Webservice Working sucessfully.");
            header('Content-Type: application/json');
            echo json_encode($responsedata);
            die;
        }
         function franchiseeList()
        {
           $is_user_login = is_user_login($this);

            // redirect to dashboard if already logged in
           $count = $this->Admin_Model->getnotification();
        
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }elseif($_SESSION['drugsafe_user']['iRole']!='1')
            {

                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/franchisee/clientRecord");
                die;
            }
            $searchAry = '';
            if(isset($_POST['szSearch']) && !empty($_POST['szSearch'])){
                $id = $_POST['szSearch'];
            }
            if(isset($_POST['szSearch1']) && !empty($_POST['szSearch1'])){
                $id = $_POST['szSearch1'];
            }
            if(isset($_POST['szSearch2']) && !empty($_POST['szSearch2'])){
                $id = $_POST['szSearch2'];
            }

          
             // handle pagination
          
                $config['base_url'] = __BASE_URL__ . "/admin/franchiseeList/";
                $config['total_rows'] = count($this->Admin_Model->viewFranchiseeList($searchAry,false,false,$id,$name,$email));
                $config['per_page'] = 5;
              
            
                $this->pagination->initialize($config);
               
                $franchiseeAray =$this->Admin_Model->viewFranchiseeList($searchAry, $config['per_page'],$this->uri->segment(3),$id,$name,$email);
          $searchOptionArr = $this->Admin_Model->viewFranchiseeList();
                  
                    $data['szMetaTagTitle'] = "Franchisee List";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Franchisee_List";
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['data'] = $data;
                    $data['notification'] = $count;
                    $data['franchiseeAray'] = $franchiseeAray;
            $data['allfranchisee'] = $searchOptionArr;
         
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/franchiseeList');
            $this->load->view('layout/admin_footer');
        }
        
         
     
           
        
        function getStatesByCountry($szCountry='')
 	{  
            if(trim($szCountry) != '')
            {
                $_POST['szCountry'] = $szCountry; 
            }
            
            $stateAry = $this->Admin_Model->getStatesByCountry(trim($_POST['szCountry']));
            
      	if(!empty($stateAry))
     	{
        	$result = "<select class=\"form-control required\" id=\"szState\" name=\"addFranchisee[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
          	foreach ($stateAry as $stateDetails)
          	{
             	$result .= "<option value='".$stateDetails['name']."'>".$stateDetails['name']."</option>";
         	}
         	$result .= "</select>";
     	}
     	else
     	{
     		$result = "<input type=\"text\" class=\"form-control required\" id=\"szState\" name=\"addFranchisee[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
     	}
      	echo $result;           
  	}
      
        function editfranchiseedata()
        {
           
            $idfranchisee = $this->input->post('idfranchisee');
           
            
            if($idfranchisee>0)
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                echo "SUCCESS||||";
                echo "editFranchisee";
            }
            
        }
        
        public function editFranchisee()
        {
//            $countryAry = $this->Admin_Model->getCountries();
            $idfranchisee = $this->session->userdata('idfranchisee');
//            $stateAry = $this->Admin_Model->getStatesByCountry(trim(Australia));
            $count = $this->Admin_Model->getnotification();
            if($idfranchisee >0)
            {
                
                  
                $data_validate = $this->input->post('addFranchisee');
                if(empty($data_validate))
                {
                    $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$idfranchisee);
                }
                else
                {
                    $userDataAry = $data_validate;
                }
                
                if($this->Admin_Model->validateFranchiseeData($data_validate,array(), $idfranchisee))
                {
                    if($this->Admin_Model->updateFranchiseeDetails($idfranchisee))
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong>Franchisee Info! </strong> Franchisee data successfully updated.";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                        
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                        die;
                    }
                }
                    $data['szMetaTagTitle'] = "Edit Franchisee Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Franchisee_List";
//                    $data['countryAry'] = $countryAry;
//                    $data['stateAry'] = $stateAry;
                    $data['validate'] = $validate;
                    $_POST['addFranchisee'] = $userDataAry;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['notification'] = $count;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/editFranchisee');
            $this->load->view('layout/admin_footer');
            }
        }
        /*public function admin_forgotPassword()
        {
            $email=$this->input->post('drugSafeForgotPassword[szEmail]');
             
            if($this->Admin_Model->sendNewPasswordToAdmin($email))
            {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Password Recovery! </strong> Your new password successfully updated.";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                $this->session->userdata('drugsafe_user_message');
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_forgotPassword");
                  die;
            }
            $data['szMetaTagTitle'] = "Admin Forgot Password";
            $this->load->view('layout/login_header', $data);
            $this->load->view('admin/forgotPassword');
            $this->load->view('layout/login_footer');
        }*/
         public function deleteFranchiseeAlert()
        {
            $data['mode'] = '__DELETE_FRANCHISEE_POPUP__';
            $data['idfranchisee'] = $this->input->post('idfranchisee');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deleteFranchiseeConfirmation()
        {
            $data['mode'] = '__DELETE_FRANCHISEE_CONFIRM__';
            $data['idfranchisee'] = $this->input->post('idfranchisee');
            $this->Admin_Model->deletefranchisee($data['idfranchisee']);
            $this->Admin_Model->deletemodelStockValue($data['idfranchisee']);
            $this->Admin_Model->deleteProductStockQuantity($data['idfranchisee']);
            $this->load->view('admin/admin_ajax_functions',$data);
        }
    public function admin_forgotPassword()
    {
        $is_user_login = is_user_login($this);
         
        if($is_user_login)
        {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
            die;
        }
        
        $data_validate=$this->input->post('drugSafeForgotPassword');
        //$data_validate = array('szEmail'=>$data_validate);
        $data_not_validate = array(
            'id',
            'szName',
            'szContactNumber',
            'szCountry',
            'szState',
            'szCity',
            'szZipCode',
            'szAddress'
        );
//        echo 'test1';
        if($this->Admin_Model->validateFranchiseeData($data_validate,$data_not_validate,'0',true))
        {
//            echo 'test2';
            if($this->Admin_Model->checkAdminAccountStatus($data_validate['szEmail']))
            {
//                echo 'test3';
                if($this->Admin_Model->sendNewPasswordToAdmin($data_validate['szEmail']))
                {
//                    echo 'test4';
                    //die;
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Password Recovery! </strong> Please check your email to recover your password.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    $this->session->userdata('drugsafe_user_message');
                    ob_end_clean();
                    header("Location:" .__BASE_URL__. "/admin/admin_login");
                    die;
                }
            }
        }
        $data['szMetaTagTitle'] = "Admin Forgot Password";
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        $data['is_user_login'] = $is_user_login;

        $this->load->view('layout/login_header', $data);
        $this->load->view('admin/forgotPassword');
        $this->load->view('layout/login_footer');

    }

    public function adminPassword_Recover($arg1='', $arg2='')
    {
        $is_user_login = is_user_login($this);

        // redirect to dashboard if already logged in
        if($is_user_login)
        {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
            die;
        }
        //echo " Hello";
        $passwordKey = $this->Admin_Model->sql_real_escape_string(trim($arg1));
        //  echo $passwordKey;
        if($this->Admin_Model->checkPasswordRecoveryExist($passwordKey))
        {

            //echo $passwordKey;
            $data_validate = $this->input->post('recoverAdminData');
            // echo $data_validate;
            $data_not_validate = array(
                'id',
                'szName',
                'szEmail',
                'szContactNumber',
                'szCountry',
                'szState',
                'szCity',
                'szZipCode',
                'szAddress'

            );
            if($this->Admin_Model->validateFranchiseeData($data_validate, $data_not_validate,0,TRUE))
            {

                if($this->Admin_Model->updateAdminPassword($passwordKey,$data_validate))
                {

                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Password Recovery! </strong> Your new password successfully updated.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);

                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/admin_login");
                    die;
                }
                else
                {
                    $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong>Password Recovery! </strong> Password recovery link is expired. Please reset your password again.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);

                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/admin_login");
                    die;
                }

            }

        }
        else
        {
            $szMessage['type'] = "error";
            $szMessage['content'] = "<strong>Password Recovery! </strong> Your Password Key is wrong. Please reset your password again.";
            $this->session->set_userdata('drugsafe_user_message', $szMessage);
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        $data['szMetaTagTitle'] = "Admin Forgot Password";
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        $data['is_user_login'] = $is_user_login;
        $data['passwordKey'] = $passwordKey;
        $this->load->view('layout/login_header', $data);
        $this->load->view('admin/adminPassword_Recover', $data);
        $this->load->view('layout/login_footer');
    }

}