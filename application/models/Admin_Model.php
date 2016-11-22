<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();
    
	public function __construct()
	{
		parent::__construct();
	}
        function set_szName($value,$flag=true)
        {
            $this->data['szName'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szName", "Name", false, false, $flag);
        }
        function set_szClientType($value)
        {
            $this->data['szClientType'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szClientType", "Client Type",false, false, $flag);
        }
        function set_szEmail($value,$flag=true)
        {
           $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, "szEmail", "Email address", false, false, $flag);
        }
        function set_szContactNumber($value,$flag=true)
        {
             if($value != '')
        {
            // strip all character except +, 0-9
            $value = preg_replace('/[^\d+]/i', '', $value);
//            if(strpos($value, "+") === false)
//            {
//                    if(strlen($value) == 10)
//                            $value = "+1" . $value;
//                    else
//                            $value = "+" . $value;
//            }
        }
            $this->data['szContactNumber'] = $this->validateInput($value, __VLD_CASE_PHONE2__, "szContactNumber", "Contact Number", false, 10, $flag);
        }
        function set_szCountry($value,$flag=true)
        {
            $this->data['szCountry'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szCountry", "Country", false, false, $flag);
        }
        function set_szState($value,$flag=true)
        {
            $this->data['szState'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szState", "State", false, false, $flag);
        }
        function set_szCity($value,$flag=true)
        {
            $this->data['szCity'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szCity", "City", false, false, $flag);
        }
        function set_szZipCode($value,$flag=true)
        {
            $this->data['szZipCode'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szZipCode", "ZIP/Postal Code", false, false, $flag);
        }
         function set_szAddress($value,$flag=true)
        {
            $this->data['szAddress'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szAddress", "Address", false, false, $flag);
        }
        function set_szPassword($value)
        {
            $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szPassword", "Password", false, 32);
        }	
        function set_szOldPassword($value)
        {
            $this->data['szOldPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__ , "szOldPassword", "Current Password", false, 32);
        }
        function set_szConfirmPassword($value)
        {
            $this->data['szConfirmPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szConfirmPassword", "Confirm Password", false, 32);
        }
         function set_franchiseeid($value,$flag=true)
        {
            $this->data['franchiseeid'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "franchiseeid", "franchisee", false, false, $flag);
        }
       /*----------------------------ADMIN RELATED FUNCTIONS-------------------------------------------*/
       
        function validateUserData($data, $arExclude=array())
        {
        if(!empty($data))
        {
            if(!in_array('szPassword',$arExclude)) 
            {
                $this->set_szPassword(sanitize_all_html_input(trim($data['szPassword'])));	
                 
            }
           
            if(!in_array('szOldPassword',$arExclude)) 
            {
                $this->set_szOldPassword(sanitize_all_html_input(trim($data['szOldPassword'])));
                
                if($this->data['szOldPassword'] != '' && $this->error == false){
                   $this->checkCurrentPasswordExists(); 
                }
                 
            }
            if($this->data['szPassword'] != '' && !isset($this->arErrorMessages['szPassword']) && sanitize_all_html_input(trim($data['szConfirmPassword'])) != '' && $this->data['szPassword'] != sanitize_all_html_input(trim($data['szConfirmPassword'])))
            {
                    $this->addError("szConfirmPassword", "Confirm password does not match.");
            }
            else if(isset($data['szConfirmPassword']) && sanitize_all_html_input(trim($data['szConfirmPassword'])) == '')
            {
                    $this->addError("szConfirmPassword", "Confirm password required.");
            }
          
           if($this->error == true)
                    return false;
            else
                    return true;
        }
        return false;
    }
            
     /*
     * Check Admin Account Expire Or Inactive 
     */
    public function checkUserAccountStatus($szEmail='')
    {
        if(trim($szEmail) == '')
        {
            $szEmail = $this->data['szEmail'];
        }
        else
        {
            $szEmail = $this->sql_real_escape_string(trim($szEmail));
        }
        
        $this->db->select('iRole,iActive,isDeleted');

        $this->db->from(__DBC_SCHEMATA_USERS__);

        $this->db->where('szEmail =',$szEmail);


        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
           if((int)$row['iRole'] == 3)
            {
                $this->addError("szEmail", "Invalid EmailId or Password.");
            } 
           
         elseif((int)$row['iActive'] == 0)
            {
                $this->addError("szEmail", "Your account is inactive.");
            }
           
            else if((int)$row['isDeleted'] == 1)
            {
                $this->addError("szEmail", "Your account is deleted.");
            }
        }
        else
        {
            $this->addError("szEmail", "This email address is not registered with Drug Safe.");
        }
     
        if($this->error == true)
                    return false;
            else
                    return true;
    }      
        
        public function adminLoginUser($validate)
	{

            $whereAry = array( 'szEmail' => $validate['szEmail'], 'szPassword' => encrypt($validate['szPassword']));
            $this->db->select('id,szName,szEmail,szPassword,iRole');
            $this->db->where($whereAry);
            $query = $this->db->get(__DBC_SCHEMATA_USERS__);
            //$sql= $this->db->last_query();die();
            //print_r($sql);
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();

                $adminAry['id'] = $row[0]['id'];
                $adminAry['szName'] = $row[0]['szName'];
                $adminAry['szEmail'] = $row[0]['szEmail'];
                $adminAry['iRole'] = $row[0]['iRole'];
                //$adminAry['Reqcount'] = $count;

                $user_session= $this->session->set_userdata('drugsafe_user', $adminAry);

                return $row[0];
            }
            else
            {
                $this->addError("szPassword", "Invalid email or password.");
                return array();
            }

	}
     

    public function checkUserExists($szEmail=false,$id=0)
    {
        $szEmail = trim($szEmail);

        $user_session = $this->session->userdata('drugsafe_user');
       
        if((empty($szEmail)) && (!empty($user_session)))
        {
            $user_session = $this->session->userdata('drugsafe_user');
            $szEmail = $user_session['szEmail'];
           
        }

        if((int)$id>0)
        {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__,array('szEmail'=>$szEmail,'id !=' => (int)$id,'isDeleted !=' => '1'));
        }
        else 
        {
            $result = $this->db->get_where(__DBC_SCHEMATA_USERS__,array('szEmail'=>$szEmail,'isDeleted !=' => '1'));
        }

        if($result->num_rows()>0)
        {
          return  $result;
        }
        else 
        {
            return false;
        }
    }
    public function checkCurrentPasswordExists()
    {
        $userData = $this->session->userdata('drugsafe_user');
                
        $this->data['id'] = (int)$userData['id'];

        $result = $this->db->get_where(__DBC_SCHEMATA_USERS__,array('szPassword'=> encrypt($this->data['szOldPassword']),'id' => (int)$this->data['id'],'isDeleted !=' => '1'));

        if($result->num_rows()>0)
        {
            return true;
        }
        else 
        {
            $this->addError("szOldPassword", "Current Password does not match.");
          
        }
    }

    public function updateChangePassword()
    {
        
       $dataAry = array(
                            'szPassword' => encrypt($this->data['szPassword']),
                            'dtUpdatedOn' => date('Y-m-d H:i:s')                      
        );  
  
        $whereAry = array('id ' => (int)$this->data['id'] );  
        
        $this->db->where($whereAry);
          
        $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry) ;
          
           
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
          
     }
     function getCountries()
   	{
   		$this->db->select('name');
                $this->db->from(__DBC_SCHEMATA_COUNTRY__)
                ->where('id','13');
                $query = $this->db->get();
		if($query->num_rows() > 0)
                {
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
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();

                $this->db->select('name');
                $this->db->from(__DBC_SCHEMATA_STATE__);                
                $this->db->where('country_id',$row[0]['id']);
                $query = $this->db->get();
                if($query->num_rows() > 0)
        	{
                    return $query->result_array();
         	}
            }
   		return false;
   	}
        

    function validateFranchiseeData($data, $arExclude=array(),$idfranchisee=0,$forgotpass=FALSE)
    {
        if(!empty($data))
        {
            if(!in_array('szName',$arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),true);
            if(!in_array('szEmail',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),true);
            if(!in_array('szContactNumber',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),true);
            if(!in_array('szCountry',$arExclude)) $this->set_szCountry(sanitize_all_html_input(trim($data['szCountry'])),true);
            if(!in_array('szState',$arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])),true);
            if(!in_array('szCity',$arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])),true);
            if(!in_array('szZipCode',$arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])),true);
            if(!in_array('szAddress',$arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])),true);
            if ($this->error == false && $this->data['szEmail'] != '') {

                $adminData = $this->session->userdata('drugsafe_user');
                $this->data['id'] = $idfranchisee;

                if ($this->checkUserExists($this->data['szEmail'], $this->data['id'])) {
                    if($forgotpass){
                        return TRUE;
                    }else{
                        $this->addError('szEmail',"Someone already registered with entered email address.");
                        return false;
                    }
                }
            }
            if($this->error == true)
            {
                return false;
            }
            else
            {
                return true;
            }
            return false;
        }
    }

          function insertFranchiseeDetails()
        {
             
             
             $szNewPassword = create_login_password();
            $date=date('Y-m-d');
            $dataAry = array(

                                'szName' => $this->data['szName'],
                                'szEmail' => $this->data['szEmail'],
                                'szPassword'=>encrypt($szNewPassword),
                                'szContactNumber' => $this->data['szContactNumber'],
                                'szCountry' => $this->data['szCountry'],
                                'szState' => $this->data['szState'],
                                'szCity' => $this->data['szCity'],
                                'szZipCode' => $this->data['szZipCode'],
                                'szAddress' => $this->data['szAddress'],
                                'iRole' => '2',
                                'iActive' => '1',
                                'dtCreatedOn' => $date
            );


                $this->db->insert(__DBC_SCHEMATA_USERS__, $dataAry);

                if($this->db->affected_rows() > 0)
               {
                  
                   $id_player = (int)$this->db->insert_id();
                   $replace_ary=array();
                   $replace_ary['szName']=$this->data['szName'];
                   $replace_ary['szEmail']=$this->data['szEmail'];
                   $replace_ary['szPassword']=$szNewPassword;
                   $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                   $replace_ary['Link']=__BASE_URL__."/admin/admin_login";
                   
                   createEmail($this,'__ADD_NEW_FRANCHISEE__', $replace_ary,$this->data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__,$id_player , __CUSTOMER_SUPPORT_EMAIL__);
                                       
                   return true;
               }
               else
               {
                   return false;
             }

        }
        
         public function viewFranchiseeList($limit,$offset)
        {
    
            $whereAry = array('isDeleted=' => '0','iRole' => '2');

            $this->db->select('*');
            $this->db->where($whereAry);
            $this->db->order_by($sortBy,$orderBy);
            
                $this->db->limit($limit, $offset);
                $this->db->order_by("id", "asc");
                $query = $this->db->get(__DBC_SCHEMATA_USERS__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
         public function getAdminDetailsByEmailOrId($szEmail='',$id=0)
    { 
              
         if((int)$id>0 && empty($szEmail))
        {
            $whereAry = array('id' => (int)$id);
        }
        else if((int)$id == 0 && !empty($szEmail))
        {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)));
        }
        else if((int)$id > 0 && !empty($szEmail))
        {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)),'id' => (int)$id);
        }
        
       $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);
        
        if($query->num_rows() > 0)
        {
            $row = $query->result_array();
            return $row[0];
        }
        else
        {
            return array();
        }
    }

    public function checkPasswordRecoveryExist($passwordKey)
    {
        $passwordKey = $this->sql_real_escape_string(trim($passwordKey));
        $this->db->select('szRecoveryPassword');
        $this->db->where('szRecoveryPassword =',$passwordKey);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function sendNewPasswordToAdmin($szEmail)
    {

        $adminDetailsAry = $this->getAdminDetailsByEmailOrId($szEmail);
        if(!empty($adminDetailsAry))
        {
            $id = $adminDetailsAry['id'];

            $szNewPassword = create_login_password();
            $data = array(
                'szRecoveryPassword' =>$szNewPassword
            );
            $whereAry = array('id' => $id);
            $this->db->where($whereAry);
            if($this->db->update(__DBC_SCHEMATA_USERS__, $data))
            {
                $replace_ary=array();
                $replace_ary['szName']='Admin';
                $replace_ary['szEmail']=$szEmail;
                $replace_ary['id']=$id;
                $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                $confirmationLink=__BASE_URL__."/admin/adminPassword_Recover/".$szNewPassword;
                $replace_ary['szLink']="<a href='".$confirmationLink."'>CLICK HERE TO CHANGE PASSWORD.</a>";
                $replace_ary['szHttpsLink']=$confirmationLink;
                createEmail($this,'__USER_FORGOT_PASSWORD__', $replace_ary,$szEmail, '', __CUSTOMER_SUPPORT_EMAIL__,$id_admin, __CUSTOMER_SUPPORT_EMAIL__);
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $passwordKey
     * @param array $dataArr
     * @return bool
     */
    public function updateAdminPassword($passwordKey, $dataArr=array())
    {

        $dataAry = array(
            'szPassword' =>encrypt($dataArr['szPassword']),
            'dtUpdatedOn' => date('Y-m-d H:i:s'),
            'szRecoveryPassword' => ''
        );

        $whereAry = array('szRecoveryPassword' => $passwordKey);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry) ;

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
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
        
        if($query->num_rows() > 0)
        {
            $row = $query->result_array();
            return $row[0];
        }
        else
        {
            return array();
        }
    }
        
        public function logEmails($logDataAry)
    {
        if($query = $this->db->insert(__DBC_SCHEMATA_USERS_EMAIL_LOG__, $logDataAry))
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
       /*
     * Get User Details By Email or Id
     */
    public function getUserDetailsByEmailOrId($szEmail='',$id=0)
    {
        if((int)$id>0 && empty($szEmail))
        {
            $whereAry = array('id' => (int)$id);
        }
        else if((int)$id == 0 && !empty($szEmail))
        {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)));
        }
        else if((int)$id > 0 && !empty($szEmail))
        {
            $whereAry = array('szEmail' => $this->sql_real_escape_string(trim($szEmail)),'id' => (int)$id);
        }
        
        
        $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_USERS__);
        
        if($query->num_rows() > 0)
        {
            $row = $query->result_array();
            return $row[0];
        }
        else
        {
            return array();
        }
    }
     
    public function updateFranchiseeDetails($idfranchisee=0)
    {
        $date=date('Y-m-d');
            $dataAry = array(

                                'szName' => $this->data['szName'],
                                'szEmail' => $this->data['szEmail'],
                                'szContactNumber' => $this->data['szContactNumber'],
                                'szCountry' => $this->data['szCountry'],
                                'szState' => $this->data['szState'],
                                'szCity' => $this->data['szCity'],
                                'szZipCode' => $this->data['szZipCode'],
                                'szAddress' => $this->data['szAddress'],
                                'iRole' => '2',
                                'dtUpdatedOn' => $date
            );

            if($idfranchisee > 0)
            {
                $whereAry = array('id' => (int)$idfranchisee);

                $this->db->where($whereAry);

                $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);
                
                if($this->db->affected_rows() > 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        
        public function deletefranchisee($idfranchisee)
	{
          $clientAray =$this->Franchisee_Model->viewClientList($idfranchisee,true,false,false);
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
		if($query = $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
        public function deletemodelStockValue($idfranchisee)
	{
                $this->db->where('iFranchiseeId', $idfranchisee);
		if($query = $this->db->delete(__DBC_SCHEMATA_MODEL_STOCK_VALUE__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         public function deleteProductStockQuantity($idfranchisee)
	{
                $this->db->where('iFranchiseeId', $idfranchisee);
		if($query = $this->db->delete(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         function validateClientData($data, $arExclude=array(),$idClient=0)
        {
            if(!empty($data))
            {
                if(!in_array('szName',$arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),true);
                if(!in_array('szEmail',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),true);
                if(!in_array('szContactNumber',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),true);
                if(!in_array('szCountry',$arExclude)) $this->set_szCountry(sanitize_all_html_input(trim($data['szCountry'])),true);
                if(!in_array('szState',$arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])),true);
                if(!in_array('szCity',$arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])),true);
                if(!in_array('szZipCode',$arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])),true);
                if(!in_array('szAddress',$arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])),true);
                 if(!in_array('franchiseeid',$arExclude)) $this->set_franchiseeid(sanitize_all_html_input(trim($data['franchiseeid'])),true);
                if ($this->error == false && $this->data['szEmail'] != '') {
                    $adminData = $this->session->userdata('drugsafe_user');
                    $this->data['id'] = $idClient;
                    if ($this->checkUserExists($this->data['szEmail'], $this->data['id'])) {
                        $this->addError('szEmail',"Someone already registered with entered email address.");
                        return false;
                    }
                }
            if($this->error == true)
                        return false;
                else
                       return true;
            }
            return false;
        }

    public function checkAdminAccountStatus($szEmail='')
    {
        //echo $szEmail;
        if(trim($szEmail) == '')
        {
            $szEmail = $this->data['szEmail'];
        }
        else
        {
            $szEmail = $this->sql_real_escape_string(trim($szEmail));
        }
        $this->load->library('form_validation');
        
        $this->db->select('iRole,iActive,isDeleted');
        $this->db->from(__DBC_SCHEMATA_USERS__);
        $this->db->where('szEmail =',$szEmail);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            if((int)$row['iActive'] == 0)
            {
                $this->form_validation->set_rules('drugSafeForgotPassword[szEmail]', 'Your account is inactive.');
                
            }

            else if((int)$row['isDeleted'] == 1)
            {
                $this->form_validation->set_rules('drugSafeForgotPassword[szEmail]', 'Your account is deleted.');
                
            }
        }
        else
        {
            $this->form_validation->set_rules('drugSafeForgotPassword[szEmail]', 'This email address is not registered with Drug Safe.');
            
        }

        if($this->error == true)
            return false;
        else
            return true;
    }
    public function getnotification(){
            $frReqQtyAray =$this->StockMgt_Model->getQtyRequestFrId(false,false);  
                                  
                    $count=0;
                    foreach($frReqQtyAray as $frReqQtyData){

                       $count++; 

                     }
                     
                     return $count;
        }

      
}
?>