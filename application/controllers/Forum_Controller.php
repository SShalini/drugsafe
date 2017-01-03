<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forum_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Error_Model');
            $this->load->model('Forum_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('StockMgt_Model');
            $this->load->library('pagination');
        }
	public function addCategory() {
           $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('forumData[szCategoryName]', 'Category Name', 'required');
            $this->form_validation->set_rules('forumData[szCategoryDiscription]', 'Category Discription', 'required');
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            { 
                $data['notification'] = $count;
                $data['szMetaTagTitle'] = "Add Category";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Forum";
                $data['subpageName'] = "Categories";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('forum/addCategory');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Forum_Model->insertCategory())
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3> Forum Category added successfully.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    header("Location:" . __BASE_URL__ . "/forum/categoriesList");
                    die;
                }
            }
        }
        function editCategoryData()
        {
            $idCategory = $this->input->post('idCategory');
            $this->session->set_userdata('idCategory',$idCategory);
           
            echo "SUCCESS||||";
            echo "editCategory";
            
        }
        
        public function editCategory() {
            $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
           
            $idCategory = $this->session->userdata('idCategory');
            $CategoryDataAry = $this->Forum_Model->getCategoryDetailsById($idCategory);
         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('forumData[szName]', 'Category Name', 'required');
            $this->form_validation->set_rules('forumData[szDiscription]', 'Category Discription', 'required');
             $this->form_validation->set_message('required', '{field} is required');
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['szMetaTagTitle'] = "Edit Category";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Forum";
                $data['subpageName'] = "Categories";
                $_POST['forumData']= $CategoryDataAry;
                $data['notification'] = $count;
                $this->load->view('layout/admin_header', $data);
                $this->load->view('forum/editCategory');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Forum_Model->UpdateCategory($idCategory))
                {
                   
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong><h3> Category updated successfully.</h3></strong>";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                        $this->session->unset_userdata('idCategory');
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/forum/categoriesList");
                    die;
                }
            }
        }
       

        function categoriesList()
        {
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
             $searchAry = $_POST['szSearchCtName'];
//             print_r($searchAry);die;
             
             $config['base_url'] = __BASE_URL__ . "/inventory/drugtestkitlist/";
             $config['total_rows'] = count($this->Forum_Model->viewCategoriesList($limit,$offset,$searchAry));
             $config['per_page'] = 5;

             $this->pagination->initialize($config);
            
               $idfranchisee = $_SESSION['drugsafe_user']['id'];
                $categoriesAray =$this->Forum_Model->viewCategoriesList($config['per_page'],$this->uri->segment(3),$searchAry);
               $categoriesListAray =$this->Forum_Model->viewCategoriesList();
               $count = $this->Admin_Model->getnotification();

                    $data['categoriesAray'] = $categoriesAray;
                    $data['szMetaTagTitle'] = " Categories List";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Forum";
                    $data['subpageName'] = "Forum_List";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['categoriesListAray'] = $categoriesListAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('forum/categoriesList');
            $this->load->view('layout/admin_footer');
        }
        public function deleteCategoryAlert()
        {
            $data['mode'] = '__DELETE_CATEGORY_POPUP__';
            $data['idCategory'] = $this->input->post('idCategory');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deleteCategoryConfirmation()
        {
            $data['mode'] = '__DELETE_CATEGORY_POPUP_CONFIRM__';
            $data['idCategory'] = $this->input->post('idCategory');
            $this->Forum_Model->deleteCategory($data['idCategory']);
            $this->load->view('admin/admin_ajax_functions',$data);
        }   
         public function forumDeleteAlert()
        {
            $data['mode'] = '__DELETE_FORUM_POPUP__';
            $data['id'] = $this->input->post('id');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deleteForumConfirmation()
        {
            $data['mode'] = '__DELETE_FORUM_POPUP_CONFIRM__';
            $data['id'] = $this->input->post('id');
            $this->Forum_Model->deleteForum($data['id']);
            $this->load->view('admin/admin_ajax_functions',$data);
        } 
         function viewForumData()
        {
            $idCategory = $this->input->post('idCategory');
            $this->session->set_userdata('idCategory',$idCategory);
           
            echo "SUCCESS||||";
            echo "forumList";
            
        }
        
         function forumList()
        {
           $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $idCategory = $this->session->userdata('idCategory');
             $searchAry = $_POST['szSearchforumTitle'];
             
             $config['base_url'] = __BASE_URL__ . "/inventory/drugtestkitlist/";
             $config['total_rows'] = count($this->Inventory_Model->viewDrugTestKitList($limit,$offset,$searchAry,$idCategory));
             $config['per_page'] = 5;

             $this->pagination->initialize($config);
            
             
          
               $forumDataAray =$this->Forum_Model->viewForumDataList($config['per_page'],$this->uri->segment(3),$searchAry,$idCategory);
               $forumDataSearchAray =$this->Forum_Model->viewForumDataList(false,false,false,$idCategory);
               $count = $this->Admin_Model->getnotification();

                    $data['forumDataAray'] = $forumDataAray;
                    $data['szMetaTagTitle'] = " Forum List";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Forum";
                    $data['subpageName'] = "Forum_List";
                    $data['notification'] = $count;
                    $data['data'] = $data;
            $data['forumDataSearchAray'] = $forumDataSearchAray;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('forum/forumList');
            $this->load->view('layout/admin_footer');
        }
         public function addforum() 
        {
            $count = $this->Admin_Model->getnotification();
             $validate = $this->input->post('forumData');
            
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('forumData[szForumTitle]', 'Forum Title', 'required');
            $this->form_validation->set_rules('forumData[szForumDiscription]', 'Forum Discription', 'required');
            $this->form_validation->set_rules('forumData[szForumLongDiscription]', 'Forum Long Discription', 'required');
            $this->form_validation->set_rules('forumData[szforumImage]', 'Forum Image', 'required');
            $this->form_validation->set_rules('forumData[idCategory]', 'category ', 'required');
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            { 
                $data['notification'] = $count;
                $data['szMetaTagTitle'] = "Add Forum Data";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Forum";
                $data['subpageName'] = "Forum_List";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('forum/addForum');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Forum_Model->insertForumData($validate))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3> Forum Data added successfully.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    header("Location:" . __BASE_URL__ . "/forum/forumList");
                    die;
                }
            }
        }
         function editForumData()
        {
            $id = $this->input->post('id');
            $this->session->set_userdata('id',$id);
           
            echo "SUCCESS||||";
            echo "editForum";
            
        }
        
        public function editForum() {
            $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
             $validate = $this->input->post('forumData');
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
           
            $id = $this->session->userdata('id');
            $forumDataAry = $this->Forum_Model->getForumDetailsById($id);
            
           
         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('forumData[szForumTitle]', 'Forum Title', 'required');
            $this->form_validation->set_rules('forumData[szForumDiscription]', 'Forum Discription', 'required');
            $this->form_validation->set_rules('forumData[szForumLongDiscription]', 'Forum Long Discription', 'required');
            $this->form_validation->set_rules('forumData[szforumImage]', 'Forum Image', 'required');
            $this->form_validation->set_message('required', '{field} is required');
            
            if ($this->form_validation->run() == FALSE)
            {
                
                $data['szMetaTagTitle'] = "Edit Forum Data";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Forum";
                $data['subpageName'] = "Forum_List";
                $_POST['forumData']= $forumDataAry;
                $data['notification'] = $count;
                $this->load->view('layout/admin_header',$data);
                $this->load->view('forum/editForum');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Forum_Model->UpdateForum($validate,$id))
                {
                   
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong><h3> Forum Data updated successfully.</h3></strong>";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                        $this->session->unset_userdata('id');
                        ob_end_clean();
                        header("Location:" . __BASE_URL__ . "/forum/forumList");
                    die;
                }
            }
        }
    }      
?>