<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockMgt_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();   
    
   
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
        
    public function getStockValueDetailsById($idfranchisee,$id=0)
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
        public function getProductQtyDetailsById($idfranchisee,$id=0)
    {

        $this->db->select('*');
         $whereAry = array('iProductId' => $id,'iFranchiseeId' => $idfranchisee);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__);
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
     function insertProductStockQuantity($idfranchisee,$data,$idProduct)
        { 
         
            $dataAry = array(

                                'iFranchiseeId' => $idfranchisee,
                                'iProductId' => $idProduct,
                                'szQuantity' => $data['szQuantity']
                                
            );


                $this->db->insert(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry);

                if($this->db->affected_rows() > 0)
               {
  
                   return true;
               }
               else
               {
                   return false;
             }

        }
        public function updateProductStockQty($data_validate,$idProduct)
         {
           $szQuantity= trim($data_validate['szQuantity'] + $data_validate['szAddMoreQuantity']);

            $dataAry = array(
 
                                 'szQuantity' => $szQuantity
                );
                $whereAry = array('iProductId' => (int)$idProduct);

                $this->db->where($whereAry);

             $queryUpdate =    $this->db->update(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry);
                
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
