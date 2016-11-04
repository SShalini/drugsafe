<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockMgt_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();   
    
    public function getProductsByCategory($szProductCategory)
   	{
        
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_PRODUCT__);
            $whereAry = array('szProductCategory' => $szProductCategory,'isDeleted=' => '0');
            $this->db->where($whereAry);
            $query = $this->db->get();
          
            if($query->num_rows() > 0)
            {
               
                    return $query->result_array();
         
            }
   		return false;
   	}
         function insertModelStockValue($idfranchisee,$data)
        { 
         
            $dataAry = array(

                                'iFranchiseeId' => $idfranchisee,
                                'iProductId' => $data['szProduct'],
                                'szModelStockVal' => $data['szModelStockVal']
                                
            );


                $this->db->insert(__DBC_SCHEMATA_MODEL_STOCK_VALUE__, $dataAry);

                if($this->db->affected_rows() > 0)
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
