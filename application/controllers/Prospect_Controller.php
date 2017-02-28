<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospect_Controller extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Prospect_Model');
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

public function prospectRecord()
   {
       $is_user_login = is_user_login($this);
       // redirect to dashboard if already logged in
       if (!$is_user_login) {
           ob_end_clean();
           redirect(base_url('/admin/admin_login'));
           die;
       }
       
       if($_SESSION['drugsafe_user']['iRole']==1){
         if(!empty($_POST['szSearch3']))
         {
           $id = $_POST['szSearch3'];   
         }
         else{
           $id = $this->session->userdata('id');  
         }
       }
       if($_SESSION['drugsafe_user']['iRole']==2){
        
           $id = $_SESSION['drugsafe_user']['id'];  
        
       }
           $szBusinessName = $_POST['szSearch1'];
           $status = $_POST['szSearch2'];
        
        $config['base_url'] = __BASE_URL__ . "/prospect/prospectRecord/";
        $config['total_rows'] = count($this->Prospect_Model->getAllProspectDetails($id,$szBusinessName,$status));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
               
            $this->pagination->initialize($config);
           
           
        $prospectDetailsAry = $this->Prospect_Model->getAllProspectDetails($id,$szBusinessName,$status, $config['per_page'],$this->uri->segment(3));
        $prospectDetailsSearchAry = $this->Prospect_Model->getAllProspectDetails($id);

        if (!empty($_POST)) {
            $_POST['szSearch3'] = $_POST['szSearch3'];
        } else {
            $_POST['szSearch3'] = $id;
        }
        
       $data['prospectDetailsSearchAry'] = $prospectDetailsSearchAry;
       $data['prospectDetailsAry'] = $prospectDetailsAry;
       $data['szMetaTagTitle'] = "Prospect Record";
       $data['is_user_login'] = $is_user_login;
       $data['pageName'] = "Prospect_Record";
       $data['id'] = $id;

       $this->load->view('layout/admin_header', $data);
       $this->load->view('prospect/prospectRecord');
       $this->load->view('layout/admin_footer');

   }
public function addprospect()
{
    $is_user_login = is_user_login($this);
    // redirect to dashboard if already logged in
    if (!$is_user_login) {
        ob_end_clean();
        redirect(base_url('/admin/admin_login'));
        die;
    }
    $franchiseId = $_SESSION['drugsafe_user']['id'];
    $validate= $this->input->post('addprospect');
   
     if($this->Prospect_Model->validateProspectData($validate,array(),false))
            {
              
                if($this->Prospect_Model->insertProspectData($validate))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>New prospect added successfully.</h3></strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                   if($_SESSION['drugsafe_user']['iRole'] == '1'){ 
                       redirect(base_url('/prospect/franchiseeProspectRecord'));
                   } else{
                       redirect(base_url('/prospect/prospectRecord'));  
                   }
                  
                }
            }

    $data['prospectDetailsAry'] = $prospectDetailsAry;
    $data['szMetaTagTitle'] = "Prospect Record";
    $data['is_user_login'] = $is_user_login;
    $data['pageName'] = "Prospect_Record";
     $data['validate'] = $validate;
     $data['getState']=$getState;
     $data['arErrorMessages'] = $this->Prospect_Model->arErrorMessages;
    
    $this->load->view('layout/admin_header', $data);
    $this->load->view('prospect/addProspect');
    $this->load->view('layout/admin_footer');

}
public function deleteprospectAlert()
      {
          $data['mode'] = '__DELETE_PROSPECT_POPUP__';
          $data['prospectId'] = $this->input->post('prospectId');
          $this->load->view('admin/admin_ajax_functions',$data);
      }
public function deleteProspectConfirmation()
{
    $data['mode'] = '__DELETE_PROSPECT_CONFIRM__';
    $data['prospectId'] = $this->input->post('prospectId');
    $this->Prospect_Model->deleteProspectRecord($data['prospectId']);
    $this->load->view('admin/admin_ajax_functions',$data);
}
   function editProspectData()
        {
           
            $idProspect = $this->input->post('idProspect');
            $flag = $this->input->post('flag');
            
            if($idProspect>0)
            {
                 $this->session->set_userdata('idProspect',$idProspect);
                 $this->session->set_userdata('flag',$flag);
                echo "SUCCESS||||";
                echo "edit_prospect";
            }
            
        }
        
        public function edit_prospect()
        {
             $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
            $idProspect = $this->session->userdata('idProspect');
            $flag = $this->session->userdata('flag');
            if($idProspect >0)
            {
              
                $data_validate = $this->input->post('editProspect');
                if(empty($data_validate))
                {
                    $prospectDataAry = $this->Prospect_Model->getProspectDetailsByProspectsId($idProspect);
                   
                }
                else
                {
                    $prospectDataAry = $data_validate;
                }
               
                if($this->Prospect_Model->validateProspectData($data_validate,array(),$idProspect))
                {
                    if($this->Prospect_Model->updateProspectDetails($data_validate,$idProspect))
                    {
                        $szMessage['type'] = "success";
                        $szMessage['content'] = "<strong><h3> Prospect data successfully updated.<h3></strong> ";
                        $this->session->set_userdata('drugsafe_user_message', $szMessage);
                      if($flag==1){
                        $this->session->unset_userdata('flag');
                        $this->session->unset_userdata('idProspect');
                        redirect(base_url('/prospect/prospectRecord'));  
                      }
                     if($flag==2){
                          $this->session->unset_userdata('flag');
                        redirect(base_url('/prospect/view_prospect_details'));  
                      }
                        
                      
                    }
                }
              
                    $data['szMetaTagTitle'] = "Edit Prospect Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Prospect_Record";
                    $_POST['editProspect'] = $prospectDataAry;
                    $_POST['flag'] = $flag;
                    $data['arErrorMessages'] = $this->Prospect_Model->arErrorMessages;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('prospect/editProspect');
            $this->load->view('layout/admin_footer');
            }
        }
         function viewProspectData()
    {
        $idProspect = $this->input->post('idProspect');
        if($idProspect>0)
        {
            $this->session->set_userdata('idProspect', $idProspect);
            echo "SUCCESS||||";
            echo "view_prospect_details";
        }
    }
    public function view_prospect_details()
    {
             $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
            $meetingNoteCreatedBy = $_POST['szSearch2'];
            $idProspect = $this->session->userdata('idProspect');
            if($idProspect >0)
            {
              $prospectDetailsAry = $this->Prospect_Model->getProspectDetailsByProspectsId($idProspect);
              
              $config['base_url'] = __BASE_URL__ . "/prospect/view_prospect_details/";
              $config['total_rows'] = count($this->Prospect_Model->getAllMeetingDetailsByProspectsId($idProspect,$meetingNoteCreatedBy));
              $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
               
            $this->pagination->initialize($config);
              $mettingsDetailsAry = $this->Prospect_Model->getAllMeetingDetailsByProspectsId($idProspect,$meetingNoteCreatedBy,$config['per_page'],$this->uri->segment(3));
              $mettingsDetailsSearchAry = $this->Prospect_Model->getAllMeetingDetailsByProspectsId($idProspect,false,false,false,1);
              
              
             
                    $data['szMetaTagTitle'] = "View Prospect Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Prospect_Record";
                    $data['prospectDetailsAry'] = $prospectDetailsAry;
                    $data['mettingsDetailsAry'] = $mettingsDetailsAry;
                    $data['mettingsDetailsSearchAry'] = $mettingsDetailsSearchAry;
                    $data['arErrorMessages'] = $this->Prospect_Model->arErrorMessages;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('prospect/viewProspectDetails.php');
            $this->load->view('layout/admin_footer');
            }
        }
         function addMeetingNotesData()
        {
            $idProspect = $this->input->post('idProspect');
            $flag = $this->input->post('flag');
            $this->session->set_userdata('idProspect',$idProspect);
            $this->session->set_userdata('flag',$flag);
           
            echo "SUCCESS||||";
            echo "add_meeting_notes";
            
        }
        public function add_meeting_notes() {
         
              $is_user_login = is_user_login($this);
              $idProspect = $this->session->userdata('idProspect');
              $flag = $this->session->userdata('flag');
              
              $validate = $this->input->post('meetingNotesData');
          
            // redirect to dashboard if already logged in
            if (!$is_user_login) {
                ob_end_clean();
              redirect(base_url('/admin/admin_login'));
                die;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('meetingNotesData[szDiscription]', 'Meeting Description', 'required');
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
            { 
               
                $data['szMetaTagTitle'] = "Add Meeting Notes";
                $data['is_user_login'] = $is_user_login;
                $data['pageName'] = "Prospect_Record";
                $data['flag'] = $flag;
                $data['idProspect'] = $idProspect;
                
                $this->load->view('layout/admin_header', $data);
                $this->load->view('prospect/addMeetingNotes');
                $this->load->view('layout/admin_footer');
            }
            else
            {
                if( $this->Prospect_Model->insertMeetingNotes($validate,$idProspect))
                {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3> Meeting Notes added successfully.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage); 
                    if($flag==1){
                       $this->session->unset_userdata('idProspect');
                       $this->session->unset_userdata('flag');  
                       redirect(base_url('/prospect/prospectRecord'));
                    }
                    else{
                       $this->session->unset_userdata('flag');   
                       redirect(base_url('/prospect/view_prospect_details'));
                    }
                   
                    
                }
            }
        }
         function viewMeetingNotesData()
    {
        $idMeetingNotes = $this->input->post('idMeetingNotes');
        if($idMeetingNotes>0)
        {
            $this->session->set_userdata('idMeetingNotes', $idMeetingNotes);
            echo "SUCCESS||||";
            echo "view_meeting_notes_details";
        }
    }
    public function view_meeting_notes_details()
    {
             $is_user_login = is_user_login($this);
            // redirect to dashboard if already logged in
            if(!$is_user_login)
            {
                ob_end_clean();
               redirect(base_url('/admin/admin_login'));
                die;
            }
            $idMeetingNotes = $this->session->userdata('idMeetingNotes');
            if($idMeetingNotes >0)
            {
//              $prospectDetailsAry = $this->Prospect_Model->getProspectDetailsByProspectsId($idProspect);
//              $mettingsDetailsAry = $this->Prospect_Model->getAllMeetingDetailsByProspectsId($idProspect);
             
                    $data['szMetaTagTitle'] = "View Prospect Details ";
                    $data['is_user_login'] = $is_user_login;
                    $data['pageName'] = "Prospect_Record";
                    $data['prospectDetailsAry'] = $prospectDetailsAry;
                    $data['mettingsDetailsAry'] = $mettingsDetailsAry;
                    $data['arErrorMessages'] = $this->Prospect_Model->arErrorMessages;
            $this->load->view('layout/admin_header',$data);
            $this->load->view('prospect/viewProspectDetails.php');
            $this->load->view('layout/admin_footer');
            }
        }
          public function editProspectStatusData()
        {
            $data['mode'] = '__PROSPECT_STATUS_EDIT_POPUP_FORM__';
            $idProspect= $this->input->post('idProspect');
            $data['idProspect'] = $this->input->post('idProspect');
            $this->load->view('admin/admin_ajax_functions',$data);
        }
        public function editProspectStatusConfirm()
        {  
          
            $data = $this->input->post('changeStatus');
            $idProspect = $this->input->post('idProspect');
           
            $this->load->library('form_validation');
            $this->form_validation->set_rules('changeStatus[status]', 'Status', 'required');
            $this->form_validation->set_message('required', '{field} is required');
            if ($this->form_validation->run() == FALSE)
           {
           ?>
            <div id="editProspectStatus" class="modal fade" tabindex="-2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="modal-title">
                        <div class="caption">
                            <h4><i class="icon-equalizer font-red-sunglo"></i> &nbsp;
                                <span class="caption-subject font-red-sunglo bold uppercase"> Change Status </span></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" id="changeStatus" name="changeStatus" method="post"
                          class="form-horizontal form-row-sepe">
                        <div class="form-body">
                            <div
                                class="form-group <?php if (form_error('changeStatus[status]')) { ?>has-error<?php } ?>">
                                <label class="control-label col-md-4">Status</label>
                                <div class="col-md-5">
                                   <div class="search">
                                        <div id='changeStatus'>                         
                                       <select class="form-control " name="changeStatus[status]" id="szState"
                                               Placeholder="Status" onfocus="remove_formError(this.id,'true')">
                                          
                                                <option value=''>Select</option>
                                                <option value="1" <?php echo (sanitize_post_field_value($prospectStatusDetailsAry['status']) == trim("1") ? "selected" : ""); ?>>Newly Added</option>
                                                <option value="2" <?php echo (sanitize_post_field_value($prospectStatusDetailsAry['status']) == trim("2") ? "selected" : ""); ?>>In Progress</option>
                                                <option value="3" <?php echo (sanitize_post_field_value($prospectStatusDetailsAry['status']) == trim("3") ? "selected" : ""); ?>>Completed</option>
                                               
                                      </select>
                                            </div>
                                  </div>
                                    <?php
                                    if (form_error('changeStatus[status]')) {
                                        ?>
                                        <span class="help-block pull-left">
                                        <span><?php echo form_error('changeStatus[status]'); ?></span>
                                        </span><?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
            <div class="portlet green-meadow box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i> Status Change Info

                            </div>

                        </div>
                       <?php  $prospectStatusDetailsAry = $this->Prospect_Model->getProspectStatusDetails($idProspect,1);
                            ?>
                        <div class="portlet-body">
                                <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> Sr No</th>
                                        <th> Status</th>
                                        <th> Updated By</th>
                                        <th> Updated On</th
                                         
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=0;
                                    foreach ($prospectStatusDetailsAry as $prospectStatusDetailsData) {
                                      
                                          $i++;
                                     ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td>
                                            <?php if ($prospectStatusDetailsData['status'] == 1) { ?>

                                                <p title="Order Status"
                                                   class="label label-sm label-warning">
                                                    Newly Added
                                                </p>
                                                <?php
                                            }
                                            if ($prospectStatusDetailsData['status'] == 3) {
                                                ?>
                                                <p title="Order Status"
                                                   class="label label-sm label-success">
                                                    Completed
                                                </p>
                                                <?php
                                            }

                                            if ($prospectStatusDetailsData['status'] == 2) {
                                                ?>
                                                <p title="Order Status"
                                                   class="label label-sm label-info">
                                                     In Progress
                                                </p>
                                                <?php
                                            }

                                           ?></td>
                                        <td>
                                            <?php 
                                             if($prospectStatusDetailsData['szUpdatedBy'])
                                            {
                                                $franchiseeDetArr = $this->Admin_Model->getAdminDetailsByEmailOrId('',$prospectStatusDetailsData['szUpdatedBy']);
                                                echo $franchiseeDetArr['szName'];
                                            }
                                            else
                                            {
                                               echo "N/A";
                                            }
                                           
                                            ?> 
                                         </td>
                                         <td>  <?php
                                        if($prospectStatusDetailsData['dtUpdatedOn']== '0000-00-00 00:00:00')
                                        {
                                          echo "N/A"; 
                                        }
                                        else{
                                             echo date('d M Y',strtotime($prospectStatusDetailsData['dtUpdatedOn'])) . ' at '.date('h:i A',strtotime($prospectStatusDetailsData['dtUpdatedOn']));   
                                          
                                        }
                                        ?> </td>
                                    

                                        </tr>
                                        
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button"
                            onclick="editProspectStatusConfirmation('<?php echo $idProspect; ?>'); return false;"
                            class="btn green">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
              <?php
           }
           else{
              
            $this->Prospect_Model->updateProspectStatus($data,$idProspect);
            $data['mode'] = '__PROSPECT_STATUS_EDIT_POPUP_CONFIRMATION__';
            $this->load->view('admin/admin_ajax_functions',$data);
           }
        }
        public function showDescriptionData()
      {
          $data['mode'] = '__SHOW_MEETING_DESCRIPTION_POPUP__';
          $data['idMeetingNote'] = $this->input->post('idMeetingNote');
          $this->load->view('admin/admin_ajax_functions',$data);
      }
       function exportProspectCsvData()
        {
            $franchiseeId = $this->input->post('franchiseeId');
            $prospectId = $this->input->post('prospectId');
            $status = $this->input->post('status');
          
                $this->session->set_userdata('franchiseeId',$franchiseeId);
                $this->session->set_userdata('prospectId',$prospectId);
                $this->session->set_userdata('status',$status);
               
                
                echo "SUCCESS||||";
                echo "export_prospect_csv";
            
 
        }
      
     public function export_prospect_csv()
        {

        ob_start();

        ini_set('max_execution_time', 5000);
        header( 'Content-type: text/html; charset=utf-8' );
        
        $szBusinessName = $this->session->userdata('prospectId');
        $status = $this->session->userdata('status');
        $franchiseeId = $this->session->userdata('franchiseeId');
        if(!empty($franchiseeId)){
           $id = $franchiseeId;    
        }
        
        if($_SESSION['drugsafe_user']['iRole']==2){
           $id = $_SESSION['drugsafe_user']['id'];  
       }
       if($_SESSION['drugsafe_user']['iRole']==2){
           $id = $_SESSION['drugsafe_user']['id'];  
       }
        $prospectDetailsAry = $this->Prospect_Model->getAllProspectDetails($id,$szBusinessName,$status);
        
        $data[0]['Sr No.'] ='Sr No.';
        $data[0]['business_name'] ='Business Name';
        $data[0]['contact_name'] ='Contact Name';
        $data[0]['abn'] ='ABN';
        $data[0]['szEmail'] ='Primary Email';
        $data[0]['szContactNo'] ='Primary Phone No';
        $data[0]['industry'] ='Industry';
        $data[0]['status'] ='Status';
        $data[0]['szContactEmail'] ='Contact Email No';
        $data[0]['szContactMobile'] ='Contact Mobile No';
        $data[0]['szContactPhone'] ='Contact Phone No';
        $data[0]['szAddress'] ='Address';
        $data[0]['szCity'] ='City';
        $data[0]['szCountry'] ='Country';
        $data[0]['szZipCode'] ='Zip Code';
        $data[0]['dt_last_updated_meeting'] ='Meeting Date/Time';
        
                       
                           

        $i=1;
        if(!empty($prospectDetailsAry))
           {
               foreach ($prospectDetailsAry as $prospectDetailsData)
               {
                     if($prospectDetailsData['industry']==1){
                               $value = 'Agriculture, Forestry and Fishing';
                            }
                            if($prospectDetailsData['industry']==2){
                               $value = 'Mining';
                            }
                            if($prospectDetailsData['industry']==3){
                               $value = 'Manufacturing';
                            }
                            if($prospectDetailsData['industry']==4){
                               $value = 'Electricity, Gas and Water Supply';
                            }if($prospectDetailsData['industry']==5){
                               $value = 'Construction';
                            }if($prospectDetailsData['industry']==6){
                               $value = 'Wholesale Trade';
                            }if($prospectDetailsData['industry']==7){
                               $value = 'Transport and Storage';
                            }if($prospectDetailsData['industry']==8){
                               $value = 'Communication Services';
                            }if($prospectDetailsData['industry']==9){
                               $value = 'Agriculture, Property and Business Services';
                            }if($prospectDetailsData['industry']==10){
                               $value = 'Agriculture, Government Administration and Defence';
                            }if($prospectDetailsData['industry']==11){
                               $value = 'Education';
                            }
                            if($prospectDetailsData['industry']==12){
                               $value = 'Health and Community Services';
                            }if($prospectDetailsData['industry']==13){
                               $value = 'Other';
                            }  
                            

                       $data[$i]['sn'] =$i;
                       $data[$i]['business_name'] =$prospectDetailsData['szBusinessName'];
                       $data[$i]['contact_name'] =$prospectDetailsData['szName'];
                       $data[$i]['abn'] =$prospectDetailsData['abn'];
                       $data[$i]['szEmail'] =$prospectDetailsData['szEmail'];
                       $data[$i]['szContactNo'] =$prospectDetailsData['szContactNo'];
                       $data[$i]['industry'] = $value;
                       $data[$i]['status'] =($prospectDetailsData['status']=='1'?'Newly Added':($prospectDetailsData['status']=='2'?'In Progress':($prospectDetailsData['status']=='3'?'Completed':'')));
                       $data[$i]['szContactEmail'] =($prospectDetailsData['szContactEmail']==''?'N/A':$prospectDetailsData['szContactEmail']);
                       $data[$i]['szContactMobile'] =($prospectDetailsData['szContactMobile']==''?'N/A':$prospectDetailsData['szContactMobile']);
                       $data[$i]['szContactPhone'] =($prospectDetailsData['szContactPhone']==''?'N/A':$prospectDetailsData['szContactPhone']);
                       $data[$i]['szAddress'] =$prospectDetailsData['szAddress'];
                       $data[$i]['szCity'] =$prospectDetailsData['szCity'];
                        $data[$i]['szCountry'] =$prospectDetailsData['szCountry'];
                       $data[$i]['szZipCode'] =$prospectDetailsData['szZipCode'];
                       $data[$i]['dt_last_updated_meeting'] =date('d/m/Y',  strtotime($prospectDetailsData['dt_last_updated_meeting'])). ' at '.date('h:i A',strtotime($prospectDetailsData['dt_last_updated_meeting']));   ; 
                      
                       $i++;

               }
           }
        header('Content-type: text/csv','charset=utf-8');
        header("Content-Disposition: attachment;filename=ProspectCsv".date('m-d-Y-h-i-s').".csv");            
        $f  =   fopen('php://output', 'w+');
        if(!empty($data))
        {
           foreach ($data as $fields) 
           {
                   $download= fputcsv($f, $fields);    
           }
        }

     }


      public function import_csv_popup_alert()
      {
          $data['mode'] = '__IMPORT_CSV_POPUP__';
          $this->load->view('admin/admin_ajax_functions',$data);
      }

    public function importCsvData(){
   
    $target_dir = __APP_PATH__."/uploads/";
    $target_file = $target_dir . basename($_FILES["imp_prospects"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if($_POST["importProspects"] == '1') {
    
    if($imageFileType == 'csv'){
      
        if (move_uploaded_file($_FILES["imp_prospects"]["tmp_name"], $target_file)) {
            
           $File =$target_file;

           $arrResult  = array();
           $handle     = fopen($File, "r");
           if(empty($handle) === false) {
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            $arrResult[] = $data;
            }
            fclose($handle);
          }
          array_shift($arrResult);
          $count =0;
            foreach ($arrResult as $worksheet) {
                
               $_POST['prospectAry']['szBusinessName'] = $worksheet[1];
               $_POST['prospectAry']['szName'] = $worksheet[2];
               $_POST['prospectAry']['abn'] = $worksheet[3];
               $_POST['prospectAry']['szEmail'] = $worksheet[4]; 
               $_POST['prospectAry']['szContactNo'] = $worksheet[5]; 
               $_POST['prospectAry']['industry'] = $worksheet[6]; 
               $_POST['prospectAry']['status'] = $worksheet[7]; 
               $_POST['prospectAry']['szContactEmail'] = $worksheet[8]; 
               $_POST['prospectAry']['szContactMobile'] = $worksheet[9]; 
               $_POST['prospectAry']['szContactPhone'] = $worksheet[10];
               $_POST['prospectAry']['szAddress'] = $worksheet[11];
               $_POST['prospectAry']['szCity'] = $worksheet[12];
               $_POST['prospectAry']['szCountry'] = $worksheet[13];
               $_POST['prospectAry']['szZipCode'] = $worksheet[14];
               $_POST['prospectAry']['dt_last_updated_meeting'] = $worksheet[15];
               $_POST['prospectAry']['iFranchiseeId'] = $_POST['iFranchiseeId'];
                 
              $validation=$this->Prospect_Model->validateProspectData($_POST['prospectAry'],array(),false,false,1);
                if($validation)
                {
                     $query =  $this->Prospect_Model->insertProspectData($_POST['prospectAry'],1); 
                }
                else
                {
                    $count++;
                    continue;
                }
            }
        
                   if($query){
                    $szMessage['type'] = "success";
                    if ($count==0){
                       $szMessage['content'] = "<strong> Prospect Record imported successfully.</strong>";   
                    }
                    else{
                        $szMessage['content'] = "<strong> Prospect Record imported successfully , but" .$count. " row is not inserted because of invalid data. </strong>";  
                    }
                  
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);  
                    redirect(base_url('/prospect/prospectRecord'));
                    }
                    else{
                     $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong> Sorry, there was an error while importing your file.</strong>" .$count . "<strong> rows not inserted </strong>" ;
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);  
                    redirect(base_url('/prospect/prospectRecord'));
               
                    }

        } else {
                    $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong><h3> Sorry, there was an error While importing your file.</h3></strong>";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);  
                    redirect(base_url('/prospect/prospectRecord'));
           
        }
        
       }
      }
     }
    function franchiseeProspectRecord()
    {

        $is_user_login = is_user_login($this);
        $count = $this->Admin_Model->getnotification();
        $commentReplyNotiCount = $this->Forum_Model->commentReplyNotifications();
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }

        $searchAry = '';

        if (isset($_POST['szSearchFrRecord']) && !empty($_POST['szSearchFrRecord'])) {
            $id = $_POST['szSearchFrRecord'];
        }

        if ($id > 0) {
            if ($_SESSION['drugsafe_user']['iRole'] == '1') {
                $prospectAray = $this->Prospect_Model->getAllProspectDetails($id);
              
            } else {
                $operationManagerId = $_SESSION['drugsafe_user']['id'];
                $prospectAray = $this->Prospect_Model->getAllClientDetails(true, false, $operationManagerId, false, false, false, $id);
            }
            if (!empty($prospectAray)) {
                $this->session->set_userdata('id', $id);
                redirect(base_url('/prospect/prospectRecord'));

            }
        }

        $data['prospectAray'] = $prospectAray;
        $data['pageName'] = "Prospect_Record";
        $data['szMetaTagTitle'] = "Prospect Record";
        $data['is_user_login'] = $is_user_login;
        $data['notification'] = $count;
        $data['commentnotification'] = $commentReplyNotiCount;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('prospect/showProspectByFranchisee');
        $this->load->view('layout/admin_footer');
    }
   
    function getProspecttListByFrIdData($idFranchisee = '')
    {
        if (trim($idFranchisee) != '') {
            $_POST['idFranchisee'] = $idFranchisee;
        }

        $prospectAray = $this->Prospect_Model->getAllProspectDetailsByFrId($_POST['idFranchisee']);

        $result = "<select class=\"form-control custom-select required\" id=\"szSearch1\" name=\"szSearch1\" placeholder=\"Business Name\" onfocus=\"remove_formError(this.id,'true')\">";
        if (!empty($prospectAray)) {
            $result .= "<option value=''>Business Name</option>";
            foreach ($prospectAray as $prospectDetails) {
                $result .= "<option value='" . $prospectDetails['id'] . "'>" . $prospectDetails['szBusinessName'] . "</option>";
            }
        } else {
            $result .= "<option value=''>Business Name</option>";
        }
        $result .= "</select>";
        echo $result;
    }    
 public function changeToClientAlert()
 {
    $data['mode'] = '__CHANGE_TO_CLIENT__';
    $prospectId= $this->input->post('prospectId');
    $data['prospectId'] = $this->input->post('prospectId');
    $this->load->view('admin/admin_ajax_functions',$data);   
 }
 public function changeToClientConfirmation()
 {
    $data['mode'] = '__CHANGE_TO_CLIENT_CONFIRMATION__';
    $prospectId= $this->input->post('prospectId');
    $data['prospectId'] = $this->input->post('prospectId');
    $this->Prospect_Model->changeToClient($_POST['prospectId']);
    $this->load->view('admin/admin_ajax_functions',$data);   
 }
 
}
?>
