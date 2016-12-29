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
                if($_SESSION['drugsafe_user']['iRole']=='5')
                {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;
                }
                elseif($_SESSION['drugsafe_user']['iRole']=='1'){
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
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
                        header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
                        die;
                      }
                       elseif($user_session[iRole]==5)
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
                        $szMessage['content'] = "<strong><h3>Your new password successfully updated.</h3></strong> ";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);

                       if($_SESSION['drugsafe_user']['iRole']==5){
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                        die;                 
                      } elseif($_SESSION['drugsafe_user']['iRole']==2){
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/franchisee/clientRecord");
                        die;
                        } else{
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
                        die;
                        }
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
        function addFranchiseeData()
        {
             $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
        }
        $idOperationManager = $this->input->post('idOperationManager');
        $flag = $this->input->post('flag');
        $this->session->set_userdata('flag',$flag);
        if($idOperationManager>0){
         $this->session->set_userdata('idOperationManager', $idOperationManager);
       }
        echo "SUCCESS||||";
        echo "addFranchisee";
    }
        function addFranchisee()
	{
             $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $validate= $this->input->post('addFranchisee');
            $idOperationManager = $this->session->userdata('idOperationManager');
            $flag = $this->session->userdata('flag');
            $count = $this->Admin_Model->getnotification();
            if($this->Admin_Model->validateUsersData($validate,array(),false,false,$flag))
            {
              
                if($this->Admin_Model->insertUserDetails($validate))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>New franchisee added successfully.</h3></strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    $this->session->unset_userdata('idOperationManager');
                    $this->session->unset_userdata('flag');
                    
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;
                }
            }
           
                    $data['idOperationManager'] = $idOperationManager;
                    $data['szMetaTagTitle'] = "Add Franchisee";
                    $data['pageName'] = "Franchisee_List";
                    $data['validate'] = $validate;
                    $data['flag'] = $flag;
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
            }
             if ($_SESSION['drugsafe_user']['iRole'] == '5') {
             $operationManagerId = $_SESSION['drugsafe_user']['id'];
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
            if(isset($_POST['szSearch3']) && !empty($_POST['szSearch3'])){
                $id = $_POST['szSearch3'];
            }
           
         
             // handle pagination
          
                $config['base_url'] = __BASE_URL__ . "/admin/franchiseeList/";
                $config['total_rows'] = count($this->Admin_Model->viewFranchiseeList($searchAry,$operationManagerId,false,false,$id,$name,$email,$opId));
                $config['per_page'] = 5;
              
            
                 $this->pagination->initialize($config);
               
                 $franchiseeAray =$this->Admin_Model->viewFranchiseeList($searchAry,$operationManagerId, $config['per_page'],$this->uri->segment(3),$id,$name,$email,$opId);
                 $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,$operationManagerId);
                
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
            function operationManagerList()
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
          
                $config['base_url'] = __BASE_URL__ . "/admin/operationManagerList/";
                $config['total_rows'] = count($this->Admin_Model->viewOperationManagerList($searchAry,false,false,$id,$name,$email));
                $config['per_page'] = 5;
              
            
                $this->pagination->initialize($config);
               
                $operationManagerAray =$this->Admin_Model->viewOperationManagerList($searchAry, $config['per_page'],$this->uri->segment(3),$id,$name,$email);
                $searchOptionArr =$this->Admin_Model->viewOperationManagerList();
          
                  
                    $data['szMetaTagTitle'] = "Operation Manager List";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Operation_Manager_List";
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['data'] = $data;
                    $data['notification'] = $count;
                    $data['operationManagerAray'] = $operationManagerAray;
                    $data['allOperationManager'] = $searchOptionArr;
                    
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/operationManagerList');
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
              function getFranchiseeByOperationManager($operationManagerId='')
 	{  
            if(trim($operationManagerId) != '')
            {
                $_POST['operationManagerId'] = $operationManagerId; 
            }
            
            $franchiseeAry = $this->Admin_Model->viewFranchiseeList(false,trim($_POST['operationManagerId']));
         
            
      	if(!empty($franchiseeAry))
     	{
        	$result = "<select class=\"form-control \" id=\"franchiseeId\" name=\"clientData[franchiseeId]\" placeholder=\"Franchisee\" onfocus=\"remove_formError(this.id,'true')\">";
          	foreach ($franchiseeAry as $franchiseeDetails)
          	{
                    
             	$result .= "<option value='".$franchiseeDetails['id']."' >".$franchiseeDetails['szName']."</option>";
         	}
         	$result .= "</select>";
     	}
     	else
     	{
     		$result = "<input type=\"text\" class=\"form-control required\" id=\"franchiseeId\" name=\"clientData[franchiseeId]\" placeholder=\"Franchisee\" onfocus=\"remove_formError(this.id,'true')\">";
     	}
      	echo $result;           
  	}
        function editfranchiseedata()
        {
           
            $idfranchisee = $this->input->post('idfranchisee');
            $idOperationManager = $this->input->post('idOperationManager');
           
            
            if($idfranchisee>0)
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                $this->session->set_userdata('idOperationManager',$idOperationManager);
                echo "SUCCESS||||";
                echo "editFranchisee";
            }
            
        }
        
        public function editFranchisee()
        {
            $idOperationManager = $this->session->userdata('idOperationManager');
            $idfranchisee = $this->session->userdata('idfranchisee');
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
                
                if($this->Admin_Model->validateUsersData($data_validate,array(), $idfranchisee,false,1))
                {
                    if($this->Admin_Model->updateUsersDetails($data_validate,$idfranchisee))
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong><h3>Franchisee data successfully updated</h3>.</strong> ";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                        ob_end_clean();
                        $this->session->unset_userdata('idOperationManager');
                        $this->session->unset_userdata('idfranchisee');
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
                    $data['idfranchisee'] = $idfranchisee;
                    $data['idOperationManager'] = $idOperationManager;
                    $_POST['addFranchisee'] = $userDataAry;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['notification'] = $count;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/editFranchisee');
            $this->load->view('layout/admin_footer');
            }
        }
 
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
        if($this->Admin_Model->validateUsersData($data_validate,$data_not_validate,'0',true))
        {

            if($this->Admin_Model->checkAdminAccountStatus($data_validate['szEmail']))
            {

                if($this->Admin_Model->sendNewPasswordToAdmin($data_validate['szEmail']))
                {

                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3> Please check your email to recover your password.</h3></strong>";
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
                    $szMessage['content'] = "<strong><h3>Your new password successfully updated.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);

                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/admin_login");
                    die;
                }
                else
                {
                    $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong><h3>Password recovery link is expired. Please reset your password again.</h3></strong>";
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
            $szMessage['content'] = "<strong><h3> Your Password Key is wrong. Please reset your password again.</h3></strong>";
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
     function addOperationManager()
	{
            $validate= $this->input->post('addOperationManager'); 

            $count = $this->Admin_Model->getnotification();
            if($this->Admin_Model->validateUsersData($validate))
            {
              
                if($this->Admin_Model->insertUserDetails($validate))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>New operation manager added successfully.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
                    die;
                }
            }
           
                    $data['szMetaTagTitle'] = "Add Operation Manager";
                    $data['pageName'] = "Operation_Manager_List";
                    $data['validate'] = $validate;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['notification'] = $count;
            
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/addOperationManager');
            $this->load->view('layout/admin_footer');
        } 
         function editOperationManagerData()
        {
           
            $idOperationManager = $this->input->post('idOperationManager');
            $flag = $this->input->post('flag');
           
            
            if($idOperationManager>0)
            {
                $this->session->set_userdata('flag',$flag);
                 $this->session->set_userdata('idOperationManager',$idOperationManager);
                echo "SUCCESS||||";
                echo "edit_Operation_Manager";
            }
            
        }
        
        public function edit_Operation_Manager()
        {
            $idOperationManager = $this->session->userdata('idOperationManager');
            $flag = $this->session->userdata('flag');
            $count = $this->Admin_Model->getnotification();
            if($idOperationManager >0)
            {
                
                  
                $data_validate = $this->input->post('editOperationManager');
                if(empty($data_validate))
                {
                    $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$idOperationManager);
                }
                else
                {
                    $userDataAry = $data_validate;
                }
                
                if($this->Admin_Model->validateUsersData($data_validate,array(), $idOperationManager))
                {
                    if($this->Admin_Model->updateUsersDetails($data_validate,$idOperationManager))
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong><h3> Operation Manager data successfully updated.<h3></strong> ";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                     
                        if($flag==1){
                        $this->session->unset_userdata('flag'); 
                        $this->session->unset_userdata('idOperationManager');
                        header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
                         ob_end_clean();
                        }else{
                          $this->session->unset_userdata('flag');
                          header("Location:" . __BASE_URL__ . "/franchisee/franchiseeRecord");  
                          ob_end_clean();
                        }
                        die;
                    }
                }
                    $data['szMetaTagTitle'] = "Edit Operation Manager Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Operation_Manager_List";
                    $data['validate'] = $validate;
                    $_POST['editOperationManager'] = $userDataAry;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['notification'] = $count;
                    $data['flag'] = $flag;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('admin/editOperationManager');
            $this->load->view('layout/admin_footer');
            }
        }
      public function deleteOperationManagerAlert()
        {
            $data['mode'] = '__DELETE_OPERATION_MANAGER_POPUP__';
            $data['idOperationManager'] = $this->input->post('idOperationManager');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deleteOperationManagerConfirmation()
        {
            $data['mode'] = '__DELETE_OPERATION_MANAGER_CONFIRM__';
            $data['idOperationManager'] = $this->input->post('idOperationManager');
            $this->Admin_Model->deleteOperationManagerDetails($data['idOperationManager']);
            $this->load->view('admin/admin_ajax_functions',$data);
        }  
}      
?>    