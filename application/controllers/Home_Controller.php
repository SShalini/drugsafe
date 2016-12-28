<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Model');
	}
	
	public function index()
	{
            $is_user_login = is_user_login($this);
           if($is_user_login)
            {
                if($_SESSION['drugsafe_user']['iRole']=='5')
                {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;
                }
                elseif($_SESSION['drugsafe_user']['iRole']=='1'){
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/operationManagerList");
                    die;
                }
                else
                {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/franchisee/clientRecord");
                    die;
                }
            }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
	}
}