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
        
function insertClientDetails($data,$franchiseeId='',$reqppval=0)
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
          
            $clientType=$data['szParentId'];
            if($clientType=='')
            {
                $clientType='0';
            }
        if(empty($clientType)){
            $clientAry=array(
                'franchiseeId' => $data['franchiseeId'],
                'clientId' => $id_client,
                'clientType' => $clientType,
                'szCreatedBy' => $CreatedBy,
                'szBusinessName' => $data['szBusinessName'],
                'szContactEmail' => $data['szContactEmail'],
                'szContactPhone' => $data['szContactPhone'],
                'szContactMobile' => $data['szContactMobile'],
                'szNoOfSites' => $data['szNoOfSites'],
                
                
            );
        }else{
             $clientAry=array(
                
                'franchiseeId' => $data['franchiseeId'],
                'clientId' => $id_client,
                'clientType' => $clientType,
                'szCreatedBy' => $CreatedBy,
             
            );
        }
           
            if($this->db->affected_rows() > 0)
               {
                
                $this->db->insert(__DBC_SCHEMATA_CLIENT__, $clientAry);
             
                
                if($this->db->affected_rows() > 0)
                {
                    if(empty($clientType)){
                   $replace_ary = array();
                   $id_player = (int)$this->db->insert_id();
                   $replace_ary['szName']=$data['szName'];
                   $replace_ary['szEmail']=$data['szEmail'];
                   $replace_ary['szPassword']=$szNewPassword;
                   $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                   $replace_ary['Link']=__BASE_URL__."/franchisee/addClient";
                 
                   createEmail($this,'__ADD_NEW_CLIENT__', $replace_ary,$data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__,$id_player , __CUSTOMER_SUPPORT_EMAIL__);
                
                    }
                    if(!empty($clientType)){
                     if(empty($reqppval)){
                      $reqppval='';   
                     }
                     else{
                        $reqppval=$reqppval;   
                     }
                $id_site = (int)$this->db->insert_id();
                $siteAry=array(
                'siteid'=> $id_site,
                'per_form_complete' => $data['per_form_complete'],
                'sp_name' => $data['sp_name'],
                'sp_mobile' => $data['sp_mobile'],
                'sp_email' => $data['sp_email'],
                'iis_name' => $data['iis_name'],
                'iis_mobile' => $data['iis_mobile'],
                'iis_email' => $data['iis_email'],
                'rlr_name' => $data['rlr_name'],
                'rlr_mobile' => $data['rlr_mobile'],
                'rlr_email' => $data['rlr_email'],
                'orlr_name' => $data['orlr_name'],
                'orlr_mobile' => $data['orlr_mobile'],
                'orlr_email' => $data['orlr_email'],
                'psc_name' => $data['psc_name'],
                'psc_phone' => $data['psc_phone'],
                'psc_mobile' => $data['psc_mobile'],
                'ssc_name' => $data['ssc_name'],
                'ssc_phone' => $data['ssc_phone'],
                'ssc_mobile' => $data['ssc_mobile'],
                'instructions' => $data['instructions'],
                'site_people' => $data['site_people'],
                'test_count' => $data['test_count'],
                'initial_testing_req' => $data['initial_testing_req'],
                'ongoing_testing_req' => $data['ongoing_testing_req'],
                'site_visit' => $data['site_visit'],
                'onsite_service' => $data['onsite_service'],
                'start_time' => $data['start_time'],
                'power_access' => $data['power_access'], 
                'risk_assessment' => $data['risk_assessment'], 
                'req_comp_induction' => $data['req_comp_induction'],
                'randomisation' => $data['randomisation'],
                'req_ppe' => $reqppval,
                'paperwork' => $data['paperwork'],
                'specify_contact' => $data['specify_contact'],
        
            );
      $this->db->insert(__DBC_SCHEMATA_SITES__, $siteAry);
               if($this->db->affected_rows() > 0)
            {
                   $replace_ary = array();
                   $id_player = (int)$this->db->insert_id();
                   $replace_ary['szName']=$data['szName'];
                   $replace_ary['szEmail']=$data['szEmail'];
                   $replace_ary['szPassword']=$szNewPassword;
                   $replace_ary['supportEmail'] = __CUSTOMER_SUPPORT_EMAIL__;
                   $replace_ary['Link']=__BASE_URL__."/franchisee/addClient";
                 
                   createEmail($this,'__ADD_NEW_SITE__', $replace_ary,$data['szEmail'], '', __CUSTOMER_SUPPORT_EMAIL__,$id_player , __CUSTOMER_SUPPORT_EMAIL__);
                   
                   
                return true;
            }
            else
            {
                    return false;
            }
                 }
            
                   return true;
               }
               return false;
                              }

               else
               {
                   return false;
             }
        }
       public function viewClientList($parent=false,$idfranchisee=0,$limit = __PAGINATION_RECORD_LIMIT__, $offset = 0,$searchAry = '',$id=0)
    {
           
             
            $whereAry = array('franchiseeId' => $idfranchisee,'isDeleted=' => '0');
             $searchq = '';
            if($id > '0'){
                $searchq = array('clientId=' => (int)$id,'isDeleted=' => '0');
            }
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            
              if (!empty($searchq)) {
            $this->db->where($searchq);


        } else {
            $this->db->where($whereAry);
        }
            if($parent){
                $this->db->where('clientType',0);
            }
             $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $s=$this->db->last_query();
//           print_r($s);die;
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
        
         public function getAllClientDetails($parent=false,$franchiseId='',$operationManagrrId='',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry = '',$id=0,$flag=0)
        { 
             if(!empty($operationManagrrId)){
            $whereAry = array('operationManagerId=' => $operationManagrrId,'clientType='=>'0'); 
            $searchq = '';
            if($id > '0'){
                $searchq = 'clientId = '.(int)$id;
            }
            $this->db->select('*');
            $this->db->from('tbl_franchisee');
            $this->db->join('tbl_client', 'tbl_franchisee.franchiseeId = tbl_client.franchiseeId');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
             if(!empty($searchq)){
               $this->db->where('isDeleted','0');
               $this->db->where($searchq);
     
            }
            else{
               $this->db->where($whereAry); 
            }
           $this->db->where($whereAry);
           $this->db->order_by("operationManagerId","asc");
           $this->db->limit($limit, $offset);
           $query = $this->db->get();
                }
        else{
             if($id > '0'){
                 
                 if($_SESSION['drugsafe_user']['iRole']==1){
                  if($flag==1){
                        $searchq = 'clientId = '.(int)$id; 
                  }
                  else{
                       $searchq = 'franchiseeId = '.(int)$id;  
                  }
                    
                 
            } else{
                $searchq = 'clientId = '.(int)$id;
            } 
            }
            
            if($franchiseId)
            {
                 $this->db->where('clientType',0);
            }
            $whereAry = array('isDeleted=' => '0');
            
             
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            
             if(!empty($searchq)){
                $this->db->where('isDeleted','0');
               $this->db->where($searchq);
     
            }
            else{
               $this->db->where($whereAry); 
            }
       
       
            $this->db->order_by("franchiseeId","asc");
            if($parent)
            {
                $this->db->where('clientType',0);
            }
            if($franchiseId)
            {
                 $this->db->where('franchiseeId',$franchiseId);
            }
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
        }
//          $s=$this->db->last_query();
//           print_r($s);die;
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
        $childListArr = $this->viewChildClientDetails($idClient,false,false,false);
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
            function getOperationManagerId($Id)
   	{
                $whereAry = array('franchiseeId' => $Id);
   		$this->db->select('operationManagerId');
                $this->db->from(__DBC_SCHEMATA_FRANCHISEE__);
                $this->db->where($whereAry);
                $query = $this->db->get();
               
		if($query->num_rows() > 0)
                { 
                    $row = $query->result_array();
                return $row[0];
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
//            $searchAry = trim($searchAry);
            $whereAry = array('clientId' => $idClient,'isDeleted=' => '0');
            
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            
//             if(!empty($searchAry)){
//               $this->db->where('isDeleted','0');
//               $this->db->where('clientId',$idClient);
//               $this->db->where("(clientId LIKE '%$searchAry%' OR szName LIKE '%$searchAry%' OR szEmail LIKE '%$searchAry%')");
//     
//            }
//            else{
               $this->db->where($whereAry); 
//            }
            
            
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
        
        public function viewChildClientDetails($idClient=0,$limit = __PAGINATION_RECORD_LIMIT__,$offset= 0,$searchAry = '',$id=0)
        {
            
            $whereAry = array('clientType' => $idClient,'isDeleted=' => '0');
            
             $searchq = '';
            if($id > '0'){
                $searchq = 'clientId = '.(int)$id;
            }
            $this->db->select('*');
            $this->db->from('tbl_client');
            $this->db->join('ds_user', 'tbl_client.clientId = ds_user.id');
            
        
             if(!empty($searchq)){
               $whereAry = array('clientType' => $idClient,'isDeleted=' => '0');
               $this->db->where($searchq);
     
            }
            else{
               $this->db->where($whereAry); 
            }
            
           
            
            
            $this->db->limit($limit, $offset);
           $query = $this->db->get();
//              $sql = $this->db->last_query($query);
             
           
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
 public function updateClientDetails($idClient=0,$data,$reqppval)
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
            if(empty($clientType)){
            $clientAry=array(
                
                'clientType' => $clientType,
                'szLastUpdatedBy' => $UpdatedBy,
                'szBusinessName' => $data['szBusinessName'],
                'szContactEmail' => $data['szContactEmail'],
                'szContactPhone' => $data['szContactPhone'],
                'szContactMobile' => $data['szContactMobile'],
                'szNoOfSites' => $data['szNoOfSites'],
                
                
            );
        }else{
             $clientAry=array(
                
                'clientType' => $clientType,
                'szLastUpdatedBy' => $UpdatedBy,
         
            );
        }
        
            if($queyUpdate)
               {
                
                $whereAry = array('clientId' => (int)$idClient);
                $this->db->where($whereAry);
                $query=$this->db->update(__DBC_SCHEMATA_CLIENT__, $clientAry);
              
                if($query)
                { if(!empty($clientType)){
                 if($data['paperwork']==2){
                    $specify_contact = $data['specify_contact'];
                 }  
                 else{
                     $specify_contact = ' '; 
                 }
               $siteAry=array(
                'per_form_complete' => $data['per_form_complete'],
                'sp_name' => $data['sp_name'],
                'sp_mobile' => $data['sp_mobile'],
                'sp_email' => $data['sp_email'],
                'iis_name' => $data['iis_name'],
                'iis_mobile' => $data['iis_mobile'],
                'iis_email' => $data['iis_email'],
                'rlr_name' => $data['rlr_name'],
                'rlr_mobile' => $data['rlr_mobile'],
                'rlr_email' => $data['rlr_email'],
                'orlr_name' => $data['orlr_name'],
                'orlr_mobile' => $data['orlr_mobile'],
                'orlr_email' => $data['orlr_email'],
                'psc_name' => $data['psc_name'],
                'psc_phone' => $data['psc_phone'],
                'psc_mobile' => $data['psc_mobile'],
                'ssc_name' => $data['ssc_name'],
                'ssc_phone' => $data['ssc_phone'],
                'ssc_mobile' => $data['ssc_mobile'],
                'instructions' => $data['instructions'],
                'site_people' => $data['site_people'],
                'test_count' => $data['test_count'],
                'initial_testing_req' => $data['initial_testing_req'],
                'ongoing_testing_req' => $data['ongoing_testing_req'],
                'site_visit' => $data['site_visit'],
                'onsite_service' => $data['onsite_service'],
                'start_time' => $data['start_time'],
                'power_access' => $data['power_access'], 
                'risk_assessment' => $data['risk_assessment'], 
                'req_comp_induction' => $data['req_comp_induction'],
                'randomisation' => $data['randomisation'],
                'req_ppe' => $reqppval,
                'paperwork' => $data['paperwork'],
                'specify_contact' => $specify_contact,
        
            );
                $userDataAry = $this->getClientDetailsId($idClient);
                
                $id_site = $userDataAry['id'];
           
                $whereAry = array('siteid' => (int)$id_site);
                $this->db->where($whereAry);
                $siteUpdate=$this->db->update(__DBC_SCHEMATA_SITES__, $siteAry);
          
                if($siteUpdate)
               {
                   
                        return true;
               }
                else
                {
                    return false;
                }    
                }  
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

            public function getSiteDetailsById($id=0)
    {
        if((int)$id>0 )
        {
            $whereAry = array('id' => (int)$id);
        }
        
            $this->db->select('*');
            $this->db->from('ds_sites');
            $this->db->join('tbl_client', 'ds_sites.siteid = tbl_client.id');
            $this->db->join('ds_user','tbl_client.clientId = ds_user.id');
            $this->db->where('ds_user.id', $id);
        
       $query = $this->db->get();
//   $s=$this->db->last_query();
//          print_r($s);die;
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
 public function getClientDetailsId($id=0)
    {
        if((int)$id>0 )
        {
            $whereAry = array('clientId' => (int)$id);
        }
        
            $this->db->select('id');
            $this->db->where($whereAry);
      $query = $this->db->get(__DBC_SCHEMATA_CLIENT__);

            
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
 public function getOperationManagerDetailsById($id = 0)
    {

        if ((int)$id > 0 ) {
            $whereAry = array('id' => (int)$id);
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
    public function getFranchiseeDetailsByOperationManagerId($id = 0)
    {
  
        if ((int)$id > 0 ) {
            $whereAry = array('franchiseeId' => (int)$id);
        } 
        $this->db->select('operationManagerId');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_FRANCHISEE__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }
     function getClientCountId($franchiseeId)
   	{
                $whereAry = array('franchiseeId' => $franchiseeId);
   		$this->db->select('id');
                $this->db->from(__DBC_SCHEMATA_CLIENT__);
                $this->db->where($whereAry);
                $query = $this->db->get();
                 $s=$this->db->last_query();
     
		if($query->num_rows() > 0)
                {
                        return $query->result_array();
                }
                return false;
   	}
         public function getParentClientDetailsId($id=0)
    {
        if((int)$id>0 )
        {
            $whereAry = array('clientId' => (int)$id);
        }
        
            $this->db->select('clientType');
            $this->db->where($whereAry);
      $query = $this->db->get(__DBC_SCHEMATA_CLIENT__);

            
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
 function getClientTypeById($clientId)
   	{
                $whereAry = array('clientId' => $clientId);
   		$this->db->select('clientType');
                $this->db->from(__DBC_SCHEMATA_CLIENT__);
                $this->db->where($whereAry);
                $query = $this->db->get();
                 $s=$this->db->last_query();
     
		if($query->num_rows() > 0)
                {
                         $row=$query->result_array();
                         return $row[0];
                }
                return false;
   	}
}
?>