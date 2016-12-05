<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Management_Controller extends CI_Controller
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
        $this->load->model('Form_Management_Model');
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
    function viewForm()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

      

        $count = $this->Admin_Model->getnotification();
        
        
        $data['notification'] = $count;
        $data['data'] = $data;
        $data['szMetaTagTitle'] = "Form Management";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Form_Management";
        $this->load->view('layout/admin_header', $data);
        $this->load->view('formManagement/viewForm');
        $this->load->view('layout/admin_footer');
    }
    function sosFormsdata()
        {
            $idsite = $this->input->post('idsite');
 
               $this->session->set_userdata('idsite',$idsite);
                
                echo "SUCCESS||||";
                echo "sosForm";
            
 
        }

    function sosForm()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            header("Location:" . __BASE_URL__ . "/admin/admin_login");
            die;
        }

      

        $count = $this->Admin_Model->getnotification();
        $idsite = $this->session->userdata('idsite');
        $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetails($idsite);
        
        $data['idsite'] = $idsite;
        $data['data'] = $data;
        $data['notification'] = $count;
        $data['szMetaTagTitle'] = "Form Management";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Form_Management";
        $data['sosRormDetailsAry'] = $sosRormDetailsAry;
        $this->load->view('layout/admin_header', $data);
        $this->load->view('formManagement/sosForm');
        $this->load->view('layout/admin_footer');
    }
     function ViewSosFormPdfData()
        {
            $idClient = $this->input->post('idClient');
 
               $this->session->set_userdata('idClient',$idClient);
                
                echo "SUCCESS||||";
                echo "pdf_sosform";
        }
 public function pdf_sosform()
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe Form Management report');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Form Management Report PDF');
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
        $idClient = $this->session->userdata('idClient');
         $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetails($idClient);
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Form Management Report</b></p></div>
         
                  <div class="row">
                        
                            <lable>Requesting Client :</lable>
                       
                            <p>'.$sosRormDetailsAry['szName'].'</p>
                      
                    </div>  
        <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th> <b>Emp/Con.</b> </th>
                                        <th><b> Donar Name</b> </th>
                                        <th><b> Result</b> </th>
                                        <th><b> Drug </b> </th>
                                        <th> <b>Alcohol</b> </th>
                                        <th> <b>Lab</b> </th>
                                   
                                    </tr>';
        if ($sosRormDetailsAry) { 
                                       $sosIdDetailByClientId = $this->Form_Management_Model->getsosFormDetailsByClientId($sosRormDetailsAry['Clientid']);
                                       $donarDetailBySosIdAry = $this->Form_Management_Model->getDonarDetailBySosId($sosIdDetailByClientId['id']);
                                        $i = 0;
                                       foreach($donarDetailBySosIdAry as $donarDetailBySosIdData){
                                           
                                    

                $html .= '<tr>
                                            <td>' . $donarDetailBySosIdData['id'] . ' </td>
                                            <td>' . $donarDetailBySosIdData['donerName'] . ' </td>
                                            <td>'.($donarDetailBySosIdData['result'] == 0 ? 'Negative': 'Positive').'</td>
                                            <td>' . $donarDetailBySosIdData['drug'] . ' </td>
                                            <td>'.($donarDetailBySosIdData['alcohol'] == 0 ? 'Negative': 'Positive').'</td>
                                            <td>' .$donarDetailBySosIdData['lab'] . ' </td>
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