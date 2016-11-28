<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_Controller extends CI_Controller
{
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
        if ($is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/franchiseeList");
            die;
        } else {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
    }

    function allstockreqlist()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

        $searchAry = $_POST['szSearchQtyReqList'];

        $count = $this->Admin_Model->getnotification();
        $config['base_url'] = __BASE_URL__ . "/reporting/allstockreqlist/";
        $config['total_rows'] = count($this->Reporting_Model->getAllQtyRequestDetails($searchAry, $limit, $offset));
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetails($searchAry, $config['per_page'], $this->uri->segment(3));
        $data['allReqQtyAray'] = $allReqQtyAray;
        $data['szMetaTagTitle'] = "All Stock Requests";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "All_Stock_Requests";
        $data['notification'] = $count;
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/stockRequestList');
        $this->load->view('layout/admin_footer');
    }

    function stockassignlist()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        $count = $this->Admin_Model->getnotification();
        $searchAry1 = $this->session->userdata('searchAry');
        $searchAry = (!empty($_POST['szSearchReqAssignList']) ? $_POST['szSearchReqAssignList'] : (!empty($searchAry1) ? $searchAry1 : ''));
        $this->session->set_userdata('searchAry', $searchAry);
//         $searchAry =    $this->session->userdata('searchAry');

        $config['base_url'] = __BASE_URL__ . "/reporting/stockassignlist/";
        $config['total_rows'] = count($this->Reporting_Model->getAllQtyAssignDetails($searchAry, $limit, $offset));
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetails($searchAry, $config['per_page'], $this->uri->segment(3));
        $data['allQtyAssignAray'] = $allQtyAssignAray;
        $data['szMetaTagTitle'] = "Stock Assignments";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "Stock_Assignments";
        $data['notification'] = $count;
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/stockAssignList');
        $this->load->view('layout/admin_footer');
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
        $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetails(false, false, false);
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
        ob_end_clean();
        $pdf->Output('stock-request-report.pdf', 'I');
    }

    public function excelstockreqlist()
    {
        $this->load->library('excel');
        $filename = 'Report';
        $title = 'Stock request list';
        $file = $filename . '-' . $title . '.xlsx'; //save our workbook as this file name


        /*$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($filename);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Franchisee Id');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'Franchisee');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'Product Code');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'Quantity Request');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'Requested On');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $allReqQtyAray = $this->Reporting_Model->getAllQtyRequestDetails(false,false,false);
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
                $i++;
            }
        }*/
        $this->excel->setActiveSheetIndex(0);
//name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
//set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
//change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
//make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
//set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $file . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
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
        $allQtyAssignAray = $this->Reporting_Model->getAllQtyAssignDetails(false, false, false);
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Assignment Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        
                                     
                                         <th style="width:70px"><b>Id</b> </th>
                                         <th style="width:90px"><b> Franchisee </b> </th>
                                         <th style="width:90px"><b> Product Code</b> </th>
                                        <th style="width:90px"><b> Quantity Assigned</b> </th>
                                        <th style="width:90px"><b> Quantity Adjusted</b> </th>
                                         <th style="width:90px"><b> Available Quantity</b> </th>
                                        <th style="width:170px"> <b>Assigned On</b> </th>
                                   
                                    </tr>';
        if ($allQtyAssignAray) {
            $i = 0;
            foreach ($allQtyAssignAray as $allQtyAssignData) {
                $productDataAry = $this->Inventory_Model->getProductDetailsById($allQtyAssignData['iProductId']);
                $franchiseeArr = $this->Admin_Model->getAdminDetailsByEmailOrId('', $allQtyAssignData['iFranchiseeId']);
                $html .= '<tr>
                                            <td> FR-' . $allQtyAssignData['iFranchiseeId'] . ' </td>
                                            <td> ' . $franchiseeArr['szName'] . '</td>
                                            <td> ' . $productDataAry['szProductCode'] . ' </td>
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
        $pdf->Output('stock-assignment-report.pdf', 'I');
    }

    function frstockreqlist()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

        $searchAry = $_POST['szSearchFrQtyReqList'];
        $franchiseeId = $_SESSION['drugsafe_user']['id'];


        $config['base_url'] = __BASE_URL__ . "/reporting/frstockreqlist/";
        $config['total_rows'] = count($this->Reporting_Model->getFrAllQtyRequestDetails($searchAry, $limit, $offset, $franchiseeId));
        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        $frAllReqQtyAray = $this->Reporting_Model->getFrAllQtyRequestDetails($searchAry, $config['per_page'], $this->uri->segment(3), $franchiseeId);
        $data['frAllReqQtyAray'] = $frAllReqQtyAray;
        $data['szMetaTagTitle'] = " Stock Requests";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "Franchisee_Stock_Requests";
        $data['data'] = $data;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/frStockRequestList');
        $this->load->view('layout/admin_footer');
    }

    function frstockassignlist()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }
        $searchAry = $_POST['szSearchFrReqAssignList'];
        $franchiseeId = $_SESSION['drugsafe_user']['id'];


        $config['base_url'] = __BASE_URL__ . "/reporting/frstockassignlist/";
        $config['total_rows'] = count($this->Reporting_Model->getFrAllQtyAssignDetails($searchAry, $limit, $offset, $franchiseeId));
        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        $frAllQtyAssignAray = $this->Reporting_Model->getFrAllQtyAssignDetails($searchAry, $config['per_page'], $this->uri->segment(3), $franchiseeId);

        $data['frAllQtyAssignAray'] = $frAllQtyAssignAray;
        $data['szMetaTagTitle'] = "Stock Assignments";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Reporting";
        $data['subpageName'] = "Franchisee_Stock_Assignments";
        $data['data'] = $data;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('reporting/frStockAssignList');
        $this->load->view('layout/admin_footer');
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
        $frAllReqQtyAray = $this->Reporting_Model->getFrAllQtyRequestDetails(false, false, false, $franchiseeId);
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
        $pdf->Output('stock-request-report.pdf', 'I');
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
        $frAllQtyAssignAray = $this->Reporting_Model->getFrAllQtyAssignDetails(false, false, false, $franchiseeId);
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Stock Assignment Report</b></p></div>
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th> <b>Product Code</b> </th>
                                        <th><b> Quantity Assigned</b> </th>
                                        <th><b> Quantity Adjusted</b> </th>
                                        <th><b> Available Quantity</b> </th>
                                        <th> <b>Assigned On</b> </th>
                                   
                                    </tr>';
        if ($frAllQtyAssignAray) {
            $i = 0;
            foreach ($frAllQtyAssignAray as $frAllQtyAssignArayData) {

                $html .= '<tr>
                                            <td> ' . $frAllQtyAssignArayData['szProductCode'] . ' </td>
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
        $pdf->Output('stock-assignment-report.pdf', 'I');
    }
}

?>