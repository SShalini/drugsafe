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
             
             $config['base_url'] = __BASE_URL__ . "/inventory/drugtestkitlist/";
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
             $config['base_url'] = __BASE_URL__ . "/inventory/marketingmateriallist/";
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
            $this->load->view('inventory/marketingMaterialList');
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
            $config['base_url'] = __BASE_URL__ . "/inventory/consumableslist/";
            $config['total_rows'] = count($this->Inventory_Model->viewConsumablesList($limit,$offset,$searchAry,2));
            $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
            $this->pagination->initialize($config);
            $idfranchisee = $_SESSION['drugsafe_user']['id'];
          
               $consumablesAray =$this->Inventory_Model->viewConsumablesList($config['per_page'],$this->uri->segment(3),$searchAry,2);
               $consumableslistAry =$this->Inventory_Model->viewConsumablesList(false,false,false,2);
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
    }      
?>