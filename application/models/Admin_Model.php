<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Model extends Error_Model
{
    var $id;
    var $szName;
     var $start_time;
    var $szEmail;
    var $szPassword;
    var $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    function set_szEmail($value,$field=false,$message=false , $flag = true)
    {
        $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, "$field", "$message", false, false, $flag);
    }
  
     function set_start_time($value, $flag = true)
    {
        $this->data['start_time'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "start_time", "Preferred Start Time", false, false, $flag);
    }
    function set_specify_contact($value,$flag = true)
    {
        $this->data['specify_contact'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "specify_contact", "Specify Contact", false, false, $flag);
    }
    function set_szOldPassword($value)
    {
        $this->data['szOldPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szOldPassword", "Current Password", false, 32);
    }
    
    function set_szName($value,$field=false,$message=false, $flag = true)
    {
        $this->data['szName'] = $this->validateInput($value, __VLD_CASE_NAME__, $field, $message, false, false, $flag);
    }

      function set_szPassword($value,$flag=true)
    {
        $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szPassword", "Password", false, false, $flag);
    }
    function set_szClientType($value)
    {
        $this->data['szClientType'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szClientType", "Client Type", false, false, $flag);
    }
    function set_id($value,$flag=true)
    {
        $this->data['id'] = $this->validateInput( $value, __VLD_CASE_WHOLE_NUM__, "id", "Id", false, false, $flag );
    }

    function set_szConfirmPassword($value)
    {
        $this->data['szConfirmPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szConfirmPassword", "Confirm Password", false, 32);
    }
   
   function set_szContactNumber($value,$field=false,$message=false, $flag = true)
    {
        $this->data['szContactNumber'] = $this->validateInput($value, __VLD_CASE_PHONE2__,$field,$message, false, 10, $flag);
    }

  
//     function set_szMobile($value, $field=false,$message=false ,$flag = true)
//    {
//        $this->data['szmobile'] = $this->validateInput($value, __VLD_CASE_MOBILE_PHONE__,$field,$message, false, 10, $flag);
//    }
//  
    

    function set_szState($value, $flag = true)
    {
        $this->data['szState'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szState", "State", false, false, $flag);
    }

    function set_szCity($value, $flag = true)
    {
        $this->data['szCity'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szCity", "City", false, false, $flag);
    }

    function set_szZipCode($value, $flag = true)
    {
        $this->data['szZipCode'] = $this->validateInput($value,__VLD_CASE_DIGITS__, "szZipCode", "ZIP/Postal Code", 4,4, $flag);
    }
    function set_abn($value, $flag = true)
    {
           $this->data['abn'] = $this->validateInput($value,__VLD_CASE_DIGITS__, "abn", "ABN",11,11, $flag); 
        
    }

    function set_szAddress($value, $flag = true)
    {
        $this->data['szAddress'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szAddress", "Address", false, false, $flag);
    }
   function set_szNoOfSites($value, $flag = true)
    {
        $this->data['szNoOfSites'] = $this->validateInput($value, __VLD_CASE_NUMERIC__, "szNoOfSites", "No Of Sites", false, false, $flag);
    }
    function set_industry($value, $flag = true)
    {
        $this->data['industry'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "industry", "Industry", false, false, $flag);
    }
     function set_franchiseeId($value, $flag = true)
    {
        $this->data['franchiseeId'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "franchiseeId", "Franchisee", false, false, $flag);
    }
    
    function set_operationManagerId($value,$flag = true)
    {
        $this->data['operationManagerId'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "operationManagerId", "Operation Manager", false, false, $flag);
    }
    function set_test_count($value, $flag = true)
    {
        $this->data['test_count'] = $this->validateInput($value, __VLD_CASE_NUMERIC__, "test_count", "How many to test ?", false, false, $flag);
    }
     function set_site_people($value, $flag = true)
    {
        $this->data['site_people'] = $this->validateInput($value, __VLD_CASE_NUMERIC__, "site_people", "People on site", false, false, $flag);
    }
    function set_szReginalName($value, $flag = true)
    {
        $this->data['szReginalName'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szReginalName", "Reginal Name", false, false, $flag);
    }
    function validateUserData($data, $arExclude = array())
    {
        if (!empty($data)) {
            if (!in_array('szPassword', $arExclude)) {
                $this->set_szPassword(sanitize_all_html_input(trim($data['szPassword'])));

            }

            if (!in_array('szOldPassword', $arExclude)) {
                $this->set_szOldPassword(sanitize_all_html_input(trim($data['szOldPassword'])));

                if ($this->data['szOldPassword'] != '' && $this->error == false) {
                    $this->checkCurrentPasswordExists();
                }

            }
            if ($this->data['szPassword'] != '' && !isset($this->arErrorMessages['szPassword']) && sanitize_all_html_input(trim($data['szConfirmPassword'])) != '' && $this->data['szPassword'] != sanitize_all_html_input(trim($data['szConfirmPassword']))) {
                $this->addError("szConfirmPassword", "Confirm password does not match.");
            } else if (isset($data['szConfirmPassword']) && sanitize_all_html_input(trim($data['szConfirmPassword'])) == '') {
                $this->addError("szConfirmPassword", "Confirm password required.");
            }

            if ($this->error == true)
                return false;
            else
                return true;
        }
        return false;
    }
    public function checkCurrentPasswordExists()
    {
        $userData = $this->session->userdata('drugsafe_user');

        $this->data['id'] = (int)$userData['id'];

        $result = $this->db->get_where(__DBC_SCHEMATA_USERS__, array('szPassword' => encrypt($this->data['szOldPassword']), 'id' => (int)$this->data['id'], 'isDeleted !=' => '1'));

        if ($result->num_rows() > 0) {
            return true;
        } else {
            $this->addError("szOldPassword", "Current Password does not match.");
    }
    }

    public function adminLoginUser($validate)
    {
        $whereAry = array('szEmail' => $validate['szEmail'], 'szPassword' => encrypt($validate['szPassword']),'isDeleted=' => '0','iActive=' => '1');
        $this->db->select('id,szName,szEmail,szPassword,iRole');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            $adminAry['id'] = $row[0]['id'];
            $adminAry['szName'] = $row[0]['szName'];
            $adminAry['szEmail'] = $row[0]['szEmail'];
            $adminAry['iRole'] = $row[0]['iRole'];

            $this->session->set_userdata('drugsafe_user', $adminAry);

            return $row[0];
            } else {
            $this->addError("szPassword", "Invalid email or password.");
            return array();
        }

    }
    public function updateChangePassword()
    {

        $dataAry = array(
            'szPassword' => encrypt($this->data['szPassword']),
            'dtUpdatedOn' => date('Y-m-d H:i:s')
        );

        $whereAry = array('id ' => (int)$this->data['id']);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);


        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    function getCountries()
    {
        $this->db->select('name');
        $this->db->from(__DBC_SCHEMATA_COUNTRY__)
            ->where('id', '13');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getStatesByCountry($szCountryName)
    {
        $this->db->select('id');
        $this->db->from(__DBC_SCHEMATA_COUNTRY__);
        $this->db->where('name', $szCountryName);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();

            $this->db->select('name');
            $this->db->from(__DBC_SCHEMATA_STATE__);
            $this->db->where('country_id', $row[0]['id']);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }
        return false;
    }

    function validateUsersData($data, $arExclude = array(),$idUser = 0, $forgotpass = FALSE,$flag=0,$flag2=0)
    {
        if (!empty($data)) {
            if (!in_array('szName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),"szName","Name", true);
            if (!in_array('szEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail","Email Address" ,true);
            if (!in_array('szContactNumber', $arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),"szContactNumber","Contact Number", true);
            if($flag2 == 2){
            if (!in_array('abn', $arExclude)) $this->set_abn(sanitize_all_html_input(trim($data['abn'])), true);  
            }
            if($flag==1){
            if (!in_array('operationManagerId', $arExclude)) $this->set_operationManagerId(sanitize_all_html_input(trim($data['operationManagerId'])), true);  
            }
            if (!in_array('szState', $arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])), true);
            if (!in_array('szCity', $arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])), true);
            if (!in_array('szZipCode', $arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])), true);
            if (!in_array('szAddress', $arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])), true);
            //if (!in_array('szReginalName', $arExclude)) $this->set_szReginalName(sanitize_all_html_input(trim($data['szReginalName'])), true);
            if ($this->error == false && $this->data['szEmail'] != '') {


                if ($this->checkUserExists($data['szEmail'],$idUser)) {
                    if ($forgotpass) {
                        return TRUE;
                    } else {
                        $this->addError('szEmail', "Someone already registered with entered email address.");
                        return false;
                    }
                }
            }
            if ($this->error == true) {
                return false;
            } else {
                return true;
            }
            return false;
        }
    }
   
    

    /*----------------------------ADMIN RELATED FUNCTIONS-------------------------------------------*/

    /*
    * Check Admin Account Expire Or Inactive
    */

 
    public function checkUserExists($szEmail = false, $id = 0)
    {

        $szEmail = trim($szEmail);

        $user_session = $this->session->userdata('drugsafe_user');

        if ((empty($szEmail)) && (!empty($user_session))) {
            $user_session = $this->session->userdata('drugsafe_user');
            $szEmail = $user_session['szEmail'];

        }

        if ((int)$id > 0) {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__, array('szEmail' => $szEmail, 'id !=' => (int)$id, 'isDeleted !=' => '1'));
        } else {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__, array('szEmail' => $szEmail, 'isDeleted !=' => '1'));
        }

        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    }
      public function checkBusinessNameExists($szBusinessName = false, $idClient = 0,$flag='0')
    {
        $szBusinessName = trim($szBusinessName);

    
        if ((int)$idClient > 0) {
            if($flag==1){
                $result = $this->db->get_where(__DBC_SCHEMATA_CLIENT__, array('szBusinessName' => $szBusinessName,'agentId!=' => (int)$idClient));  
            }
            else{
                  $result = $this->db->get_where(__DBC_SCHEMATA_CLIENT__, array('szBusinessName' => $szBusinessName,'clientId!=' => (int)$idClient));
            }
          
        } else {
            $result = $this->db->get_where(__DBC_SCHEMATA_CLIENT__, array('szBusinessName' => $szBusinessName));
        }

        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    }
     public function checkCompanyNameExists($szCompanyName = false, $idClient = 0)
    {
        $szCompanyName = trim($szCompanyName);

    
        if ((int)$idClient > 0) {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__, array('szName' => $szCompanyName,'id!=' => (int)$idClient));
        } else {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__, array('szName' => $szCompanyName));
        }

        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function insertUserDetails($data,$id=0)
    {
        $szNewPassword = create_login_password();
        if(!empty($data['abn'])){
           $abn = $data['abn'];  
        }
        else{
          $abn = '';     
        }
        
        $reginolDataAry =array(
             'stateId'=> $data['szState'],
             'reginolCode'=> $data['reginolCode'],
             'reginolName'=> $data['szReginalName']
         );
         $query=$this->db->insert(__DBC_SCHEMATA_REGINOL__, $reginolDataAry);
        
 
        if ($this->db->affected_rows() > 0) {
            $reginolId=$this->db->insert_id();
            $date = date('Y-m-d');
            $dataAry = array(
            'szName' => $data['szName'],
            'abn' => $abn,
            'szEmail' => $data['szEmail'],
            'szPassword' => encrypt($szNewPassword),
            'szContactNumber' => $data['szContactNumber'],
            'szCountry' => $data['szCountry'],
            'szCity' => $data['szCity'],
            'userCode' => $data['reginolCode'],
            'reginolId' => $reginolId,
            'szZipCode' => $data['szZipCode'],
            'szAddress' => $data['szAddress'],
            'iRole' => $data['iRole'],
            'iActive' => '1',
            'dtCreatedOn' => $date
        );
        $query=$this->db->insert(__DBC_SCHEMATA_USERS__, $dataAry);
            
            if($data['iRole']==2){
            $id_franchisee = (int)$this->db->insert_id();
            $franchiseeAry=array(
            'franchiseeId' => $id_franchisee,
            'operationManagerId' => $data['operationManagerId'],
            );
            $this->db->insert(__DBC_SCHEMATA_FRANCHISEE__, $franchiseeAry);
         }
            $id_player = (int)$id_franchisee;
            $replace_ary = array();
            $replace_ary['szName'] = $data['szName'];
            $replace_ary['szEmail'] = $data['szEmail'];
            $replace_ary['szPassword'] = $szNewPassword;
            $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
            $replace_ary['Link'] = __BASE_URL__ . "/admin/admin_login";
           if($data['iRole']==2){
            createEmail($this, '__ADD_NEW_FRANCHISEE__', $replace_ary, $data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__, $id_player, __CUSTOMER_SUPPORT_EMAIL__);
            
           }
           if($data['iRole']==5){
             createEmail($this, '__ADD_NEW_OPERATION_MANAGER__', $replace_ary, $data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__, $id_player, __CUSTOMER_SUPPORT_EMAIL__);
           }
           
            return true;
        } else {
            return false;
        }

    }

    public function viewFranchiseeList($searchAry='',$operationManagerId=0, $limit = __PAGINATION_RECORD_LIMIT__, $offset = 0,$id=0,$name='',$email='',$opId='')
    {
     
       if(!empty($operationManagerId)){
          $whereAry = array('operationManagerId=' => $operationManagerId,'isDeleted=' => '0', 'iRole' => '2');  
       }
       else{
           $whereAry = array('isDeleted=' => '0', 'iRole' => '2');
       }
        $searchq = '';
        if($id > '0'){
            $searchq = 'franchiseeId = '.(int)$id;
        }
        if(!empty($name)){
            $searchq = "szName LIKE '%$name%'";
        }
        if(!empty($email)){
            $searchq = "szEmail LIKE '%$email%'";
        } if(!empty($opId)){
            $searchq = "operationManagerId LIKE '%$opId%'";
        }
        

            $this->db->select('*');
            $this->db->from('tbl_franchisee');
            $this->db->join('ds_user', 'tbl_franchisee.franchiseeId = ds_user.id');
            
        if (!empty($searchq)) {
            $whereAry = array('isDeleted=' => '0', 'iRole' => '2');
            $this->db->where($searchq);
        } else {
            $this->db->where($whereAry);
        }

        $this->db->order_by($sortBy, $orderBy);
        $this->db->limit($limit, $offset);
        $this->db->order_by("franchiseeId", "asc");
        $query = $this->db->get();
//$sql = $this->db->last_query($query);
//print_r($sql);die;
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function getoperationManagerId($id = 0)
    {
        $whereAry = array('franchiseeId' => $this->sql_real_escape_string(trim($id)));
      
        $this->db->select('operationManagerId');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_FRANCHISEE__);
//$sql = $this->db->last_query($query);
//print_r($sql);die;
        if ($query->num_rows() > 0) {
           $row = $query->result_array();
            return $row[0];
        } else {
           return array();
        }
   }


     public function viewOperationManagerList($searchAry='', $limit = __PAGINATION_RECORD_LIMIT__, $offset = 0,$id=0,$name='',$email='')
    {
        $searchAry = trim($searchAry);
        $searchDataAry= explode("-",$searchAry) ;
        $searchDataAry[0] = strtolower($searchDataAry[0]);
       if($searchDataAry[0]=='om'){
           $search=$searchDataAry[1];
       }
       else{
           $search=$searchDataAry[0];
       }
        $whereAry = array('isDeleted=' => '0', 'iRole' => '5');
                $searchq = '';
        if($id > '0'){
            $searchq = 'id = '.(int)$id;
        }
        if(!empty($name)){
            $searchq = "szName LIKE '%$name%'";
        }
        if(!empty($email)){
            $searchq = "szEmail LIKE '%$email%'";
        }
        $this->db->select('*');
       if (!empty($searchq)) {
            $whereAry = array('isDeleted=' => '0', 'iRole' => '5');
            $this->db->where($searchq);

        } else {
            $this->db->where($whereAry);
        }

        $this->db->order_by($sortBy, $orderBy);
        $this->db->limit($limit, $offset);
        $this->db->order_by("id", "asc");
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);

//$sql = $this->db->last_query($query);
//print_r($sql);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function checkPasswordRecoveryExist($passwordKey)
    {
        $passwordKey = $this->sql_real_escape_string(trim($passwordKey));
        $this->db->select('szRecoveryPassword');
        $this->db->where('szRecoveryPassword =', $passwordKey);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function sendNewPasswordToAdmin($szEmail)
    {

        $adminDetailsAry = $this->getAdminDetailsByEmailOrId($szEmail);
        if (!empty($adminDetailsAry)) {
            $id = $adminDetailsAry['id'];

            $szNewPassword = create_login_password();
            $data = array(
                'szRecoveryPassword' => $szNewPassword
            );
            $whereAry = array('id' => $id);
            $this->db->where($whereAry);
            if ($this->db->update(__DBC_SCHEMATA_USERS__, $data)) {
                $replace_ary = array();
                $replace_ary['szName'] = 'Admin';
                $replace_ary['szEmail'] = $szEmail;
                $replace_ary['id'] = $id;
                $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                $confirmationLink = __BASE_URL__ . "/admin/adminPassword_Recover/" . $szNewPassword;
                $replace_ary['szLink'] = "<a href='" . $confirmationLink . "'>CLICK HERE TO CHANGE PASSWORD.</a>";
                $replace_ary['szHttpsLink'] = $confirmationLink;
                createEmail($this, '__USER_FORGOT_PASSWORD__', $replace_ary, $szEmail, '', __CUSTOMER_SUPPORT_EMAIL__, $id_admin, __CUSTOMER_SUPPORT_EMAIL__);
                return true;
            }
        } else {
            return false;
        }
    }

    public function getAdminDetailsByEmailOrId($szEmail = '', $id = 0)
    {

        if ((int)$id > 0 && empty($szEmail)) {
            $whereAry = array('id' => (int)$id);
        } else if ((int)$id == 0 && !empty($szEmail)) {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)));
        } else if ((int)$id > 0 && !empty($szEmail)) {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)), 'id' => (int)$id);
        }

        $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    /**
     * @param $passwordKey
     * @param array $dataArr
     * @return bool
     */
    public function updateAdminPassword($passwordKey, $dataArr = array())
    {

        $dataAry = array(
            'szPassword' => encrypt($dataArr['szPassword']),
            'dtUpdatedOn' => date('Y-m-d H:i:s'),
            'szRecoveryPassword' => ''
        );

        $whereAry = array('szRecoveryPassword' => $passwordKey);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function getEmailTemplateDetailsByTitle($szTitle)
    {
        // print_r($szTitle);
        $whereAry = array('sectionTitle' => $szTitle);
        $this->db->select('subject,sectionDescription');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_EMAIL_CMS__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    public function logEmails($logDataAry)
    {
        if ($query = $this->db->insert(__DBC_SCHEMATA_USERS_EMAIL_LOG__, $logDataAry)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getUserDetailsByEmailOrId($szEmail = '', $id = 0)
    {
        if ((int)$id > 0 && empty($szEmail)) {
            $whereAry = array('id' => (int)$id);
        } else if ((int)$id == 0 && !empty($szEmail)) {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)));
        } else if ((int)$id > 0 && !empty($szEmail)) {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)), 'id' => (int)$id);
        }


        $this->db->select('*');
        $this->db->where($whereAry);

        $query = $this->db->get(__DBC_SCHEMATA_USERS__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    /*
  * Get User Details By Email or Id
  */

    public function updateUsersDetails($data,$id = 0)
    {
        $ReginolData=array(
           'reginolCode'=>$data['reginolCode'],
           'stateId'=>$data['szState'],
           'reginolName'=>$data['szReginalName']
        );
         $this->db->where('id',$data['reginolid']);
        $queyUpdate=$this->db->update(__DBC_SCHEMATA_REGINOL__, $ReginolData);
        
            if ($queyUpdate) {
                
                $date = date('Y-m-d');
        $dataAry = array(

            'szName' => $data['szName'],
            'szEmail' => $data['szEmail'],
              'abn' => $data['abn'],
            'szContactNumber' => $data['szContactNumber'],
            'szCountry' => $data['szCountry'],
            'szCity' => $data['szCity'],
            'szZipCode' => $data['szZipCode'],
            'szAddress' => $data['szAddress'],
            'iRole' => $data['iRole'],
            'dtUpdatedOn' => $date
        );

        if ($id> 0) {
            $whereAry = array('id' => (int)$id);

            $this->db->where($whereAry);

            $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);
                 $OmAry=array(
                
                'operationManagerId' => $data['operationManagerId'],
                   );
                $whereAry = array('franchiseeId' => (int)$id);
                $this->db->where($whereAry);
                $this->db->update(__DBC_SCHEMATA_FRANCHISEE__, $OmAry);
                 return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deletefranchisee($idfranchisee)
    {
       $clientAray = $this->Franchisee_Model->viewClientList(false,$idfranchisee, true, false, false);
        if (!empty($clientAray)) {
            foreach ($clientAray as $clientlist) {
                $this->Franchisee_Model->deleteClient($clientlist['id']);
            }

        }

        $data = $this->input->post('idfranchisee');
        $dataAry = array(
            'isDeleted' => '1'
        );
        $this->db->where('id', $idfranchisee);
        if ($query = $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry)) {
            return true;
        } else {
            return false;
        }
    }
       public function deleteOperationManagerDetails($idOperationManager)
    {
        $franchiseeAray = $this->Admin_Model->viewFranchiseeList(false,$idOperationManager); 
        if (!empty($franchiseeAray)) {
            foreach ($franchiseeAray as $franchiseelist) {
                $this->deletefranchisee($franchiseelist['id']);
            }

        }
        $dataAry = array(
            'isDeleted' => '1'
        );
        $this->db->where('id', $idOperationManager);
        if ($query = $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry)) {
            return true;
        } else {
            return false;
        }
    }


    public function deletemodelStockValue($idfranchisee)
    {
        $this->db->where('iFranchiseeId', $idfranchisee);
        if ($query = $this->db->delete(__DBC_SCHEMATA_MODEL_STOCK_VALUE__)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProductStockQuantity($idfranchisee)
    {
        $this->db->where('iFranchiseeId', $idfranchisee);
        if ($query = $this->db->delete(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__)) {
            return true;
        } else {
            return false;
        }
    }

    function validateParentClientData($data, $arExclude = array(), $idClient=0)
  {
        if (!empty($data)) {
            if (!in_array('szBusinessName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szBusinessName'])),"szBusinessName","Business Name",true);
            if (!in_array('abn', $arExclude)) $this->set_abn(sanitize_all_html_input(trim($data['abn'])), true);
            if (!in_array('szName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),"szName","Contact Name", true);
            if (!in_array('szEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail","Primary Email address", true);
            if (!in_array('szContactNumber', $arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),"szContactNumber","Primary Phone Number", true);
            if (!in_array('szContactEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szContactEmail'])),"szContactEmail","Contact Email address", false);
            if (!in_array('szContactPhone', $arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactPhone'])),"szContactPhone"," Contact Phone Number", false);
            if (!in_array('szContactMobile', $arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactMobile'])),"szContactMobile","Contact Mobile Number", false);
            if (!in_array('szState', $arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])), true);
            if (!in_array('szCity', $arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])), true);
            if (!in_array('szZipCode', $arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])), true);
            if (!in_array('szAddress', $arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])), true);
            if(!in_array('franchiseeId',$arExclude)) $this->set_franchiseeId(sanitize_all_html_input(trim($data['franchiseeId'])),true);
            if(!in_array('operationManagerId',$arExclude)) $this->set_operationManagerId(sanitize_all_html_input(trim($data['operationManagerId'])),true);
             if(!in_array('szNoOfSites',$arExclude)) $this->set_szNoOfSites(sanitize_all_html_input(trim($data['szNoOfSites'])),true);
             if(!in_array('industry',$arExclude)) $this->set_industry(sanitize_all_html_input(trim($data['industry'])),true);
          
            if($this->error == false )
            {
                 if ($this->checkUserExists($data['szEmail'], $idClient)) {
                    $this->addError('szEmail', "Someone already registered with entered email address.");
                    return false;
                }
                if ($this->checkBusinessNameExists($data['szBusinessName'],$idClient)) {
                    $this->addError('szBusinessName', "Business Name must be unique.");
                    return false;
                }
                if ($this->data['szNoOfSites'] < $data['szOldNoOfSites']) {
                $this->addError('szNoOfSites', "No Of Sites must be greater than or equal to Previous no of sites");
                return false;
                }
            }
            
           
            if ($this->error == true)
                return false;
            else
                return true;
        }
        return false;
    
  }
     function validateAdminData($data, $arExclude = array())
    {
        if (!empty($data)) {
            if (!in_array('szEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail"," Email address", true);
            if (!in_array('szPassword', $arExclude)) $this->set_szPassword(sanitize_all_html_input(trim($data['szPassword'])), true);
            
          if ($this->error == false && $this->data['szEmail'] != '' || $this->data['szPassword'] != '')
         {
        $this->db->select('iRole,iActive,isDeleted');

        $this->db->from(__DBC_SCHEMATA_USERS__);

        $this->db->where('szEmail =', $data['szEmail']);


        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ((int)$row['iRole'] == 3) {
             $this->addError('szEmail', "Invalid EmailId or Password.");
                        return false;
            } 
//            elseif ((int)$row['iActive'] == 0) {
//                $this->addError("szEmail", "Your account is inactive.");
//            }
//            else if ((int)$row['isDeleted'] == 1) {
//                $this->addError("szEmail", "Your account is deleted.");
//            }
        } 

    } 
            if ($this->error == true)
                return false;
            else
                return true;
        }
        return false;
    }
    public function checkAdminAccountStatus($szEmail = '')
    {
        //echo $szEmail;
        if (trim($szEmail) == '') {
            $szEmail = $this->data['szEmail'];
        } else {
            $szEmail = $this->sql_real_escape_string(trim($szEmail));
        }
        $this->load->library('form_validation');

        $this->db->select('iRole,iActive,isDeleted');
        $this->db->from(__DBC_SCHEMATA_USERS__);
        $this->db->where('szEmail =', $szEmail);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ((int)$row['iActive'] == 0) {
                $this->addError('szEmail', "Your account is inactive.");
                $this->form_validation->set_rules('drugSafeForgotPassword[szEmail]', '');

            } else if ((int)$row['isDeleted'] == 1) {
             $this->addError('szEmail', "Your account is deleted.");
                

            }
        } else {
               $this->addError('szEmail', "This email address is not registered with Drug Safe.");
              

        }

        if ($this->error == true)
            return false;
        else
            return true;
    }

    public function getnotification()
    {
        if($_SESSION['drugsafe_user']['iRole']==1){
        $frReqQtyAray = $this->StockMgt_Model->getQtyRequestFrId(false, false);
       }
       else {
           
        $operationManagerId = $_SESSION['drugsafe_user']['id'];
        $franchiseeAray =$this->Admin_Model->viewFranchiseeList(false,$operationManagerId);
        $frReqQtyAray = array();
        $i=0;
        foreach ($franchiseeAray as $franchiseeData) {
        $frReqQtyAray[$i] =$this->StockMgt_Model->getQtyRequestFrIdByOpId($franchiseeData['franchiseeId']);
        $i++;
            }
        $frReqQtyAray = array_filter($frReqQtyAray);  
        }

        $count = 0;
        foreach ($frReqQtyAray as $frReqQtyData) {

            $count++;

        }

        return $count;
    }
      function validateClientData($data, $arExclude=array(),$idClient=0)
        {
            if(!empty($data))
            {
                if (!in_array('szName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),"szName"," Company Name",true);
                if(!in_array('per_form_complete',$arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['per_form_complete'])),"per_form_complete","Name of Person Completing Form",true);
                if(!in_array('szEmail',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail","Company Email",true);
                if(!in_array('szContactNumber',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),"szContactNumber","Company Phone Number",true);
               
                if(!in_array('szState',$arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])),true);
                if(!in_array('szCity',$arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])),true);
                if(!in_array('szZipCode',$arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])),true);
                if(!in_array('szAddress',$arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])),true);
                if (!in_array('sp_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['sp_name'])),"sp_name","Contact Name", true);
                if(!in_array('sp_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['sp_mobile'])),"sp_mobile","Contact Phone Number",true);
                if(!in_array('sp_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['sp_email'])),"sp_email"," Contact Email",true); 
                 if(!empty($data['iis_name']) || !empty($data['iis_mobile']) ||  !empty($data['iis_email'] )){
               if (!in_array('iis_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['iis_name'])),"iis_name","Contact Name", true);
                if(!in_array('iis_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['iis_mobile'])),"iis_mobile","Contact Phone Number",true);
                if(!in_array('iis_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['iis_email'])),"iis_email","Contact Email",true);              
                }
                else{
                if (!in_array('iis_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['iis_name'])),"iis_name","Contact Name", false);
                if(!in_array('iis_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['iis_mobile'])),"iis_mobile","Contact Phone Number",false);
                if(!in_array('iis_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['iis_email'])),"iis_email","Contact Email",false); 
                }
                if (!in_array('rlr_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['rlr_name'])),"rlr_name" ,"Contact Name", true);
                if(!in_array('rlr_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['rlr_mobile'])),"rlr_mobile","Contact Phone Number",true);
                if(!in_array('rlr_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['rlr_email'])),"rlr_email"," Contact Email",true);  
                 if(!empty($data['orlr_name']) || !empty($data['orlr_mobile']) ||  !empty($data['orlr_email'] )){
                if (!in_array('orlr_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['orlr_name'])),"orlr_name","Contact Name", true);
                if(!in_array('orlr_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['orlr_mobile'])),"orlr_mobile","Contact Phone Number",true);
                if(!in_array('orlr_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['orlr_email'])),"orlr_email"," Contact Email",true);   
                }
                else{
                if (!in_array('orlr_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['orlr_name'])),"orlr_name","Contact Name", false);
                if(!in_array('orlr_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['orlr_mobile'])),"orlr_mobile","Contact Phone Number",false);
                if(!in_array('orlr_email',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['orlr_email'])),"orlr_email"," Contact Email",false);   
                }
                if (!in_array('psc_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['psc_name'])),"psc_name","Contact Name", true);
                if(!in_array('psc_phone',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['psc_phone'])),"psc_phone","Landline Phone Number",true);
                if(!in_array('psc_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['psc_mobile'])),"psc_mobile","Mobile Phone Number",true);
                if(!empty($data['ssc_name']) || !empty($data['ssc_phone']) ||  !empty($data['ssc_mobile'] )){
                if(!in_array('ssc_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['ssc_name'])),"ssc_name","Contact Name",true);
                if(!in_array('ssc_phone',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['ssc_phone'])),"ssc_phone","Landline Phone Number",true);
                if(!in_array('ssc_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['ssc_mobile'])),"ssc_mobile","Mobile Phone Number",true);
                }
                else{
                    if(!in_array('ssc_name', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['ssc_name'])),"ssc_name","Contact Name",false);
                if(!in_array('ssc_phone',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['ssc_phone'])),"ssc_phone","Landline Phone Number",false);
                if(!in_array('ssc_mobile',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['ssc_mobile'])),"ssc_mobile","Mobile Phone Number",false);  
                }
                if (!in_array('site_people', $arExclude)) $this->set_site_people(sanitize_all_html_input(trim($data['site_people'])), true);
                if(!in_array('test_count',$arExclude)) $this->set_test_count(sanitize_all_html_input(trim($data['test_count'])),true);
                if (!in_array('start_time', $arExclude)) $this->set_start_time(sanitize_all_html_input(trim($data['start_time'])), true);
               
                if($data['paperwork']==2){
                if(!in_array('specify_contact',$arExclude)) $this->set_specify_contact(sanitize_all_html_input(trim($data['specify_contact'])),true);   
                }
                 if($this->error == false )
            { 
                    $adminData = $this->session->userdata('drugsafe_user');
                    $this->data['id'] = $idClient;
                 if ($this->checkUserExists($data['szEmail'],$this->data['id'])) {
                    $this->addError('szEmail', "Someone already registered with entered email address.");
                    return false;
                }
                if ($this->checkCompanyNameExists($data['szName'],$this->data['id'])) {
                    $this->addError('szName', "Company Name must be unique.");
                    return false;
                }
                if ($this->data['site_people'] < $data['test_count']) {
                $this->addError('test_count', "The test count can not be more than the no of people on site.");
                return false;
                }
            }
                
            if($this->error == true)
            { 
            return false;
            
            }
                else{
                return true;}
            }
            return false;
        }
        
       
   function validateAgentData($data, $arExclude=array(),$idAgent='0')
  {
        if (!empty($data)) {
            if (!in_array('szBusinessName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szBusinessName'])),"szBusinessName","Business Name",true);
           if (!in_array('abn', $arExclude)) $this->set_abn(sanitize_all_html_input(trim($data['abn'])), true);
            if (!in_array('szName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),"szName","Contact Name", true);
            if (!in_array('szEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail","Primary Email address", true);
            if (!in_array('szContactNumber', $arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),"szContactNumber","Primary Phone Number", true);
            if (!in_array('szState', $arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])), true);
            if (!in_array('szCity', $arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])), true);
            if (!in_array('szZipCode', $arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])), true);
            if (!in_array('szAddress', $arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])), true);
             if(!in_array('industry',$arExclude)) $this->set_industry(sanitize_all_html_input(trim($data['industry'])),true);
          
            if($this->error == false )
            {
                 if ($this->checkUserExists($data['szEmail'], $idAgent)) {
                    $this->addError('szEmail', "Someone already registered with entered email address.");
                    return false;
                }
                if ($this->checkBusinessNameExists($data['szBusinessName'],$idAgent,1)) {
                  
                    $this->addError('szBusinessName', "Business Name must be unique.");
                    return false;
                }
                
            }
            
           
            if ($this->error == true)
                return false;
            else
                return true;
        }
        return false;
    
  }
    public function viewAllIndustryList()
    {
        $this->db->select('id,szName');
        $query = $this->db->get(__DBC_SCHEMATA_INDUSTRIES__);

        if ($query->num_rows() > 0) {
           return $query->result_array();
          
        } else {
           return array();
        }
   } 
    public function getIndustryNameByid($id)
    {
        $this->db->select('szName');
        $this->db->where('id',$id);
        $query = $this->db->get(__DBC_SCHEMATA_INDUSTRIES__);
       
         //echo $sql = $this->db->last_query();die();

        if ($query->num_rows() > 0) {
           $row = $query->result_array();
            return $row[0];
          
        } else {
           return array();
        }
   } 
    public function getRegionCode($stateId)
    {
        $this->db->select('*');
        $this->db->where('stateId',$stateId);
         $this->db->select_max('regionCode', 'regionCodeMax');
        $query = $this->db->get(__DBC_SCHEMATA_REGION__);
        //$sql=$this->db->last_query();
        if ($query->num_rows() > 0) {
           $row = $query->result_array();
            return $row[0];
          
        } else {
           return array();
        }
   } 
    public function getstateIdByResinolId($resinolId)
    {
        $this->db->select('*');
        $this->db->where('id',$resinolId);
        $query = $this->db->get(__DBC_SCHEMATA_REGINOL__);
        //$sql=$this->db->last_query();
        if ($query->num_rows() > 0) {
           $row = $query->result_array();
            return $row[0];
          
        } else {
           return array();
        }
   } 
    function getAllStateByCountryId($countryId)
    {
        $this->db->select('*');
        $this->db->where('country_id',$countryId);
        $query = $this->db->get(__DBC_SCHEMATA_STATE__);
        //echo $sql=$this->db->last_query();die();
        if ($query->num_rows() > 0) {
           $row = $query->result_array();
            return $row;
          
        } else {
           return array();
        }
   } 
    function insertOpertionDetails($data,$id=0)
    {
        $szNewPassword = create_login_password();
        if(!empty($data['abn'])){
           $abn = $data['abn'];  
        }
        else{
          $abn = '';     
        }
        $date = date('Y-m-d');
            $dataAry = array(
            'szName' => $data['szName'],
            'abn' => $abn,
            'szEmail' => $data['szEmail'],
            'szPassword' => encrypt($szNewPassword),
            'szContactNumber' => $data['szContactNumber'],
            'szCountry' => $data['szCountry'],
            'szCity' => $data['szCity'],
            'szZipCode' => $data['szZipCode'],
            'szAddress' => $data['szAddress'],
            'iRole' => $data['iRole'],
            'iActive' => '1',
            'dtCreatedOn' => $date
        );
        $query=$this->db->insert(__DBC_SCHEMATA_USERS__, $dataAry);
       
        
 
        if ($this->db->affected_rows() > 0) {
            $operationalId=$this->db->insert_id();
             $operationalDataAry =array(
             'stateId'=> $data['szState'],
             'operationId'=> $operationalId
         );
         $query=$this->db->insert(__DBC_SCHEMATA_OPERATION_STATE_MAPING__, $operationalDataAry);
            
            
            if($data['iRole']==2){
            $id_franchisee = (int)$this->db->insert_id();
            $franchiseeAry=array(
            'franchiseeId' => $id_franchisee,
            'operationManagerId' => $data['operationManagerId'],
            );
            $this->db->insert(__DBC_SCHEMATA_FRANCHISEE__, $franchiseeAry);
         }
            $id_player = (int)$id_franchisee;
            $replace_ary = array();
            $replace_ary['szName'] = $data['szName'];
            $replace_ary['szEmail'] = $data['szEmail'];
            $replace_ary['szPassword'] = $szNewPassword;
            $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
            $replace_ary['Link'] = __BASE_URL__ . "/admin/admin_login";
           if($data['iRole']==2){
            createEmail($this, '__ADD_NEW_FRANCHISEE__', $replace_ary, $data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__, $id_player, __CUSTOMER_SUPPORT_EMAIL__);
            
           }
           if($data['iRole']==5){
             createEmail($this, '__ADD_NEW_OPERATION_MANAGER__', $replace_ary, $data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__, $id_player, __CUSTOMER_SUPPORT_EMAIL__);
           }
           
            return true;
        } else {
            return false;
        }

    }
     public function getStateByOperationid($operationId = 0)
    {
       
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_OPERATION_STATE_MAPING__);
        $this->db->where('operationId',$operationId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }
    public function updateOperationDetails($data,$id = 0)
    {
        $operationStateAry=array(
           'stateId'=>$data['szState']
        );
         $this->db->where('operationId',$id);
        $queyUpdate=$this->db->update(__DBC_SCHEMATA_OPERATION_STATE_MAPING__, $operationStateAry);
        
            if ($queyUpdate) {
                
                $date = date('Y-m-d');
        $dataAry = array(

            'szName' => $data['szName'],
            'szEmail' => $data['szEmail'],
            'abn' => $data['abn'],
            'szContactNumber' => $data['szContactNumber'],
            'szCountry' => $data['szCountry'],
            'szCity' => $data['szCity'],
            'szZipCode' => $data['szZipCode'],
            'szAddress' => $data['szAddress'],
            'iRole' => $data['iRole'],
            'dtUpdatedOn' => $date
        );

        if ($id> 0) {
            $whereAry = array('id' => (int)$id);

            $this->db->where($whereAry);

            $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);
                 $OmAry=array(
                
                'operationManagerId' => $data['operationManagerId'],
                   );
                $whereAry = array('franchiseeId' => (int)$id);
                $this->db->where($whereAry);
                $this->db->update(__DBC_SCHEMATA_FRANCHISEE__, $OmAry);
                 return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function insertRegion($data)
    {
         $regionAry=array(
           'stateId'=>$data['szState'],
           'regionCode'=>$data['iRegionCode'],
           'regionName'=>$data['szRegionName'],
        );
        
        if ($query = $this->db->insert(__DBC_SCHEMATA_REGION__, $regionAry)) {
            return true;
        } else {
            return false;
        }
    }
    function getAllRegion()
    {
        $query=$this->db->select('*')
                ->from(__DBC_SCHEMATA_STATE__)
                ->join(__DBC_SCHEMATA_REGION__, __DBC_SCHEMATA_REGION__ . '.stateId = ' . __DBC_SCHEMATA_STATE__ . '.id')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
            
  
        }?>