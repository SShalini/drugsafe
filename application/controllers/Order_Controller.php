<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Order_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('StockMgt_Model');
            $this->load->library('pagination');
            
        
	}
	
          function drugtestkit()
        {
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
             $searchAry = $_POST['szSearchProdCode'];
             
             $config['base_url'] = __BASE_URL__ . "/order/drugtestkit/";
             $config['total_rows'] = count($this->Inventory_Model->viewDrugTestKitList($limit,$offset,$searchAry,2));
             $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

             $this->pagination->initialize($config);
            
               $idfranchisee = $_SESSION['drugsafe_user']['id'];
          
               $drugTestKitAray =$this->Inventory_Model->viewDrugTestKitList($config['per_page'],$this->uri->segment(3),$searchAry,2);
               $drugTestKitListAray =$this->Inventory_Model->viewDrugTestKitList(false,false,false,2);
               $count = $this->Admin_Model->getnotification();

                    $data['drugTestKitAray'] = $drugTestKitAray;
                    $data['szMetaTagTitle'] = " Drug Test Kit ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['subpageName'] = "Drug_Test_Kit";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/orderDrugTestKit');
            $this->load->view('layout/admin_footer');
        }
        function marketingmaterial()
        {
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                redirect(base_url('/admin/admin_login'));
                die;
            }
            
             $searchAry = $_POST['szSearchProductCode'];
             $config['base_url'] = __BASE_URL__ . "/order/marketingmaterial/";
             $config['total_rows'] = count($this->Inventory_Model->viewMarketingMaterialList($searchAry,$limit,$offset,2));
             $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

             $this->pagination->initialize($config);
            
             $idfranchisee = $_SESSION['drugsafe_user']['id'];
             $marketingMaterialAray =$this->Inventory_Model->viewMarketingMaterialList($searchAry,$config['per_page'],$this->uri->segment(3),2);
            $marketingMaterialListAray =$this->Inventory_Model->viewMarketingMaterialList(false,false,false,2);
             $count = $this->Admin_Model->getnotification();


                    $data['marketingMaterialAray'] = $marketingMaterialAray;
                    $data['szMetaTagTitle'] = "Marketing Material";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['subpageName'] = "Marketing_Material";
                    $data['notification'] = $count;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['data'] = $data;
                    $data['marketingMaterialListAray'] = $marketingMaterialListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/orderMarketingMaterial');
            $this->load->view('layout/admin_footer');
        }

  
 
        function uploadProfileImage()
        {
            
            $output_dir = __APP_PATH_PRODUCT_IMAGES__;
            
            $ret = array();
            $RandomNum   = time();
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            if($ImageName > 10)
            {
                $ImageName=substr($ImageName,0,10);
            }
            if(strlen($ImageName)>20)
            {
                $ImageName=substr_replace($ImageName,'',20);
            }
            $NewImageName = 'Drug_product_'.$ImageName.'-'.$RandomNum.'.'.$ImageExt;
            move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.'/'. $NewImageName);
//       	 	 echo $output_dir. $NewImageName;
            $randomNum=rand().time();
            $ret['name']= $NewImageName;
            $ret['rand_num']= $randomNum;
            $ret['img_div']= '<div id="photoDiv_'.$randomNum.'"><img class="" src="'.__BASE_USER_PRODUCT_IMAGES_URL__.'/'.$NewImageName.'" width="60" height="60" alt="Product  Image" />
                                   <a href="javascript:void(0);" id="remove_btn_'.$randomNum.'" class="btn red-intense btn-sm" onclick="removeIncidentPhoto();">Remove</a>
                           </div>';
           
            echo json_encode($ret);
        }

        function consumables()
        {
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
            $searchAry = $_POST['szSearchProdCode'];
            $config['base_url'] = __BASE_URL__ . "/order/consumables/";
            $config['total_rows'] = count($this->Inventory_Model->viewConsumablesList($limit,$offset,$searchAry,3));
            $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
            $this->pagination->initialize($config);
            $idfranchisee = $_SESSION['drugsafe_user']['id'];
          
               $consumablesAray =$this->Inventory_Model->viewConsumablesList($config['per_page'],$this->uri->segment(3),$searchAry,3);
               $consumableslistAry =$this->Inventory_Model->viewConsumablesList(false,false,false,3);
               $count = $this->Admin_Model->getnotification();

                    $data['consumablesAray'] = $consumablesAray;
                    $data['szMetaTagTitle'] = " Consumables";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['subpageName'] = "Consumables";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['consumableslist'] = $consumableslistAry;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/orderConsumables');
            $this->load->view('layout/admin_footer');
        } 
           function placeOrderData()
        { 
             $idProduct = $this->input->post('idProduct');
             $quantity = $this->input->post('val');
             $flag = $this->input->post('flag');
             $this->session->set_userdata('flag',$flag);
        
             if($quantity>0){
             $this->Order_Model->InsertOrder($idProduct,$quantity);
              echo "SUCCESS||||";
              echo "placeOrderConfirmation";
             }
             else{
                $szMessage['type'] = "error";
                $szMessage['content'] = "<strong><h3>Please Enter the Quantity.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                redirect(base_url('/order/drugtestkit'));
             } 
        }
        
         public function placeOrder()
        {
            $flag = $this->session->userdata('flag');
            $data['mode'] = '__PLACE_ORDER_POPUP_CONFIRM__';
            $this->load->view('admin/admin_ajax_functions',$data);   
           
          
        }
       function orderList()
        {
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
             $searchAry = $_POST['szSearchProdCode'];
             
             $config['base_url'] = __BASE_URL__ . "/order/orderList/";
             $config['total_rows'] = count($this->Order_Model->getOrdersList($limit,$offset,$searchAry));
             $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

             $this->pagination->initialize($config);
            
               $idfranchisee = $_SESSION['drugsafe_user']['id'];
          
              
               $totalOrdersAray =$this->Order_Model->getOrdersList($config['per_page'],$this->uri->segment(3),$searchAry);
               $totalOrdersSearchAray =$this->Order_Model->getOrdersList();
               
               $count = $this->Admin_Model->getnotification();

                    $data['totalOrdersSearchAray'] = $totalOrdersSearchAray;     
                    $data['totalOrdersAray'] = $totalOrdersAray;
                    $data['szMetaTagTitle'] = " Order List";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/cartOrderValuelist');
            $this->load->view('layout/admin_footer');
        } 
        public function DeleteOrderAlert()
    {
        $data['mode'] = '__DELETE_ORDER_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function OrderDeleteConfirmation()
    {    
        $data['mode'] = '__DELETE_ORDER_CONFIRM__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->Order_Model->deleteOrder($data['idOrder']);
        $this->load->view('admin/admin_ajax_functions', $data);
    }
 
     public function updateCartData()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $count = $_POST['count'];
         
        for ($i = 1; $i <= $count; $i++)
        {
         $quantity =  $_POST['order_quantity'.$i];
         $orderId =  $_POST['order_id'.$i];
         $orderUpdate =$this->Order_Model->updateOrder($quantity,$orderId); 
        }
        if($orderUpdate){
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong><h3>Your Cart has been successfully updated.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                redirect(base_url('/order/orderList'));
        }
               
    }
       function checkOutOrderData()
        {
           $idfranchisee = $this->input->post('idfranchisee');
           $this->session->set_userdata('idfranchisee', $idfranchisee);
        
              echo "SUCCESS||||";
              echo "checkOutOrder";
            
        }
        public function checkOutOrder()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $this->session->unset_userdata('orderid');
        $franchiseeid = $this->session->userdata('idfranchisee');
        $totalOrdersAray =$this->Order_Model->getOrdersListByFranchisee($franchiseeid);
         
        $TotalPrice = 0;
        foreach($totalOrdersAray as $totalOrdersData){
         $productDataArr = $this->Inventory_Model->getProductDetailsById($totalOrdersData['productid']);
         $price =  ($totalOrdersData['quantity'])*($productDataArr['szProductCost']);
         $TotalPrice +=$price;
        }
        if($idorder=$this->Order_Model->InsertOrderSuccess($totalOrdersAray['0']['franchiseeid'],$TotalPrice))
        {
            foreach($totalOrdersAray as $totalOrdersData){
          $queryInsert= $this->Order_Model->InsertOrderDetails($totalOrdersData,$idorder);
               }
               if($queryInsert){

                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong><h3>Your Order has been successfully placed.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                $this->session->unset_userdata('idfranchisee');
                redirect(base_url('/order/ordersuccess'));   
               }
             
       }
            
    }
    
        public function ordersuccess()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $orderid = $this->session->userdata('orderid');
        $totalOrdersDetailsAray = $this->Order_Model->getOrderDetailsByOrderId($orderid);
     
     
                    $data['totalOrdersDetailsAray'] = $totalOrdersDetailsAray;     
                    $data['orderid'] = $orderid;
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/successOrder');
            $this->load->view('layout/admin_footer'); 
               
    }
     public function view_order_list()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
       $validOrdersDetailsAray = $this->Order_Model->getallValidOrderId($orderid);
       
                    $data['validOrdersDetailsAray'] = $validOrdersDetailsAray;    
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('order/viewOrderDetails');
            $this->load->view('layout/admin_footer'); 
               
    }
     public function viewOrderData()
        {
            $data['mode'] = '__VIEW_ORDER_DETAILS_POPUP__';
            $data['idOrder'] = $this->input->post('idOrder');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
    }      
?>