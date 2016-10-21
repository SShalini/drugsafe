<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Franchisee_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
        
	}
	
	public function index()
	{
            
             $is_user_login = is_user_login($this);
            
            if($is_user_login)
            {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/franchisee/dashboard");
                    die;
            }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }

        } 
        
        public function dashboard() {
           
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }



            $data['szMetaTagTitle'] = "Dashboard";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Franchisee_Dashboard";

            $this->load->view('layout/admin_header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('layout/admin_footer');
        }
        
        function addClientData()
        {
           
            $idfranchisee = $this->input->post('idfranchisee');
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                echo "SUCCESS||||";
                echo "addClient";
            }
            
        }
        
        function addClient()
        {
            $validate= $this->input->post('clientData'); 
            $countryAry = $this->Admin_Model->getCountries();
            $idfranchisee = $this->session->userdata('idfranchisee');
            
            if($this->Admin_Model->validateClientData($validate))
            {
                if($this->Franchisee_Model->insertClientDetails($validate,$idfranchisee))
                {
                   ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/franchisee/clientList");
                    die;
                }
            }
           
                    $data['szMetaTagTitle'] = "Add Client";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Franchisee_List";
                    $data['countryAry'] = $countryAry;
                    $data['validate'] = $validate;
                    $data['idfranchisee'] = $idfranchisee;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
            
            $this->load->view('layout/admin_header',$data);
            $this->load->view('franchisee/addClient');
            $this->load->view('layout/admin_footer');
            
        }
          function logout()
        {
            logout($this);
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die();			
        }
        
        function getStatesByCountryClient($szCountry='')
 	{  
            
            if(trim($szCountry) != '')
            {
                $_POST['szCountry'] = $szCountry; 
            }
            
            $stateAry = $this->Admin_Model->getStatesByCountry(trim($_POST['szCountry']));
            
      	if(!empty($stateAry))
     	{
        	$result = "<select class=\"form-control required\" id=\"szState\" name=\"clientData[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
          	foreach ($stateAry as $stateDetails)
          	{
             	$result .= "<option value='".$stateDetails['name']."'>".$stateDetails['name']."</option>";
         	}
         	$result .= "</select>";
     	}
     	else
     	{
     		$result = "<input type=\"text\" class=\"form-control required\" id=\"szState\" name=\"clientData[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
     	}
      	echo $result;           
  	}
        
        function viewClientData()
        {
           
            $idfranchisee = $this->input->post('idfranchisee');
            {
                $this->session->set_userdata('idfranchisee',$idfranchisee);
                echo "SUCCESS||||";
                echo "clientList";
            }
            
        }
         function clientList()
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
            $clientAray =$this->Franchisee_Model->viewClientList($idfranchisee);
            
            $data['idfranchisee'] = $idfranchisee;
            $data['clientAry'] = $clientAray;
            $data['szMetaTagTitle'] = "Client List";
            $data['is_user_login'] = $is_user_login;
                   
                    
            $this->load->view('layout/admin_header',$data);
            $this->load->view('franchisee/clientList');
            $this->load->view('layout/admin_footer');
        }
        public function deleteClientAlert()
        {
            $data['mode'] = '__DELETE_CLIENT_POPUP__';
            $data['idClient'] = $this->input->post('idClient');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deleteClientConfirmation()
        {
           
            $data['mode'] = '__DELETE_CLIENT_CONFIRM__';
            $data['idClient'] = $this->input->post('idClient');
            $this->Franchisee_Model->deleteClient($data['idClient']);
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        function getParentClient()
        {
            $franchiseeId = $this->input->post('franchiseeId');
            $clientType = $this->input->post('clientType');
            if($clientType=='2')
            {
                $parentClient = $this->Franchisee_Model->getParentClientDetails(trim($franchiseeId));
            if(!empty($parentClient))
     	    {
            $result = "<div id=\"parentId\" class=\"form-group\">
                    <label class=\"col-md-3 control-label\">Parent Client</label>
                        <div class=\"col-md-5\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\">
                                    <i class=\"fa fa-user\"></i>
                                </span>
                                <select class=\"form-control required\" name=\"clientData[szParentId]\" id=\"szParentId\"    Placeholder=\"Client Type\" onfocus=\"remove_formError(this.id,\"true\")\">";
                                foreach ($parentClient as $parentClientData)
          	                {
             	                    $result .= "<option value='".$parentClientData['id']."'>".$parentClientData['szName']."</option>";
         	                }
         	                $result .= "</select>
                                </select>
                            </div>
                        </div>
                </div>";
        }
                echo $result;  
            }
            
     	         
  	}
        
        function viewClientDetailsData()
        {
           
            $idClient = $this->input->post('idClient');
            {
                $this->session->set_userdata('idClient',$idClient);
                echo "SUCCESS||||";
                echo "viewClientDetails";
            }
            
        }
         function viewClientDetails()
        {
            $is_user_login = is_user_login($this);

            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idClient = $this->session->userdata('idClient');
            $clientDetailsAray =$this->Franchisee_Model->viewClientDetails($idClient);
            $childClientDetailsAray =$this->Franchisee_Model->viewChildClientDetails($idClient);
            
            
            $data['idClient'] = $idClient;
            $data['clientDetailsAray'] = $clientDetailsAray;
            $data['childClientDetailsAray'] = $childClientDetailsAray;
            $data['szMetaTagTitle'] = "Client Details";
            $data['is_user_login'] = $is_user_login;
                   
                    
            $this->load->view('layout/admin_header',$data);
            $this->load->view('franchisee/clientDetails');
            $this->load->view('layout/admin_footer');
        }
        function editClientData()
        {
          
            $idClient = $this->input->post('idClient');
    
            if($idClient>0)
            {
                $this->session->set_userdata('idClient',$idClient);
                echo "SUCCESS||||";
                echo "editClient";
            }
            
        }
        
        public function editClient()
        {
       
            $countryAry = $this->Admin_Model->getCountries();
            $idClient = $this->session->userdata('idClient');
            
            if($idClient >0)
            {

                $data_validate = $this->input->post('clientData');
              
            
                if(empty($data_validate))
                {
                   
                    $userDataAry = $this->Franchisee_Model->getUserDetailsByEmailOrId('',$idClient);
             
                }
                else
                {
                    $userDataAry = $data_validate;
                }
                
                if($this->Franchisee_Model->validateFranchiseeData($data_validate,array(), $idClient))
                {
                    if($this->Franchisee_Model->updateClientDetails($idClient))
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong>Profile Update! </strong> User profile suucessfully updated.";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                        
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/franchisee/clientList");
                        die;
                    }
                }
                    $data['szMetaTagTitle'] = "Edit Client Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Edit Client Details"; 
                    $data['countryAry'] = $countryAry;
                    $data['validate'] = $validate;
                    $_POST['clientData'] = $userDataAry;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    
            $this->load->view('layout/admin_header',$data);
            $this->load->view('franchisee/editClient');
            $this->load->view('layout/admin_footer');
            
        }
}      
}      
?>