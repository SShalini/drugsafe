<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reporting_Controller extends CI_Controller {
     
	function __construct()
	{
            parent::__construct();
           
            $this->load->library('pagination');
            $this->load->model('Error_Model');
            $this->load->model('Admin_Model');
            $this->load->model('Franchisee_Model');
            $this->load->model('Inventory_Model');
            $this->load->model('StockMgt_Model');
            $this->load->model('Reporting_Model');
        
	}
        public function index()
	{
            $is_user_login = is_user_login($this);
            if($is_user_login)
            {
  
                    ob_end_clean();
                    header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
                    die;

           
             }
             else {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
   
        } 
        
         function allstockreqlist()
        {
           $is_user_login = is_user_login($this);
           
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
             $count = $this->Admin_Model->getnotification();
             
             
        $config['base_url'] = __BASE_URL__ . "/reporting/allstockreqlist/";
        $config['total_rows'] = count($this->Reporting_Model->getAllQtyRequestDetails($limit,$offset));
        $config['per_page'] = 5;


        $this->pagination->initialize($config);
        
             $allReqQtyAray =$this->Reporting_Model->getAllQtyRequestDetails($config['per_page'],$this->uri->segment(3));
 
                    $data['allReqQtyAray'] = $allReqQtyAray;
                    $data['szMetaTagTitle'] = "All Stock Requests";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Reporting";
                    $data['subpageName'] = "All_Stock_Requests";
                    $data['notification'] = $count;
                    $data['data'] = $data;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/StockRequestList');
            $this->load->view('layout/admin_footer');
        }
         function stockassignlist()
        {
           $is_user_login = is_user_login($this);
           
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
                header("Location:" . __BASE_URL__ . "/admin/admin_login");
                die;
            }
             $count = $this->Admin_Model->getnotification();
                   
        $config['base_url'] = __BASE_URL__ . "/reporting/stockassignlist/";
        $config['total_rows'] = count($this->Reporting_Model->getAllQtyAssignDetails($limit,$offset));
        $config['per_page'] = 5;


        $this->pagination->initialize($config);
             
             $allQtyAssignAray =$this->Reporting_Model->getAllQtyAssignDetails($config['per_page'],$this->uri->segment(3));
 
                    $data['allQtyAssignAray'] = $allQtyAssignAray;
                    $data['szMetaTagTitle'] = "Stock Assignments";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Reporting";
                    $data['subpageName'] = "Stock_Assignments";
                    $data['notification'] = $count;
                    $data['data'] = $data;
 
            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/StockAssignList');
            $this->load->view('layout/admin_footer');
        }

 public function pdfstockreqlist (){
    $this->load->library('Pdf');
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Pdf');
    $pdf->SetHeaderMargin(20);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
     $pdf->SetCreator(PDF_CREATOR);
    // Add a page
    $pdf->AddPage();
    
    $allReqQtyAray =$this->Reporting_Model->getAllQtyRequestDetails();
     
    $html.='       
                        <div class= "table-responsive">
                            <table class="table table-striped table-bordered table-hover" border="1">
                                <thead>
                                    <tr>
                                        
                                        <th> <b>Id</b> </th>
                                        <th> <b>Franchisee</b> </th>
                                        <th> <b>Product Code</b> </th>
                                        <th><b> Quantity</b> </th>
                                        <th> <b>Requested On</b> </th>
                                   
                                    </tr>
                                </thead>';
                            if($allReqQtyAray)
                            {
                                $i = 0;
                                foreach($allReqQtyAray as $allReqQtyData){
                                    $productDataAry = $this->Inventory_Model->getProductDetailsById($allReqQtyData['iProductId']);
                                    $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$allReqQtyData['iFranchiseeId']);
                                    $html.='<tr>
                                            <td> FR-'.$allReqQtyData['iFranchiseeId'].' </td>
                                            <td> '. $franchiseeArr['szName'].'</td>
                                            <td> '.$productDataAry['szProductCode'].' </td>
                                            <td>'. $allReqQtyData['szQuantity'].' </td>
                                             <td>'.date('d/m/Y h:i:s A',strtotime( $allReqQtyData['dtRequestedOn'])).' </td>
                                
                                        </tr>';
                                    
                                }
                            }
                            $i++;

   
                               $html.='
                            </table>
                        </div>
                      
                        ';
    $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
    $pdf->Output('pdfexample.pdf', 'I'); 
           
 
 }
      
  public function pdfstockassignlist (){
    $this->load->library('Pdf');
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Pdf');
    $pdf->SetHeaderMargin(20);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
     $pdf->SetCreator(PDF_CREATOR);
    // Add a page
    $pdf->AddPage();
    
    $allQtyAssignAray =$this->Reporting_Model->getAllQtyAssignDetails();
     
    $html.='       
                        <div class= "table-responsive">
                            <table class="table table-striped table-bordered table-hover" border="1">
                                <thead>
                                    <tr>
                                        
                                        <th> <b>Id</b> </th>
                                        <th> <b>Franchisee</b> </th>
                                        <th> <b>Product Code</b> </th>
                                        <th><b> Quantity</b> </th>
                                        <th> <b>Requested On</b> </th>
                                   
                                    </tr>
                                </thead>';
                            if($allQtyAssignAray)
                            {
                                $i = 0;
                                foreach($allQtyAssignAray as $allQtyAssignData){
                                    $productDataAry = $this->Inventory_Model->getProductDetailsById($allQtyAssignData['iProductId']);
                                    $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$allQtyAssignData['iFranchiseeId']);
                                    $html.='<tr>
                                            <td> FR-'.$allQtyAssignData['iFranchiseeId'].' </td>
                                            <td> '. $franchiseeArr['szName'].'</td>
                                            <td> '.$productDataAry['szProductCode'].' </td>
                                            <td>'. $allQtyAssignData['szQuantityAssigned'].' </td>
                                            <td>'.date('d/m/Y h:i:s A',strtotime( $allQtyAssignData['dtRequestedOn'])).' </td>
                                            <td> '. date('d/m/Y h:i:s A',strtotime($allQtyAssignData['dtAssignedOn'])).'  </td>
                                        </tr>';
                                    
                                }
                            }
                            $i++;

   
                               $html.='
                            </table>
                        </div>
                      
                        ';
    $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
    $pdf->Output('pdfexample.pdf', 'I'); 
           
 
 }
      
    }      
    
?>