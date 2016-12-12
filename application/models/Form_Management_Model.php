<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Management_Model extends Error_Model {
    
   public function getsosFormDetails($idsite)
    {
        $whereAry = array('Clientid=' => $idsite);
        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->join('ds_user', 'ds_sos.Clientid = ds_user.id');
        $this->db->where($whereAry);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            $row = $query->result_array();
                return $row[0];
        } else {
            return array();
        }
    } 
     public function getsosFormDetailsByClientId($idClient)
    {
        $whereAry = array('Clientid' => $idClient);
        $this->db->select('id');
        $this->db->from(__DBC_SCHEMATA_SOS_FORM__);
        $this->db->where($whereAry); 
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
             $row = $query->result_array();
                return $row[0];
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
}
?>