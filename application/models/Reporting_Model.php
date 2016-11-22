<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Model extends Error_Model {
    
     public function getAllQtyRequestDetails($limit,$offset)
        {
            $this->db->select('*');
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_REQUEST_QUANTITY__);


            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
         public function getAllQtyAssignDetails($limit,$offset)
        {
            $this->db->select('*');
             $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);


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
