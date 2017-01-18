<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends Error_Model {
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();
    
	function insertProduct()
        {		
            $date=date('Y-m-d');
            $expiredOn=$_POST['productData']['dtExpiredOn'];
            $dtExpiredOn = date("Y-m-d", strtotime($expiredOn));
            $dataAry = array(
                                'szProductImage' => $_POST['productData']['szProductImage'],
                                'szProductCode' => $_POST['productData']['szProductCode'],
                                'szProductDiscription'=>$_POST['productData']['szProductDiscription'],
                                'szProductCost' => $_POST['productData']['szProductCost'],
                                'szProductCategory' => $_POST['productData']['szProductCategory'],
				'dtCreatedOn' => $date,
                                'dtExpiredOn' => $dtExpiredOn
                            );
	    $this->db->insert(__DBC_SCHEMATA_PRODUCT__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        }
      
     
        public function getProductDetailsById($id)
        {
        
            $whereAry = array('id' => (int)$id);
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_PRODUCT__);
            $this->db->where($whereAry);
            $query = $this->db->get();
          
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
        public function UpdateProduct($id)
        {
            $expiredOn=$_POST['productData']['dtExpiredOn'];
            $dtExpiredOn = date("Y-m-d", strtotime($expiredOn));
            $dataAry = array(                                  
                                'szProductImage' => $_POST['productData']['szProductImage'],
                                'szProductCode' => $_POST['productData']['szProductCode'],
                                'szProductDiscription'=>$_POST['productData']['szProductDiscription'],
                                'szProductCost' => $_POST['productData']['szProductCost'],
                                'dtExpiredOn' => $dtExpiredOn,
                                'szProductCategory' => $_POST['productData']['szProductCategory'],
                            );
                $this->db->where('id',(int)$id);
                $queyUpdate=$this->db->update(__DBC_SCHEMATA_PRODUCT__, $dataAry);
                if($queyUpdate)
                { 
                    return true;
                }
                else
                {
                    return false;
                }
            }
     public function viewDrugTestKitList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry = '',$flag='')
        {
            $searchAry = trim($searchAry);
            if($_SESSION['drugsafe_user']['iRole']==1 || $_SESSION['drugsafe_user']['iRole']==5 )
            {
                if(!empty($searchAry)){
                    $whereAry = array('isDeleted=' => '0','szProductCategory' => '1');
                    $this->db->where("(szProductCode LIKE '%$searchAry%')");
                }
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '1');
                }
            if($flag==1){
              $this->db->select('id');  
            }
            else{
             $this->db->select('*');   
            }
            
            $this->db->where($whereAry); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);
      
            }
            else{
            $idfranchisee = $_SESSION['drugsafe_user']['id'];
             if(!empty($searchAry)){
                  
                     $whereAry = array('isDeleted=' => '0','szProductCategory' => '1','iFranchiseeId=' => $idfranchisee);
                      $this->db->where("(szProductCode LIKE '%$searchAry%')");
                     }
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '1','iFranchiseeId=' => $idfranchisee);
                }
           
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_PRODUCT__);
            $this->db->join('fr_prodstock_qty', 'tbl_product.id = fr_prodstock_qty.iProductId');
            $this->db->where($whereAry);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            }
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
         public function viewMarketingMaterialList($searchAry= '',$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0)
        {
            $searchAry = trim($searchAry);
            if($_SESSION['drugsafe_user']['iRole']==1 || $_SESSION['drugsafe_user']['iRole']==5){
            
                 if(!empty($searchAry)){
                    $whereAry = array('isDeleted=' => '0','szProductCategory' => '2');
                    $this->db->where("(szProductCode LIKE '%$searchAry%')");
                    }
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '2');
                }
                
            
            $this->db->select('*');
            $this->db->where($whereAry); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);
            } 
         
            else{
            $idfranchisee = $_SESSION['drugsafe_user']['id'];
             if(!empty($searchAry)){
                    $whereAry = array('isDeleted=' => '0','szProductCategory' => '2','iFranchiseeId=' => $idfranchisee);
                    $this->db->where("(szProductCode LIKE '%$searchAry%')");}
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '2','iFranchiseeId=' => $idfranchisee);
                }
            
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_PRODUCT__);
            $this->db->join('fr_prodstock_qty', 'tbl_product.id = fr_prodstock_qty.iProductId');
            $this->db->where($whereAry); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get();

            }
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }
        public function deleteProduct($idProduct)
	{
                $data = $this->input->post('idProduct');
               
		$dataAry = array(
			'isDeleted' => '1'
                );  
                $this->db->where('id', $idProduct);
		if($query = $this->db->update(__DBC_SCHEMATA_PRODUCT__, $dataAry))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
  public function viewConsumablesList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='')
        {
            $searchAry = trim($searchAry);
            if($_SESSION['drugsafe_user']['iRole']==1 || $_SESSION['drugsafe_user']['iRole']==5)
            {
                if(!empty($searchAry)){
                    $whereAry = array('isDeleted=' => '0','szProductCategory' => '3');
                    $this->db->where("(szProductCode LIKE '%$searchAry%')");
                }
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '3');
                }
            
            $this->db->select('*');
            $this->db->where($whereAry); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);
      
            }
            else{
            $idfranchisee = $_SESSION['drugsafe_user']['id'];
             if(!empty($searchAry)){
                  
                     $whereAry = array('isDeleted=' => '0','szProductCategory' => '3','iFranchiseeId=' => $idfranchisee);
                      $this->db->where("(szProductCode LIKE '%$searchAry%')");
                     }
                else{
                   $whereAry = array('isDeleted=' => '0','szProductCategory' => '3','iFranchiseeId=' => $idfranchisee);
                }
           
            $this->db->select('*');
            $this->db->from(__DBC_SCHEMATA_PRODUCT__);
            $this->db->join('fr_prodstock_qty', 'tbl_product.id = fr_prodstock_qty.iProductId');
            $this->db->where($whereAry);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            }
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