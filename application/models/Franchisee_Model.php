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
           
           $replace_ary = array();
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
                                'dtCreatedOn' => $date
            );
            $this->db->insert(__DBC_SCHEMATA_USERS__, $dataAry);
            
            $id_client = (int)$this->db->insert_id();
            if($franchiseeId=='')
            {
                $franchiseeId=$_SESSION['drugsafe_user']['id'];
            }
            
            $clientType=$data['szClientType'];
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
         
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            $this->db->where('franchiseeId', $idfranchisee);
            $query = $this->db->get();

            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
}
?>

