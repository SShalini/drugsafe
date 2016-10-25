<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Model');
	}
	
	public function index()
	{$is_user_login = is_user_login($this);
            
            if($is_user_login)
          {
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/dashboard");
                    die;
           }
            else
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
	}
}