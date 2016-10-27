<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
        
	}
	
	public function addProduct() {
           
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productData[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('productData[szProductDiscription]', 'Product Discription', 'required');
            $this->form_validation->set_rules('productData[szProductCost]', 'Product Cost', 'required');
            $this->form_validation->set_rules('productData[szProductCategory]', 'Product Category', 'required');
            $this->form_validation->set_rules('productData[szProductImage]', 'Product Image', 'required');
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['szMetaTagTitle'] = "Add Product";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Inventory";
                $data['subpageName'] = "add_Product";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('inventory/addProduct');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Inventory_Model->insertProduct())
                {
                    header("Location:" . __BASE_URL__ . "/franchisee/clientList");
                    die;
                }
               ;
                
            }
        }
        public function editProduct() {
           
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $productId='1';
            $productDataAry = $this->Inventory_Model->getProductDetailsById($productId);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productData[szProductCode]', 'Product Code', 'required');
            $this->form_validation->set_rules('productData[szProductDiscription]', 'Product Discription', 'required');
            $this->form_validation->set_rules('productData[szProductCost]', 'Product Cost', 'required');
            $this->form_validation->set_rules('productData[szProductCategory]', 'Product Category', 'required');
            $this->form_validation->set_rules('productData[szProductImage]', 'Product Image', 'required');
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['szMetaTagTitle'] = "Edit Product";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Inventory";
                $_POST['productData']=$productDataAry;
                $this->load->view('layout/admin_header', $data);
                $this->load->view('inventory/editProduct');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Inventory_Model->UpdateProduct($productId))
                {
                    header("Location:" . __BASE_URL__ . "/inventory/");
                    die;
                }
               ;
                
            }
        }
        function uploadProfileImage()
        {
            //If directory doesnot exists create it.
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
    }      
    
?>
