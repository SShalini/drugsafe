<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Management_Model extends Error_Model {
    
   public function getsosFormDetails($idsite,$flag=0)
    {
        $whereAry = array('Clientid=' => $idsite);
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->join('ds_user', 'ds_sos.Clientid = ds_user.id');
        $this->db->where($whereAry);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            if($flag==1){
                return $row[0];
            }
            else{
               return $row;  
            }
        } else {
            return array();
        }
    } 
     public function getsosFormDetailsByClientId($idClient)
    {
        $whereAry = array('Clientid' => $idClient,'Status'=>'1');
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->where($whereAry); 
        $query = $this->db->get();
       //$sql = $this->db->last_query($query);
//print_r($sql);die;
        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row;
        } else {
            return array();
        }
    } 
    
     public function getDonarDetailBySosId($idSos)
    {
        $whereAry = array('sosid' => $idSos);
        $this->db->select('*');
        $this->db->order_by($sortBy, $orderBy);
        $this->db->order_by("id", "asc");
        $this->db->from(__DBC_SCHEMATA_DONER__);
        $this->db->where($whereAry); 
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    } 
     public function getSosDetailBySosId($idSos)
    {
        $whereAry = array('id' => $idSos);
        $this->db->select('*');
        $this->db->order_by($sortBy, $orderBy);
        $this->db->order_by("id", "asc");
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->where($whereAry); 
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
         $row=  $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    } 
      public function getDonarDetailByCocId($idCoc)
    {
        $whereAry = array('cocid' => $idCoc);
        $this->db->select('*');
        $this->db->order_by($sortBy, $orderBy);
        $this->db->order_by("id", "asc");
        $this->db->from(__DBC_SCHEMATA_DONER__);
        $this->db->where($whereAry); 
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
         $row=  $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    } 
    public function getActiveDonorDetailsBySosId($idSos)
    {
        $whereAry = array('sosid' => $idSos,'cocid!='=>'0');
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_DONER__);
        $this->db->where($whereAry); 
        $query = $this->db->get();
       
        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row;
        } else {
            return array();
        }
    } 
    public function getCocFormDetailsByCocId($idcoc)
    {
        $whereAry = array('id' => $idcoc);
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_COC_FORM__);
        $this->db->where($whereAry); 
        $query = $this->db->get();
       
        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row[0];
        } else {
            return array();
        }
    } 
    public function getsosFormDetailsByMultipleClientId($id)
    {
        $whereAry = array('Status'=>'1');
        
        $this->db->where_in('Clientid', $id);
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->where($whereAry); 
        $query = $this->db->get();
       $sql = $this->db->last_query($query);
      
        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row;
        } else {
            return array();
        }
    } 
    public function getAllsosFormDetails($searchAry=array())
    {
        
        $dtStart = $this->Order_Model->getSqlFormattedDate($searchAry['dtStart']);
        $dtEnd = $this->Order_Model->getSqlFormattedDate($searchAry['dtEnd']);
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_MANUAL_CAL__, __DBC_SCHEMATA_SOS_FORM__,'tbl_client');
        $this->db->join('ds_sos', 'tbl_manual_calc.sosid = ds_sos.id');
        $this->db->join('tbl_client', 'ds_sos.Clientid = tbl_client.clientId');
        $this->db->where('dtCreatedOn >=', $dtStart);
        $this->db->where('dtCreatedOn <=', $dtEnd);
        $this->db->where('clientType !=', '0');
        $this->db->where('status', '1');
        $this->db->group_by('franchiseeId');
        $query = $this->db->get();
        //echo $sql = $this->db->last_query(); die();

        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row;
        } else {
            return array();
        
        }
    } 
}
?>