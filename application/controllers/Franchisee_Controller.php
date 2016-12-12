<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Franchisee_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Error_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Franchisee_Model');
        $this->load->library('pagination');
        $this->load->model('StockMgt_Model');
    }

    public function index()
    {

        $is_user_login = is_user_login($this);

        if ($is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/franchisee/dashboard");
            die;
        } else {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
    }

    public function dashboard()
    {

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
        $idclient = $this->input->post('idclient');
        $url = $this->input->post('url');
        $flag = $this->input->post('flag');
       
        $this->session->set_userdata('idfranchisee', $idfranchisee);
        $this->session->set_userdata('idclient', $idclient);
        $this->session->set_userdata('url', $url);
        $this->session->set_userdata('flag', $flag);

      
        echo "SUCCESS||||";
        echo "addClient";
    }

    function addClient()
    {
        
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

        
        $count = $this->Admin_Model->getnotification();
        $validate = $this->input->post('clientData');
    
    
        $idfranchisee = $this->session->userdata('idfranchisee');
        $url = $this->session->userdata('url');
        $flag = $this->session->userdata('flag');
        $idclient = $this->session->userdata('idclient');

        $franchiseeAray = $this->Admin_Model->viewFranchiseeList(false,false,false);
        if (!empty($idclient)) {
            $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idclient);
            $data['clientDetailsAray'] = $franchiseeDetArr1;
        }
        if (!empty($idfranchisee)) {
            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idfranchisee);
            $data['franchiseeArr'] = $franchiseeDetArr;
        }
        if(empty($idclient)){
        
            if ($this->Admin_Model->validateParentClientData($validate, array(), $idclient)) {
        
            if ($this->Franchisee_Model->insertClientDetails($validate, $idfranchisee)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Client Info! </strong> Client added successfully.";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);

                ob_end_clean();
                $this->session->unset_userdata('idfranchisee');
                $this->session->unset_userdata('idclient');
                $this->session->unset_userdata('flag');
                ob_end_clean();
                header("Location:" . __BASE_URL__ . $url);
            }
        }
        }
        else{
            
              if ($this->Admin_Model->validateClientData($validate, array(), $idclient)) {
                   $reqppearr = $this->input->post('req_ppe');
                   if(!empty($reqppearr)){
                   $reqppval = '';
        foreach ($reqppearr as $reqpp){
            $reqppval .= $reqpp.',';
        }
        $reqppval = substr($reqppval, 0,-1);
                   }
            if ($this->Franchisee_Model->insertClientDetails($validate, $idfranchisee,$reqppval)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Client Info! </strong> Client added successfully.";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);

                ob_end_clean();
                $this->session->unset_userdata('idfranchisee');
                $this->session->unset_userdata('idclient');
                $this->session->unset_userdata('flag');
                ob_end_clean();
                header("Location:" . __BASE_URL__ . $url);
            }
        }

        }
      
        $data['pageName'] = "Client_Record";
        $data['szMetaTagTitle'] = "Add Client";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;
        $data['franchiseeAray'] = $franchiseeAray;
        $data['validate'] = $validate;
        $data['idfranchisee'] = $idfranchisee;
        $data['flag'] = $flag;
        $data['szParentId'] = $idclient;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;

        $this->load->view('layout/admin_header', $data);
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

    function getStatesByCountryClient($szCountry = '')
    {

        if (trim($szCountry) != '') {
            $_POST['szCountry'] = $szCountry;
        }

        $stateAry = $this->Admin_Model->getStatesByCountry(trim($_POST['szCountry']));

        if (!empty($stateAry)) {
            $result = "<select class=\"form-control required\" id=\"szState\" name=\"clientData[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
            foreach ($stateAry as $stateDetails) {
                $result .= "<option value='" . $stateDetails['name'] . "'>" . $stateDetails['name'] . "</option>";
            }
            $result .= "</select>";
        } else {
            $result = "<input type=\"text\" class=\"form-control required\" id=\"szState\" name=\"clientData[szState]\" placeholder=\"State\" onfocus=\"remove_formError(this.id,'true')\">";
        }
        echo $result;
    }

    function viewClientData()
    {
        $idfranchisee = $this->input->post('idfranchisee');
        {
            $this->session->set_userdata('idfranchisee', $idfranchisee);
            echo "SUCCESS||||";
            echo "clientList";
        }
    }

    function clientList()
    {
        $is_user_login = is_user_login($this);

        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
         $idfranchisee = $this->session->userdata('idfranchisee');
         // handle pagination
         
          
      
      $searchAry = '';
        if(isset($_POST['szSearchClRecord']) && !empty($_POST['szSearchClRecord'])){
            $id = $_POST['szSearchClRecord'];
        }
        if(isset($_POST['szSearchClRecord1']) && !empty($_POST['szSearchClRecord1'])){
            $id = $_POST['szSearchClRecord1'];
        }
        if(isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])){
            $id = $_POST['szSearchClRecord2'];
        }
        
        $config['base_url'] = __BASE_URL__ . "/franchisee/clientList/";
        $config['total_rows'] = count($this->Franchisee_Model->viewClientList(true, $franchiseId,$limit,$offset,$searchAry,$id));
        $config['per_page'] = 5;


        $this->pagination->initialize($config);

     
        $clientAray = $this->Franchisee_Model->viewClientList(true,$idfranchisee,$config['per_page'],$this->uri->segment(3),$searchAry,$id);
        $clientlistArr = $this->Franchisee_Model->viewClientList(true,$idfranchisee);
    
        $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idfranchisee);
        $count = $this->Admin_Model->getnotification();
        $frdata = array();

        foreach ($clientAray as $cldata) {
            $franchiseeDataArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $cldata['szCreatedBy']);
            array_push($frdata, $franchiseeDataArr);
        }


        $data['franchiseeArr'] = $franchiseeArr;
        $data['clientlistArr'] = $clientlistArr;
        $data['franchiseeDataArr'] = $frdata;
        $data['idfranchisee'] = $idfranchisee;
        $data['clientAry'] = $clientAray;
        $data['pageName'] = "Client_Record";
        $data['szMetaTagTitle'] = "Client List";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/clientList');
        $this->load->view('layout/admin_footer');
    }

    public function deleteClientAlert()
    {
        $data['mode'] = '__DELETE_CLIENT_POPUP__';
        $data['idClient'] = $this->input->post('idClient');
        $url = $this->input->post('url');
        $this->session->set_userdata('url', $url);

        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function deleteClientConfirmation()
    {
        $data['url'] = $this->session->userdata('url');
        $data['mode'] = '__DELETE_CLIENT_CONFIRM__';
        $data['idClient'] = $this->input->post('idClient');
        $this->Franchisee_Model->deleteClient($data['idClient']);
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    function getParentClient()
    {
        $franchiseeId = $this->input->post('franchiseeId');
        $clientType = $this->input->post('clientType');
        if ($clientType == '1') {
            $parentClient = $this->Franchisee_Model->getParentClientDetails(trim($franchiseeId));
            if (!empty($parentClient)) {
                $result = "<div id=\"parentId\" class=\"form-group\">
                    <label class=\"col-md-3 control-label\">Parent Client</label>
                        <div class=\"col-md-5\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\">
                                    <i class=\"fa fa-user\"></i>
                                </span>
                                <select class=\"form-control required\" name=\"clientData[szParentId]\" id=\"szParentId\"    Placeholder=\"Client Type\" onfocus=\"remove_formError(this.id,\"true\")\">";
                foreach ($parentClient as $parentClientData) {
                    $result .= "<option value='" . $parentClientData['id'] . "'>" . $parentClientData['szName'] . "</option>";
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
            $this->session->set_userdata('idClient', $idClient);
            echo "SUCCESS||||";
            echo "viewClientDetails";
        }
    }

    function viewClientDetails()
    {
        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
         $idClient = $this->session->userdata('idClient');
         if(isset($_POST['szSearchClRecord']) && !empty($_POST['szSearchClRecord'])){
            $id = $_POST['szSearchClRecord'];
        }
        if(isset($_POST['szSearchClRecord1']) && !empty($_POST['szSearchClRecord1'])){
            $id = $_POST['szSearchClRecord1'];
        }
        if(isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])){
            $id = $_POST['szSearchClRecord2'];
        }
        $config['base_url'] = __BASE_URL__ . "/franchisee/viewClientDetails/";
         $config['total_rows'] = count( $this->Franchisee_Model->viewChildClientDetails($idClient,$limit,$offset,$searchAry,$id));
       
        $config['per_page'] = 5;


        $this->pagination->initialize($config);
       
        $clientDetailsAray = $this->Franchisee_Model->viewClientDetails($idClient);
        $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($idClient,$config['per_page'],$this->uri->segment(3),$searchAry,$id);
        $clientFranchiseeArr = $this->Franchisee_Model->getClientFranchisee($idClient);

        $sitesArr = $this->Franchisee_Model->viewChildClientDetails($idClient);
        if ($clientDetailsAray['clientType'] > 0) {
            $parentClientDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientDetailsAray['clientType']);
            $data['ParentOfChild'] = $parentClientDetArr;
        }
        if (!empty($clientFranchiseeArr)) {
            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientFranchiseeArr[0]['franchiseeId']);
            $data['franchiseeArr'] = $franchiseeDetArr;
        }

        $data['sitesArr'] = $sitesArr;
        $data['idClient'] = $idClient;
        $data['pageName'] = "Client_Record";
        $data['clientDetailsAray'] = $clientDetailsAray;
        $data['childClientDetailsAray'] = $childClientDetailsAray;
        $data['szMetaTagTitle'] = "Client Details";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/clientDetails');
        $this->load->view('layout/admin_footer');
    }

    function editClientData()
    {
        $idClient = $this->input->post('idClient');
        $idfranchisee = $this->input->post('idfranchisee');
        $url = $this->input->post('url');
        $flag = $this->input->post('flag');


        if ($idClient > 0) {
            $this->session->set_userdata('idClient', $idClient);
            $this->session->set_userdata('idfranchisee', $idfranchisee);
            $this->session->set_userdata('url', $url);
            $this->session->set_userdata('flag', $flag);
            echo "SUCCESS||||";
            echo "editClient";
        }
    }

    public function editClient()
    {
        $count = $this->Admin_Model->getnotification();
        $idClient = $this->session->userdata('idClient');
        $flag = $this->session->userdata('flag');
        $idfranchisee = $this->session->userdata('idfranchisee');
        $url = $this->session->userdata('url');
        $clientDetailsAray = $this->Franchisee_Model->viewClientDetails($idClient);
   
        if (!empty($clientDetailsAray['clientType'])) {
            $franchiseeDetArr2 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientDetailsAray['clientType']);
            $data['clientChildDetailsAray'] = $franchiseeDetArr2;
        }
        if (!empty($idClient)) {
            $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientDetailsAray['clientId']);
            $data['clientDetailsAray'] = $franchiseeDetArr1;
        }
        if (!empty($idfranchisee)) {
            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientDetailsAray['franchiseeId']);
            $data['franchiseeArr'] = $franchiseeDetArr;
        }
        if ($idClient > 0) {

            $data_validate = $this->input->post('clientData');
           
            if (empty($data_validate)) {
                if(empty($clientDetailsAray['clientType'])){
                $userDataAry = $this->Franchisee_Model->getUserDetailsByEmailOrId('', $idClient);}
                else{
                    $userDataAry = $this->Franchisee_Model->getSiteDetailsById($idClient);
                  
                }
                if ($userDataAry['clientType'] != '0') {
                    $parentClient = $this->Franchisee_Model->getParentClientDetails(trim($idfranchisee));
                }
            } else {
                $userDataAry = $data_validate;
            }
           if(empty($clientDetailsAray['clientType'])){
                if ($this->Admin_Model->validateParentClientData($data_validate, array(), $idClient)) {
            
                if ($this->Franchisee_Model->updateClientDetails($idClient, $userDataAry)) {


                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Client Info! </strong> Client details successfully updated.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . $url);

                    die;
                }
            } 
           }
           else{
                 if ($this->Admin_Model->validateClientData($data_validate, array(), $idClient)) {
                   $reqppearr = $this->input->post('req_ppe');
                   $reqppval = '';
                   foreach ($reqppearr as $reqpp){
                   $reqppval .= $reqpp.',';
                   }
                   $reqppval = substr($reqppval, 0,-1);
                   if ($this->Franchisee_Model->updateClientDetails($idClient, $userDataAry,$reqppval)) {


                    $szMessage['type'] = "success";
                    if($clientDetailsAray['clientType']!='0')
                    { 
                    $szMessage['content'] = "<strong>Site Info! </strong> Site details successfully updated.";}
                    else{
                    $szMessage['content'] = "<strong>Client Info! </strong> Client details successfully updated.";  
                    }
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                   
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . $url);

                    die;
                }
            }
           }
            if(!empty($clientDetailsAray['clientType'])){
             $req_ppe_ary = explode(",", $userDataAry['req_ppe']);
          
             $data['req_ppe_ary'] = $req_ppe_ary;  
            }
        

            $data['szMetaTagTitle'] = "Edit Client Details ";
            $data['pageName'] = "Client_Record";
            $data['flag'] = $flag;
//            $data['validate'] = $validate;
            $_POST['clientData'] = $userDataAry;
            
            $data['idfranchisee'] = $idfranchisee;
            $data['parentClient'] = $parentClient;
            $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
            $data['notification'] = $count;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('franchisee/editClient');
            $this->load->view('layout/admin_footer');
        }
    }

    function clientRecord()
    {
        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
            $franchiseId = $_SESSION['drugsafe_user']['id'];
        }
         if ($_SESSION['drugsafe_user']['iRole'] == '5') {
            $operationManagrrId = $_SESSION['drugsafe_user']['id'];
        
        }
        $searchAry = '';
        if(isset($_POST['szSearchClRecord']) && !empty($_POST['szSearchClRecord'])){
            $id = $_POST['szSearchClRecord'];
        }
        if(isset($_POST['szSearchClRecord1']) && !empty($_POST['szSearchClRecord1'])){
            $id = $_POST['szSearchClRecord1'];
        }
        if(isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])){
            $id = $_POST['szSearchClRecord2'];
        }
         // handle pagination
          
                $config['base_url'] = __BASE_URL__ . "/franchisee/clientRecord/";
                $config['total_rows'] = count($this->Franchisee_Model->getAllClientDetails(true, $franchiseId,$operationManagrrId,$limit,$offset,$searchAry,$id));
                $config['per_page'] = 5;
           
            
        $this->pagination->initialize($config);
      
        $clientAray = $this->Franchisee_Model->getAllClientDetails(true, $franchiseId,$operationManagrrId,$config['per_page'],$this->uri->segment(3),$searchAry,$id);
        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
             $clientlistArr = $this->Franchisee_Model->getAllClientDetails(true,$franchiseId);
        }
         if ($_SESSION['drugsafe_user']['iRole'] == '5') {
           $clientlistArr = $this->Franchisee_Model->getAllClientDetails(true,'',$operationManagrrId);
        
        }
        if ($_SESSION['drugsafe_user']['iRole'] == '1') {
           $clientlistArr = $this->Franchisee_Model->getAllClientDetails(true);
        
        }
        
        
        $data['clientAry'] = $clientAray;
        $data['clientlistArr'] = $clientlistArr;
        $data['pageName'] = "Client_Record";
        $data['szMetaTagTitle'] = "Client Record";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/clientRecord');
        $this->load->view('layout/admin_footer');
    }
     function viewFranchiseeData()
    {
        $idOperationManager = $this->input->post('idOperationManager');
        {
            $this->session->set_userdata('idOperationManager', $idOperationManager);
            echo "SUCCESS||||";
            echo "franchiseeRecord";
        }
    }

    function franchiseeRecord()
    {
        $is_user_login = is_user_login($this);

        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
         $searchAry = '';
            if(isset($_POST['szSearch']) && !empty($_POST['szSearch'])){
                $email = $_POST['szSearch'];
            }
            if(isset($_POST['szSearch1']) && !empty($_POST['szSearch1'])){
                $id = $_POST['szSearch1'];
            }
            if(isset($_POST['szSearch2']) && !empty($_POST['szSearch2'])){
                $name = $_POST['szSearch2'];
            }
         $idOperationManager = $this->session->userdata('idOperationManager');
         // handle pagination
        $searchAry = $_POST['szSearchClList'];
        $config['base_url'] = __BASE_URL__ . "/franchisee/franchiseeRecord/";
        $config['total_rows'] = count($this->Admin_Model->viewFranchiseeList($searchAry,$operationManagerAray['id'],false,false,$id,$name,$email));
        $config['per_page'] = 5;


        $this->pagination->initialize($config);
      
        $operationManagerAray = $this->Franchisee_Model->getOperationManagerDetailsById($idOperationManager);
        $franchiseeAray = $this->Admin_Model->viewFranchiseeList($searchAry,$operationManagerAray['id'], $config['per_page'],$this->uri->segment(3),$id,$name,$email);
        $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,$operationManagerAray['id']);
   
        $data['allfranchisee'] = $searchOptionArr;
        $data['operationManagerAray'] = $operationManagerAray;
        $data['franchiseeAray'] = $franchiseeAray;
//        $data['idOperationManager'] = $idOperationManager;
        $data['pageName'] = "Franchisee_Record";
        $data['szMetaTagTitle'] = "Franchisee List";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        
        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/franchiseeRecord');
        $this->load->view('layout/admin_footer');
       
    }
}
?>