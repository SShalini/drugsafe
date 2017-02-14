<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Controller extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('StockMgt_Model');
        $this->load->library('pagination');
        $this->load->model('Ordering_Model');
	$this->load->model('Reporting_Model');
        $this->load->model('Forum_Model');
        $this->load->model('Error_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Franchisee_Model');
        $this->load->model('Inventory_Model');
        $this->load->model('Form_Management_Model');
        $this->load->model('StockMgt_Model');
        $this->load->model('Webservices_Model');
        
    }

    public function index()
    {
        $is_user_login = is_user_login($this);
        if ($is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/franchiseeList'));
             die;
        } else {
            ob_end_clean();
             redirect(base_url('/admin/admin_login'));
            die;
        }
    }
    function allstockreqlistData()
        {
            $flag = $this->input->post('flag');
            
                $this->session->set_userdata('flag',$flag);
                
                echo "SUCCESS||||";
                echo "allstockreqlist";
            
 
        }

    function allstockreqlist()
    { 
         if(!empty($_POST)){
          $this->session->unset_userdata('searchterm');   
        }
        $flag = $this->session->userdata('flag');
         if($flag==1){
            $this->session->unset_userdata('searchterm');    
         }
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
             redirect(base_url('/admin/admin_login'));
            die;
        }

           $searchAry = '';
            
              if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
              $searchItemFr = $_POST['szSearch'];  
              $searchItemProd = $_POST['szSearch']; 
          }else{
              if(isset($_POST['szSearch']) && !empty($_POST['szSearch'])){
               $searchItem = $_POST['szSearch']; 
              
            }
            if(isset($_POST['szSearch2']) && !empty($_POST['szSearch2'])){
                $searchItem = $_POST['szSearch2'];
             }
             $searchItemData = $this->Reporting_Model->searchterm_handler($searchItem); 
          }
       
           
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
        $config['base_url'] = __BASE_URL__ . "/reporting/allstockreqlist/";
        
         if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
             
               $config['total_rows'] = count($this->Reporting_Model->getAllQtyRequestDetails($searchAry, $limit, $offset,$searchItemData,3));
          }else{
              $config['total_rows'] = count($this->Reporting_Model->getAllQtyRequestDetails($searchAry, $limit, $offset,$searchItemData)); 
              
            }

        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
        $this->pagination->initialize($config);
        
          if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
             
             $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetails($searchAry, $config['per_page'], $this->uri->segment(3),$searchItemData,3);
          }else{
            $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetails($searchAry, $config['per_page'], $this->uri->segment(3),$searchItemData);
              
            }

        $allQtyRequestListAray = $this->Reporting_Model->getAllQtyRequestDetails(false,false,false,false,1);
        $allQtyProductRequestListAray = $this->Reporting_Model->getAllQtyRequestDetails(false,false,false,false,2);
      
        
        
        $data['allReqQtyAray'] = $allReqQtyAray;
        $data['allQtyProductRequestListAray'] = $allQtyProductRequestListAray;
        $data['allQtyRequestListAray'] = $allQtyRequestListAray;
        $data['szMetaTagTitle'] = "All Stock Requests";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "All_Stock_Requests";
        $data['notification'] = $count;
        $data['commentnotification'] = $commentReplyNotiCount;
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/stockRequestList');
        $this->load->view('layout/admin_footer');
    }
   function stockassignlistData()
        {
            $flag = $this->input->post('flag');
            
                $this->session->set_userdata('flag',$flag);
                
                echo "SUCCESS||||";
                echo "stockassignlist";
            
 
        }
    function stockassignlist()
    {
       if(!empty($_POST)){
          $this->session->unset_userdata('searchtermAssign');   
        }
         $flag = $this->session->userdata('flag');
         if($flag==1){
            $this->session->unset_userdata('searchtermAssign');    
         }
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
             redirect(base_url('/admin/admin_login'));
            die;
        }
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
       
          $searchAry = '';
          if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
              $searchItemFr = $_POST['szSearch'];  
              $searchItemProd = $_POST['szSearch']; 
          }else{
              if(isset($_POST['szSearch']) && !empty($_POST['szSearch'])){
               $searchItem = $_POST['szSearch']; 
              
            }
            if(isset($_POST['szSearch2']) && !empty($_POST['szSearch2'])){
                $searchItem = $_POST['szSearch2'];
             }
             $searchItemData = $this->Reporting_Model->searchtermAssign_handler($searchItem); 
          }
        $config['base_url'] = __BASE_URL__ . "/reporting/stockassignlist/";
       
       if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
             
               $config['total_rows'] = count($this->Reporting_Model->getAllQtyAssignDetails($searchAry, $limit, $offset,false,3));
          }else{
            $config['total_rows'] = count($this->Reporting_Model->getAllQtyAssignDetails($searchAry, $limit, $offset,$searchItemData)); 
              
            }
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
        $this->pagination->initialize($config);
        if(!empty($_POST['szSearch'])&&!empty($_POST['szSearch2'])){
             
              $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetails($searchAry,$config['per_page'], $this->uri->segment(3),false,3);
          }else{
           $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetails($searchAry,$config['per_page'], $this->uri->segment(3),$searchItemData);
              
            }
        
        $allQtyAssignListAray = $this->Reporting_Model->getAllQtyAssignDetails(false,false,false,false,1);
        $allQtyProductAssignListAray = $this->Reporting_Model->getAllQtyAssignDetails(false,false,false,false,2);
       
     
        $data['allQtyAssignAray'] = $allQtyAssignAray;
        $data['allQtyAssignListAray'] = $allQtyAssignListAray;
        $data['allQtyProductAssignListAray'] = $allQtyProductAssignListAray;
        $data['szMetaTagTitle'] = "Stock Assignments";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "Stock_Assignments";
        $data['notification'] = $count;
        $data['commentnotification'] = $commentReplyNotiCount;
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/stockAssignList');
        $this->load->view('layout/admin_footer');
    }
function ViewReqReportingPdfData()
        {
            $franchiseeName = $this->input->post('franchiseeName');
            $productCode = $this->input->post('productCode');
          
            
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('franchiseeName',$franchiseeName);
               
                
                echo "SUCCESS||||";
                echo "pdfstockreqlist";
            
 
        }
    public function pdfstockreqlist()
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
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        
        $franchiseeName = $this->session->userdata('franchiseeName');
        $productCode = $this->session->userdata('productCode');
        
            
           $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetailsForPdf($franchiseeName,$productCode);  
       
      
        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Request Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b> Id</b> </th>
                                        <th> <b>Franchisee</b> </th>
                                        <th> <b>Product Code</b> </th>
                                        <th style="width:150px"><b> Quantity Requested</b> </th>
                                        <th style="width:170px"> <b>Requested On</b> </th>
                                   
                                    </tr>';
        if ($allReqQtyAray) {
            $i = 0;
            foreach ($allReqQtyAray as $allReqQtyData) {
                $productDataAry = $this->Inventory_Model->getProductDetailsById($allReqQtyData['iProductId']);
                $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $allReqQtyData['iFranchiseeId']);
                $html .= '<tr>
                                            <td> FR-' . $allReqQtyData['iFranchiseeId'] . ' </td>
                                            <td> ' . $franchiseeArr['szName'] . '</td>
                                            <td> ' . $productDataAry['szProductCode'] . ' </td>
                                            <td>' . $allReqQtyData['szQuantity'] . ' </td>
                                             <td>' . date('d/m/Y h:i:s A', strtotime($allReqQtyData['dtRequestedOn'])) . ' </td>
                                
                                        </tr>';
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);
       
          $this->session->unset_userdata('productCode');
           $this->session->unset_userdata('franchiseeName');
        $pdf->Output('stock-request-report.pdf', 'I');
    }
function excelstockreqlistData()
        {
            $franchiseeName = $this->input->post('franchiseeName');
            $productCode = $this->input->post('productCode');
          
            
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('franchiseeName',$franchiseeName);
               
                
                echo "SUCCESS||||";
                echo "excelstockreqlist";
            
 
        }
    public function excelstockreqlist()
    {
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Stock request list';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Franchisee Id');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Franchisee');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'Quantity Request');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Requested On');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $franchiseeName = $this->session->userdata('franchiseeName');
        $productCode = $this->session->userdata('productCode');
         $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetailsForPdf($franchiseeName,$productCode);
        if(!empty($allReqQtyAray)){
            $i = 2;
            foreach($allReqQtyAray as $item){
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $item['iFranchiseeId']);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $item['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('D'.$i, $item['szQuantity']);
                $this->excel->getActiveSheet()->setCellValue('E'.$i, date('d/m/Y h:i:s A', strtotime($item['dtRequestedOn'])));

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $this->session->unset_userdata('productCode');
        $this->session->unset_userdata('franchiseeName');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
function ViewAssignReportingPdfData()
        {
            $franchiseeName = $this->input->post('franchiseeName');
            $productCode = $this->input->post('productCode');
            $flag = $this->input->post('flag');
            
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('franchiseeName',$franchiseeName);
                $this->session->set_userdata('flag',$flag);
                
                echo "SUCCESS||||";
                echo "pdfstockassignlist";
            
 
        }
    public function pdfstockassignlist()
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe stock assignment report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Stock Assignment Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        $flag = $this->session->userdata('flag');
        $franchiseeName = $this->session->userdata('franchiseeName');
        $productCode = $this->session->userdata('productCode');
        if($flag==1){
            
           $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetailsForPdf($franchiseeName,$productCode);  
        }
    
        
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Assignment Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        
                                     
                                         <th style="width:60px"><b>Id</b> </th>
                                         <th style="width:85px"><b> Franchisee </b> </th>
                                         <th style="width:70px"><b> Product Code</b> </th>
                                         <th style="width:70px"><b>Cost Per Item</b> </th>
                                         <th style="width:90px"><b> Total Cost For Quantity Assign</b> </th>
                                        <th style="width:80px"><b> Quantity Assigned</b> </th>
                                        <th style="width:80px"><b> Quantity Adjusted</b> </th>
                                         <th style="width:80px"><b> Available Quantity</b> </th>
                                        <th style="width:100px"> <b>Assigned On</b> </th>
                                   
                                    </tr>';
        if ($allQtyAssignAray) {
            $i = 0;
            foreach ($allQtyAssignAray as $allQtyAssignData) {
               
                $productDataAry = $this->Inventory_Model->getProductDetailsById($allQtyAssignData['iProductId']);
                $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $allQtyAssignData['iFranchiseeId']);
              
                if($allQtyAssignData['quantityDeducted'] !=0){
                    $Qty= $allQtyAssignData['quantityDeducted'];
                     $Cost= $allQtyAssignData['szProductCost'];
                     $TotalCostPerQty = "(-) $".($Qty*$Cost);
                    
                  }
                  else{
                       $Qty= $allQtyAssignData['szQuantityAssigned'];
                       $Cost= $allQtyAssignData['szProductCost'];
                       $TotalCostPerQty =  "(+) $".($Qty*$Cost);
                       
                    }
                $html .= '<tr>
                                            <td> FR-' . $allQtyAssignData['iFranchiseeId'] . ' </td>
                                            <td> ' . $franchiseeArr['szName'] . '</td>
                                            <td> ' . $allQtyAssignData['szProductCode'] . ' </td>
                                            <td> $' . $allQtyAssignData['szProductCost'] . ' </td>
                                            <td> $' .$TotalCostPerQty. ' </td>
                                            <td>' . $allQtyAssignData['szQuantityAssigned'] . ' </td>
                                            <td>' . $allQtyAssignData['quantityDeducted'] . ' </td>
                                            <td>' . $allQtyAssignData['szTotalAvailableQty'] . ' </td>
                                            <td> ' . date('d/m/Y h:i:s A', strtotime($allQtyAssignData['dtAssignedOn'])) . '  </td>
                                        </tr>';
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
         $this->session->unset_userdata('$flag');
         $this->session->unset_userdata('productCode');
         $this->session->unset_userdata('franchiseeName');
        $pdf->Output('stock-assignment-report.pdf', 'I');
    }
function excelstockassignlistData()
        {
            $franchiseeName = $this->input->post('franchiseeName');
            $productCode = $this->input->post('productCode');
          
            
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('franchiseeName',$franchiseeName);
               
                
                echo "SUCCESS||||";
                echo "excelstockassignlist";
            
 
        }
    public function excelstockassignlist()
    {
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Stock assignment';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Franchisee Id');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Franchisee');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->setCellValue('D1', 'Cost Per Item');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->setCellValue('E1', 'Total Cost For Quantity Assign');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Quantity Assigned');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('G1', 'Quantity Adjusted');
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('H1', 'Total available quantity');
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('I1', 'Assigned On');
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $franchiseeName = $this->session->userdata('franchiseeName');
        $productCode = $this->session->userdata('productCode');
         $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetailsForPdf($franchiseeName,$productCode);  
               
        if(!empty($allQtyAssignAray)){
            $i = 2;
            foreach($allQtyAssignAray as $item){
               if($item['quantityDeducted'] !=0){
                    $Qty= $item['quantityDeducted'];
                     $Cost= $item['szProductCost'];
                     $TotalCostPerQty = "(-) $".($Qty*$Cost);
                    
                  }
                  else{
                       $Qty= $item['szQuantityAssigned'];
                       $Cost= $item['szProductCost'];
                       $TotalCostPerQty =  "(+) $".($Qty*$Cost);
                       
                    }
                
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $item['iFranchiseeId']);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $item['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('D'.$i, $item['szProductCost']);
                $this->excel->getActiveSheet()->setCellValue('E'.$i, $TotalCostPerQty);
                $this->excel->getActiveSheet()->setCellValue('F'.$i, $item['szQuantityAssigned']);
                $this->excel->getActiveSheet()->setCellValue('G'.$i, $item['quantityDeducted']);
                $this->excel->getActiveSheet()->setCellValue('H'.$i, $item['szTotalAvailableQty']);
                $this->excel->getActiveSheet()->setCellValue('I'.$i, date('d/m/Y h:i:s A', strtotime($item['dtAssignedOn'])));

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        //Session Unset
        $this->session->unset_userdata('productCode');
        $this->session->unset_userdata('franchiseeName');
        //end session Unset
        $objWriter->save('php://output');
    }

    function frstockreqlist()
    {
        if(empty($_POST)||empty($_POST['szSearchProdCode'])){
          $this->session->unset_userdata('searchterm');   
        }
       
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
           redirect(base_url('/admin/admin_login'));
            die;
        }

        $searchAryData = $_POST['szSearchProdCode'];
        $searchAry = $this->Reporting_Model->searchterm_handler($searchAryData);
        $franchiseeId = $_SESSION['drugsafe_user']['id'];


        $config['base_url'] = __BASE_URL__ . "/reporting/frstockreqlist/";
        $config['total_rows'] = count($this->Reporting_Model->getFrAllQtyRequestDetails($searchAry, $limit, $offset, $franchiseeId));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

        $this->pagination->initialize($config);

        $frAllReqQtyAray = $this->Reporting_Model->getFrAllQtyRequestDetails($searchAry, $config['per_page'], $this->uri->segment(3), $franchiseeId);
        $AllQtyReqListAry = $this->Reporting_Model->getFrAllQtyRequestDetails(false,false,false,$franchiseeId);
        $data['frAllReqQtyAray'] = $frAllReqQtyAray;
        $data['szMetaTagTitle'] = " Stock Requests";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['AllQtyReqList'] = $AllQtyReqListAry;
        $data['subpageName'] = "Franchisee_Stock_Requests";
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/frStockRequestList');
        $this->load->view('layout/admin_footer');
    }
    
 function frstockassignlistData()
        {
            $flag = $this->input->post('flag');
            
                $this->session->set_userdata('flag',$flag);
                
                echo "SUCCESS||||";
                echo "frstockassignlist";
            
 
        }
    function frstockassignlist()
    {
        if(!empty($_POST)){
          $this->session->unset_userdata('searchtermAssign');   
        }
         $flag = $this->session->userdata('flag');
         if($flag==1){
            $this->session->unset_userdata('searchtermAssign');    
         }
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
           redirect(base_url('/admin/admin_login'));
            die;
        }
        $searchAryData = $_POST['szSearchProdCode'];
        $searchAry = $this->Reporting_Model->searchtermAssign_handler($searchAryData);
        $franchiseeId = $_SESSION['drugsafe_user']['id'];

        $config['base_url'] = __BASE_URL__ . "/reporting/frstockassignlist/";
        $config['total_rows'] = count($this->Reporting_Model->getFrAllQtyAssignDetails($searchAry, $limit, $offset, $franchiseeId));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

        $this->pagination->initialize($config);

        $frAllQtyAssignAray = $this->Reporting_Model->getFrAllQtyAssignDetails($searchAry, $config['per_page'], $this->uri->segment(3), $franchiseeId);
        $allQtyAssignListAray = $this->Reporting_Model->getFrAllQtyAssignDetails(false, false, false, $franchiseeId,1);
        
        $data['frAllQtyAssignAray'] = $frAllQtyAssignAray;
         $data['allQtyAssignListAray'] = $allQtyAssignListAray;
        $data['szMetaTagTitle'] = "Stock Assignments";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "Franchisee_Stock_Assignments";
        $data['data'] = $data;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/frStockAssignList');
        $this->load->view('layout/admin_footer');
    }
 function pdffrstockreqlistData()
        {
            
            $productCode = $this->input->post('productCode');
          
            $this->session->set_userdata('productCode',$productCode);
               
                echo "SUCCESS||||";
                echo "pdffrstockreqlist";
            
 
        }
    public function pdffrstockreqlist()
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe stock request report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Stock Request Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        
        $franchiseeId = $_SESSION['drugsafe_user']['id'];
         $productCode = $this->session->userdata('productCode');
        $frAllReqQtyAray = $this->Reporting_Model->getFrAllQtyRequestDetails($productCode, false, false, $franchiseeId);
        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Request Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th> <b>Product Code</b> </th>
                                        <th><b> Quantity Requested</b> </th>
                                        <th> <b>Requested On</b> </th>
                                   
                                    </tr>';
        if ($frAllReqQtyAray) {
            $i = 0;
            foreach ($frAllReqQtyAray as $frAllReqQtyArayData) {
                $html .= '<tr>
                                        
                                            <td> ' . $frAllReqQtyArayData['szProductCode'] . ' </td>
                                            <td>' . $frAllReqQtyArayData['szQuantity'] . ' </td>
                                             <td>' . date('d/m/Y h:i:s A', strtotime($frAllReqQtyArayData['dtRequestedOn'])) . ' </td>
                                
                                        </tr>';
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        ob_end_clean();
        $this->session->unset_userdata('productCode');
        $pdf->Output('stock-request-report.pdf', 'I');
    }
function excelfrstockreqlistData()
        {
            
            $productCode = $this->input->post('productCode');
          
            $this->session->set_userdata('productCode',$productCode);
               
                echo "SUCCESS||||";
                echo "excelfrstockreqlist";
            
 
        }
    public function excelfrstockreqlist()
    {
        $franchiseeId = $_SESSION['drugsafe_user']['id'];
        $productCode = $this->session->userdata('productCode');
        $frAllReqQtyAray = $this->Reporting_Model->getFrAllQtyRequestDetails($productCode, false, false, $franchiseeId);
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Stock request';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Quantity Requested');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Requested On');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        if(!empty($frAllReqQtyAray)){
            $i = 2;
            foreach($frAllReqQtyAray as $item){
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $item['szQuantity']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, date('d/m/Y h:i:s A', strtotime($item['dtRequestedOn'])));

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
         $this->session->unset_userdata('productCode');
        $objWriter->save('php://output');
    }
 function pdf_fr_stockassignlist_Data()
        {
            
            $productCode = $this->input->post('productCode');
          
            $this->session->set_userdata('productCode',$productCode);
               
                echo "SUCCESS||||";
                echo "pdf_fr_stockassignlist";
            
 
        }
    public function pdf_fr_stockassignlist()
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe stock assignment report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Stock Assignment Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page  
        $pdf->AddPage();
        $franchiseeId = $_SESSION['drugsafe_user']['id'];
         $productCode = $this->session->userdata('productCode');
       
        $frAllQtyAssignAray = $this->Reporting_Model->getFrAllQtyAssignDetails($productCode, false, false, $franchiseeId);
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Assignment Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th> <b>Product Code</b> </th>
                                        <th><b>Cost Per Item</b> </th>
                                         <th><b> Total Cost For Quantity Assign</b> </th>
                                        <th><b> Quantity Assigned</b> </th>
                                        <th><b> Quantity Adjusted</b> </th>
                                        <th><b> Available Quantity</b> </th>
                                        <th> <b>Assigned On</b> </th>
                                   
                                    </tr>';
        if ($frAllQtyAssignAray) {
            $i = 0;
            foreach ($frAllQtyAssignAray as $frAllQtyAssignArayData) {
               if($frAllQtyAssignArayData['quantityDeducted'] !=0){
                            $Qty= $frAllQtyAssignArayData['quantityDeducted'];
                             $Cost= $frAllQtyAssignArayData['szProductCost'];
                             $TotalCostPerQty = "(-) $".($Qty*$Cost);
                          }
                          else{
                               $Qty= $frAllQtyAssignArayData['szQuantityAssigned'];
                               $Cost= $frAllQtyAssignArayData['szProductCost'];
                               $TotalCostPerQty = "(+) $".($Qty*$Cost);
                          }              

                $html .= '<tr>
                                            <td> ' . $frAllQtyAssignArayData['szProductCode'] . ' </td>
                                            <td> $' . $frAllQtyAssignArayData['szProductCost'] . ' </td>
                                            <td> $' .$TotalCostPerQty. ' </td>
                                            <td>' . $frAllQtyAssignArayData['szQuantityAssigned'] . ' </td>
                                            <td>' . $frAllQtyAssignArayData['quantityDeducted'] . ' </td>
                                             <td>' . $frAllQtyAssignArayData['szTotalAvailableQty'] . ' </td>
                                            <td> ' . date('d/m/Y h:i:s A', strtotime($frAllQtyAssignArayData['dtAssignedOn'])) . '  </td>
                                        </tr>';
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $this->session->unset_userdata('productCode');
        $pdf->Output('stock-assignment-report.pdf', 'I');
    }
function excelfr_stockassignlist_Data()
        {
            
            $productCode = $this->input->post('productCode');
          
            $this->session->set_userdata('productCode',$productCode);
               
                echo "SUCCESS||||";
                echo "excelfr_stockassignlist";
            
 
        }
    public function excelfr_stockassignlist()
    {
        $franchiseeId = $_SESSION['drugsafe_user']['id'];
       $productCode = $this->session->userdata('productCode');
       $frAllQtyAssignAray = $this->Reporting_Model->getFrAllQtyAssignDetails($productCode, false, false, $franchiseeId);
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Stock assignment';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
        
        $this->excel->getActiveSheet()->setCellValue('B1', 'Cost Per Item');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
         $this->excel->getActiveSheet()->setCellValue('C1', 'Total Cost For Quantity Assign');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        

        $this->excel->getActiveSheet()->setCellValue('D1', 'Quantity Assigned');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Quantity Adjusted');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Available Quantity');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('G1', 'Assigned On');
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        if(!empty($frAllQtyAssignAray)){
            $i = 2;
            foreach($frAllQtyAssignAray as $item){
                 if($item['quantityDeducted'] !=0){
                            $Qty= $item['quantityDeducted'];
                             $Cost= $item['szProductCost'];
                             $TotalCostPerQty = "(-) $".($Qty*$Cost);
                          }
                          else{
                               $Qty= $item['szQuantityAssigned'];
                               $Cost= $item['szProductCost'];
                               $TotalCostPerQty = "(+) $".($Qty*$Cost);
                          }
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $Cost);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, $TotalCostPerQty);
                $this->excel->getActiveSheet()->setCellValue('D'.$i, $item['szQuantityAssigned']);
                $this->excel->getActiveSheet()->setCellValue('E'.$i, $item['quantityDeducted']);
                $this->excel->getActiveSheet()->setCellValue('F'.$i, $item['szTotalAvailableQty']);
                $this->excel->getActiveSheet()->setCellValue('G'.$i, date('d/m/Y h:i:s A', strtotime($item['dtAssignedOn'])));

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
         $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
         $this->session->unset_userdata('productCode');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
      public function inventoryReport()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
           $count = $this->Admin_Model->getnotification();
           $searchAry = $_POST;
           $franchiseeid = $_POST['szSearch1'];
           $catid = $_POST['szSearch2'];
           $prodcode = $_POST['szSearch3'];
           //$validPendingOrdersDetailsAray = $this->Order_Model->getallValidPendingOrderDetails($searchAry);
            $allFrPendingDetailsSearchAray = $this->Order_Model->getallPendingValidOrderFrId();
            $validPendingOrdersDetailsAray = $this->Order_Model->getProductDetsByfranchiseeid($franchiseeid,$catid,$prodcode);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('szSearch1', 'Franchisee Name ', 'required');
            $this->form_validation->set_rules('szSearch2', 'Product Category', 'required');
            if($_POST['szSearch3'])
            {
                $productAry = $this->Inventory_Model->getProductByCategory(trim($catid));
               
            }
            
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            {  
                    $data['validOrdersDetailsAray'] = $validOrdersDetailsAray; 
                    $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray; 
                    $data['allFrPendingDetailsSearchAray'] = $allFrPendingDetailsSearchAray;  
                    $data['szMetaTagTitle'] = "Inventory Report";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Reporting";
                      $data['subpageName'] = "Inventory_Report";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['productAry']=$productAry;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/inventoryReport');
            $this->load->view('layout/admin_footer'); 
            }
            else
            { 
                    $data['validPendingOrdersDetailsAray'] = $validPendingOrdersDetailsAray; 
                    $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray; 
                    $data['allFrPendingDetailsSearchAray'] = $allFrPendingDetailsSearchAray;  
                    $data['szMetaTagTitle'] = "Inventory Report";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Reporting";
                      $data['subpageName'] = "Inventory_Report";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['productAry']=$productAry;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/inventoryReport');
            $this->load->view('layout/admin_footer'); 
           
               
    }
     
               
    }
    
       public function viewOrderReport()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        
         $searchAry = $_POST;
        
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/View_Order_Report');
            $this->load->view('layout/admin_footer'); 
               
    }
           public function xero()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        
         $searchAry = $_POST;
        
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/xero');
            $this->load->view('layout/admin_footer'); 
               
    }
     function getProductCodeListByCategory($szCategory='')
 	{  
            if(trim($szCategory) != '')
            {
                $_POST['szCategory'] = $szCategory; 
            }
            
            $productAry = $this->Inventory_Model->getProductByCategory(trim($_POST['szCategory']));
        $result = "<select class=\"form-control custom-select required\" id=\"szSearch3\" name=\"szSearch3\" placeholder=\"Product Code\" onfocus=\"remove_formError(this.id,'true')\">";
      	if(!empty($productAry))
     	{
              $result .= "<option value=''>Product Code</option>";
          	foreach ($productAry as $productDetails)
          	{
             	$result .= "<option value='".$productDetails['id']."'>".$productDetails['szProductCode']."</option>";
         	}
     	}
     	else
     	{
            $result .= "<option value=''>Product Code</option>";
     	}
        $result .= "</select>";
      	echo $result;           
  	}
          public function frInventoryReport()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
           
        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('szSearch2', 'Product Category', 'required');
            
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            {  
                    $data['validPendingOrderFrDetailsAray'] = $validPendingOrderFrDetailsAray;
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/frInventoryReport');
            $this->load->view('layout/admin_footer'); 
            }
            else
            { 
                $searchAry = $_POST; 
                $validPendingOrderFrDetailsAray = $this->Order_Model->getallValidPendingOrderFrDetails($searchAry);
                   $data['validPendingOrderFrDetailsAray'] = $validPendingOrderFrDetailsAray; 
                    $data['szMetaTagTitle'] = "Order Details";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Orders";
                    $data['notification'] = $count;
                    $data['data'] = $data;
                    $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
                    $data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/frInventoryReport');
            $this->load->view('layout/admin_footer'); 
           
               
    }
     
               
    } 
    function ViewpdfFrInventoryReportData()
        {
          
            $prodCategory = $this->input->post('prodCategory');
            $productCode = $this->input->post('productCode');
          
            
                $this->session->set_userdata('prodCategory',$prodCategory);
                $this->session->set_userdata('productCode',$productCode);
               
                
                echo "SUCCESS||||";
                echo "ViewpdfFrInventoryReport";
            
 
        }
    public function ViewpdfFrInventoryReport()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe inventory report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Inventory Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        
        $productCode = $this->session->userdata('productCode');
        $prodCategory = $this->session->userdata('prodCategory');
        
            
           $allReqOrderAray = $this->Order_Model->getValidPendingOdrFrDetailsForPdf($productCode,$prodCategory);  
       
      
        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Request Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b>  #</b> </th>
                                        <th> <b>Category</b> </th>
                                        <th> <b>Product Code </b> </th>
                                        <th style="width:150px"><b> In Stock  </b> </th>
                                        <th style="width:170px"> <b>Requested</b> </th>
                                        <th style="width:170px"> <b>Alloted</b> </th>
                                   
                                    </tr>';
        if ($allReqOrderAray) {
            
            $i = 0;
            foreach ($allReqOrderAray as $allReqOrderData) {
                $i++;
              
                 $productcatAry = $this->Order_Model->getCategoryDetailsById(trim($allReqOrderData['szProductCategory']));
                $html .= '<tr>
                                            <td> ' . $i . ' </td>
                                            <td> ' . $productcatAry['szName'] . '</td>
                                            <td> ' . $allReqOrderData['szProductCode'] . ' </td>
                                            <td>' . $allReqOrderData['szAvailableQuantity'] . ' </td>
                                               <td>' . $allReqOrderData['quantity'] . ' </td>
                                                    <td>' . $allReqOrderData['dispatched'] . ' </td>
                                                    
                                
                                        </tr>';
            }
        }
        
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);
       
        $pdf->Output('stock-request-report.pdf', 'I');
    }
    function ViewexcelFrInventoryReportData()
        {
              $prodCategory = $this->input->post('prodCategory');
            $productCode = $this->input->post('productCode');
          
            
                $this->session->set_userdata('prodCategory',$prodCategory);
                $this->session->set_userdata('productCode',$productCode);
               
                
                echo "SUCCESS||||";
                echo "ViewexcelFrInventoryReport";
            
 
        }
    public function ViewexcelFrInventoryReport()
    {
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Inventory Report';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', '#');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Category');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', ' In Stock ');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Requested');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Alloted');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $productCode = $this->session->userdata('productCode');
        $prodCategory = $this->session->userdata('prodCategory');
        
            
           $allReqOrderAray = $this->Order_Model->getValidPendingOdrFrDetailsForPdf($productCode,$prodCategory);  
        if(!empty($allReqOrderAray)){
            $i = 2;
            $x=0;
            foreach($allReqOrderAray as $item){
                 $productcatAry = $this->Order_Model->getCategoryDetailsById(trim($item['szProductCategory']));
                 $x++;
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $x);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $productcatAry['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('D'.$i, $item['szAvailableQuantity']);
                $this->excel->getActiveSheet()->setCellValue('E'.$i,$item['quantity']);
                 $this->excel->getActiveSheet()->setCellValue('F'.$i,$item['dispatched']);

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                 $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
     function ViewpdfInventoryReportData()
        {
          
            $prodCategory = $this->input->post('prodCategory');
            $productCode = $this->input->post('productCode');
            $franchiseeId = $this->input->post('franchiseeId');
          
            
                $this->session->set_userdata('franchiseeId',$franchiseeId);
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('prodCategory',$prodCategory);
               
                
                echo "SUCCESS||||";
                echo "ViewpdfInventoryReport";
            
 
        }
    public function ViewpdfInventoryReport()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe inventory report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Inventory Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        
        $franchiseeId = $this->session->userdata('franchiseeId');
        $productCode = $this->session->userdata('productCode');
        $prodCategory = $this->session->userdata('prodCategory');
        
            
           $reqOrderAray = $this->Order_Model->getProductDetsByfranchiseeid($franchiseeId,$prodCategory,$productCode);
     
      
        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Inventory Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b>  #</b> </th>
                                        <th> <b>Category</b> </th>
                                        <th style="width:130px"> <b>Product Code </b> </th>
                                        <th style="width:120px"><b> In Stock  </b> </th>
                                        <th style="width:120px"> <b>Requested</b> </th>
                                        <th style="width:120px"> <b>Alloted</b> </th>
                                   
                                    </tr>';
        if ($reqOrderAray) {
            
            $i = 0;
            foreach ($reqOrderAray as $reqOrderData) {
                $i++;
              
                 $productcatAry = $this->Order_Model->getCategoryDetailsById(trim($reqOrderData['szProductCategory']));
                $availprodqty = $this->Order_Model->getorderdanddispatchval($reqOrderData['iFranchiseeId'],$reqOrderData['id']);
                $html .= '<tr>
                                            <td> ' . $i . ' </td>
                                            <td> ' . $productcatAry['szName'] . '</td>
                                            <td> ' . $reqOrderData['szProductCode'] . ' </td>
                                            <td>' . $reqOrderData['szQuantity'] . ' </td>';
                                        if(!empty($availprodqty)) {
                                            $printzero = true;
                                            foreach ($availprodqty as $requestedqty) {
                                                if ($requestedqty['productid'] == $reqOrderData['id']) {
                                                    $html .='<td>'.$requestedqty['quantity'].'</td>
                                                    <td>'.$requestedqty['dispatched'].'</td>';
                                                    $printzero = false;
                                                }
                                            }
                                            if($printzero) {
                                                $html .= '<td>0</td>
                                                <td>0</td>';
                                           }
                                        }else{
                                            $html .= '<td>0</td><td>0</td>';
                                        }
                                
                                        $html .='</tr>';
            }
        }
        
        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);
       
        $pdf->Output('stock-request-report.pdf', 'I');
    }
    function ViewexcelInventoryReportData()
        {
           $prodCategory = $this->input->post('prodCategory');
           $productCode = $this->input->post('productCode');
           $franchiseeId = $this->input->post('franchiseeId');
          
            
                $this->session->set_userdata('franchiseeId',$franchiseeId);
                $this->session->set_userdata('productCode',$productCode);
                $this->session->set_userdata('prodCategory',$prodCategory);
                
                echo "SUCCESS||||";
                echo "ViewexcelInventoryReport";
            
 
        }
         public function ViewexcelInventoryReport()
    {
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Inventory Report';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', '#');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Category');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', ' In Stock ');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Requested');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Alloted');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $productCode = $this->session->userdata('productCode');
        $prodCategory = $this->session->userdata('prodCategory');
        $franchiseeId = $this->session->userdata('franchiseeId');
        
            
          $reqOrderAray = $this->Order_Model->getProductDetsByfranchiseeid($franchiseeId,$prodCategory,$productCode);
        if(!empty($reqOrderAray)){
            $i = 2;
            $x=0;
            foreach($reqOrderAray as $item){
                 $productcatAry = $this->Order_Model->getCategoryDetailsById(trim($item['szProductCategory']));
                $availprodqty = $this->Order_Model->getorderdanddispatchval($item['iFranchiseeId'],$item['id']);
                 $x++;
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $x);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $productcatAry['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, $item['szProductCode']);
                $this->excel->getActiveSheet()->setCellValue('D'.$i, $item['szQuantity']);
                if(!empty($availprodqty)) {
                    $printzero = true;
                    foreach ($availprodqty as $requestedqty) {
                        if ($requestedqty['productid'] == $item['id']) {
                            $this->excel->getActiveSheet()->setCellValue('E' . $i, $requestedqty['quantity']);
                            $this->excel->getActiveSheet()->setCellValue('F' . $i, $requestedqty['dispatched']);
                            $printzero = false;
                        }
                    }
                    if($printzero){
                        $this->excel->getActiveSheet()->setCellValue('E' . $i, 0);
                        $this->excel->getActiveSheet()->setCellValue('F' . $i, 0);
                    }
                }else{
                    $this->excel->getActiveSheet()->setCellValue('E' . $i, 0);
                    $this->excel->getActiveSheet()->setCellValue('F' . $i, 0);
                }

                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
         $this->session->unset_userdata('franchiseeId');
         $this->session->unset_userdata('productCode');
        $this->session->unset_userdata('prodCategory');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
  

    function ViewpdfOrderReportData()
    {

        $szSearch1 = $this->input->post('szSearch1');
        $szSearch2 = $this->input->post('szSearch2');
        $szSearch4 = $this->input->post('szSearch4');
        $szSearch5 = $this->input->post('szSearch5');
        $this->session->set_userdata('szSearch1',$szSearch1);
        $this->session->set_userdata('szSearch2',$szSearch2);
        $this->session->set_userdata('szSearch4',$szSearch4);
        $this->session->set_userdata('szSearch5',$szSearch5);
        echo "SUCCESS||||";
        echo "ViewpdfOrderReport";


    }
    public function ViewpdfOrderReport()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe orders report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Orders Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        $searchAry['szSearch1'] = $this->session->userdata('szSearch1');
        $searchAry['szSearch2'] = $this->session->userdata('szSearch2');
        $searchAry['szSearch4'] = $this->session->userdata('szSearch4');
        $searchAry['szSearch5'] = $this->session->userdata('szSearch5');
        $validOrdersDetailsAray = $this->Order_Model->getallValidOrderDetails($searchAry);


        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Orders Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b>  #</b> </th>
                                        <th> <b>Franchisee</b> </th>
                                        <th> <b>Order date </b> </th>
                                        <th ><b> Order#  </b> </th>
                                        <th > <b>No. of products</b> </th>
                                   <th ><b> Order cost </b> </th>
                                        <th > <b>Xero Invoice No.</b> </th>
                                    </tr>';
        if ($validOrdersDetailsAray) {

            $i = 0;
            foreach ($validOrdersDetailsAray as $reqOrderData) {
                $i++;
                $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $reqOrderData['franchiseeid']);
                $html .= '<tr>
                                            <td> ' . $i . ' </td>
                                            <td> ' . $franchiseeDetArr1['szName'] . '</td>
                                            <td> ' . date('d M Y',strtotime($reqOrderData['createdon'])) . ' at '.date('h:i A',strtotime($reqOrderData['createdon'])).' </td>
                                            <td>#' . sprintf(__FORMAT_NUMBER__, $reqOrderData['orderid']) . ' </td>
                                               <td>' . $reqOrderData['totalproducts'] . ' </td>
                                            <td>$' . ($reqOrderData['price']>0?$reqOrderData['price']:'0.00') . ' </td>
                                               <td>' . (!empty($reqOrderData['XeroIDnumber'])?$reqOrderData['XeroIDnumber']:'N/A'). ' </td>
                                        </tr>';
            }
        }

        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);

        $pdf->Output('orders-report.pdf', 'I');
    }

    function ViewexcelOrderReportData()
    {
        $szSearch1 = $this->input->post('szSearch1');
        $szSearch2 = $this->input->post('szSearch2');
        $szSearch4 = $this->input->post('szSearch4');
        $szSearch5 = $this->input->post('szSearch5');
        $this->session->set_userdata('szSearch1',$szSearch1);
        $this->session->set_userdata('szSearch2',$szSearch2);
        $this->session->set_userdata('szSearch4',$szSearch4);
        $this->session->set_userdata('szSearch5',$szSearch5);
        echo "SUCCESS||||";
        echo "ViewexcelOrdersReport";


    }
    public function ViewexcelOrdersReport()
    {
        $this->load->library('excel');
        $filename = 'DrugSafe';
        $title = 'Orders Report';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($title);
        $this->excel->getActiveSheet()->setCellValue('A1', '#');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Franchisee');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Order date');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'Order#');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'No. of products');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Order cost');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('G1', 'Xero Invoice No.');
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $searchAry['szSearch1'] = $this->session->userdata('szSearch1');
        $searchAry['szSearch2'] = $this->session->userdata('szSearch2');
        $searchAry['szSearch4'] = $this->session->userdata('szSearch4');
        $searchAry['szSearch5'] = $this->session->userdata('szSearch5');
        $validOrdersDetailsAray = $this->Order_Model->getallValidOrderDetails($searchAry);
        if(!empty($validOrdersDetailsAray)){
            $i = 2;
            $x=0;
            foreach($validOrdersDetailsAray as $item){
                $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $item['franchiseeid']);
                $x++;
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $x);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, $franchiseeDetArr1['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i, date('d M Y',strtotime($item['createdon'])) . ' at '.date('h:i A',strtotime($item['createdon'])));
                $this->excel->getActiveSheet()->setCellValue('D'.$i, '#'.sprintf(__FORMAT_NUMBER__, $item['orderid']));
                $this->excel->getActiveSheet()->setCellValue('E'.$i,$item['totalproducts']);
                $this->excel->getActiveSheet()->setCellValue('F'.$i,'$'.($item['price']>0?number_format($item['price'],2,'.',','):'0.00'));
                $this->excel->getActiveSheet()->setCellValue('G'.$i,(!empty($item['XeroIDnumber'])?$item['XeroIDnumber']:'N/A'));
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
                $i++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    function ViewpdfofRevenueGenerate()
    {

        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $szFranchisee = $this->input->post('szFranchisee');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
        $this->session->set_userdata('szFranchisee',$szFranchisee);
        echo "SUCCESS||||";
        echo "ViewpdfRevenueGenerate";
    }
    public function ViewpdfRevenueGenerate()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe Revenue Generate');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Revenue Generate PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        $searchAry['dtStart'] = $this->session->userdata('dtStart');
        $searchAry['dtEnd'] = $this->session->userdata('dtEnd');
        $searchAry['szFranchisee'] = $this->session->userdata('szFranchisee');
         $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '',$searchAry['szFranchisee']);
        //$getClientDeatils=$this->Webservices_Model->getclientdetails($searchAry['szFranchisee']);
        $id=array();
        foreach($getClientDeatils as $getClientData)
        {   
            array_push($id, $getClientData['clientId']);
        }
        $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
        $sosId=array();
        foreach($getSosDetails as $getSosData)
        {   
            array_push($sosId, $getSosData['id']);
        }
        if(!empty($sosId))
        {
            $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
        }
        


        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Revenue Generate</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b>  #</b> </th>
                                        <th> <b>Proforma Invoice #</b> </th>
                                        <th> <b>Proforma Invoice Date </b> </th>
                                        <th ><b> Client Id  </b> </th>
                                        <th > <b>Client Name</b> </th>
                                   <th ><b> Total Revenue </b> </th>
                                        <th > <b>Royalty Fees</b> </th>
                                        <th > <b>Net Profit</b> </th>
                                    </tr>';
        if ($getManualCalcStartToEndDate) {

            $i = 0;
            $totalRevenu='';
            $totalRoyaltyfees='';
            $totalNetProfit='';
            foreach ($getManualCalcStartToEndDate as $getManualCalcData) {
                $getClientId=$this->Form_Management_Model->getSosDetailBySosId($getManualCalcData['sosid']);
                $getClientDetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$getClientId['Clientid']);
                $ClirntDetailsDataAry = $this->Franchisee_Model->getParentClientDetailsId($getClientId['Clientid']);
                $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('', $ClirntDetailsDataAry['clientType']);
                $DrugtestidArr = array_map('intval', str_split($getClientId['Drugtestid']));
                if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                    $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($getManualCalcData['sosid']));
                }
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
                $Royaltyfees = $ValTotal * 0.1;
                $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                $Royaltyfees= number_format($Royaltyfees, 2, '.', ',');
                                                    
                $NetTotal = $ValTotal - $Royaltyfees;
                $NetTotal = number_format($NetTotal, 2, '.', '');
                $NetTotal = number_format($NetTotal, 2, '.', ',');
                                                            
                $totalRevenu=$totalRevenu+$ValTotal;
                $totalRevenu=number_format($totalRevenu, 2, '.', '');
                $totalRevenu=number_format($totalRevenu, 2, '.', ',');
                
                $totalRoyaltyfees=$totalRoyaltyfees+$Royaltyfees;
                $totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', '');
                $totalRoyaltyfees=number_format($totalRoyaltyfees, 2, '.', ',');
                
                $totalNetProfit=$totalNetProfit+$NetTotal;
                $totalNetProfit = number_format($totalNetProfit, 2, '.', '');
                $totalNetProfit =number_format($totalNetProfit, 2, '.', ',');
                
                $i++;
                $html .= '<tr>
                            <td> ' . $i . ' </td>
                            <td> #' . sprintf(__FORMAT_NUMBER__, $getManualCalcData['id']) . '</td>
                            <td> ' . date("d-m-Y", strtotime($getManualCalcData['dtCreatedOn'])).' </td>
                            <td>CL-' . $getClientDetails['id'] . ' </td>
                            <td>' . $userDataAry['szName'] . ' </td>
                            <td>$' . number_format($ValTotal, 2, '.', ',') . ' </td>
                            <td>$' .$Royaltyfees. ' </td>
                            <td>$'.$NetTotal.'</td>
                        </tr>';
            }
            $html.='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>$'.$totalRevenu.'</td>
                    <td>$'.$totalRoyaltyfees.'</td>
                    <td>$'.$totalNetProfit.'</td>
                   </tr>';
        }

        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);

        $pdf->Output('revenue-generate.pdf', 'I');
    }
    
    function ViewexcelofRevenueGenerate()
    {
        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $szFranchisee = $this->input->post('szFranchisee');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
        $this->session->set_userdata('szFranchisee',$szFranchisee);
        echo "SUCCESS||||";
        echo "ViewexcelRevenueGenerate";


    }
    public function ViewexcelRevenueGenerate()
    {
        $this->load->library('excel');
        $filename = 'DrugSafe';
        $title = 'Revenue Generate';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($title);
        $this->excel->getActiveSheet()->setCellValue('A1', '#');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Proforma Invoice #');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Proforma Invoice Date');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'Client Id');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Client Name');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'Total Revenue');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('G1', 'Royalty Fees');
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->setCellValue('H1', 'Net Profit');
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $searchAry['dtStart'] = $this->session->userdata('dtStart');
        $searchAry['dtEnd'] = $this->session->userdata('dtEnd');
        $searchAry['szFranchisee'] = $this->session->userdata('szFranchisee');
        //$getClientDeatils=$this->Webservices_Model->getclientdetails($searchAry['szFranchisee']);
        
        $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '',$searchAry['szFranchisee']);
        $id=array();
        foreach($getClientDeatils as $getClientData)
        {   
            array_push($id, $getClientData['clientId']);
        }
        $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
        $sosId=array();
        foreach($getSosDetails as $getSosData)
        {   
            array_push($sosId, $getSosData['id']);
        }
        if(!empty($sosId))
        {
            $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
        }
        
        
        if(!empty($getManualCalcStartToEndDate)){
            $i = 2;
            $x=0;
            $totalRevenu='';
            $totalRoyaltyfees='';
            $totalNetProfit='';
            foreach($getManualCalcStartToEndDate as $getManualCalcData){
                $getClientId=$this->Form_Management_Model->getSosDetailBySosId($getManualCalcData['sosid']);
                $getClientDetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$getClientId['Clientid']);
                $ClirntDetailsDataAry = $this->Franchisee_Model->getParentClientDetailsId($getClientId['Clientid']);
                $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('', $ClirntDetailsDataAry['clientType']);
                $DrugtestidArr = array_map('intval', str_split($getClientId['Drugtestid']));
                if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                    $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($getManualCalcData['sosid']));
                }
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
                $Royaltyfees = $ValTotal * 0.1;
                $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                $Royaltyfees= number_format($Royaltyfees, 2, '.', ',');
                                                    
                $NetTotal = $ValTotal - $Royaltyfees;
                $NetTotal = number_format($NetTotal, 2, '.', '');
                $NetTotal = number_format($NetTotal, 2, '.', ',');
                                                            
                $totalRevenu=$totalRevenu+$ValTotal;
                $totalRevenu=number_format($totalRevenu, 2, '.', '');
                $totalRevenu=number_format($totalRevenu, 2, '.', ',');
                
                $totalRoyaltyfees=$totalRoyaltyfees+$Royaltyfees;
                $totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', '');
                $totalRoyaltyfees=number_format($totalRoyaltyfees, 2, '.', ',');
                
                $totalNetProfit=$totalNetProfit+$NetTotal;
                $totalNetProfit = number_format($totalNetProfit, 2, '.', '');
                $totalNetProfit =number_format($totalNetProfit, 2, '.', ',');
                $x++;
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $x);
                $this->excel->getActiveSheet()->setCellValue('B'.$i, '#'.sprintf(__FORMAT_NUMBER__, $getManualCalcData['id']));
                $this->excel->getActiveSheet()->setCellValue('C'.$i, date("d-m-Y", strtotime($getManualCalcData['dtCreatedOn'])));
                $this->excel->getActiveSheet()->setCellValue('D'.$i, 'Cl-'.$getClientDetails['id']);
                $this->excel->getActiveSheet()->setCellValue('E'.$i,$userDataAry['szName']);
                $this->excel->getActiveSheet()->setCellValue('F'.$i,'$'.number_format($ValTotal, 2, '.', ','));
                $this->excel->getActiveSheet()->setCellValue('G'.$i,'$'.$Royaltyfees);
                $this->excel->getActiveSheet()->setCellValue('H'.$i,'$'.$NetTotal);
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
                $i++;
            }
            $this->excel->getActiveSheet()->setCellValue('E'.$i,Total);
            $this->excel->getActiveSheet()->setCellValue('F'.$i,'$'.$totalRevenu);
            $this->excel->getActiveSheet()->setCellValue('G'.$i,'$'.$totalRoyaltyfees);
            $this->excel->getActiveSheet()->setCellValue('H'.$i,'$'.$totalNetProfit);
            
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    public function view_revenue_generate()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $searchOptionArr =$this->Admin_Model->viewFranchiseeList();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('szFranchisee', 'Franchisee ', 'required');
        $this->form_validation->set_rules('dtStart', 'Start Order date ', 'required');
        $this->form_validation->set_rules('dtEnd', 'End Order date', 'required');
        if($_POST['dtStart']!='' && $_POST['dtEnd']!='' && $_POST['szFranchisee']!='')
        {
            $searchAry =$_POST; 
            //$getClientDeatils=$this->Webservices_Model->getclientdetails($_POST['szFranchisee']);
            $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '', $_POST['szFranchisee']);
            
            $id=array();
            foreach($getClientDeatils as $getClientData)
            {   
                array_push($id, $getClientData['clientId']);
            }
            $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
            $sosId=array();
            foreach($getSosDetails as $getSosData)
            {   
                array_push($sosId, $getSosData['id']);
            }
            if(!empty($sosId))
            {
                $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
            }
        }
        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Revenue Generate";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_generate";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['allfranchisee'] = $searchOptionArr;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewRevenueGenerateReport');
            $this->load->view('layout/admin_footer');

        } else {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Revenue Generate";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_generate";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['allfranchisee'] = $searchOptionArr;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewRevenueGenerateReport');
            $this->load->view('layout/admin_footer');


        }
    }
    public function franchisee_revenue_generate()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
		$idfranchisee = $_SESSION['drugsafe_user']['id'];
        $searchOptionArr =$this->Admin_Model->viewFranchiseeList();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('szFranchisee', 'Franchisee ', 'required');
        $this->form_validation->set_rules('dtStart', 'Start Order date ', 'required');
        $this->form_validation->set_rules('dtEnd', 'End Order date', 'required');
        if($_POST['dtStart']!='' && $_POST['dtEnd']!='' && $idfranchisee!='')
        {
            $searchAry =$_POST; 
            
            $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '', $idfranchisee);
            $id=array();
            foreach($getClientDeatils as $getClientData)
            {   
                array_push($id, $getClientData['clientId']);
            }
            $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
            $sosId=array();
            foreach($getSosDetails as $getSosData)
            {   
                array_push($sosId, $getSosData['id']);
            }
            if(!empty($sosId))
            {
                $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
            }
        }
        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Revenue Generate";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_generate";
            $data['notification'] = $count;
            $data['data'] = $data;
	     $data['idfranchisee'] =$idfranchisee;
            $data['allfranchisee'] = $searchOptionArr;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/franchiseeRevenueGenerateReport');
            $this->load->view('layout/admin_footer');

        } else {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Revenue Generate";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_generate";
            $data['notification'] = $count;
            $data['data'] = $data;
			
            $data['allfranchisee'] = $searchOptionArr;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/franchiseeRevenueGenerateReport');
            $this->load->view('layout/admin_footer');


        }
    }
    
    public function view_revenue_summery()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        if($_POST['dtStart']!='' && $_POST['dtEnd']!='')
        {
            $searchAry =$_POST; 
            $getSosDetails=$this->Form_Management_Model->getAllsosFormDetails($searchAry);
            
            $franchiseeId=array();
            foreach($getSosDetails as $getSosData)
            {   
                array_push($franchiseeId, $getSosData['franchiseeId']);
            }
            $franchiseeId = array_unique($franchiseeId);
            
        }
	
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('szFranchisee', 'Franchisee ', 'required');
        $this->form_validation->set_rules('dtStart', 'Start Order date ', 'required');
        $this->form_validation->set_rules('dtEnd', 'End Order date', 'required');
       
        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Revenue Summery";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_summery";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['searchAry'] = $_POST;
			
            $data['allfranchisee'] = $franchiseeId;
            $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewRevenueSummery');
            $this->load->view('layout/admin_footer');

        } else {
            
            $data['szMetaTagTitle'] = "Revenue Summery";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "revenue_summery";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['searchAry'] = $_POST;
	    $data['allfranchisee'] = $searchOptionArr;
            $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewRevenueSummery');
            $this->load->view('layout/admin_footer');


        }
    }
    function ViewpdfofRevenueSummery()
    {

        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
       
        echo "SUCCESS||||";
        echo "ViewpdfRevenueSummery";
    }
    public function ViewpdfRevenueSummery()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe Revenue Summery');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Revenue Summery PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        $searchAry['dtStart'] = $this->session->userdata('dtStart');
        $searchAry['dtEnd'] = $this->session->userdata('dtEnd');
        
            $getSosDetails=$this->Form_Management_Model->getAllsosFormDetails($searchAry);
            $franchiseeId=array();
            foreach($getSosDetails as $getSosData)
            {   
                array_push($franchiseeId, $getSosData['franchiseeId']);
            }
            $allfranchisee = array_unique($franchiseeId);
       
        


        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Revenue Generate</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:80px"><b>  #</b> </th>
                                        <th> <b>Franchisee Name </b> </th>
                                        <th> <b>Total Revenue </b> </th>
                                        <th ><b> Royalty Fees </b> </th>
                                        <th > <b>Net Profit</b> </th>
                                  
                                    </tr>';
        if ($allfranchisee) {

            $i = 0;
            $totalRevenu='';
            $totalRoyaltyfees='';
            $totalNetProfit='';
            foreach ($allfranchisee as $allfranchiseeData) {
                 $getAdmindetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$allfranchiseeData);
                                                    
						    //$getClientDeatils=$this->Webservices_Model->getclientdetails($allfranchiseeData);
                                                    $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '',$allfranchiseeData);
                                                    $id=array();
                                                    foreach($getClientDeatils as $getClientData)
                                                    {   
                                                        array_push($id, $getClientData['clientId']);
                                                    }
													
                                                    $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
                                                    $sosId=array();
                                                    foreach($getSosDetails as $getSosData)
                                                    {   
                                                        array_push($sosId, $getSosData['id']);
                                                    }
													
                                                    if(!empty($sosId))
                                                    {
                                                        $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
                                                    }
													$totalRevenu='';
                                                    $totalRoyaltyfees='';
                                                    $totalNetProfit='';
						    foreach ($getManualCalcStartToEndDate as $getManualCalcData) {
														
                                                        $getClientId=$this->Form_Management_Model->getSosDetailBySosId($getManualCalcData['sosid']);
                                                        $getClientDetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$getClientId['Clientid']);
                                                        $DrugtestidArr = array_map('intval', str_split($getClientId['Drugtestid']));
                                                        if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                                                            $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($getManualCalcData['sosid']));
                                                        }
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
                                                        $Royaltyfees = $ValTotal * 0.1;
                                                        $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                                                        $Royaltyfees= number_format($Royaltyfees, 2, '.', ',');
                                                    
                                                        $NetTotal = $ValTotal - $Royaltyfees;
                                                        $NetTotal = number_format($NetTotal, 2, '.', '');
                                                        $NetTotal = number_format($NetTotal, 2, '.', ',');
                                                            
                                                        $totalRevenu=$totalRevenu+$ValTotal;
														$totalRevenu = number_format($totalRevenu, 2, '.', '');
                                                        $totalRevenu=number_format($totalRevenu, 2, '.', ',');
														
                                                        $totalRoyaltyfees=$totalRoyaltyfees+$Royaltyfees;
														$totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', '');
                                                        $totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', ',');
														
                                                        $totalNetProfit=$totalNetProfit+$NetTotal;
														$totalNetProfit = number_format($totalNetProfit, 2, '.', '');
                                                        $totalNetProfit = number_format($totalNetProfit, 2, '.', ',');
                                                        
						   }
                
                $i++;
                $html .= '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$getAdmindetails['szName'].'</td>
                            <td>$'.$totalRevenu.'</td>
                            <td>$'.$totalRoyaltyfees.'</td>
                            <td>$'.$totalNetProfit.'</td>
                            
                        </tr>';
            }
            
        }

        $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);

        $pdf->Output('revenue-generate.pdf', 'I');
    }

    function ViewexcelofRevenueSummery()
    {
        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
        
        echo "SUCCESS||||";
        echo "ViewexcelRevenueSummery";


    }
    public function ViewexcelRevenueSummery()
    {
        $this->load->library('excel');
        $filename = 'DrugSafe';
        $title = 'Revenue Summery';
        $file = $filename . '-' . $title ; //save our workbook as this file name


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($title);
        $this->excel->getActiveSheet()->setCellValue('A1', '#');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Franchisee Name');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Total Revenue');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'Royalty Fees');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Net Profit');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

       
        $searchAry['dtStart'] = $this->session->userdata('dtStart');
        $searchAry['dtEnd'] = $this->session->userdata('dtEnd');
         $getSosDetails=$this->Form_Management_Model->getAllsosFormDetails($searchAry);
            $franchiseeId=array();
            foreach($getSosDetails as $getSosData)
            {   
                array_push($franchiseeId, $getSosData['franchiseeId']);
            }
            $allfranchisee = array_unique($franchiseeId);
            if (!empty($allfranchisee)) {

            $i = 2;
            $x=0;
            $totalRevenu='';
            $totalRoyaltyfees='';
            $totalNetProfit='';
            foreach ($allfranchisee as $allfranchiseeData) {
                 $getAdmindetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$allfranchiseeData);
                                                    
						   $getClientDeatils = $this->Ordering_Model->getAllChClientDetails('', '',$allfranchiseeData);
                                                    $id=array();
                                                    foreach($getClientDeatils as $getClientData)
                                                    {   
                                                        array_push($id, $getClientData['clientId']);
                                                    }
													
                                                    $getSosDetails=$this->Form_Management_Model->getsosFormDetailsByMultipleClientId($id);
                                                    $sosId=array();
                                                    foreach($getSosDetails as $getSosData)
                                                    {   
                                                        array_push($sosId, $getSosData['id']);
                                                    }
													
                                                    if(!empty($sosId))
                                                    {
                                                        $getManualCalcStartToEndDate = $this->Order_Model->getManualCalcStartToEndDate($searchAry,$sosId);
                                                    }
													$totalRevenu='';
                                                    $totalRoyaltyfees='';
                                                    $totalNetProfit='';
						    foreach ($getManualCalcStartToEndDate as $getManualCalcData) {
														
                                                        $getClientId=$this->Form_Management_Model->getSosDetailBySosId($getManualCalcData['sosid']);
                                                        $getClientDetails=$this->Admin_Model->getAdminDetailsByEmailOrId('',$getClientId['Clientid']);
                                                        $DrugtestidArr = array_map('intval', str_split($getClientId['Drugtestid']));
                                                        if (in_array(1, $DrugtestidArr) || in_array(2, $DrugtestidArr) || in_array(3, $DrugtestidArr)) {
                                                            $countDoner = count($this->Form_Management_Model->getDonarDetailBySosId($getManualCalcData['sosid']));
                                                        }
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
                                                        $Royaltyfees = $ValTotal * 0.1;
                                                        $Royaltyfees = number_format($Royaltyfees, 2, '.', '');
                                                        $Royaltyfees= number_format($Royaltyfees, 2, '.', ',');
                                                    
                                                        $NetTotal = $ValTotal - $Royaltyfees;
                                                        $NetTotal = number_format($NetTotal, 2, '.', '');
                                                        $NetTotal = number_format($NetTotal, 2, '.', ',');
                                                            
                                                        $totalRevenu=$totalRevenu+$ValTotal;
														$totalRevenu = number_format($totalRevenu, 2, '.', '');
                                                        $totalRevenu=number_format($totalRevenu, 2, '.', ',');
														
                                                        $totalRoyaltyfees=$totalRoyaltyfees+$Royaltyfees;
														$totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', '');
                                                        $totalRoyaltyfees = number_format($totalRoyaltyfees, 2, '.', ',');
														
                                                        $totalNetProfit=$totalNetProfit+$NetTotal;
														$totalNetProfit = number_format($totalNetProfit, 2, '.', '');
                                                        $totalNetProfit = number_format($totalNetProfit, 2, '.', ',');
                                                        
						   }
                $x++;
                $this->excel->getActiveSheet()->setCellValue('A'.$i, $x);
                $this->excel->getActiveSheet()->setCellValue('B'.$i,$getAdmindetails['szName']);
                $this->excel->getActiveSheet()->setCellValue('C'.$i,'$'. $totalRevenu);
                $this->excel->getActiveSheet()->setCellValue('D'.$i,'$'. $totalRoyaltyfees);
                $this->excel->getActiveSheet()->setCellValue('E'.$i,'$'.$totalNetProfit);
                
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
                
                $i++;
            }
            
            
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }    
    
      public function clientcomparisonReport()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $count = $this->Admin_Model->getnotification();
        $clientarr = array();
        $sitearr = array();
        $franchiseeid = (isset($_POST['szSearch1'])?$_POST['szSearch1']:'');
        $clientid = (isset($_POST['szSearch2'])?$_POST['szSearch2']:'');
        $siteid = (isset($_POST['szSearch3'])?$_POST['szSearch3']:'');
        $testtype = (isset($_POST['szSearch4'])?$_POST['szSearch4']:'');
        $drugtesttype = ($testtype == 'A'?'1':($testtype=='O'?'2':($testtype=='U'?'3':($testtype=='AZ'?'4':'5'))));
        $comparetype = (isset($_POST['szSearch5'])?$_POST['szSearch5']:'');
        if(!empty($clientid)){
            $clientarr = $this->Webservices_Model->getclientdetails($franchiseeid);
        }
        if(!empty($siteid)){
            $sitearr = $this->Webservices_Model->getclientdetails($franchiseeid,$clientid);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('szSearch1', 'Franchisee Name ', 'required');
        $this->form_validation->set_rules('szSearch2', 'Client Name', 'required');
        $this->form_validation->set_rules('szSearch3', 'Company Name/Site ', 'required');
        $this->form_validation->set_rules('szSearch4', 'Test Type', 'required');
        $this->form_validation->set_rules('szSearch5', 'Compare Data ', 'required');
        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE){

            $data['szMetaTagTitle'] = "Client Comparison Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Client_Comparison_Report";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['err'] = true;
            $data['clientarr'] = $clientarr;
            $data['sitearr'] = $sitearr;
            $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;

            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/clientCmpReport');
            $this->load->view('layout/admin_footer');
        }
        else {
            $comparisonResultArr = $this->Reporting_Model->getcomparisonrecord($siteid,$drugtesttype,$comparetype);
            $data['szMetaTagTitle'] = "Client Comparison Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Client_Comparison_Report";
            $data['notification'] = $count;
            $data['compareresultarr'] = $comparisonResultArr;
            $data['data'] = $data;
            $data['err'] = false;
            $data['drugtesttype'] = $drugtesttype;
            $data['clientarr'] = $clientarr;
            $data['sitearr'] = $sitearr;
            $data['testtype'] = $testtype;
            $data['comparetype'] = $comparetype;
            $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('reporting/clientCmpReport');
            $this->load->view('layout/admin_footer');
        }






        }
      function getClientListByFrId($idFranchisee='')
 	{ 
            if(trim($idFranchisee) != '')
            {
                $_POST['idFranchisee'] = $idFranchisee; 
            }
            
            $clientAry = $this->Franchisee_Model->viewClientList(true,$_POST['idFranchisee']);

        $result = '<select class="form-control custom-select" name="szSearch2" id="szSearch2" onfocus="remove_formError(this.id,\'true\')" onchange="getSiteListByClientIdData(this.value)">';
      	if(!empty($clientAry))
     	{
              $result .= "<option value=''>Client Name</option>";
          	foreach ($clientAry as $clientDetails)
          	{
             	$result .= "<option value='".$clientDetails['id']."'>".$clientDetails['szName']."</option>";
         	}
     	}
     	else
     	{
     	    $result .= "<option value=''>Client Name</option>";
     	}
        $result .= "</select>";
      	echo $result;           
  	}
         function getSiteListByClientId($idClient='')
 	{ 
            if(trim($idClient) != '')
            {
                $_POST['idClient'] = $idClient; 
            }
            
            $siteAry = $this->Franchisee_Model->viewChildClientDetails($_POST['idClient']);

        $result = '<select class="form-control custom-select" name="szSearch3" id="szSearch3" onfocus="remove_formError(this.id,\'true\')">';
      	if(!empty($siteAry))
     	{
              $result .= "<option value=''>Company Name/site</option>";
          	foreach ($siteAry as $siteDetails)
          	{
             	$result .= "<option value='".$siteDetails['id']."'>".$siteDetails['szName']."</option>";
         	}
     	}
     	else
     	{
            $result .= "<option value=''>Company Name/site</option>";
     	}
        $result .= "</select>";
      	echo $result;           
  	} 
    public function view_industry_report()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        if($_POST['dtStart']!='' && $_POST['dtEnd']!='')
        {
            $searchArray=$_POST;
            $getSosAndClientDetils=$this->Reporting_Model->getSosAndClientDetils($searchArray);
        }
        $allIndustry=$this->Admin_Model->viewAllIndustryList();
	$this->load->library('form_validation');
        $this->form_validation->set_rules('dtStart', 'Start Industry date ', 'required');
        $this->form_validation->set_rules('dtEnd', 'End Industry date', 'required');
        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['getManualCalcStartToEndDate'] = $getManualCalcStartToEndDate;
            $data['szMetaTagTitle'] = "Industry Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "industry_report";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['searchAry'] = $_POST;
            $data['allIndustry'] =$allIndustry;
            $data['getSosAndClientDetils']=$getSosAndClientDetils;
	    $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;
            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewIndustryReort');
            $this->load->view('layout/admin_footer');

        } else {
            
            $data['szMetaTagTitle'] = "Industry Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "industry_report";
            $data['notification'] = $count;
            $data['searchAry'] = $_POST;
            $data['allIndustry'] =$allIndustry;
	    $data['getSosAndClientDetils']=$getSosAndClientDetils;
            $data['arErrorMessages'] = $this->Reporting_Model->arErrorMessages;
            $this->load->view('layout/admin_header', $data);
            $this->load->view('reporting/viewIndustryReort');
            $this->load->view('layout/admin_footer');
        }
    }
    function industryReportPdf()
   {
        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $szIndustry = $this->input->post('szIndustry');
        $szTestType = $this->input->post('szTestType');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
        $this->session->set_userdata('szIndustry',$szIndustry);
        $this->session->set_userdata('szTestType',$szTestType);
        echo "SUCCESS||||";
        echo "industryReportOfPdf";
    }
    public function industryReportOfPdf()
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
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);
        // Add a page
        $pdf->AddPage();
        
        $searchArray['dtStart'] = $this->session->userdata('dtStart');
        $searchArray['dtEnd'] = $this->session->userdata('dtEnd');
        $searchArray['szIndustry'] = $this->session->userdata('szIndustry');
        $searchArray['szTestType'] = $this->session->userdata('szTestType');
        
            
          $getSosAndClientDetils=$this->Reporting_Model->getSosAndClientDetils($searchArray); 
       
      
        $html = '<a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Industry Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                            <thead>
                                    <tr>
                                        <th></th>
					<th></th>';
					foreach($getSosAndClientDetils as $getSosAndClientData)
					{
					    $industryname=$this->Admin_Model->getIndustryNameByid($getSosAndClientData['industry']);
					    $html .='<td>'.$industryname['szName'].'</td>';
					}
                                $html .=   '</tr>
                            </thead>';
			    if($searchArray['szTestType']=='' || $searchArray['szTestType']=='A')
			    {
			    $html .='<tbody>
					<tr>
                                            <td>Alchohol</td>
                                            <td>Total Donors</td>';
					    foreach($getSosAndClientDetils as $getSosAndClientData)
					    {
						$html .='<td>'.$getSosAndClientData['totalAlcohol'].'</td>';
					    }
                                
                               $html .= '</tr>
                                        <tr>
				            <td></td>
                                            <td>Positive Result</td>';
				            foreach($getSosAndClientDetils as $getSosAndClientData)
				            {
				                $html .='<td>'.$getSosAndClientData['totalPositiveAlcohol'].'</td>';
			                    }
			        $html .='</tr>
			                <tr>
				            <td></td>
                                            <td>Negative Result</td>';
				            foreach($getSosAndClientDetils as $getSosAndClientData)
				            {
				                $html .='<td>'.$getSosAndClientData['totalNegativeAlcohol'].'</td>';
				            }
				$html .='</tr>
                                    </tbody>';
			    }
			    if($searchArray['szTestType']=='' || $searchArray['szTestType']=='U')
			    {
			    $html .='<tbody>
					<tr>
                                            <td>Urine AS/NZA 4308:2001/ As/NZA 4308:2008</td>
                                            <td>Total Donors</td>';
					    foreach($getSosAndClientDetils as $getSosAndClientData)
					    {
						$html .='<td>'.$getSosAndClientData['totalDonarUrine'].'</td>';
					    }
                                $html .='</tr>
                                        <tr>
					    <td></td>
                                            <td>Positive Result</td>';
					    foreach($getSosAndClientDetils as $getSosAndClientData )
					    {
						$totalNegativeUrine=$getSosAndClientData['totalDonarUrine'] -  $getSosAndClientData['totalNegativeUrine'];
						$html .='<td>'.$totalNegativeUrine.'</td>';
					    }
				$html .='</tr>
					<tr>
					    <td></td>
                                            <td>Negative Result</td>';
					    foreach($getSosAndClientDetils as $getSosAndClientData)
					    {
						$html .='<td>'.$getSosAndClientData['totalNegativeUrine'].'</td>';
					    }
				$html .='</tr>
                                    </tbody>';
			    }
			    if($searchArray['szTestType']=='' || $searchArray['szTestType']=='O')
			    {
			    $html .='<tbody>
					<tr>
                                            <td>Oral Fluid AS 4760:2006</td>
                                            <td>Total Donors</td>';
                                            foreach($getSosAndClientDetils as $getSosAndClientData)
					    {
						$html .='<td>'.$getSosAndClientData['totalDonarOral'].'</td>';
					    }
                               $html .='</tr>
                                        <tr>
					    <td></td>
                                            <td>Positive Result</td>';
					    foreach($getSosAndClientDetils as $getSosAndClientData)
					    {
                                                $totalPositiveOral=$getSosAndClientData['totalDonarOral'] -  $getSosAndClientData['totalNegativeOral'];
						$html .='<td>'.$totalPositiveOral.'</td>';
					    }
					$html .='</tr>
						<tr>
						   <td></td>
                                                    <td>Negative Result</td>';
						    foreach($getSosAndClientDetils as $getSosAndClientData)
						    {
                                                        $html .='<td>'.$getSosAndClientData['totalNegativeOral'].'</td>';
						    }
						    $html .='</tr>
                                    </tbody>';
			    }
		$i++;
                $html .= '
                            </table>
                        </div>
                      
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
        error_reporting(E_ALL);
       
          $this->session->unset_userdata('productCode');
           $this->session->unset_userdata('franchiseeName');
        $pdf->Output('stock-request-report.pdf', 'I');
    }
     function industryReportOfXls()
    {
        $dtStart = $this->input->post('dtStart');
        $dtEnd = $this->input->post('dtEnd');
        $szIndustry = $this->input->post('szIndustry');
        $szTestType = $this->input->post('szTestType');
        $this->session->set_userdata('dtStart',$dtStart);
        $this->session->set_userdata('dtEnd',$dtEnd);
        $this->session->set_userdata('szIndustry',$szIndustry);
        $this->session->set_userdata('szTestType',$szTestType);
        
        echo "SUCCESS||||";
        echo "industryReportXls";


    }
    public function industryReportXls()
    {
        $this->load->library('excel');
        $filename = 'DrugSafe';
        $title = 'Industry Report';
        $file = $filename . '-' . $title ; //save our workbook as this file name

        $searchArray['dtStart'] = $this->session->userdata('dtStart');
        $searchArray['dtEnd'] = $this->session->userdata('dtEnd');
        $searchArray['szIndustry'] = $this->session->userdata('szIndustry');
        $searchArray['szTestType'] = $this->session->userdata('szTestType');
        $alphabet = array('B','C','D','E','F','G','H','I','J','K','L','M','N');
        $getSosAndClientDetils=$this->Reporting_Model->getSosAndClientDetils($searchArray);

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($title);
        $this->excel->getActiveSheet()->setCellValue('A1', '');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', '');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(13);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $j=1;
        $k = 1;
        foreach($getSosAndClientDetils as $getSosAndClientData)
        {
            
            $industryname=$this->Admin_Model->getIndustryNameByid($getSosAndClientData['industry']);
            $alphaobj = $alphabet[$j];
            $this->excel->getActiveSheet()->setCellValue($alphaobj.$k, $industryname['szName']);
            $this->excel->getActiveSheet()->getStyle($alphaobj.$k)->getFont()->setSize(13);
            $this->excel->getActiveSheet()->getStyle($alphaobj.$k)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle($alphaobj.$k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $j++;
        }
        
        if (!empty($getSosAndClientDetils)) {
           
            if($searchArray['szTestType']=='' || $searchArray['szTestType']=='A')
            {
                $j=1;
                $this->excel->getActiveSheet()->setCellValue('A2','Alchohol');
                $this->excel->getActiveSheet()->setCellValue('B2','Total Donors');
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=2;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalAlcohol']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A3','');
                $this->excel->getActiveSheet()->setCellValue('B3','Positive Result');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=3;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalPositiveAlcohol']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A4','');
                $this->excel->getActiveSheet()->setCellValue('B4','Negative Result');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=4;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalNegativeAlcohol']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A5','');
                $this->excel->getActiveSheet()->setCellValue('B5','');
                $this->excel->getActiveSheet()->setCellValue('C5','');
                $this->excel->getActiveSheet()->setCellValue('D5','');
                    
                }
                if($searchArray['szTestType']=='' || $searchArray['szTestType']=='U')
                {
                     $this->excel->getActiveSheet()->setCellValue('A6','Urine AS/NZA 4308:2001/ As/NZA 4308:2008');
                $this->excel->getActiveSheet()->setCellValue('B6','Total Donors');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=6;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalDonarUrine']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A7','');
                $this->excel->getActiveSheet()->setCellValue('B7','Positive Result');
                $totalPositiveUrine='';
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=7;
                    $alphaobj = $alphabet[$j];
                    $totalPositiveUrine=$getSosAndClientData['totalDonarUrine'] -  $getSosAndClientData['totalNegativeUrine'];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$totalPositiveUrine);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A8','');
                $this->excel->getActiveSheet()->setCellValue('B8','Negative Result');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=8;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalNegativeUrine']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A9','');
                $this->excel->getActiveSheet()->setCellValue('B9','');
                $this->excel->getActiveSheet()->setCellValue('C9','');
                $this->excel->getActiveSheet()->setCellValue('D9','');
                    
                }
                                                   
                if($searchArray['szTestType']=='' || $searchArray['szTestType']=='O')
                {
                    $this->excel->getActiveSheet()->setCellValue('A10','Oral Fluid AS 4760:2006');
                $this->excel->getActiveSheet()->setCellValue('B10','Total Donors');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=10;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalDonarOral']);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A11','');
                $this->excel->getActiveSheet()->setCellValue('B11','Positive Result');
                 $j=1;
                 $totalPositiveOral='';
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=11;
                    $alphaobj = $alphabet[$j];
                    $totalPositiveOral= $getSosAndClientData['totalDonarOral'] -  $getSosAndClientData['totalNegativeOral'];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$totalPositiveOral);
                    $j++;
                }
                $this->excel->getActiveSheet()->setCellValue('A12','');
                $this->excel->getActiveSheet()->setCellValue('B12','Negative Result');
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $k=12;
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->setCellValue($alphaobj.$k,$getSosAndClientData['totalNegativeOral']);
                    $j++;
                }
                    
                }
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
               
                $j=1;
                foreach($getSosAndClientDetils as $getSosAndClientData)
                {  
                    $alphaobj = $alphabet[$j];
                    $this->excel->getActiveSheet()->getColumnDimension($alphaobj)->setAutoSize(TRUE);
                    $j++;
                }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }    
    

}
?>