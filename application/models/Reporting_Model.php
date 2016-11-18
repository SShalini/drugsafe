<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Model extends Error_Model {
    
     public function getAllQtyRequestDetails()
        {
            $this->db->select('*');
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
      
}
?>
