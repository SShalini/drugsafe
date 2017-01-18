<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();
    
	  function InsertOrder($idProduct,$quantity)
        {		
           $date = date('Y-m-d H:i:s');
            $CheckOrderExistArr = $this->CheckOrderExist($idProduct);
            
              if(!empty($CheckOrderExistArr)){
                 $quantityTotal = 0; 
                 foreach($CheckOrderExistArr as $CheckOrderExistData) {
                     $quantityTotal +=  $CheckOrderExistData['quantity'] ; 
                 } 
                 $quantityforUpdate = $quantity+$quantityTotal;
                 $dataAry = array(
                       'franchiseeid' => $_SESSION['drugsafe_user']['id'],
                       'productid' => $idProduct,
                       'quantity' => $quantityforUpdate,
                       'addedon' => $date,
                   );
             $this->db->where('productid',(int)$idProduct);
             $queyUpdate=$this->db->update(__DBC_SCHEMATA_CART__, $dataAry);  
            } 
            else{
               $dataAry = array(
                                'franchiseeid' => $_SESSION['drugsafe_user']['id'],
                                'productid' => $idProduct,
				'quantity' => $quantity,
                                'addedon' => $date,
                            );
	    $this->db->insert(__DBC_SCHEMATA_CART__, $dataAry); 
            }
             
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        }
       
    
        public function CheckOrderExist($id)
        {
        
            $whereAry = array('productid' => (int)$id);
            $this->db->select('id,quantity');
            $this->db->from(__DBC_SCHEMATA_CART__);
            $this->db->where($whereAry);
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
        public function getOrdersList()
        {
        
            $this->db->select('id');
            $this->db->from(__DBC_SCHEMATA_CART__);
            $query = $this->db->get();
          
            if($query->num_rows() > 0)
            {
                return  $query->result_array();
            }
            else
            {
                return array();
            }
        }
}
?>