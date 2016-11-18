<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Franchisee_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Error_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Franchisee_Model');
        $this->load->model('StockMgt_Model');
    }

    public function index() {

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

    function addClientData() {

        $idfranchisee = $this->input->post('idfranchisee');
        $idclient = $this->input->post('idclient');
        $url = $this->input->post('url');
        $this->session->set_userdata('idfranchisee', $idfranchisee);
        $this->session->set_userdata('idclient', $idclient);

        $this->session->set_userdata('url', $url);


        echo "SUCCESS||||";
        echo "addClient";
    }

    function addClient() {
        $count = $this->Admin_Model->getnotification();
        $validate = $this->input->post('clientData');
        $flag = $this->session->userdata('flag');
        $countryAry = $this->Admin_Model->getCountries();
        $stateAry = $this->Admin_Model->getStatesByCountry(trim(Australia));
        $idfranchisee = $this->session->userdata('idfranchisee');
        $url = $this->session->userdata('url');
        $idclient = $this->session->userdata('idclient');

        $franchiseeAray = $this->Admin_Model->viewFranchiseeList();
        if (!empty($idclient)) {
            $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idclient);
            $data['clientDetailsAray'] = $franchiseeDetArr1;
        }
        if (!empty($idfranchisee)) {
            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idfranchisee);
            $data['franchiseeArr'] = $franchiseeDetArr;
        }
        if ($this->Admin_Model->validateClientData($validate)) {
            if ($this->Franchisee_Model->insertClientDetails($validate, $idfranchisee)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Client Info! </strong> Client added successfully.";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);

                ob_end_clean();
                $this->session->unset_userdata('idfranchisee');
                $this->session->unset_userdata('idclient');
                ob_end_clean();
                header("Location:" . __BASE_URL__ . $url);
            }
        }



        $data['pageName'] = "Client_Record";
        $data['szMetaTagTitle'] = "Add Client";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;
        $data['countryAry'] = $countryAry;
        $data['franchiseeAray'] = $franchiseeAray;
        $data['stateAry'] = $stateAry;
        $data['validate'] = $validate;
        $data['idfranchisee'] = $idfranchisee;
        $data['szParentId'] = $idclient;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;


        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/addClient');
        $this->load->view('layout/admin_footer');
    }

    function logout() {
        logout($this);
        ob_end_clean();
        header("Location:" . __BASE_URL__ . "/admin/admin_login");
        die();
    }

    function getStatesByCountryClient($szCountry = '') {

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

    function viewClientData() {

        $idfranchisee = $this->input->post('idfranchisee');
        {
            $this->session->set_userdata('idfranchisee', $idfranchisee);
            echo "SUCCESS||||";
            echo "clientList";
        }
    }

    function clientList() {
        $is_user_login = is_user_login($this);

        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

        $idfranchisee = $this->session->userdata('idfranchisee');
        $clientAray = $this->Franchisee_Model->viewClientList($idfranchisee, true);
        $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $idfranchisee);
        $count = $this->Admin_Model->getnotification();
        $frdata = array();

        foreach ($clientAray as $cldata) {
            $franchiseeDataArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $cldata['szCreatedBy']);
            array_push($frdata, $franchiseeDataArr);
        }


        $data['franchiseeArr'] = $franchiseeArr;
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

    public function deleteClientAlert() {
        $data['mode'] = '__DELETE_CLIENT_POPUP__';
        $data['idClient'] = $this->input->post('idClient');
        $url = $this->input->post('url');
        $this->session->set_userdata('url', $url);

        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function deleteClientConfirmation() {
        $data['url'] = $this->session->userdata('url');
        $data['mode'] = '__DELETE_CLIENT_CONFIRM__';
        $data['idClient'] = $this->input->post('idClient');
        $this->Franchisee_Model->deleteClient($data['idClient']);
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    function getParentClient() {
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

    function viewClientDetailsData() {

        $idClient = $this->input->post('idClient');
        {
            $this->session->set_userdata('idClient', $idClient);
            echo "SUCCESS||||";
            echo "viewClientDetails";
        }
    }

    function viewClientDetails() {
        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        $idClient = $this->session->userdata('idClient');
        $clientDetailsAray = $this->Franchisee_Model->viewClientDetails($idClient);
        $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($idClient);
        $clientFranchiseeArr = $this->Franchisee_Model->getClientFranchisee($idClient);


//            $frdata = array();
//             $UpdatedBy= array();
//            foreach ($childClientDetailsAray as $cldata){
//               $franchiseeDataArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$cldata['szCreatedBy']);
//                array_push($frdata, $franchiseeDataArr);
//                 if(!empty($cldata['szLastUpdatedBy'])){
//                    $updateByDataArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$cldata['szLastUpdatedBy']);
//                    array_push($UpdatedBy, $updateByDataArr);
//            }
//            }
        if ($clientDetailsAray['clientType'] > 0) {
            $parentClientDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientDetailsAray['clientType']);
            $data['ParentOfChild'] = $parentClientDetArr;
        }
        if (!empty($clientFranchiseeArr)) {
            $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $clientFranchiseeArr[0]['franchiseeId']);
            $data['franchiseeArr'] = $franchiseeDetArr;
        }
//            $data['updateByDataArr'] = $UpdatedBy; 
//            $data['franchiseeDataArr'] = $frdata;
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

    function editClientData() {
        $idClient = $this->input->post('idClient');
        $idfranchisee = $this->input->post('idfranchisee');
        $url = $this->input->post('url');


        if ($idClient > 0) {
            $this->session->set_userdata('idClient', $idClient);
            $this->session->set_userdata('idfranchisee', $idfranchisee);
            $this->session->set_userdata('url', $url);
            echo "SUCCESS||||";
            echo "editClient";
        }
    }

    public function editClient() {
        $count = $this->Admin_Model->getnotification();
        $countryAry = $this->Admin_Model->getCountries();
        $stateAry = $this->Admin_Model->getStatesByCountry(trim(Australia));
        $idClient = $this->session->userdata('idClient');
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


            if ($userDataAry['clientType'] !== '0') {
                $parentClient = $this->Franchisee_Model->getParentClientDetails(trim($idfranchisee));
            }
            if (empty($data_validate)) {

                $userDataAry = $this->Franchisee_Model->getUserDetailsByEmailOrId('', $idClient);
            } else {
                $userDataAry = $data_validate;
            }

            if ($this->Admin_Model->validateClientData($data_validate, array(), $idClient)) {
                if ($this->Franchisee_Model->updateClientDetails($idClient, $data_validate)) {


                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong>Client Info! </strong> Client details successfully updated.";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);

                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . $url);

                    die;
                }
            }


            $data['szMetaTagTitle'] = "Edit Client Details ";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Client_Record";
            $data['countryAry'] = $countryAry;
            $data['stateAry'] = $stateAry;
            $data['validate'] = $validate;
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

    function clientRecord() {
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
        $clientAray = $this->Franchisee_Model->getAllClientDetails(true, $franchiseId);
        $data['clientAry'] = $clientAray;
        $data['pageName'] = "Client_Record";
        $data['szMetaTagTitle'] = "Client Record";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('franchisee/clientRecord');
        $this->load->view('layout/admin_footer');
    }

}

?>
