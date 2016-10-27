<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Franchisee_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();
    
	public function __construct()
	{
		parent::__construct();
	}
        
function insertClientDetails($data,$franchiseeId='')
        {
           
            $szNewPassword = create_login_password();
            $date=date('Y-m-d');
            $dataAry = array(

                                'szName' => $data['szName'],
                                'szEmail' => $data['szEmail'],
                                'szPassword'=>encrypt($szNewPassword),
                                'szContactNumber' => $data['szContactNumber'],
                                'szCountry' => $data['szCountry'],
                                'szState' => $data['szState'],
                                'szCity' => $data['szCity'],
                                'szZipCode' => $data['szZipCode'],
                                'szAddress' => $data['szAddress'],
                                'iRole' => '3',
                                'iActive' => '1',
                                'dtCreatedOn' => $date
            );
            $this->db->insert(__DBC_SCHEMATA_USERS__, $dataAry);
            
            $id_client = (int)$this->db->insert_id();
            $CreatedBy=$_SESSION['drugsafe_user']['id'];
          
            if($franchiseeId=='')
            {
                 $franchiseeId=$_SESSION['drugsafe_user']['id'];
                      
            }
            
            $clientType=$data['szParentId'];
            if($clientType=='')
            {
                $clientType='0';
            }
           // print_r($franchiseeId);die;
            $clientAry=array(
                
                'franchiseeId' => $franchiseeId,
                'clientId' => $id_client,
                'clientType' => $clientType,
                'szCreatedBy' => $CreatedBy,
                
                
            );
            
            if($this->db->affected_rows() > 0)
               {
                
                $this->db->insert(__DBC_SCHEMATA_CLIENT__, $clientAry);
                if($this->db->affected_rows() > 0)
                {
                   $replace_ary = array();
                   $id_player = (int)$this->db->insert_id();
                   $replace_ary['szName']=$data['szName'];
                   $replace_ary['szEmail']=$data['szEmail'];
                   $replace_ary['szPassword']=$szNewPassword;
                   $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                   $replace_ary['Link']=__BASE_URL__."/franchisee/addClient";
                   
                   createEmail($this,'__ADD_NEW_CLIENT__', $replace_ary,$data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__,$id_player , __CUSTOMER_SUPPORT_EMAIL__);
                                       
                     return true;
                    
                }
               
               }
               else
               {
                   return false;
             }
        }
        public function viewClientList($idfranchisee,$parent = false)
        {
            $whereAry = array('franchiseeId' => $idfranchisee,'isDeleted=' => '0');

            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            $this->db->where($whereAry);
            if($parent){
                $this->db->where('clientType',0);
            }
            $query = $this->db->get();
            $s=$this->db->last_query();
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
        public function deleteClient($idClient)
	{
        $childListArr = $this->viewChildClientDetails($idClient);
        if (!empty($childListArr)) {
            foreach ($childListArr as $childlist) {
                $this->deleteClient($childlist['id']);
            }

        }
            $data = $this->input->post('idClient');
		$dataAry = array(
			'isDeleted' => '1'
                );  
                $this->db->where('id', $idClient);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_USERS__, $dataAry))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
        function getParentClientDetails($franchiseeId)
   	{
                $whereAry = array('franchiseeId' => $franchiseeId,'clientType=' => '0','isDeleted=' => '0');
   		$this->db->select('*');
                $this->db->from(__DBC_SCHEMATA_CLIENT__);
                $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
                $this->db->where($whereAry);
                $query = $this->db->get();
               
		if($query->num_rows() > 0)
                {
                        return $query->result_array();
                }
                return false;
   	}
    function getClientFranchisee($clientId)
    {
        $whereAry = array('clientId' => $clientId,'isDeleted=' => '0');
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_CLIENT__);
        $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
        $this->db->where($whereAry);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        return false;
    }
         public function viewClientDetails($idClient)
        {
            $whereAry = array('clientId' => $idClient,'isDeleted=' => '0');
            
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            $this->db->where($whereAry);
            $query = $this->db->get();
           
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
        
        public function viewChildClientDetails($idClient)
        {
            $whereAry = array('clientType' => $idClient,'isDeleted=' => '0');
            
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            $this->db->where($whereAry);
            $query = $this->db->get();
           
            if($query->num_rows() > 0)
            {
                 $row = $query->result_array();
                return $row;
            }
            else
            {
                    return array();
            }
        }
 public function updateClientDetails($idClient=0,$data)
    {
        $date=date('Y-m-d');
        
            $dataAry = array(                                  
                               'szName' => $data['szName'],
                                'szEmail' => $data['szEmail'],
                                'szContactNumber' => $data['szContactNumber'],
                                'szCountry' => $data['szCountry'],
                                'szState' => $data['szState'],
                                'szCity' => $data['szCity'],
                                'szZipCode' => $data['szZipCode'],
                                'szAddress' => $data['szAddress'],
                                'iRole' => '3',
                                'iActive' => '1',
                                'dtUpdatedOn' => $date
            );
           
                $whereAry = array('id' => (int)$idClient);

                $this->db->where($whereAry);

                $queyUpdate=$this->db->update(__DBC_SCHEMATA_USERS__, $dataAry);
                
            $UpdatedBy=$_SESSION['drugsafe_user']['id'];    
            if( $idClient=='')
            {
                $idClient=$_SESSION['drugsafe_user']['id'];
            }
            $clientType=$data['szParentId'];
            if($clientType=='')
            {
                $clientType='0';
            }
            //$clientType= $this->data['clientType']; 
         
            $clientAry=array(
 
                'clientType' => $clientType,
                'szLastUpdatedBy' => $UpdatedBy,
                
            );
            
            if($queyUpdate)
               {
                
                $whereAry = array('clientId' => (int)$idClient);
                $this->db->where($whereAry);
                $query=$this->db->update(__DBC_SCHEMATA_CLIENT__, $clientAry);
                if($query)
                {
                     return true;
                    
                }
                else{
                    return false;
                }
               
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
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
          $this->db->where('ds_user.id', $id);
        
       $query = $this->db->get();

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

function set_szName($value,$flag=true)
        {
            $this->data['szName'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szName", "Name", false, false, $flag);
        }
        function set_szEmail($value,$flag=true)
        {
            $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szEmail", "Email", false, false, $flag);
        }
        function set_szContactNumber($value,$flag=true)
        {
            $this->data['szContactNumber'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szContactNumber", "Contact Number", false, false, $flag);
        }
        function set_clientType($value,$flag=true)
        {
            $this->data['clientType'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "clientType", "Client Type", false, false, $flag);
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
            $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_PASSWORD__, "szPassword", "Password", 6, 32);
        }	
        function set_szOldPassword($value)
        {
            $this->data['szOldPassword'] = $this->validateInput($value, __VLD_CASE_PASSWORD__, "szOldPassword", "Current Password", 6, 32);
        }
        function set_szConfirmPassword($value)
        {
            $this->data['szConfirmPassword'] = $this->validateInput($value, __VLD_CASE_PASSWORD__, "szConfirmPassword", "Confirm Password", 6, 32);
        }
        function set_szClientType($value)
        {
            $this->data['szClientType'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szClientType", "Client Type",false, false, $flag);
        }
         function validateFranchiseeData($data, $arExclude=array())
        {
            if(!empty($data))
            {
                if(!in_array('szName',$arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),true);
                if(!in_array('szEmail',$arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),true);
                if(!in_array('szContactNumber',$arExclude)) $this->set_szContactNumber(sanitize_all_html_input(trim($data['szContactNumber'])),true);
                if(!in_array('clientType',$arExclude)) $this->set_clientType(sanitize_all_html_input(trim($data['clientType'])),true);
                if(!in_array('szCountry',$arExclude)) $this->set_szCountry(sanitize_all_html_input(trim($data['szCountry'])),true);
                if(!in_array('szState',$arExclude)) $this->set_szState(sanitize_all_html_input(trim($data['szState'])),true);
                if(!in_array('szCity',$arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])),true);
                if(!in_array('szZipCode',$arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])),true);
                if(!in_array('szAddress',$arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])),true);
                 
            if($this->error == true)
                        return false;
                else
                       return true;
            }
            return false;
        }
}
?>