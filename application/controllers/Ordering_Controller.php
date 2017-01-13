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
            $freanchId = $this->session->userdata('freanchId');
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
                $data['freanchId']=$freanchId;
                $this->load->view('layout/admin_header', $data);
                $this->load->view('ordering/manualOrdering');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Ordering_Model->insertCalulatedData($data))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>Calculations saved successfully.</h3> </strong> ";
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
            redirect(base_url('/admin/admin_login'));
        }
        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
            $franchiseId = $_SESSION['drugsafe_user']['id'];
        }
         if ($_SESSION['drugsafe_user']['iRole'] == '5') {
            $operationManagrrId = $_SESSION['drugsafe_user']['id'];
        }
        
        $searchAry = '';
        $idFreanch = $this->session->userdata('idFreanch');
        if($idFreanch)
        {
            $_POST['szSearchClRecord2']=$idFreanch;
            $this->session->unset_userdata('idFreanch');
        }
        
        if(isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])){
            $id = $_POST['szSearchClRecord2'];
        }
        $this->session->set_userdata('freanchId', $id);
        
      
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
            $manualCalcDetails=$this->Ordering_Model->getManualCalculationBySosId($sosRormDetailsAry['id']);
        
            
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
    
    function editCalcForm()
    {
          $idsite = $this->input->post('idsite');
          $Drugtestid = $this->input->post('Drugtestid');
          $sosid = $this->input->post('sosid');
          $manualCalId = $this->input->post('manualCalId');
         
          $this->session->set_userdata('Drugtestid', $Drugtestid);
          $this->session->set_userdata('idsite', $idsite);
          $this->session->set_userdata('sosid', $sosid);
          $this->session->set_userdata('manualCalId', $manualCalId);
         echo "SUCCESS||||";
         echo "editcalform";
    }
     public function editcalform() {
            $count = $this->Admin_Model->getnotification();
            $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
            $freanchId = $this->session->userdata('freanchId');
            $Drugtestid = $this->session->userdata('Drugtestid');
            $idsite = $this->session->userdata('idsite');
            $manualCalId = $this->session->userdata('manualCalId');
            $sosid = $this->session->userdata('sosid');
            $data_validate = $this->input->post('orderingData');
            if(empty($data_validate))
            {
                   $manualCalcDataAry=$this->Ordering_Model->getManualCalculationBySosId($sosid);
            }
            else
            {
                $manualCalcDataAry = $data_validate;
            }
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
                $_POST['orderingData'] = $manualCalcDataAry;
                $data['sosid'] = $sosid;
                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['notification'] = $count;
                $data['freanchId']=$freanchId;
                $data['szMetaTagTitle'] = "Ordering";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Ordering";
                $data['subpageName'] = "Sites_Record";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('ordering/editManualOrdering');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Ordering_Model->updateCalulatedData($data_validate,$manualCalId))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>Calculations update successfully.</h3> </strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    
                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['sosid'] = $sosid;
                $data['notification'] = $count;
                $data['data'] = $data_validate;
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
        function viewCalc()
        {
            $idsite = $this->input->post('idsite');
            $Drugtestid = $this->input->post('Drugtestid');
            $sosid = $this->input->post('sosid');
            $this->session->set_userdata('Drugtestid', $Drugtestid);
            $this->session->set_userdata('idsite', $idsite);
            $this->session->set_userdata('sosid', $sosid);
            echo "SUCCESS||||";
            echo "viewCalcDetails";
        }
        function viewCalcDetails()
        {
            $freanchId = $this->session->userdata('freanchId');
            $Drugtestid = $this->session->userdata('Drugtestid');
            $idsite = $this->session->userdata('idsite');
            $sosid = $this->session->userdata('sosid');
            $data=$this->Ordering_Model->getManualCalculationBySosId($sosid);
            
            $data['idsite'] = $idsite;
            $data['Drugtestid'] = $Drugtestid;
            $data['sosid'] = $sosid;
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['freanchId']=$freanchId;
            $data['szMetaTagTitle'] = "Ordering";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Ordering";
            $data['subpageName'] = "Sites_Record";
            $this->load->view('layout/admin_header', $data);
            $this->load->view('ordering/viewCalcDetails');
            $this->load->view('layout/admin_footer');
         
        }
        function calcDetailspdf()
        {
            $idsite = $this->input->post('idsite');
            $Drugtestid = $this->input->post('Drugtestid');
            $sosid = $this->input->post('sosid');
            $this->session->set_userdata('idsite',$idsite);
            $this->session->set_userdata('Drugtestid',$Drugtestid);
            $this->session->set_userdata('sosid',$sosid);
            echo "SUCCESS||||";
            echo "pdfcalculationdetails";
        }
        public function pdfcalculationdetails()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe stock request report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Stock Request Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        
        $pdf->AddPage();
        
        $Drugtestid = $this->session->userdata('Drugtestid');
        $idsite = $this->session->userdata('idsite');
        $sosid = $this->session->userdata('sosid');
        $data=$this->Ordering_Model->getManualCalculationBySosId($sosid);
        $DrugtestidArr = array_map('intval', str_split($Drugtestid));
        $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($sosid));
        $ValTotal = 0;
        if (in_array(1, $DrugtestidArr)) 
        {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_1__, 2, '.', '');
        }
        if (in_array(2, $DrugtestidArr))
        {
             $ValTotal = number_format($ValTotal + $countDoner * __RRP_2__, 2, '.', '');
        }
        if (in_array(3, $DrugtestidArr)) 
        {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_3__, 2, '.', '');
        }
        
        $Royaltyfees = $ValTotal * 0.1;
        $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
        $GST = $ValTotal * 0.1;
        $GST = number_format($GST, 2, '.', '');
        $TotalbeforeRoyalty = $ValTotal + $GST;
        $TotalbeforeRoyalty = number_format($TotalbeforeRoyalty, 2, '.', '');
        $TotalafterRoyalty = $ValTotal - $Royaltyfees + $GST;
        $TotalafterRoyalty = number_format($TotalafterRoyalty, 2, '.', '');
        $NetTotal = $ValTotal - $Royaltyfees;
        $NetTotal = number_format($NetTotal, 2, '.', '');
        $mobileScreen = $data['mobileScreenBasePrice'] * $data['mobileScreenHr'];
        $travel = $data['travelBasePrice'] * $data['travelHr'];
        $TotalTrevenu = $data['urineNata'] + $data['nataLabCnfrm'] + $data['oralFluidNata'] + $data['SyntheticCannabinoids'] + $data['labScrenning'] + $data['RtwScrenning'] + $mobileScreen + $travel;
        $TotalTrevenu = number_format($TotalTrevenu, 2, '.', '');
        $RoyaltyfeesManual = ($TotalTrevenu * 0.1);
        $RoyaltyfeesManual=  number_format($RoyaltyfeesManual, 2, '.', '');
        $GSTmanual = ($TotalTrevenu * 0.1);
        $GSTmanual = number_format($GSTmanual, 2, '.', '');
        $Total1 = $TotalTrevenu + $GSTmanual;
        $Total1 = number_format($Total1, 2, '.', '');
        $Total2 = $TotalTrevenu - $RoyaltyfeesManual + $GSTmanual;
        $Total2 = number_format($Total2, 2, '.', '');
        $totalRoyalty = $Royaltyfees + $RoyaltyfeesManual;
        $totalGst = $GST + $GSTmanual;
        $totalinvoiceAmt = $ValTotal + $TotalTrevenu;
        $totalRoyaltyBefore = $Total1 + $TotalbeforeRoyalty;
        $totalRoyaltyAfter = $Total2 + $TotalafterRoyalty;
        
        
        $html = '<a style="text-align:center;  margin-bottom:15px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
<br />            
<div><label style="font-size:18px;color:red;margin-bottom:5px;"><b>Automatic Calculated Result
            </b></label></div>
            <div>
                <lable>Total :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.$ValTotal.'</lable>  
            </div>
            <div>
                <lable>Royalty fees :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.number_format($Royaltyfees, 2, '.', ',').'</lable>  
            </div>
            <div>
                <lable>GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.number_format($GST, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total before Royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.number_format($TotalbeforeRoyalty, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total after royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.number_format($TotalafterRoyalty, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Net Total after royalty and exl GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>$'.number_format($NetTotal, 2, '.', ',').'</lable>  
            </div>
            <br />
            <div><label style="font-size:18px;color:red;margin-bottom:15px;"><b>Manual Calculations Result    
            </b></label></div>
            <div>
                <lable>Total "Other Trevenu Streams :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($TotalTrevenu, 2, '.', ',').'</lable>  
            </div>
            <div>
                <lable>Royalty fees :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($RoyaltyfeesManual, 2, '.', ',').'</lable>  
            </div>
            <div>
                <lable>GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($GSTmanual, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total before Royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($Total1, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total after royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable> $'.number_format($Total2, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Net Total after royalty and exl GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable> $'.number_format($TotalTrevenu - $GSTmanual, 2, '.', ',').'</lable>  
            </div>
            <br />
            <div><label style="font-size:18px;color:red;margin-bottom:15px;"><b>Proforma Invoice Totals     
            </b></label></div>
            <div>
                <lable>Total Invoice amount :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($totalinvoiceAmt, 2, '.', ',').'</lable>  
            </div>
            <div>
                <lable>Total Royalty fees :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($totalRoyalty, 2, '.', ',').'</lable>  
            </div>
            <div>
                <lable>GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($totalGst, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total before Royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<lable>$'.number_format($totalRoyaltyBefore, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Total after royalty and Inc GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <lable>$'.number_format($totalRoyaltyAfter, 2, '.', ',').'</lable>  
            </div>
             <div>
                <lable>Net Total after royalty and exl GST :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <lable>$'.number_format($totalinvoiceAmt - $totalGst, 2, '.', ',').'</lable>  
            </div>
           
            
        ';
        $pdf->writeHTML($html, true, false, true, false, '');

        error_reporting(E_ALL);
       
        $this->session->unset_userdata('idsite');
        $this->session->unset_userdata('Drugtestid');
        $this->session->unset_userdata('sosid');
        $pdf->Output('view_calculation_details.pdf', 'I');
    }
    function siteRecordpage()
    {
          $freanchId = $this->input->post('freanchId');
          $this->session->set_userdata('idFreanch', $freanchId);
          echo "SUCCESS||||";
          echo "sitesRecord";
    }
    }      
?>