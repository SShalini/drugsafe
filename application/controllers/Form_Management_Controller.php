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
            redirect(base_url('/admin/franchiseeList'));
            die;
        } else {
            ob_end_clean();
              redirect(base_url('/admin/admin_login'));
            die;
        }
    }
    function viewFormData()
        {
            $flag = $this->input->post('flag');
            
                $this->session->set_userdata('flag',$flag);
                
                echo "SUCCESS||||";
                echo "viewForm";
            
 
        }

    function viewForm()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
             redirect(base_url('/admin/admin_login'));
            die;
        }
          $count = $this->Admin_Model->getnotification();
          $searchOptionArr =$this->Admin_Model->viewFranchiseeList(false,false);
        
        if($_POST['szSearchFrRecord'])
        {
             $count = $this->Admin_Model->getnotification();
            $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$_POST['szSearchFrRecord']);
            $clientlistArr = $this->Franchisee_Model->getAllClientDetails(true,false,false,false,false,false,$_POST['szSearchFrRecord']);
            $this->session->set_userdata('szSearchFrRecord',$_POST['szSearchFrRecord']);
            if(empty($clientlistArr))
            {  
                $count = $this->Admin_Model->getnotification();
                $data['searchOptionArr']=$searchOptionArr;
                $data['data'] = $data;
                $data['notification'] = $count;
                $data['notfound']="Not Found";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('formManagement/formViewByFr');
                $this->load->view('layout/admin_footer');
            }
            $data['clientlistArr'] = $clientlistArr;
            $data['userDataAry']=$userDataAry;
            $data['data'] = $data;
            $data['szMetaTagTitle'] = "Form Management";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Form_Management";
            $data['notification'] = $count;
            $this->load->view('layout/admin_header', $data);
            $this->load->view('formManagement/formViewByCl'); 
            $this->load->view('layout/admin_footer');
           
        }
        elseif ($_POST['szSearchClRecord']) 
        {   $count = $this->Admin_Model->getnotification();
            $franchiseeDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$_POST['szSearchClRecord']);
            $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($_POST['szSearchClRecord'],false,false,false,false);
            $this->session->set_userdata('szSearchClRecord',$_POST['szSearchClRecord']);
            
            if(empty($childClientDetailsAray))
            {
                $count = $this->Admin_Model->getnotification();
                $szSearchFrRecord = $this->session->userdata('szSearchFrRecord');
                $userDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$szSearchFrRecord);
                $clientlistArr = $this->Franchisee_Model->getAllClientDetails(true,false,false,false,false,false,$szSearchFrRecord);
                $data['clientlistArr'] = $clientlistArr;
                $data['userDataAry']=$userDataAry;
                $data['data'] = $data;
                $data['notfound']="Not Found";
                $data['szMetaTagTitle'] = "Form Management";
                $data['is_user_login'] = $is_user_login;
                $data['notification'] = $count;
                $data['pageName'] = "Form_Management";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('formManagement/formViewByCl'); 
                $this->load->view('layout/admin_footer');
            }
            $data['franchiseeDataAry'] = $franchiseeDataAry;
            $data['childClientDetailsAray']=$childClientDetailsAray;
            $data['data'] = $data;
            $data['szMetaTagTitle'] = "Form Management";
            $data['is_user_login'] = $is_user_login;
            $data['notification'] = $count;
            $data['pageName'] = "Form_Management";
            $this->load->view('layout/admin_header', $data);
            $this->load->view('formManagement/formViewBySite'); 
            $this->load->view('layout/admin_footer');
        } 
        elseif ($_POST['szSearchClRecord2']) 
        {
              $count = $this->Admin_Model->getnotification();
            $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetailsByClientId($_POST['szSearchClRecord2']);
            if(empty($sosRormDetailsAry))
            {
                  $count = $this->Admin_Model->getnotification();
                $szSearchClRecord = $this->session->userdata('szSearchClRecord');
                $franchiseeDataAry = $this->Admin_Model->getUserDetailsByEmailOrId('',$szSearchClRecord);
                $childClientDetailsAray = $this->Franchisee_Model->viewChildClientDetails($szSearchClRecord,false,false,false,false);
                $data['franchiseeDataAry'] = $franchiseeDataAry;
                $data['childClientDetailsAray']=$childClientDetailsAray;
                $value = "2";
                $data['value'] = $value;
                $data['data'] = $data;
                $data['notification'] = $count;
                $data['notfound']="Not Found";
                $data['szMetaTagTitle'] = "Form Management";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Form_Management";
                $this->load->view('layout/admin_header', $data);
                $this->load->view('formManagement/formViewBySite'); 
                $this->load->view('layout/admin_footer');
            }
            $data['sosRormDetailsAry'] = $sosRormDetailsAry;
            $data['data'] = $data;
            $data['notification'] = $count;
            $data['szMetaTagTitle'] = "Form Management";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Form_Management";
            $this->load->view('layout/admin_header', $data);
            $this->load->view('formManagement/formViewBySite'); 
            $this->load->view('layout/admin_footer');
        } 
        else 
        {
            $count = $this->Admin_Model->getnotification();
            $data['searchOptionArr']=$searchOptionArr;
            $data['data'] = $data;
            $data['szMetaTagTitle'] = "Form Management";
            $data['notification'] = $count;
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Form_Management";
            $this->load->view('layout/admin_header', $data);
            $this->load->view('formManagement/formViewByFr');
            $this->load->view('layout/admin_footer');
        }
    }
    function sosFormsdata()
        {
            $idsite = $this->input->post('idsite');
            $idClient = $this->input->post('idClient');
 
               $this->session->set_userdata('idClient',$idClient);
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
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $count = $this->Admin_Model->getnotification();
        $idsite = $this->session->userdata('idsite');
        $idClient = $this->session->userdata('idClient');
        $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetails($idClient,1);
       
        
        $data['idClient'] = $idClient;
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
            $idsite = $this->input->post('idsite');
            
            $this->session->set_userdata('idClient',$idClient);
            $this->session->set_userdata('idsite',$idsite);
                
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
        $idsite = $this->session->userdata('idsite');
         $sosRormDetailsAry = $this->Form_Management_Model->getsosFormDetails($idClient,1);
        
        $html = '       
        <a style="text-align:center;  margin-bottom:5px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
            <div><p style="text-align:center; font-size:18px; margin-bottom:5px; color:red"><b>Form Management Report</b></p></div>
        
                        <div>
                             <lable><b>Requesting Client :</b> '.$sosRormDetailsAry['szName'].'</lable>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <lable><b>City :</b> '.$sosRormDetailsAry['szCity'].'</lable>  
                             
                        </div>
                        
                         <div>
                             <lable><b>Country :</b> '.$sosRormDetailsAry['szCountry'].'</lable>  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <lable><b>Address :</b> '.$sosRormDetailsAry['szAddress'].'</lable> 
                        </div>
                        <div>
                             <lable><b>State :</b> '.$sosRormDetailsAry['szState'].'</lable> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <lable><b>ZIP/Postal Code :</b> '.$sosRormDetailsAry['szZipCode'].'</lable>  
                        </div>
                        
                        <div>
                             <lable><b>Service Commenced On :</b> '.$sosRormDetailsAry['ServiceCommencedOn'].'</lable>   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <lable><b>Service Concluded On :</b> '.$sosRormDetailsAry['ServiceConcludedOn'].'</lable>  
                        </div>';
                    
                        
                          $html .='
                  
                    
                  
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
                                      
                                       $donarDetailBySosIdAry = $this->Form_Management_Model->getDonarDetailBySosId($idsite);
                                       if(!empty($donarDetailBySosIdAry)){
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
            else{
               $html .= '<tr>
                            <td align="center" colspan="6">Not Found</td>
                        </tr>'; 
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>  
                        <hr>
                        <div class="table-responsive">
                            <table  border="1" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th><b>* U = Result Requiring Further  Testing N = Negative <br> ** P = Positive N = Negative</b> </th>                                        
                                        <th><b> Urine </b></th>
                                        <th><b> Oral</b></th>  
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>Total Donar Screenings/Collections </td>
                                            <td>'.$sosRormDetailsAry['TotalDonarScreeningUrine'].'</td>
                                            <td> '. $sosRormDetailsAry['TotalDonarScreeningOral'].' </td>
                                        </tr>
                                         <tr>
                                            <td> Negative Results</td>
                                            <td>'.$sosRormDetailsAry['NegativeResultOral'].'</td>
                                            <td>'.$sosRormDetailsAry['NegativeResultOral'].'</td>
                                        </tr>
                                         <tr>
                                            <td> Result Requiring Further Testing </td>
                                            <td>'.$sosRormDetailsAry['FurtherTestUrine'].'</td>
                                            <td>'.$sosRormDetailsAry['FurtherTestOral'].' </td>
                                        </tr>
                                      
                                </tbody>
                            </table>
                        </div>
                        <hr>
                       <div>
                            <lable><b>Total No Alcohol Screens : </b> '.$sosRormDetailsAry['TotalAlcoholScreening'].'</lable> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <lable><b>Positive Alcohol Results : </b> '.$sosRormDetailsAry['PositiveAlcohol'].'</lable>
                        </div>
                         <div>
                            <lable><b>Refusals , No Shows or Others : </b> '.$sosRormDetailsAry['Refusals'].'</lable>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; <lable><b>Negative Alcohol Results :</b> '.$sosRormDetailsAry['NegativeAlcohol'].'</lable>
                        </div>
                        <hr>
                         <div>
                            <lable><b>Device Name : </b> '.$sosRormDetailsAry['DeviceName'].'</lable> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; <lable><b>Breath Testing Unit : </b> '.$sosRormDetailsAry['BreathTesting'].'</lable>
                        </div> 
                         <div>
                            <lable><b>Extra Used :</b> '.$sosRormDetailsAry['ExtraUsed'].'</lable>
                        </div>
                        <hr>
                         <div>
                          <p>I/we <b>'.$sosRormDetailsAry['CollectorName'].'</b> conducted the alcohol and/or drugscreening/collection service detailed above and confirm that all procedures were undertaken in accordance with the relevant Standard.</p><b>Collector Signature : </b>'.$sosRormDetailsAry['CollectorSignature'].'</div>
                        </div>
                      <hr>
                      <div>
                          <p><b>Comments or Observation : </b>'.$sosRormDetailsAry['Comments'].'</div>
                        </div>
                      <hr>
                        <div>
                            <lable><b>Nominated Client Representative :</b> '.$sosRormDetailsAry['ClientRepresentative'].'</lable> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;<lable><b>Signed : </b> '.$sosRormDetailsAry['RepresentativeSignature'].'</lable>
                        </div>
                         <div>
                          <lable><b>Status :</b> '.($sosRormDetailsAry['Status'] == 0 ? 'Not Completed':'Completed').'</lable>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; <lable><b>Time :</b> '.$sosRormDetailsAry['RepresentativeSignatureTime'].'</lable> 
                        </div>';
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Drugsafe_Form_Management_report.pdf', 'I');
    }
    function cocFormDetails()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
       
        
        $data['notification'] = $count;
        $data['szMetaTagTitle'] = "Form Management";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Form_Management";
    
        $this->load->view('layout/admin_header', $data);
        $this->load->view('formManagement/cocForm');
        $this->load->view('layout/admin_footer');
    }
    function ViewDonorDetailsData()
        {
            
            $idsos = $this->input->post('idsos');
            
            
            $this->session->set_userdata('idsos',$idsos);
                
                echo "SUCCESS||||";
                echo "ViewDonorDetails";
        }
         function ViewDonorDetails()
    {
        $idsos = $this->session->userdata('idsos');
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
       $DonorDetailsAry = $this->Form_Management_Model->getActiveDonorDetailsBySosId($idsos);
        
        $data['notification'] = $count;
        $data['idsos'] = $idsos;
        $data['szMetaTagTitle'] = "Donor Details";
        $data['DonorDetailsAry'] = $DonorDetailsAry;
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Form_Management";
    
        $this->load->view('layout/admin_header', $data);
        $this->load->view('formManagement/donorDetailsList');
        $this->load->view('layout/admin_footer');
    }
     function ViewCocFormData()
        {
            
             $idcoc = $this->input->post('idcoc');
              $idsos = $this->input->post('idsos');
            
             $this->session->set_userdata('idsos',$idsos);
            $this->session->set_userdata('idcoc',$idcoc);
                
                echo "SUCCESS||||";
                echo "ViewCocForm";
        }
         function ViewCocForm()
    {
        $idcoc = $this->session->userdata('idcoc');
         $idsos = $this->session->userdata('idsos');
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
              redirect(base_url('/admin/admin_login'));
            die;
        }
       $cocFormDetailsAry = $this->Form_Management_Model->getCocFormDetailsByCocId($idcoc);
       
        $data['notification'] = $count;
        $data['idcoc'] = $idcoc;
        $data['idsos'] = $idsos;
        $data['szMetaTagTitle'] = "Donor Details";
        $data['cocFormDetailsAry'] = $cocFormDetailsAry;
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Form_Management";
    
        $this->load->view('layout/admin_header', $data);
        $this->load->view('formManagement/cocForm');
        $this->load->view('layout/admin_footer');
    }
}
?>