<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ordering_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->model('Ordering_Model');
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('Form_Management_Model');
            $this->load->model('StockMgt_Model');
            $this->load->library('pagination');
        
	}
     function viewcalform()
    {
          $idsite = $this->input->post('idsite');
          $Drugtestid = $this->input->post('Drugtestid');
          $sosid = $this->input->post('sosid');
           $this->session->set_userdata('Drugtestid', $Drugtestid);
         $this->session->set_userdata('idsite', $idsite);
         $this->session->set_userdata('sosid', $sosid);
        echo "SUCCESS||||";
        echo "calform";
    }
       public function calform() {
            $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $Drugtestid = $this->session->userdata('Drugtestid');
            $idsite = $this->session->userdata('idsite');
            $sosid = $this->session->userdata('sosid');
            $data= $this->input->post('orderingData');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('orderingData[urineNata]', 'Urine NATA Laboratory screening', 'required|numeric');
            $this->form_validation->set_rules('orderingData[nataLabCnfrm]', 'NATA Laboratory confirmation', 'required|numeric');
            $this->form_validation->set_rules('orderingData[oralFluidNata]', 'Oral Fluid NATA Laboratory confirmation', 'required|numeric');
            $this->form_validation->set_rules('orderingData[SyntheticCannabinoids]', 'Synthetic Cannabinoids', 'required|numeric');
            $this->form_validation->set_rules('orderingData[labScrenning]', 'Laboratory screening', 'required|numeric');
           
            $this->form_validation->set_rules('orderingData[RtwScrenning]', 'Return to work  screening', 'required|numeric');
            $this->form_validation->set_rules('orderingData[mobileScreenBasePrice]', 'Drugsafe Communiies mobile clinic screening Base Price', 'required|numeric');
            $this->form_validation->set_rules('orderingData[mobileScreenHr]', 'Drugsafe Communiies mobile clinic screening Hours', 'required|numeric');
             $this->form_validation->set_rules('orderingData[travelType]', 'Travel Type', 'required');
            $this->form_validation->set_rules('orderingData[travelBasePrice]', ' Travel Base Price', 'required|numeric');
            $this->form_validation->set_rules('orderingData[travelHr]', 'Travel Hours', 'required|numeric');
            
             $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            { 
                $data['sosid'] = $sosid;
                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['notification'] = $count;
                $data['szMetaTagTitle'] = "Ordering";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Ordering";
                $data['subpageName'] = "Sites_Record";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('ordering/manualOrdering');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Ordering_Model->insertCalulatedData($data))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>Calculations Data added successfully.</h3> </strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    
                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['sosid'] = $sosid;
                $data['notification'] = $count;
                $data['data'] = $data;
                $data['szMetaTagTitle'] = "Ordering";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Ordering";
                $data['subpageName'] = "Sites_Record";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('ordering/manualCalcResult');
                $this->load->view('layout/admin_footer');
               
               
                }
            }
        }
        
          function sitesRecord()
    {
        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
            $franchiseId = $_SESSION['drugsafe_user']['id'];
        }
         if ($_SESSION['drugsafe_user']['iRole'] == '5') {
            $operationManagrrId = $_SESSION['drugsafe_user']['id'];
        
        }
        $searchAry = '';
       
        if(isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])){
            $id = $_POST['szSearchClRecord2'];
           
           
        }
        if($id>0)
            {
               $childclientAray = $this->Ordering_Model->getAllChClientDetails($config['per_page'],$this->uri->segment(3),$id);
             
               $i=0;
               $sosRormDetailsAry=array();
               foreach($childclientAray as $childclientData ){
                   
               $sosRormDetailsAry[$i] = $this->Form_Management_Model->getsosFormDetailsByClientId($childclientData['clientId']);
                $i++;
               }
               $sosRormDetailsAry = array_filter($sosRormDetailsAry);
       
            }
      
        $data['childclientAray'] = $childclientAray;
        $data['sosRormDetailsAry'] = $sosRormDetailsAry;
        $data['pageName'] = "Ordering";
        $data['subpageName'] = "Sites_Record";
        $data['szMetaTagTitle'] = "Sites Record";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('ordering/sitesRecord');
        $this->load->view('layout/admin_footer');
    }  
      
    }      
?>