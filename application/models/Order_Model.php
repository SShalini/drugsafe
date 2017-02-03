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
        public function getOrdersList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry = '')
        {
           if(!empty($searchAry)){
                    $whereAry = array('productid=' => $searchAry);
                    $this->db->where($whereAry);
                }
            $this->db->select('id,franchiseeid,productid,quantity');
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
        public function deleteOrder($idOrder)
	{
        
             $this->db->where('id', $idOrder);
		if($query = $this->db->delete(__DBC_SCHEMATA_CART__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
      public function updateOrder($quantity,$orderId)
	{
		$dataAry = array(
			'quantity' => $quantity
                );  
                $this->db->where('id', $orderId);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_CART__, $dataAry))
                        
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
  public function getOrdersListByFranchisee($franchiseeId)
        {
          
            $whereAry = array('franchiseeid=' => $franchiseeId);
            $this->db->select('id,franchiseeid,productid,addedon,quantity');
            $this->db->from(__DBC_SCHEMATA_CART__);
            $this->db->where($whereAry);
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
   function InsertOrderSuccess($franchiseeId,$Price)
        { 
        
          $date = date('Y-m-d H:i:s');
          $dataAry = array(
                                'franchiseeid' => $franchiseeId,
                                'price' => $Price,
				'status' => '1',
                                'createdon' => $date,
                            );
	    $this->db->insert(__DBC_SCHEMATA_ORDER__, $dataAry); 
            if($this->db->affected_rows() > 0)
            {
                $id_order = (int)$this->db->insert_id();
             return $id_order;
            }
            else
            {
                return false;
            }
        }
     function InsertOrderDetails($totalOrdersData,$idorder)
        { 
          
          $orderid = $idorder;
          
                $dataAry = array(
                                'orderid' => $orderid,
                                'productid' => $totalOrdersData['productid'],
				'quantity' => $totalOrdersData['quantity'],
                                'dispatched' => '0',
                            );
            $this->db->insert(__DBC_SCHEMATA_ORDER_DETAILS__, $dataAry); 
        if($this->db->affected_rows() > 0){
            
             $this->db->where('franchiseeid', $totalOrdersData['franchiseeid']);
	     if($query = $this->db->delete(__DBC_SCHEMATA_CART__))
                { 
                 $this->session->set_userdata('orderid', $orderid);
                  $updatedataAry = array(
                                'validorder' => '1',
                            );
                  $this->db->where('id',(int)$orderid);
             if($this->db->update(__DBC_SCHEMATA_ORDER__, $updatedataAry))
             {
               return true;  
             }
             else{
                 return false; 
             }
                    return true;
                }
                else
                {
                    return false;
                }
                 return true;
            }
             else
            {
                return false;
            }
            
        }
       public function getOrderDetailsByFrId($franchiseeId)
        {
          
            $whereAry = array('franchiseeid=' => $franchiseeId);
            $this->db->select('id');
            $this->db->from(__DBC_SCHEMATA_ORDER__);
            $this->db->where($whereAry);
            $query = $this->db->get();
          
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();
                  return $row['0'];
            }
            else
            {
                return array();
            }
        }  
       public function getOrderDetailsByOrderId($orderId)
        {
          
            $whereAry = array('orderid=' => $orderId);
            $this->db->select('orderid,productid,quantity,dispatched');
            $this->db->from(__DBC_SCHEMATA_ORDER_DETAILS__);
            $this->db->where($whereAry);
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
          public function getOrderByOrderId($orderId)
        {
          
            $whereAry = array('id=' => $orderId);
            $this->db->select('createdon,franchiseeid,status,price');
            $this->db->from(__DBC_SCHEMATA_ORDER__);
            $this->db->where($whereAry);
            $query = $this->db->get();
          
            if($query->num_rows() > 0)
            {
                 $row = $query->result_array();
                 return  $row['0']; 
            }
            else
            {
                return array();
            }
        }
         
 public function getallValidOrderDetails($searchAry=array())
    {
        $searchQuery = 'validorder = 1';
         if(!empty($searchAry))
        {
            
            foreach($searchAry as $key=>$searchData)
            { 
                if($key == 'szSearch4' || $key == 'szSearch5')
                {
                    if(!empty($searchData))
                    {
                         $searchData = $this->getSqlFormattedDate($searchData);
                      
                    }
                    if(!empty($searchData))
                    {
                        if($key == 'szSearch4')
                        {
                            $startcreatedon=$searchData;
                            $searchQuery .="
                                AND
                                    createdon >= '".$searchData." 00:00:00'
                                ";
                        }
                    }
                    
                    if($key == 'szSearch5')
                    { 
                        if(!empty($searchData))
                        {
                            $endcreatedon=$searchData;
                            if($endcreatedon != '')
                            {
                                if(strtotime($startcreatedon) > strtotime($endcreatedon))
                                {
                                    $this->addError("szSearch5","To Date should be greater than From Date.");
                                    return false;
                                }
                            }
                            $searchQuery .="
                                AND
                                    createdon <= '".$searchData." 23:59:59'
                                ";
                        }
                    }
                    
                         
                }
             

                 if($key == 'szSearch1'){
                    if(!empty ($searchData)){
                        $searchQuery.="
                            AND franchiseeid = ".(int)($searchData);
                    }
                }
                if($key == 'szSearch2'){
                    if(!empty ($searchData)){
                        $searchQuery .="
                        AND 
                         orderid = ".(int)($searchData);
                    }
                }
                if($searchData != '')
                {
                    if($key =='szSearch3')
                    {
                        $searchQuery .="
                       AND
                            status = ".(int)($searchData);
                              
                    }
                    
                   
                    }
                }
                  
        }
        $this->db->where($searchQuery);
        $this->db->distinct();
        $this->db->select('franchiseeid,price,orderid,createdon,status');
        $this->db->order_by("orderid", "desc");
        $this->db->from(__DBC_SCHEMATA_ORDER__);
        $this->db->join('ds_order_details', 'ds_orders.id = ds_order_details.orderid');
     
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
          
            }
         
        else {
            return array();
        }
    } 
      public function getallValidOrderFrId()
    {
        $whereAry = array('validorder=' => '1');
        $this->db->distinct();
        $this->db->select('szName,franchiseeid');
        $this->db->from(__DBC_SCHEMATA_ORDER__);
        $this->db->join('ds_user', 'ds_orders.franchiseeid = ds_user.id');
        $this->db->where($whereAry);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
          
            }
         
        else {
            return array();
        }
    } 
    function getSqlFormattedDate($unFormatted_date)
{
    $dateAry=explode('/', $unFormatted_date);
    $formattedDate=$dateAry['2'].'-'.$dateAry['1'].'-'.$dateAry['0'];
    return $formattedDate;
    
}
 public function updateOrderByOrderId($orderId,$flag='0')
	{
     $date = date('Y-m-d H:i:s');
     if($flag==2){
       $dataAry = array(
			'status' => '4',
                        'dispatchedon' => $date
                );   
     }
     if($flag==3){
        $dataAry = array(
			'status' => '3',
                        'canceledon' => $date
            
                );  
     }
		 
                $this->db->where('id', $orderId);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_ORDER__, $dataAry))
                        
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         public function dispatchOrder($quantity,$orderId,$productid,$szAvailableQuantity,$franchiseeId)
	{ 
            
		$dataAry = array(
			'dispatched' => $quantity
                );
                 $whereAry = array('orderid=' => $orderId,'productid' => $productid);
                $this->db->where($whereAry);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_ORDER_DETAILS__, $dataAry))
                        
                {
                    $availableQuantity = $szAvailableQuantity-$quantity;
                   $dataAry = array(
			'szAvailableQuantity' => $availableQuantity
                ); 
                 $whereAry = array('id' => $productid);
                $this->db->where($whereAry);
                 
                if($query = $this->db->update(__DBC_SCHEMATA_PRODUCT__, $dataAry)){
                 
                   $prodQuantity =  $this->StockMgt_Model->getProductQtyDetailsById($franchiseeId,$productid);
                  $Quantity = $prodQuantity['szQuantity']+$quantity;
                   $dataAry = array(
			'szQuantity' => $Quantity
                ); 
                 $whereAry = array('iFranchiseeId' => $franchiseeId,'iProductId' => $productid);
                 $this->db->where($whereAry);
                 if($this->db->update(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry)) {
                  return true;
                } 
                else{
                   return false;  
                }
                    return true;
                }
                else
                {
                    return false;
                }
                return true;
                }
                
                else{
                   return false;  
                }
	}
         public function orderFinalUpdate($orderId,$price)
	{ 
             
            $date = date('Y-m-d H:i:s');
		$dataAry = array(
			'status' => '2',
                        'price' => $price,
                        'dispatchedon' => $date
                );
                 $whereAry = array('id=' => $orderId);
                $this->db->where($whereAry);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_ORDER__, $dataAry))
                        
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         public function pendingOrder($quantity,$orderId,$productid,$szAvailableQuantity,$franchiseeId)
	{ 
            
		$dataAry = array(
			'dispatched' => $quantity
                );
                 $whereAry = array('orderid=' => $orderId,'productid' => $productid);
                $this->db->where($whereAry);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_ORDER_DETAILS__, $dataAry))
                        
                {
                    $availableQuantity = $szAvailableQuantity-$quantity;
                   $dataAry = array(
			'szAvailableQuantity' => $availableQuantity
                ); 
                 $whereAry = array('id' => $productid);
                $this->db->where($whereAry);
                 
                if($query = $this->db->update(__DBC_SCHEMATA_PRODUCT__, $dataAry)){
                 
                   $prodQuantity =  $this->StockMgt_Model->getProductQtyDetailsById($franchiseeId,$productid);
                  $Quantity = $prodQuantity['szQuantity']+$quantity;
                   $dataAry = array(
			'szQuantity' => $Quantity
                ); 
                 $whereAry = array('iFranchiseeId' => $franchiseeId,'iProductId' => $productid);
                 $this->db->where($whereAry);
                 if($this->db->update(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry)) {
                  return true;
                } 
                else{
                   return false;  
                }
                    return true;
                }
                else
                {
                    return false;
                }
                return true;
                }
                
                else{
                   return false;  
                }
	}
         public function orderPendingUpdate($orderId,$price)
	{ 
             
            $date = date('Y-m-d H:i:s');
		$dataAry = array(
			'status' => '4',
                        'price' => $price
                );
                 $whereAry = array('id=' => $orderId);
                $this->db->where($whereAry);
                 
		if($query = $this->db->update(__DBC_SCHEMATA_ORDER__, $dataAry))
                        
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
      public function getallPendingValidOrderFrId()
    { 
        $whereAry = "validorder LIKE '%1%' OR status LIKE '%4%' OR status LIKE '%1%'";
        $this->db->distinct();
        $this->db->select('szName,franchiseeid');
        $this->db->from(__DBC_SCHEMATA_ORDER__);
        $this->db->join('ds_user', 'ds_orders.franchiseeid = ds_user.id');
        $this->db->where($whereAry);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
          
            }
         
        else {
            return array();
        }
    }
    public function getallValidPendingOrderDetails($searchAry=array())
    {
         $searchQuery = "validorder LIKE '%1%' AND status != '3' AND dispatched LIKE '%0%' ";
         if(!empty($searchAry))
        {
            
            foreach($searchAry as $key=>$searchData)
            { 

                 if($key == 'szSearch1'){
                    if(!empty ($searchData)){
                        $searchQuery.="
                            AND franchiseeid = ".(int)($searchData);
                    }
                }
                if($key == 'szSearch2'){
                    if(!empty ($searchData)){
                        $searchQuery .="
                        AND 
                         szProductCategory = ".(int)($searchData);
                    }
                }
                if($searchData != '')
                {
                    if($key =='szSearch3')
                    {
                        $searchQuery .="
                       AND
                             productid = ".(int)($searchData);
                              
                    }
                    
                   
                    }
                }
                  
        }
        $this->db->where($searchQuery);
        $this->db->distinct();
       $this->db->select('franchiseeid,price,orderid,createdon,dispatched,status,szProductCategory,szProductCode,szAvailableQuantity,quantity');
        $this->db->order_by("orderid", "desc");
        $this->db->from(__DBC_SCHEMATA_ORDER__);
        $this->db->join('ds_order_details', 'ds_orders.id = ds_order_details.orderid');
        $this->db->join('tbl_product', 'ds_order_details.productid = tbl_product.id');
        
        
        $query = $this->db->get();
//$sql = $this->db->last_query($query);
//print_r($sql);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
          
            }
         
        else {
            return array();
        }
    } 
     public function getCategoryDetailsById($id)
    { 
        $whereAry = array('id' => $id) ;
        $this->db->select('szName');
        $this->db->from(__DBC_SCHEMATA_PRODUCT_CATEGORY__);
        $this->db->where($whereAry);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
          return $row['0'];
            }
         
        else {
            return array();
        }
    }
     public function getallValidPendingOrderFrDetails($searchAry=array())
    {
         $franchiseeid = $_SESSION['drugsafe_user']['id'];
         $searchQuery = "validorder LIKE '%1%'AND franchiseeid LIKE '%$franchiseeid%' AND status != '3' AND status != '2' AND dispatched LIKE '%0%' ";
         if(!empty($searchAry))
        {  
             foreach($searchAry as $key=>$searchData)
            { 
                if($key == 'szSearch2'){
                    if(!empty ($searchData)){
                        $searchQuery .="
                        AND 
                         szProductCategory = ".(int)($searchData);
                    }
                }
                if($searchData != '')
                {
                    if($key =='szSearch3')
                    {
                        $searchQuery .="
                       AND
                             productid = ".(int)($searchData);
                              
                    }
                    
                   
                    }
                }
        }      
       
        $this->db->where($searchQuery);
        $this->db->distinct();
        $this->db->select('franchiseeid,price,orderid,createdon,dispatched,status,szProductCategory,szProductCode,szAvailableQuantity,quantity');
        $this->db->order_by("orderid", "desc");
        $this->db->from(__DBC_SCHEMATA_ORDER__);
        $this->db->join('ds_order_details', 'ds_orders.id = ds_order_details.orderid');
        $this->db->join('tbl_product', 'ds_order_details.productid = tbl_product.id');
        
        
        $query = $this->db->get();
//$sql = $this->db->last_query($query);
//print_r($sql);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
          
            }
         
        else {
            return array();
        }
    } 
     public function getValidPendingOdrFrDetailsForPdf($productCode='',$prodCategory='')
        {
        $franchiseeid = $_SESSION['drugsafe_user']['id'];
          if(!empty($prodCategory)){
               $searchq = " szProductCategory LIKE '%$prodCategory%' AND franchiseeid LIKE '%$franchiseeid%'";
            }
            if(!empty($productCode)){
               $searchq = "productid LIKE '%$productCode%' AND franchiseeid LIKE '%$franchiseeid%' ";
            }
            if(!empty($prodCategory) && !empty($productCode)){
               $searchq = array('szProductCategory' => $prodCategory,'productid' => $productCode,'franchiseeid ' =>$franchiseeid);
            }
            $this->db->where($searchq);
           $this->db->distinct();
           $this->db->select('franchiseeid,price,orderid,createdon,dispatched,status,szProductCategory,szProductCode,szAvailableQuantity,quantity');
           $this->db->order_by("orderid", "desc");
           $this->db->from(__DBC_SCHEMATA_ORDER__);
           $this->db->join('ds_order_details', 'ds_orders.id = ds_order_details.orderid');
           $this->db->join('tbl_product', 'ds_order_details.productid = tbl_product.id');  
            
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
         public function getValidPendingOdrDetailsForPdf($franchiseeid,$productCode='',$prodCategory='')
        {
          
          if(!empty($prodCategory)){
               $searchq = " szProductCategory LIKE '%$prodCategory%' AND franchiseeid LIKE '%$franchiseeid%'";
            }
            if(!empty($productCode)){
               $searchq = "productid LIKE '%$productCode%' AND franchiseeid LIKE '%$franchiseeid%' ";
            }
            if(!empty($prodCategory) && !empty($productCode)){
               $searchq = array('szProductCategory' => $prodCategory,'productid' => $productCode,'franchiseeid ' =>$franchiseeid);
            }
            $this->db->where($searchq);
           $this->db->distinct();
           $this->db->select('franchiseeid,price,orderid,createdon,dispatched,status,szProductCategory,szProductCode,szAvailableQuantity,quantity');
           $this->db->order_by("orderid", "desc");
           $this->db->from(__DBC_SCHEMATA_ORDER__);
           $this->db->join('ds_order_details', 'ds_orders.id = ds_order_details.orderid');
           $this->db->join('tbl_product', 'ds_order_details.productid = tbl_product.id');  
            
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