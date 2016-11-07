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
         function insertModelStockValue($idfranchisee,$data,$idProduct)
        { 
         
            $dataAry = array(

                                'iFranchiseeId' => $idfranchisee,
                                'iProductId' => $idProduct,
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
        public function viewDrugTestKitList()
        {

            $whereAry = array('isDeleted=' => '0','szProductCategory' => '1');

            $this->db->select('*');
            $this->db->where($whereAry);  
            $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
        
       public function viewMarketingMaterialList()
        {

            $whereAry = array('isDeleted=' => '0','szProductCategory' => '2');

            $this->db->select('*');
            $this->db->where($whereAry);  
            $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
        
         public function getProductDetailsById($idfranchisee,$id=0)
    {

        $this->db->select('*');
         $whereAry = array('iProductId' => $id,'iFranchiseeId' => $idfranchisee);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_MODEL_STOCK_VALUE__);

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
    public function getModelstockDetailsById($idfranchisee,$idproduct)
    {
 
        $this->db->select('*');
        $whereAry = array('iProductId' => $idproduct,'iFranchiseeId' => $idfranchisee);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_MODEL_STOCK_VALUE__);
          $sql = $this->db->last_query($query);
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
    public function getProductsDetailsById($idproduct)
    {

        $this->db->select('*');
        $whereAry = array('id' => $idproduct);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);
        
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
     public function getCategoryDetailsById($idCategory)
    {

        $this->db->select('szName');
        $whereAry = array('id' => $idCategory);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT_CATEGORY__);
        
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
    public function updateModelStockVal($data_validate,$idProduct)
    {
        $szModelStockVal=$data_validate['szModelStockVal'];
    
        
            $dataAry = array(
 
                                'szModelStockVal' => $szModelStockVal
                );
                $whereAry = array('iProductId' => (int)$idProduct);

                $this->db->where($whereAry);

             $queryUpdate =    $this->db->update(__DBC_SCHEMATA_MODEL_STOCK_VALUE__, $dataAry);
                
                if(!empty($queryUpdate))
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
