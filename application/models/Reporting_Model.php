<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Model extends Error_Model {
    
     public function getAllQtyRequestDetails($searchAry = '',$limit=__PAGINATION_RECORD_LIMIT__,$offset=0,$searchItemData='',$flag='0')
        {
     
          if(!empty($searchItemData)){
               $searchq = "iFranchiseeId LIKE '%$searchItemData%' OR szName LIKE '%$searchItemData%' OR szProductCode LIKE '%$searchItemData%'";
            }
            if($flag==1){
            $this->db->distinct();
           $this->db->select( 'szName');  
        }elseif($flag==2)
        {
           $this->db->distinct();
           $this->db->select( 'szProductCode');   
        }
            else{
           $this->db->select( '*');  
        }
         
          
            $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
            if($_SESSION['drugsafe_user']['iRole']==5){
          
            $operationManagerId =  $_SESSION['drugsafe_user']['id'];
            $whereAry = array('operationManagerId' => $operationManagerId);
            $this->db->join('ds_user','tbl_stock_request.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_request.iProductId = tbl_product.id');
            $this->db->join('tbl_franchisee','tbl_stock_request.iFranchiseeId = tbl_franchisee.franchiseeId');
             if (!empty($searchq)) {
               $this->db->where($searchq);
               $this->db->where($whereAry);
               }
               else{
                  $this->db->where($whereAry);  
               }
            
            }
            else{
             $this->db->join('ds_user','tbl_stock_request.iFranchiseeId = ds_user.id');
             $this->db->join('tbl_product','tbl_stock_request.iProductId = tbl_product.id');   
             if (!empty($searchq)) {
               $this->db->where($searchq);
               } 
                if($flag==3){
                    if( $searchItemFr &&  $searchItemProd ){
                          $whereAry = array('szName' => $searchItemFr,'szProductCode' => $searchItemProd);  
                    } else{
                         $whereAry = array('szName' => $_POST['szSearch2'],'szProductCode' => $_POST['szSearch']);   
                    }
           
                 $this->db->where($whereAry);
            }
            }
            
            
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_REQUEST_QUANTITY__.'.id DESC');
            $query = $this->db->get();
//$sql = $this->db->last_query($query);
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
         public function getAllQtyAssignDetails($searchAry = '',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchItemData='',$flag='0')
        {
            if(!empty($searchItemData)){
               $searchq = "iFranchiseeId LIKE '%$searchItemData%' OR szName LIKE '%$searchItemData%' OR szProductCode LIKE '%$searchItemData%'";
            }
           
        if($flag==1){
            $this->db->distinct();
           $this->db->select( 'szName');  
        }elseif($flag==2)
        {
           $this->db->distinct();
           $this->db->select( 'szProductCode');   
        }
            else{
           $this->db->select( '*');  
        }
           
            $this->db->from(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);
            
             if($_SESSION['drugsafe_user']['iRole']==5){
          
            $operationManagerId =  $_SESSION['drugsafe_user']['id'];
            $whereAry = array('operationManagerId' => $operationManagerId);
            $this->db->join('ds_user','tbl_stock_assign_tracking.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_assign_tracking.iProductId = tbl_product.id');
            $this->db->join('tbl_franchisee','tbl_stock_assign_tracking.iFranchiseeId = tbl_franchisee.franchiseeId');
             if (!empty($searchq)) {
               $this->db->where($searchq);
               $this->db->where($whereAry);
               }
               else{
                  $this->db->where($whereAry);  
               }
            
            }
            else{
            $this->db->join('ds_user','tbl_stock_assign_tracking.iFranchiseeId = ds_user.id');
            $this->db->join('tbl_product','tbl_stock_assign_tracking.iProductId = tbl_product.id');
             if (!empty($searchq)) {
               $this->db->where($searchq);
               }
                if($flag==3){
                    if( $searchItemFr &&  $searchItemProd ){
                          $whereAry = array('szName' => $searchItemFr,'szProductCode' => $searchItemProd);  
                    } else{
                         $whereAry = array('szName' => $_POST['szSearch2'],'szProductCode' => $_POST['szSearch']);   
                    }
           
                 $this->db->where($whereAry);
            }
            }
            $this->db->limit($limit, $offset);
            $this->db->order_by(__DBC_SCHEMATA_STOCK_REQ_TRACKING__.'.id DESC');
            $query = $this->db->get();
//$sql = $this->db->last_query($query);
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
public function searchterm_handler($searchterm='')
{
    if($searchterm)
    { 
        $this->session->set_userdata('searchterm',$searchterm);
        return $searchterm;
    }
    elseif($this->session->userdata('searchterm'))
    { 
        $searchterm = $this->session->userdata('searchterm');
        return $searchterm;
    }
    else
    { 
        $searchterm ="";
        return $searchterm;
    }
}
public function searchtermAssign_handler($searchtermAssign='')
{
    if($searchtermAssign)
    { 
        $this->session->set_userdata('searchtermAssign',$searchtermAssign);
        return $searchtermAssign;
    }
    elseif($this->session->userdata('searchtermAssign'))
    { 
        $searchtermAssign= $this->session->userdata('searchtermAssign');
        return $searchtermAssign;
    }
    else
    { 
        $searchtermAssign ="";
        return $searchtermAssign;
    }
}

}
?>