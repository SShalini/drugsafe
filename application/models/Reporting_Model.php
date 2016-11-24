<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Model extends Error_Model {
    
     public function getAllQtyRequestDetails($searchAry,$limit,$offset)
        {
        
            $searchAry = trim($searchAry);
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
            $this->db->join('ds_user','tbl_stock_request.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_request.iProductId = tbl_product.id');
            if(!empty($searchAry)){
           
                $this->db->where("(iFranchiseeId LIKE '%$searchAry%' OR szName LIKE '%$searchAry%' OR szProductCode LIKE '%$searchAry%')");
           
                }
            $this->db->limit($limit, $offset);
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
         public function getAllQtyAssignDetails($searchAry,$limit,$offset)
        {
          
            $searchAry = trim($searchAry);
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);
            $this->db->join('ds_user','tbl_stock_assign_tracking.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_assign_tracking.iProductId = tbl_product.id');
            if(!empty($searchAry)){
           
                $this->db->where("(iFranchiseeId LIKE '%$searchAry%' OR szName LIKE '%$searchAry%' OR szProductCode LIKE '%$searchAry%')");
           
                }
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_STOCK_REQ_TRACKING__.'.id DESC');
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
      
        public function getFrAllQtyRequestDetails($searchAry,$limit,$offset,$franchiseeId)
        {
        
            $searchAry = trim($searchAry);
             if(!empty($searchAry)){
          
                $whereAry = array('iFranchiseeId' => $franchiseeId,'szProductCode' => $searchAry);
           
                }
                else{
                    $whereAry = array('iFranchiseeId' => $franchiseeId); 
                }
           
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
            $this->db->join('tbl_product','tbl_stock_request.iProductId = tbl_product.id');
          
             $this->db->where($whereAry);
            $this->db->limit($limit, $offset);
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
         public function getFrAllQtyAssignDetails($searchAry,$limit,$offset,$franchiseeId)
        {
            $searchAry = trim($searchAry);
             if(!empty($searchAry)){
          
                $whereAry = array('iFranchiseeId' => $franchiseeId,'szProductCode' => $searchAry);
           
                }
                else{
                    $whereAry = array('iFranchiseeId' => $franchiseeId); 
                }
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);
            $this->db->join('tbl_product','tbl_stock_assign_tracking.iProductId = tbl_product.id');
            $this->db->where($whereAry);
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_STOCK_REQ_TRACKING__.'.id DESC');
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
      
}
?>
