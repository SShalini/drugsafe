<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prospect_Model extends Error_Model
{
    public function __construct()
    {
        parent::__construct();
    }
     function set_szName($value,$field=false,$message=false, $flag = true)
    {
        $this->data['szName'] = $this->validateInput($value, __VLD_CASE_NAME__, $field, $message, false, false, $flag);
    }
    function set_szEmail($value,$field=false,$message=false , $flag = true)
    {
        $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, "$field", "$message", false, false, $flag);
    }
    function set_szContactNo($value,$field=false,$message=false, $flag = true)
    {
        $this->data['szContactNo'] = $this->validateInput($value, __VLD_CASE_PHONE2__,$field,$message, false, 10, $flag);
    }
    function set_szCity($value, $flag = true)
    {
        $this->data['szCity'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szCity", "City", false, false, $flag);
    }
        function set_iFranchiseeId($value, $flag = true)
    {
        $this->data['iFranchiseeId'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "iFranchiseeId", "Franchisee", false, false, $flag);
    }
    
    function set_szCountry($value, $flag = true)
    {
        $this->data['szCountry'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szCountry", "Country", false, false, $flag);
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
      function set_industry($value, $flag = true)
    {
        $this->data['industry'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "industry", "Industry", false, false, $flag);
    }

     function getAllProspectDetails($franchiseeId,$szBusinessName='0',$status='0', $limit = __PAGINATION_RECORD_LIMIT__, $offset = 0)
    {
//      if($_SESSION['drugsafe_user']['iRole']==5){
//      $operationManagerId =  $_SESSION['drugsafe_user']['id'];
//      if((!empty($szBusinessName)) || (!empty($status)))
//      {
//            $array = 'operationManagerId =' . (int)$operationManagerId .' AND isDeleted = 0 '.($status>0?' AND status = '.(int)$status:'').($szBusinessName>0?' AND id = '.(int)$szBusinessName:'') ;   
//    
//      }
//       else{
//       $array = array('operationManagerId' => (int)$operationManagerId, 'isDeleted' => '0');
//         } 
//            $query = $this->db->select('prospect.id,szName,szCity,szZipCode,abn,szContactMobile,szContactEmail,szContactPhone,industry,szCountry,szAddress,szBusinessName,szEmail,szContactNo,dtCreatedOn,dtUpdatedOn,status,dt_last_updated_meeting')
//            ->from(__DBC_SCHEMATA_PROSPECT__. ' as prospect' )
//            ->join(__DBC_SCHEMATA_FRANCHISEE__, prospect . '.iFranchiseeId = ' . __DBC_SCHEMATA_FRANCHISEE__ . '.franchiseeId')
//            ->order_by("id","desc") 
//            ->limit($limit, $offset)
//            ->where($array)
//            ->get();
//      }
//      else{
          if($franchiseeId){
              $franchiseeid  = $franchiseeId; 
          }
         
      if((!empty($szBusinessName)) || (!empty($status )) || (!empty($franchiseeId)))
      {
            $array = 'isDeleted = 0 '.($franchiseeId>0?' AND iFranchiseeId = '.(int)$franchiseeId:'').($status>0?' AND status = '.(int)$status:'').($szBusinessName>0?' AND id = '.(int)$szBusinessName:'') ;   
    
      }
       else{
       $array = array('isDeleted' => '0');
         } 
           $query = $this->db->select('id,szName,szCity,szZipCode,abn,szContactMobile,szContactEmail,szContactPhone,industry,szCountry,szAddress,szBusinessName,szEmail,szContactNo,dtCreatedOn,dtUpdatedOn,status,dt_last_updated_meeting')
            ->from(__DBC_SCHEMATA_PROSPECT__)
           ->order_by("id","desc") 
           ->limit($limit, $offset)
            ->where($array)
            ->get();
     
     
     
       
   
//     $q = $this->db->last_query();
//        echo $q; die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
    function validateProspectData($data, $arExclude = array(), $idUser=0,$flag='0')
  {
        if (!empty($data)) {
            $this->error = FALSE;
            if($data['szContactEmail']=='N/A')
            {
               $data['szContactEmail']=''; 
            }
            if($data['szContactPhone']=='N/A')
            {
               $data['szContactPhone']=''; 
            }
            if($data['szContactMobile']=='N/A')
            {
               $data['szContactMobile']=''; 
            }
            if (!in_array('szBusinessName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szBusinessName'])),"szBusinessName","Business Name",true);
            if (!in_array('abn', $arExclude)) $this->set_abn(sanitize_all_html_input(trim($data['abn'])), true);
            if (!in_array('szName', $arExclude)) $this->set_szName(sanitize_all_html_input(trim($data['szName'])),"szName","Contact Name", true);
            if (!in_array('szEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])),"szEmail","Primary Email address", true);
            if (!in_array('szContactNo', $arExclude)) $this->set_szContactNo(sanitize_all_html_input(trim($data['szContactNo'])),"szContactNo","Primary Phone Number", true);
            if (!in_array('szContactEmail', $arExclude)) $this->set_szEmail(sanitize_all_html_input(trim($data['szContactEmail'])),"szContactEmail","Contact Email address", false);
            if (!in_array('szContactPhone', $arExclude)) $this->set_szContactNo(sanitize_all_html_input(trim($data['szContactPhone'])),"szContactPhone"," Contact Phone Number", false);
            if (!in_array('szContactMobile', $arExclude)) $this->set_szContactNo(sanitize_all_html_input(trim($data['szContactMobile'])),"szContactMobile","Contact Mobile Number", false);
            if (!in_array('szCity', $arExclude)) $this->set_szCity(sanitize_all_html_input(trim($data['szCity'])), true);
             if($data['iFranchiseeId']){
                if (!in_array('iFranchiseeId', $arExclude)) $this->set_iFranchiseeId(sanitize_all_html_input(trim($data['iFranchiseeId'])), true);
            }
            if($flag==1){
                if (!in_array('szCountry', $arExclude)) $this->set_szCountry(sanitize_all_html_input(trim($data['szCountry'])), true);   
            }
            if (!in_array('szZipCode', $arExclude)) $this->set_szZipCode(sanitize_all_html_input(trim($data['szZipCode'])), true);
            if (!in_array('szAddress', $arExclude)) $this->set_szAddress(sanitize_all_html_input(trim($data['szAddress'])), true);
            if(!in_array('industry',$arExclude)) $this->set_industry(sanitize_all_html_input(trim($data['industry'])),true);
      
            if($this->error == false )
            {
                 if ($this->checkProspectExists($data['szEmail'], $idUser)) {
                    $this->addError('szEmail', "Someone already registered with entered email address.");
                    return false;
                }
                if ($this->checkBusinessNameExists($data['szBusinessName'],$idUser)) {
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
      function insertProspectData($data,$flag='0'){
       
          if(empty($data['iFranchiseeId'])){
             $data['iFranchiseeId']  =  $_SESSION['drugsafe_user']['id'];  
          }
          else{
             $data['iFranchiseeId'] =$data['iFranchiseeId']; 
          }
     
       $date = date('Y-m-d H:i:s');
       if($flag==1){
          
           $meetingDateTime = $this->getSqlFormattedDate($data['dt_last_updated_meeting']);
         
           if($data['industry']== 'Agriculture, Forestry and Fishing'){
                               $value = '1';
                            }
                            if($data['industry']=='Mining'){
                               $value = '2';
                            }
                            if($data['industry']=='Manufacturing'){
                               $value = '3';
                            }
                            if($data['industry']=='Electricity, Gas and Water Supply'){
                               $value = '4';
                            }if($data['industry']=='Construction'){
                               $value = '5';
                            }if($data['industry']=='Wholesale Trade'){
                               $value = '6';
                            }if($data['industry']=='Transport and Storage'){
                               $value = '7';
                            }if($data['industry']=='Communication Services'){
                               $value = '8';
                            }if($data['industry']=='Agriculture, Property and Business Services'){
                               $value = '9';
                            }if($data['industry']=='Agriculture, Government Administration and Defence'){
                               $value = '10';
                            }if($data['industry']=='Education'){
                               $value = '11';
                            }
                            if($data['industry']=='Health and Community Services'){
                               $value = '12';
                            }if($data['industry']=='Other'){
                               $value = '13';
                            }  
                      if($data['status']=='In Progress') {
                          $status = '2'; 
                      }  
                      elseif($data['status']=='Completed') {
                          $status = '3'; 
                      }  
                     else {
                          $status = '1'; 
                      }  
                    if($data['szContactEmail']=='N/A'){
                     $data['szContactEmail'] = '';
                    }  
                    else{
                       $data['szContactEmail'] = $data['szContactEmail'];  
                    }
                     if($data['szContactMobile']=='N/A'){
                     $data['szContactMobile'] = '';
                    }  
                    else{
                       $data['szContactMobile'] = $data['szContactMobile'];  
                    }
                     if($data['szContactPhone']=='N/A'){
                     $data['szContactPhone'] = '';
                    }  
                    else{
                       $data['szContactPhone'] = $data['szContactPhone'];  
                    }
                             
      
       $whereAry = array(
                'iFranchiseeId' => (int)$data['iFranchiseeId'],
                'szName' => $data['szName'],
                'szEmail' => $data['szEmail'],
                'szContactNo' => $data['szContactNo'],
                'dtCreatedOn' =>$date,
                'isDeleted' =>'0',
                'szCountry' => $data['szCountry'],
                'abn' => $data['abn'], 
                'szCity' => $data['szCity'],
                'szZipCode' => $data['szZipCode'],
                'szAddress' => $data['szAddress'],
                'szBusinessName' => $data['szBusinessName'],
                'szContactEmail' => $data['szContactEmail'],
                'szContactPhone' => $data['szContactPhone'],
                'szContactMobile' => $data['szContactMobile'],
                'industry' => $value,
                'status' => $status,
                'szCreatedBy' => (int)$_SESSION['drugsafe_user']['id'],
               'dt_last_updated_meeting' => $meetingDateTime
            );    
       }
       else{
        $whereAry = array(
                'iFranchiseeId' => (int)$data['iFranchiseeId'],
                'szName' => $data['szName'],
                'szEmail' => $data['szEmail'],
                'szContactNo' => $data['szContactNo'],
                'dtCreatedOn' =>$date,
                'isDeleted' =>'0',
                'szCountry' => $data['szCountry'],
                'abn' => $data['abn'], 
                'szCity' => $data['szCity'],
                'szZipCode' => $data['szZipCode'],
                'szAddress' => $data['szAddress'],
                'szBusinessName' => $data['szBusinessName'],
                'szContactEmail' => $data['szContactEmail'],
                'szContactPhone' => $data['szContactPhone'],
                'szContactMobile' => $data['szContactMobile'],
                'szCreatedBy' => (int)$_SESSION['drugsafe_user']['id'],
                'industry' => $data['industry'],
                'status' => '1'
            );   
           }
           
            $this->db->insert(__DBC_SCHEMATA_PROSPECT__, $whereAry);
            if (!($this->db->affected_rows() > 0)) {
                $message = "Some error occurred while adding product.";
                array_push($failarr, $message);
                return false;
            }
            else{
                $prospectId = (int)$this->db->insert_id();
                 $whereAry = array(
                'prospectId' => (int)$prospectId,
                'status' => (int)'1',
                'dtUpdatedOn' =>$date,
                'szUpdatedBy' =>(int)$franchiseeid
            );
            $this->db->insert(__DBC_SCHEMATA_STATUS__, $whereAry);   
               return true; 
            }
        
    }
    function getProspectDetailsByProspectsId($prospectsId)
    {
        
        $array = array('id' => (int)$prospectsId, 'isDeleted' => '0');
        $query = $this->db->select('id,szName,iFranchiseeId,szEmail,szContactNo,abn,szCity,szCountry,szBusinessName,szContactEmail,szContactPhone,szContactMobile,industry,szZipCode,szAddress,dtCreatedOn,dtUpdatedOn,status')
            ->from(__DBC_SCHEMATA_PROSPECT__)
            ->where($array)
            ->get();
        /*$q = $this->db->last_query();
        echo $q;*/
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row['0'];
        } else {
            return false;
        }
    }
     public function deleteProspectRecord($prospectId)
    {
       $prospectStatusAry = $this->Prospect_Model->getProspectStatusDetails($idProspect,1);
       if(!empty($prospectStatusAry))
       {
        foreach($prospectStatusAry as $prospectData){
        $this->deleteStatus($prospectData['id']);  
       }      
       }
       $mettingsDetailsSearchAry = $this->Prospect_Model->getAllMeetingDetailsByProspectsId($idProspect);
       if(!empty($mettingsDetailsSearchAry)){
         foreach($mettingsDetailsSearchAry as $meetingData){
        $this->deleteMeeting($meetingData['id']);  
       }   
       }
       
      
        $dataAry = array(
            'isDeleted' => '1'
        );
        $this->db->where('id', $prospectId);
        if ($query = $this->db->update(__DBC_SCHEMATA_PROSPECT__, $dataAry)) {
            return true;
        } else {
            return false;
        }
    }
     function updateProspectDetails($data,$prospectId){
         if(empty($data['iFranchiseeId'])){
             $data['iFranchiseeId']  =  $_SESSION['drugsafe_user']['id'];  
          }
          else{
             $data['iFranchiseeId'] =$data['iFranchiseeId']; 
          }
         $failarr = array();
         $franchiseeid  =  $_SESSION['drugsafe_user']['id'];
         $date = date('Y-m-d H:i:s');
            $dataAry = array(
                'iFranchiseeId' => (int)$data['iFranchiseeId'],
                'szName' => $data['szName'],
                'szEmail' => $data['szEmail'],
                'szContactNo' => $data['szContactNo'],
                'szCountry' => $data['szCountry'],
                'abn' => $data['abn'], 
                'szCity' => $data['szCity'],
                'szZipCode' => $data['szZipCode'],
                'szAddress' => $data['szAddress'],
                'szBusinessName' => $data['szBusinessName'],
                'szContactEmail' => $data['szContactEmail'],
                'szContactPhone' => $data['szContactPhone'],
                'szContactMobile' => $data['szContactMobile'],
                'szCreatedBy' => $_SESSION['drugsafe_user']['id'],
                'industry' => $data['industry'],
                'dtUpdatedOn' =>$date,
                'isDeleted' =>'0'
            );
         
        $whereAry = array('id' => (int)$prospectId);
     $qyeryUpdate =  $this->db->where($whereAry)
            ->update(__DBC_SCHEMATA_PROSPECT__, $dataAry);
        
         if (!$qyeryUpdate) {
                $message = "Some error occurred while edit prospect.";
                array_push($failarr, $message);
            }
            else{
               return true; 
            }
    }
     function insertMeetingNotes($data,$idProspect){
       
        $date = date('Y-m-d H:i:s');
        $franchiseeid  =  $_SESSION['drugsafe_user']['id'];
            $whereAry = array(
                'idProspect' => (int)$idProspect,
                'szDescription' => $data['szDiscription'],
                'dtCreatedOn' => $date,
                'szCreatedBy' => $franchiseeid
            );
          $this->db->insert(__DBC_SCHEMATA_MEETINGS_NOTE__, $whereAry);
            if (!($this->db->affected_rows() > 0)) {
                return false; 
            }
            else{
                $whereAry = array('id' => (int)$idProspect);
                $dataAry = array(
                'dt_last_updated_meeting' => $date
             );
             $qyeryUpdate =  $this->db->where($whereAry)
             ->update(__DBC_SCHEMATA_PROSPECT__, $dataAry);
               return true; 
            }
        
    }
     function getAllMeetingDetailsByProspectsId($prospectsId,$meetingNoteCreatedBy='0', $limit = __PAGINATION_RECORD_LIMIT__, $offset = 0,$flag='')
    { 
       if($meetingNoteCreatedBy > 0){
         $array = array('idProspect' => (int)$prospectsId,'szCreatedBy' => (int)$meetingNoteCreatedBy,);   
       } 
       else{
            $array = array('idProspect' => (int)$prospectsId);
       }
       
     
          
       if($flag==1){
          $query = $this->db->select('szCreatedBy')
           ->distinct('szCreatedBy')
            ->from(__DBC_SCHEMATA_MEETINGS_NOTE__)
            ->where($array)
             ->limit($limit, $offset)
            ->order_by("id","desc")
            ->get();
       }
       else{
           $query = $this->db->select('id,szDescription,dtCreatedOn,szCreatedBy')
       
            ->from(__DBC_SCHEMATA_MEETINGS_NOTE__)
            ->where($array)
               ->limit($limit, $offset)
            ->order_by("id","desc")
            ->get(); 
       }
        
//        $q = $this->db->last_query();
//        echo $q; die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
     function getProspectStatusDetails($prospectsId,$flag='0')
    {
         $array = array('prospectId' => (int)$prospectsId);
        if($flag==1){
          $query = $this->db->select('id,status,prospectId,dtUpdatedOn,szUpdatedBy')
            ->from(__DBC_SCHEMATA_STATUS__)
           ->order_by("id","desc")
            ->where($array)
            ->get();
       }
       else{
             $query = $this->db->select('MAX(id)')
            ->from(__DBC_SCHEMATA_STATUS__)
            ->where($array)
            ->get();
       }
      

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            if($flag==1){
             return $row;    
            }
            else{
              return $row['0'];   
            }
           
        } else {
            return false;
        }
    } 
     function getStatusDetailsByStatusId($statusId)
    {
       
        $array = array('id' => (int)$statusId);
        $query = $this->db->select('id,status,szUpdatedBy,prospectId,dtUpdatedOn')
            ->from(__DBC_SCHEMATA_STATUS__)
            ->where($array)
            ->get();
//      $q = $this->db->last_query();
//        echo $q;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row['0'];
        } else {
            return false;
        }
    }
    
         function updateProspectStatus($data,$prospectsId)
    { 
        $date = date('Y-m-d H:i:s');
        $franchiseeid  =  $_SESSION['drugsafe_user']['id'];
            $whereAry = array(
                'prospectId' => (int)$prospectsId,
                'status' => $data['status'],
                'dtUpdatedOn' =>$date,
                'szUpdatedBy' =>$franchiseeid
               
            );
            $this->db->insert(__DBC_SCHEMATA_STATUS__, $whereAry);   
            if (!($this->db->affected_rows() > 0)) {
                $message = "Some error occurred while adding product.";
                array_push($failarr, $message);
            }
            else{
             $dataAry = array(
                'status' => $data['status'],
           
            ); 
          $whereAry = array('id' => (int)$prospectsId);
          $qyeryUpdate =  $this->db->where($whereAry)
            ->update(__DBC_SCHEMATA_PROSPECT__, $dataAry);
               return true; 
            }
        
    }
     function getMettingDetailsById($Id)
    {
        
       $array = array('id' => (int)$Id);
       $query = $this->db->select('szDescription')
            ->from(__DBC_SCHEMATA_MEETINGS_NOTE__)
            ->where($array)
            ->get();
        /*$q = $this->db->last_query();
        echo $q;*/
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row['0'];
        } else {
            return false;
        }
    }
     public function checkProspectExists($szEmail = false, $id = 0)
    {

        $szEmail = trim($szEmail);

        $user_session = $this->session->userdata('drugsafe_user');

        if ((empty($szEmail)) && (!empty($user_session))) {
            $user_session = $this->session->userdata('drugsafe_user');
            $szEmail = $user_session['szEmail'];

        }

        if ((int)$id > 0) {
            $result = $this->db->get_where(__DBC_SCHEMATA_PROSPECT__, array('szEmail' => $szEmail, 'id !=' => (int)$id, 'isDeleted !=' => '1'));
        } else {
            $result = $this->db->get_where(__DBC_SCHEMATA_PROSPECT__, array('szEmail' => $szEmail, 'isDeleted !=' => '1'));
        }

        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    } 
    public function checkBusinessNameExists($szBusinessName = false, $id = 0,$flag='0')
    {
        $szBusinessName = trim($szBusinessName);

    
        if ((int)$id > 0) {
            if($flag==1){
                $result = $this->db->get_where(__DBC_SCHEMATA_PROSPECT__, array('szBusinessName' => $szBusinessName,'id!=' => (int)$id,'isDeleted !=' => '1'));  
            }
            else{
                  $result = $this->db->get_where(__DBC_SCHEMATA_PROSPECT__, array('szBusinessName' => $szBusinessName,'id!=' => (int)$id,'isDeleted !=' => '1'));
            }
          
        } else {
            $result = $this->db->get_where(__DBC_SCHEMATA_PROSPECT__, array('szBusinessName' => $szBusinessName,'isDeleted !=' => '1'));
        }

        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    } 
  function getSqlFormattedDate($unFormatted_date)
{ 
    $dateAry = explode('at', $unFormatted_date);
    $dateDataAry = explode('/',$dateAry['0']);
   
    $timeDataAry = explode(':',$dateAry['1']);
    
    $time1DataAry = explode(' ',$timeDataAry['1']);
   if($time1DataAry=='AM'){
    $formattedDate=$dateDataAry['2'].'-'.$dateDataAry['1'].'-'.$dateDataAry['0'].' '.$timeDataAry['0'].':'.$time1DataAry['0'].':'.'00';  
   
    }
   else{
       $value =$timeDataAry['0'] ;
       $time = 12+$value;
       $formattedDate=$dateDataAry['2'].'-'.$dateDataAry['1'].'-'.$dateDataAry['0'].' '.$time.':'.$time1DataAry['0'].':'.'00';  
   
       
   }
 
   return $formattedDate;  
}
 public function deleteMeeting($meetingId)
	{   
          
                $this->db->where('id', $meetingId);
		if($query = $this->db->delete(__DBC_SCHEMATA_MEETINGS_NOTE__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         public function deleteStatus($prospectId)
	{   
          
                $this->db->where('prospectId', $prospectId);
		if($query = $this->db->delete(__DBC_SCHEMATA_STATUS__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
  function getAllProspectDetailsByFrId($franchiseeId)
    {
      
       $array = array('iFranchiseeId' => (int)$franchiseeId, 'isDeleted' => '0');
        
           $query = $this->db->select('id,szName,szCity,szZipCode,abn,szContactMobile,szContactEmail,szContactPhone,industry,szCountry,szAddress,szBusinessName,szEmail,szContactNo,dtCreatedOn,dtUpdatedOn,status,dt_last_updated_meeting')
            ->from(__DBC_SCHEMATA_PROSPECT__)
           ->order_by("id","desc") 
           ->limit($limit, $offset)
            ->where($array)
            ->get();
    

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
     public function changeToClient($idProspect)
    {
       
        $dataAry = array(
            'szConvertToClient' => '1'
        );
        $this->db->where('id', $idProspect);

        if ($query = $this->db->update(__DBC_SCHEMATA_PROSPECT__, $dataAry)) {
            return true;
        } else {
            return false;
        }
    }
}
?>