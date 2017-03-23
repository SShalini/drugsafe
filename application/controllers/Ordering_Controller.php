<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordering_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Order_Model');
        $this->load->model('StockMgt_Model');
        $this->load->library('pagination');
        $this->load->model('Ordering_Model');
        $this->load->model('Forum_Model');
        $this->load->model('Error_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Franchisee_Model');
        $this->load->model('Inventory_Model');
        $this->load->model('Form_Management_Model');
        $this->load->model('StockMgt_Model');
        $this->load->model('Webservices_Model');
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

    public function calform()
    {
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $freanchId = $this->session->userdata('freanchId');
        $Drugtestid = $this->session->userdata('Drugtestid');
        $idsite = $this->session->userdata('idsite');
        $sosid = $this->session->userdata('sosid');
        $data = $this->input->post('orderingData');
        if($data){
            $checkforvalidation = false;
        }else{
            $checkforvalidation = true;
        }

        $this->load->library('form_validation');
          if(!empty($data['FCOBasePrice']) || !empty($data['FCOHr'])){
        $this->form_validation->set_rules('orderingData[FCOBasePrice]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[FCOHr]', 'Hours', 'required|greater_than[1]|numeric');
        $checkforvalidation = true;
          }
        if(!empty($data['SyntheticCannabinoids'])){
            $this->form_validation->set_rules('orderingData[SyntheticCannabinoids]', 'Synthetic Cannabinoids Screening', 'required|numeric');
            $checkforvalidation = true;
        }
         if(!empty($data['mobileScreenBasePrice']) || !empty($data['mobileScreenHr'])){
        $this->form_validation->set_rules('orderingData[mobileScreenBasePrice]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[mobileScreenHr]', 'Hours', 'required|numeric');
             $checkforvalidation = true;
         }
          if(!empty($data['CallOutBasePrice']) || !empty($data['CallOutHr'])){
        $this->form_validation->set_rules('orderingData[CallOutBasePrice]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[CallOutHr]', 'Hours', 'required|greater_than[2]|numeric');
              $checkforvalidation = true;
         }
        if(!empty($data['urineNata'])){
            $this->form_validation->set_rules('orderingData[urineNata]', 'Urine NATA Laboratory screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['nataLabCnfrm'])){
            $this->form_validation->set_rules('orderingData[nataLabCnfrm]', 'NATA Laboratory confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['oralFluidNata'])){
            $this->form_validation->set_rules('orderingData[oralFluidNata]', 'Oral Fluid NATA Laboratory confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['laboratoryScreening'])){
            $this->form_validation->set_rules('orderingData[laboratoryScreening]', 'Laboratory Screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['laboratoryConfirmation'])){
            $this->form_validation->set_rules('orderingData[laboratoryConfirmation]', 'Laboratory Confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['RtwScrenning'])){
            $this->form_validation->set_rules('orderingData[RtwScrenning]', 'Return to work  screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['DCmobileScreenBasePrice']) || !empty($data['DCmobileScreenHr'])){
        $this->form_validation->set_rules('orderingData[DCmobileScreenBasePrice]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[DCmobileScreenHr]', 'Hours', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data['travelType'])){
            $this->form_validation->set_rules('orderingData[travelType]', 'Travel Type', 'required');
            $checkforvalidation = true;
        }

         if(!empty($data['travelBasePrice']) || !empty($data['travelHr'])){
        $this->form_validation->set_rules('orderingData[travelBasePrice]', ' Travel Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[travelHr]', 'Travel Hours', 'required|numeric');
             $checkforvalidation = true;
         }
        if(!empty($data['cancellationFee'])){
            $this->form_validation->set_rules('orderingData[cancellationFee]', 'Cancellation Fee', 'required|numeric');
            $checkforvalidation = true;
        }
        $this->form_validation->set_message('required', '{field} is required.');
        if (($checkforvalidation) && ($this->form_validation->run() == FALSE)) {
            $data['sosid'] = $sosid;
            $data['idsite'] = $idsite;
            $data['Drugtestid'] = $Drugtestid;
            $data['notification'] = $count;
            $data['commentnotification'] = $commentReplyNotiCount;
            $data['szMetaTagTitle'] = "Generate Proforma Invoice";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Generate Proforma Invoice";
            $data['subpageName'] = "Sites_Record";
            $data['freanchId'] = $freanchId;
            $this->load->view('layout/admin_header', $data);
            $this->load->view('ordering/manualOrdering');
            $this->load->view('layout/admin_footer');
        } else {
            if ($this->Ordering_Model->insertCalulatedData($data)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Proforma Invoice saved successfully.</strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);

                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['sosid'] = $sosid;
                $data['notification'] = $count;
                $data['data'] = $data;
                $data['szMetaTagTitle'] = "Generate Proforma Invoice";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Generate Proforma Invoice";
                $data['freanchId'] = $freanchId;
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
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();

        if (!$is_user_login) {
            redirect(base_url('/admin/admin_login'));
        }
        $id = 0;
        if ($_SESSION['drugsafe_user']['iRole'] == '2') {
            $id = $_SESSION['drugsafe_user']['id'];
        }
        if ($_SESSION['drugsafe_user']['iRole'] == '5') {
            $operationManagrrId = $_SESSION['drugsafe_user']['id'];
        }
        $searchAry = '';
        $idFreanch = $this->session->userdata('idFreanch');
        if ($idFreanch) {
            $_POST['szSearchClRecord2'] = $idFreanch;
            $this->session->unset_userdata('idFreanch');
        }
        if($id>0){
            $_POST['szSearchClRecord2'] = $id;
        }
        if (isset($_POST['szSearchClRecord2']) && !empty($_POST['szSearchClRecord2'])) {
            $id = $_POST['szSearchClRecord2'];
        }
        $this->session->set_userdata('freanchId', $id);
        if ($id > 0) {
            $childclientAray = $this->Ordering_Model->getAllChClientDetails($config['per_page'], $this->uri->segment(3), $id);
            $i = 0;
            $sosRormDetailsAry = array();
            foreach ($childclientAray as $childclientData) {
                $sosRormDetailsAry[$i] = $this->Form_Management_Model->getsosFormDetailsByClientId($childclientData['clientId']);
                $i++;
            }
            $sosRormDetailsAry = array_filter($sosRormDetailsAry);
        }
        $manualCalcDetails = $this->Ordering_Model->getManualCalculationBySosId($sosRormDetailsAry['id']);
       
        $data['childclientAray'] = $childclientAray;
        $data['sosRormDetailsAry'] = $sosRormDetailsAry;
        $data['pageName'] = "proforma_invoice";
        $data['subpageName'] = "view_proforma_invoice";
        $data['szMetaTagTitle'] = "Sites Record";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;
        $data['commentnotification'] = $commentReplyNotiCount;
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
    public function editcalform()
    {
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $freanchId = $this->session->userdata('freanchId');
        $Drugtestid = $this->session->userdata('Drugtestid');
        $idsite = $this->session->userdata('idsite');
        $manualCalId = $this->session->userdata('manualCalId');
        $sosid = $this->session->userdata('sosid');
        $data_validate = $this->input->post('orderingData');
        if($data_validate){
            $checkforvalidation = false;
        }else{
            $checkforvalidation = true;
        }
      
        if (empty($data_validate)) {
            $manualCalcDataAry = $this->Ordering_Model->getManualCalculationBySosId($sosid);
            if(!empty($manualCalcDataAry)){
                $manualCalcDataAry['urineNata'] = ($manualCalcDataAry['urineNata']>0.00?$manualCalcDataAry['urineNata']:'');
                $manualCalcDataAry['nataLabCnfrm'] = ($manualCalcDataAry['nataLabCnfrm']>0.00?$manualCalcDataAry['nataLabCnfrm']:'');
                $manualCalcDataAry['oralFluidNata'] = ($manualCalcDataAry['oralFluidNata']>0.00?$manualCalcDataAry['oralFluidNata']:'');
                $manualCalcDataAry['SyntheticCannabinoids'] = ($manualCalcDataAry['SyntheticCannabinoids']>0.00?$manualCalcDataAry['SyntheticCannabinoids']:'');
                $manualCalcDataAry['labScrenning'] = ($manualCalcDataAry['labScrenning']>0.00?$manualCalcDataAry['labScrenning']:'');
                $manualCalcDataAry['RtwScrenning'] = ($manualCalcDataAry['RtwScrenning']>0.00?$manualCalcDataAry['RtwScrenning']:'');
                $manualCalcDataAry['mobileScreenBasePrice'] = ($manualCalcDataAry['mobileScreenBasePrice']>0.00?$manualCalcDataAry['mobileScreenBasePrice']:'');
                $manualCalcDataAry['travelBasePrice'] = ($manualCalcDataAry['travelBasePrice']>0.00?$manualCalcDataAry['travelBasePrice']:'');
                $manualCalcDataAry['fcobp'] = ($manualCalcDataAry['fcobp']>0.00?$manualCalcDataAry['fcobp']:'');
                $manualCalcDataAry['mcbp'] = ($manualCalcDataAry['mcbp']>0.00?$manualCalcDataAry['mcbp']:'');
                $manualCalcDataAry['cobp'] = ($manualCalcDataAry['cobp']>0.00?$manualCalcDataAry['cobp']:'');
                $manualCalcDataAry['labconf'] = ($manualCalcDataAry['labconf']>0.00?$manualCalcDataAry['labconf']:'');
                $manualCalcDataAry['cancelfee'] = ($manualCalcDataAry['cancelfee']>0.00?$manualCalcDataAry['cancelfee']:'');
                $manualCalcDataAry['mobileScreenHr'] = ($manualCalcDataAry['mobileScreenHr']>0?$manualCalcDataAry['mobileScreenHr']:'');
                $manualCalcDataAry['travelHr'] = ($manualCalcDataAry['travelHr']>0?$manualCalcDataAry['travelHr']:'');
                $manualCalcDataAry['travelType'] = ($manualCalcDataAry['travelType']>0?$manualCalcDataAry['travelType']:'');
                $manualCalcDataAry['fcohr'] = ($manualCalcDataAry['fcohr']>0?$manualCalcDataAry['fcohr']:'');
                $manualCalcDataAry['mchr'] = ($manualCalcDataAry['mchr']>0?$manualCalcDataAry['mchr']:'');
                $manualCalcDataAry['cohr'] = ($manualCalcDataAry['cohr']>0?$manualCalcDataAry['cohr']:'');
            }
        } else {
            $manualCalcDataAry = $data_validate;
        }
      
          $this->load->library('form_validation');
          if(!empty($data_validate['fcobp']) || !empty($data_validate['fcohr'])){
        $this->form_validation->set_rules('orderingData[fcobp]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[fcohr]', 'Hours', 'required|greater_than[1]|numeric');
              $checkforvalidation = true;
          }
        if(!empty($data_validate['SyntheticCannabinoids'])){
            $this->form_validation->set_rules('orderingData[SyntheticCannabinoids]', 'Synthetic Cannabinoids Screening', 'required|numeric');
            $checkforvalidation = true;
        }
         if(!empty($data_validate['mcbp']) || !empty($data_validate['mchr'])){
        $this->form_validation->set_rules('orderingData[mcbp]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[mchr]', 'Hours', 'required|numeric');
             $checkforvalidation = true;
         }
          if(!empty($data_validate['cobp']) || !empty($data_validate['cohr'])){
        $this->form_validation->set_rules('orderingData[cobp]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[cohr]', 'Hours', 'required|greater_than[2]|numeric');
              $checkforvalidation = true;
         }
        if(!empty($data_validate['urineNata'])){
            $this->form_validation->set_rules('orderingData[urineNata]', 'Urine NATA Laboratory screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['nataLabCnfrm'])){
            $this->form_validation->set_rules('orderingData[nataLabCnfrm]', 'NATA Laboratory confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['oralFluidNata'])){
            $this->form_validation->set_rules('orderingData[oralFluidNata]', 'Oral Fluid NATA Laboratory confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['labScrenning'])){
            $this->form_validation->set_rules('orderingData[labScrenning]', 'Laboratory Screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['labconf'])){
            $this->form_validation->set_rules('orderingData[labconf]', 'Laboratory Confirmation', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['RtwScrenning'])){
            $this->form_validation->set_rules('orderingData[RtwScrenning]', 'Return to work  screening', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['mobileScreenBasePrice']) || !empty($data_validate['mobileScreenHr'])){
        $this->form_validation->set_rules('orderingData[mobileScreenBasePrice]', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[mobileScreenHr]', 'Hours', 'required|numeric');
            $checkforvalidation = true;
        }
        if(!empty($data_validate['travelType'])){
            $this->form_validation->set_rules('orderingData[travelType]', 'Travel Type', 'required');
            $checkforvalidation = true;
        }

         if(!empty($data_validate['travelBasePrice']) || !empty($data_validate['travelHr'])){
        $this->form_validation->set_rules('orderingData[travelBasePrice]', ' Travel Base Price', 'required|numeric');
        $this->form_validation->set_rules('orderingData[travelHr]', 'Travel Hours', 'required|numeric');
             $checkforvalidation = true;
         }
        if(!empty($data_validate['cancelfee'])){
            $this->form_validation->set_rules('orderingData[cancelfee]', 'Cancellation Fee', 'required|numeric');
            $checkforvalidation = true;
        }
        $this->form_validation->set_message('required', '{field} is required.');
           if (($checkforvalidation) && ($this->form_validation->run() == FALSE)) {
        
          
            $_POST['orderingData'] = $manualCalcDataAry;
            $data['sosid'] = $sosid;
            $data['idsite'] = $idsite;
            $data['Drugtestid'] = $Drugtestid;
            $data['notification'] = $count;
            $data['commentnotification'] = $commentReplyNotiCount;
            $data['freanchId'] = $freanchId;
            $data['szMetaTagTitle'] = "Ordering";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Ordering";
            $data['subpageName'] = "Sites_Record";
            $this->load->view('layout/admin_header', $data);
            $this->load->view('ordering/editManualOrdering');
            $this->load->view('layout/admin_footer');
        } else {
            if ($this->Ordering_Model->updateCalulatedData($data_validate, $manualCalId)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong>Proforma Invoice updated successfully.</strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);

                $data['idsite'] = $idsite;
                $data['Drugtestid'] = $Drugtestid;
                $data['sosid'] = $sosid;
                $data['notification'] = $count;
                $data['data'] = $data_validate;
                $data['szMetaTagTitle'] = "Ordering";
                $data['is_user_login'] = $is_user_login;
                $data['freanchId'] = $freanchId;
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
        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
        $freanchId = $this->session->userdata('freanchId');
        $Drugtestid = $this->session->userdata('Drugtestid');
        $idsite = $this->session->userdata('idsite');
        $sosid = $this->session->userdata('sosid');
        $data = $this->Ordering_Model->getManualCalculationBySosId($sosid);
        $data['idsite'] = $idsite;
        $data['Drugtestid'] = $Drugtestid;
        $data['sosid'] = $sosid;
        $data['notification'] = $count;
        $data['commentnotification'] = $commentReplyNotiCount;
        $data['data'] = $data;
        $data['freanchId'] = $freanchId;
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
        $this->session->set_userdata('idsite', $idsite);
        $this->session->set_userdata('Drugtestid', $Drugtestid);
        $this->session->set_userdata('sosid', $sosid);
        echo "SUCCESS||||";
        echo "pdfcalculationdetails";
    }

    public function pdfcalculationdetails()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe Proforma Invoice report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Proforma Invoice Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);

        $pdf->AddPage('L');

        $Drugtestid = $this->session->userdata('Drugtestid');
        $idsite = $this->session->userdata('idsite');
        $sosid = $this->session->userdata('sosid');
        $FrenchiseeDataArr = $this->Webservices_Model->getuserhierarchybysiteid($idsite);
        $getState = $this->Franchisee_Model->getStateByFranchiseeId($FrenchiseeDataArr[0]['franchiseeId']);
        $siteDataArr = $this->Webservices_Model->getuserdetails($idsite);
        $clientDataArr = $this->Webservices_Model->getuserdetails($FrenchiseeDataArr[0]['clientType']);
        $data = $this->Ordering_Model->getManualCalculationBySosId($sosid);
        $DrugtestidArr = array_map('intval', str_split($Drugtestid));
        $testDate = $this->Webservices_Model->getsosformdatabysosid($sosid);
        $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($sosid));
        $ValTotal = 0;
        if (in_array(1, $DrugtestidArr)) {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_1__, 2, '.', '');
        }
        if (in_array(2, $DrugtestidArr)) {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_2__, 2, '.', '');
        }
        if (in_array(3, $DrugtestidArr)) {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_3__, 2, '.', '');
        }
        if (in_array(4, $DrugtestidArr)) {
            $ValTotal = number_format($ValTotal + $countDoner * __RRP_4__, 2, '.', '');
        }

        //$Royaltyfees = $ValTotal * 0.1;
        //$Royaltyfees = number_format($Royaltyfees, 2, '.', '');
        $GST = $ValTotal * 0.1;
        $GST = number_format($GST, 2, '.', '');
        $TotalbeforeRoyalty = $ValTotal + $GST;
        $TotalbeforeRoyalty = number_format($TotalbeforeRoyalty, 2, '.', '');
        //$TotalafterRoyalty = $ValTotal - $Royaltyfees + $GST;
        //$TotalafterRoyalty = number_format($TotalafterRoyalty, 2, '.', '');
        //$NetTotal = $ValTotal - $Royaltyfees;
        //$NetTotal = number_format($NetTotal, 2, '.', '');

        $DcmobileScreen = $data['mobileScreenBasePrice'] * ($data['mobileScreenHr']>1?$data['mobileScreenHr']:1);
        $mobileScreen = $data['mcbp'] * ($data['mchr']>1?$data['mchr']:1);
        $calloutprice = $data['cobp'] * ($data['cohr']>3?$data['cohr']:3);
        $fcoprice = $data['fcobp'] * ($data['fcohr']>2?$data['fcohr']:2);
        $travel = $data['travelBasePrice'] * ($data['travelHr']>1?$data['travelHr']:1);

        $TotalTrevenu = $data['urineNata'] + $data['labconf']+$data['cancelfee']+ $data['nataLabCnfrm'] + $data['oralFluidNata'] + $data['SyntheticCannabinoids'] + $data['labScrenning'] + $data['RtwScrenning'] + $mobileScreen + $DcmobileScreen+ $travel + $calloutprice + $fcoprice;

        $TotalTrevenu = number_format($TotalTrevenu, 2, '.', '');
        //$RoyaltyfeesManual = ($TotalTrevenu * 0.1);
        //$RoyaltyfeesManual = number_format($RoyaltyfeesManual, 2, '.', '');
        $GSTmanual = ($TotalTrevenu * 0.1);
        $GSTmanual = number_format($GSTmanual, 2, '.', '');
        $Total1 = $TotalTrevenu + $GSTmanual;
        $Total1 = number_format($Total1, 2, '.', '');
        //$Total2 = $TotalTrevenu - $RoyaltyfeesManual + $GSTmanual;
        //$Total2 = number_format($Total2, 2, '.', '');
        //$totalRoyalty = $Royaltyfees + $RoyaltyfeesManual;

        $totalinvoiceAmt = $ValTotal + $TotalTrevenu;

        $discount = $this->Ordering_Model->getClientDiscountByClientId($FrenchiseeDataArr[0]['clientType']);
        if(!empty($discount)){
            $discountpercent = $discount['percentage'];
        }else{
            $discountpercent = 0;
        }
        if($discountpercent>0){
            $totaldiscount = $totalinvoiceAmt*$discountpercent*0.01;
            $totalafterdiscount = $totalinvoiceAmt-$totaldiscount;
            $totalGst = $totalafterdiscount*0.1;
            $totalRoyaltyBefore = $totalGst + $totalafterdiscount;
        }else{
            $totalGst = $GST + $GSTmanual;
            $totalRoyaltyBefore = $Total1 + $TotalbeforeRoyalty;
            $totaldiscount = 0;
            $totalafterdiscount = 0;
        }
       $val =  sprintf(__FORMAT_NUMBER__, $data['id']);
        //$totalRoyaltyAfter = $Total2 + $TotalafterRoyalty;
        $html = '<div class="wraper">
        <table cellpadding="5px">
       
    <tr>
        <td rowspan="4" align="left"><a style="text-align:left;  margin-bottom:15px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a></td><td align="right"><b>Address:</b> '.$FrenchiseeDataArr[0]['szAddress'].', '.$FrenchiseeDataArr[0]['szZipCode'].', '.$getState['name'].', '.$FrenchiseeDataArr[0]['szCountry'].'</td>
    </tr>
    <tr>
        <td align="right"><b>Phone:</b> '.$FrenchiseeDataArr[0]['szContactNumber'].'</td>
    </tr>
    <tr>
        <td align="right"><b>Email:</b> '.$FrenchiseeDataArr[0]['szEmail'].'</td>
    </tr>
    <tr>
        <td align="right"><b>ABN:</b> '.$FrenchiseeDataArr[0]['abn'].'</td>
    </tr>
</table>
<br />
<h1 style="text-align: center;">Proforma Invoice</h1>

<table cellpadding="5px">
    <tr>
        <td width="50%" align="left" font-size="20"><b>Proforma Invoice#:</b> #'.$val.'</td><td width="50%" align="right"><b>Proforma Invoice Date:</b> '.date('d/m/Y',strtotime($data['dtCreatedOn'])).'</td>
    </tr>
    <tr>
        <td width="50%" align="left" font-size="20"><b>Business Name:</b> '.$clientDataArr[0]['szName'].'</td><td width="50%" align="right"><b>Company Name:</b> '.$siteDataArr[0]['szName'].'</td>
    </tr>
    <tr>
        <td width="50%" align="left"><b>Business Address:</b> '.$clientDataArr[0]['szAddress'].', '.$clientDataArr[0]['szZipCode'].', '.$getState['name'].', '.$clientDataArr[0]['szCountry'].'</td><td width="50%" align="right"><b>Company Address:</b> '.$siteDataArr[0]['szAddress'].', '.$siteDataArr[0]['szZipCode'].', '.$getState['name'].', '.$siteDataArr[0]['szCountry'].'</td>
    </tr>
    <tr>
        <td width="50%" align="left"><b>ABN:</b> '.$clientDataArr[0]['abn'].'</td><td width="50%" align="right"><b>Test Date:</b> '.date('d/m/Y',strtotime($testDate[0]['testdate'])).'</td>
    </tr>
    <tr>
       <td width="50%"> </td><td width="50%" align="right"><b>No of Donors Tested:</b> '.$countDoner.'</td>
    </tr>
</table>
<h3 style="color:black">System Calculated Result</h3>
<table border="1px" cellpadding="5px">
    <tr>
        <td width="80%" align="left"><b>Total (Excluding GST):</b></td><td width="20%" align="right">$'.number_format($ValTotal,2,'.',',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>GST (10%):</b></td><td width="20%" align="right">$'.number_format($GST, 2, '.', ',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>Total (Including GST):</b></td><td width="20%" align="right">$'.number_format($TotalbeforeRoyalty, 2, '.', ',').'</td>
    </tr>
</table>
<h3 style="color:black">Other Revenue Stream Calculation Result</h3>
<table border="1px" cellpadding="5px">
    <tr>
        <td width="80%" align="left"><b>Total (Excluding GST):</b></td><td width="20%" align="right">$'.number_format($TotalTrevenu,2,'.',',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>GST (10%):</b></td><td width="20%" align="right">$'.number_format($GSTmanual, 2, '.', ',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>Total (Including GST):</b></td><td width="20%" align="right">$'.number_format($Total1, 2, '.', ',').'</td>
    </tr>
</table>
<br />
<h3 style="color:black">Proforma Invoice Totals</h3>
<br />
<table border="1px" cellpadding="5px">
    <tr>
        <td width="80%" align="left"><b>Total (Excluding GST):</b></td><td width="20%" align="right">$'.number_format($totalinvoiceAmt, 2, '.', ',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>Discount '.($discountpercent>0?'('.$discountpercent.'%)':'').':</b></td><td width="20%" align="right">'.($discountpercent>0?'$'.number_format($totaldiscount, 2, '.', ','):'-').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>Total After Discount (Excluding GST):</b></td><td width="20%" align="right">'.($discountpercent>0?'$'.number_format($totalafterdiscount, 2, '.', ','):'-').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>GST (10%):</b></td><td width="20%" align="right">$'.number_format($totalGst, 2, '.', ',').'</td>
    </tr>
    <tr>
        <td width="80%" align="left"><b>Total (Including GST):</b></td><td width="20%" align="right">$'.number_format($totalRoyaltyBefore, 2, '.', ',').'</td>
    </tr>
</table>
        </div>';
        $pdf->writeHTML($html, true, false, true, false, '');

        error_reporting(E_ALL);/*
        $this->session->unset_userdata('idsite');
        $this->session->unset_userdata('Drugtestid');
        $this->session->unset_userdata('sosid');*/
        ob_end_clean();
        $pdf->Output('view_calculation_details.pdf', 'I');
    }

    function siteRecordpage()
    {
        $freanchId = $this->input->post('freanchId');
        $this->session->set_userdata('idFreanch', $freanchId);
        echo "SUCCESS||||";
        echo "sitesRecord";
    }
    function discountPercentage()
    {
        $is_user_login = is_user_login($this);
        if(!$is_user_login)
        {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $getAllDiscountAry=$this->Ordering_Model->getAllDiscounPercentage();
        $data['szMetaTagTitle'] = "Discount Percentage List";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "proforma_invoice";
        $data['subpageName'] = "discount_percentage";
        $data['getAllDiscountAry']=$getAllDiscountAry;
        $this->load->view('layout/admin_header',$data);
        $this->load->view('ordering/discountList');
        $this->load->view('layout/admin_footer');
    }
    function createDiscount()
    {
        $is_user_login = is_user_login($this);
        if(!$is_user_login)
        {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
            }
            $data = $this->input->post('createDiscount');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('createDiscount[percentage]', 'Discount Percentage', 'required|is_numeric|maximumCheck');
            $this->form_validation->set_rules('createDiscount[description]', 'Description', 'required');
            $this->form_validation->set_message('maximumCheck', ' %s field must be less than 100.');
            $this->form_validation->set_message('required', '{field} is required.');
            
            if ($this->form_validation->run() == FALSE)
            { 
                $data['szMetaTagTitle'] = "create Discount";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "proforma_invoice";
                $data['subpageName'] = "discount_percentage";
                $this->load->view('layout/admin_header',$data);
                $this->load->view('ordering/createDiscount');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if($this->Ordering_Model->insertDiscount($data))
                {
		    redirect(base_url('ordering/discountPercentage/'));
                    die;
                }
            }
        }
        function editDiscountDetails()
        {
            $idDiscount = $this->input->post('idDiscount');
           
            if($idDiscount>0)
            {
                $this->session->set_userdata('idDiscount',$idDiscount);
                echo "SUCCESS||||";
                echo "editDiscount";
            }
            
        }
        
        public function editDiscount()
        {
          $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
            $data_validate = $this->input->post('editDiscount');
            $idDiscount = $this->session->userdata('idDiscount');
            if(empty($data_validate))
            {
                 $getDiscountData = $this->Ordering_Model->getDiscountById($idDiscount);
            }
            else
            {
                $getDiscountData = $data_validate;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('editDiscount[percentage]', 'Discount Percentage', 'required|is_numeric|maximumCheck');
            $this->form_validation->set_rules('editDiscount[description]', 'Description', 'required');
            $this->form_validation->set_message('maximumCheck', ' %s field must be less than 100.');
             $this->form_validation->set_message('required', '{field} is required.');
             if ($this->form_validation->run() == FALSE)
            { 
                $data['szMetaTagTitle'] = "Edit Discount";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "proforma_invoice";
                $data['subpageName'] = "discount_percentage";
	        $_POST['editDiscount']=$getDiscountData;
                $this->load->view('layout/admin_header',$data);
                $this->load->view('ordering/editDiscount');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if($this->Ordering_Model->updateDiscount($data_validate,$idDiscount))
                {
		    redirect(base_url('ordering/discountPercentage/'));
                    die;
                }
            }
         }
        public function discountDeleteeAlert()
        {
            $data['mode'] = '__DELETE_DISCOUNT_POPUP__';
            $data['idDiscount'] = $this->input->post('idDiscount');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function deletediscountConfirmation()
        {
            $data['mode'] = '___DELETE_DISCOUNT_CONFIRM__';
            $data['idDiscount'] = $this->input->post('idDiscount');
            $this->Ordering_Model->deleteDiscount($data['idDiscount']);
            $this->load->view('admin/admin_ajax_functions',$data);
        }
      function discountViewData()
        {
            $idDiscount = $this->input->post('idDiscount');
           
            if($idDiscount>0)
            {
                $this->session->set_userdata('idDiscount',$idDiscount);
                echo "SUCCESS||||";
                echo "discount_view";
            }
            
        }
        
        public function discount_view()
        {
          $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
           
            $idDiscount = $this->session->userdata('idDiscount');
            $getAllDiscountAry=$this->Ordering_Model->getDiscountById($idDiscount);
                    $data['szMetaTagTitle'] = "View Discount";
                    $data['is_user_login'] = $is_user_login;
                    $data['getAllDiscountAry'] = $getAllDiscountAry;
                    $data['pageName'] = "proforma_invoice";
                    $data['subpageName'] = "discount_percentage";
                  
                
                $this->load->view('layout/admin_header',$data);
                $this->load->view('ordering/viewDiscount');
                $this->load->view('layout/admin_footer');
          
         }
}

?>