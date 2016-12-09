<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Model extends Error_Model {
    
     public function getAllQtyRequestDetails($searchAry = '',$limit=__PAGINATION_RECORD_LIMIT__,$offset=0,$id=0,$name='',$productCode='')
        {
     
          $searchq = '';
        if($id > '0'){
            $searchq = 'iFranchiseeId = '.(int)$id;
        }
        if(!empty($name)){
            $searchq = "szName LIKE '%$name%'";
        }
        if(!empty($productCode)){
            $searchq = "szProductCode LIKE '%$productCode%'";
        }
          
          
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
            $this->db->join('ds_user','tbl_stock_request.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_request.iProductId = tbl_product.id');
            
              if (!empty($searchq)) {
               $this->db->where($searchq);
               } 
            
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_REQUEST_QUANTITY__.'.id DESC');
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
         public function getAllQtyAssignDetails($searchAry = '',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$id='0',$name='',$productCode='')
        {
          
             $searchq = '';
        if($id > '0'){
            $searchq = 'iFranchiseeId = '.(int)$id;
        }
        if(!empty($name)){
            $searchq = "szName LIKE '%$name%'";
        }
        if(!empty($productCode)){
            $searchq = "szProductCode LIKE '%$productCode%'";
        }
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);
            $this->db->join('ds_user','tbl_stock_assign_tracking.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_assign_tracking.iProductId = tbl_product.id');
             if (!empty($searchq)) {
               $this->db->where($searchq);
               }
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_STOCK_REQ_TRACKING__.'.id DESC');
            $query = $this->db->get();
// $sql = $this->db->last_query($query);
// print_r($sql);die;
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
      
        public function getFrAllQtyRequestDetails($searchAry = '',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$franchiseeId = 0)
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
         public function getFrAllQtyAssignDetails($searchAry='',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$franchiseeId = 0)
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
