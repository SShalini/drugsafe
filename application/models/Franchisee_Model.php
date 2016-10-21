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
            if($franchiseeId=='')
            {
                 $franchiseeId=$_SESSION['drugsafe_user']['id'];
            }
            
           
            $clientType=$data['szClientType'];
           // print_r($franchiseeId);die;
            $clientAry=array(
                
                'franchiseeId' => $franchiseeId,
                'clientId' => $id_client,
                'clientType' => $clientType,
                
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
        public function viewClientList($idfranchisee)
        {
            $whereAry = array('franchiseeId' => $idfranchisee,'isDeleted=' => '0');
            
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            $this->db->where($whereAry);
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
}
?>

