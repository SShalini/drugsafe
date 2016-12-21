<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservices_Model extends Error_Model
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
    }
function checkUserExist($emailid){
    $whereAry = array('szEmail' => trim($emailid), 'isDeleted' => 0);
    $query = $this->db->select('szEmail')
                        ->from(__DBC_SCHEMATA_USERS__)
                        ->where($whereAry)
                        ->get();
    if ($query->num_rows() > 0) {
return true;
    }else{
        $this->addError("szEmail", "You are not registered with us.");
        return false;
    }
}
    function validateuser($data){
        $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])), 'szEmail', 'Email Address', true);
        $this->set_szPassword(sanitize_all_html_input(trim($data['szPassword'])), true);
        if($this->error){
            return false;
        }else{
            if($this->checkUserExist($data['szEmail'])){
                if($data['szrole'] == 'fr'){
                    $role = "`iRole` = '2'";
                }else{
                    $role =  "(`iRole` = '3'
                    OR `iRole` = '4')";
                }
                $where = "szEmail='".$data['szEmail']."' AND `szPassword` = '".encrypt($data['szPassword'])."' AND ".$role." AND isDeleted = 0 " ;
                //$whereAry = array('szEmail' => $data['szEmail'], 'szPassword' => encrypt($data['szPassword']),'iRole' => $role, 'isDeleted' => 0);
                $query =  $this->db->select('id, szName, szEmail, iRole')
                                    ->from(__DBC_SCHEMATA_USERS__)
                                    ->where($where)
                                    ->get();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();

                    $userAry['id'] = $row[0]['id'];
                    $userAry['szName'] = $row[0]['szName'];
                    $userAry['szEmail'] = $row[0]['szEmail'];
                    $userAry['iRole'] = $row[0]['iRole'];
                    return $userAry;
                }else{
                    $this->addError("szPassword", "Wrong credentials. Please try again.");
                    return false;
                }
            }else{
                return false;
            }

        }

    }

    function getuserdetails($userid){
        $array = array('id' => (int)$userid, 'isDeleted' => 0);
        $query =  $this->db->select('id, szName, szEmail, iRole')
                            ->from(__DBC_SCHEMATA_USERS__)
                            ->where($array)
                            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }else{
            $this->addError("usernotexist", "User does not exist.");
        }
    }
    function getclientdetails($franchiseeid,$parent=0){
        $array = array(__DBC_SCHEMATA_CLIENT__.'.franchiseeId' => (int)$franchiseeid, __DBC_SCHEMATA_CLIENT__.'.clientType' => (int)$parent);
        $query =  $this->db->select(__DBC_SCHEMATA_USERS__.'.id, szName, szEmail')
            ->from(__DBC_SCHEMATA_USERS__)
            ->join(__DBC_SCHEMATA_CLIENT__, __DBC_SCHEMATA_CLIENT__.'.clientId = '.__DBC_SCHEMATA_USERS__.'.id')
            ->where($array)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }else{
            $this->addError("usernotexist", "User does not exist.");
        }
    }

    function addsosdata($data){
        $datearr = explode('/',$data['sosdate']);
        $data['testdate'] = $datearr['2'].'-'.$datearr['1'].'-'.$datearr['0'];
        $this->set_fieldReq(sanitize_all_html_input(trim($data['testdate'])), 'testdate', 'Date', true, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['site'])), 'site', 'Site', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['drugtest'])), 'drugtest', 'Drug to be tested', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['servicecomm'])), 'servicecomm', 'Service commenced', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['servicecon'])), 'servicecon', 'Service concluded', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['totscreenu'])), 'totscreenu', 'Total Donor Screenings/Collections Urine', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['totscreeno'])), 'totscreeno', 'Total Donor Screenings/Collections Oral', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['negresu'])), 'negresu', 'Negative Results Urine', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['negreso'])), 'negreso', 'Negative Results Oral', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['furtestu'])), 'furtestu', 'Results Requiring Further Testing Urine', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['furtesto'])), 'furtesto', 'Results Requiring Further Testing Oral', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['totalcscreen'])), 'totalcscreen', 'Total No Alcohol Screen', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['negalcres'])), 'negalcres', 'Negative Alcohol Results', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['posalcres'])), 'posalcres', 'Positive Alcohol Results', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['refusals'])), 'refusals', 'Refusals', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['devicename'])), 'devicename', 'Device Name', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['extraused'])), 'extraused', 'Extra Used', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['breathtest'])), 'breathtest', 'Breath Testing Unit', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['nominated'])), 'nominated', 'Nominated Client Respresentative', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['sign'])), 'sign', 'Email Address', true);

        if($this->error){
            return false;
        }else{
            $dataAry = array(
                'testdate' => date('Y-m-d',strtotime($data['testdate'])),
                'Clientid' => $data['site'],
                'Drugtestid' => $data['drugtest'],
                'ServiceCommencedOn' => $data['servicecomm'],
                'ServiceConcludedOn' => $data['servicecon'],
                'FurtherTestRequired' => $data['furthertestreq'],
                'TotalDonarScreeningUrine' => $data['totscreenu'],
                'TotalDonarScreeningOral' => $data['totscreeno'],
                'NegativeResultUrine' => $data['negresu'],
                'NegativeResultOral' => $data['negreso'],
                'FurtherTestUrine' => $data['furtestu'],
                'FurtherTestOral' => $data['furtesto'],
                'TotalAlcoholScreening' => $data['totalcscreen'],
                'NegativeAlcohol' => $data['negalcres'],
                'PositiveAlcohol' => $data['posalcres'],
                'Refusals' => $data['refusals'],
                'DeviceName' => $data['devicename'],
                'ExtraUsed' => $data['extraused'],
                'BreathTesting' => $data['breathtest'],
                'Comments' => $data['comments'],
                'ClientRepresentative' => $data['nominated'],
                'RepresentativeSignature' => $data['sign'],
                'RepresentativeSignatureTime' => date('Y-m-d'),
                'Status' => $data['status']
            );
            $this->db->insert(__DBC_SCHEMATA_SOS_FORM__, $dataAry);
            if ($this->db->affected_rows() > 0) {
                $sosid = (int)$this->db->insert_id();
                $failarr = array();
                for($i=1;$i<=$data['donercount'];$i++){
                    if(!empty($data['name'.$i])){
                        $donerAry=array(
                            'donerName' => $data['name'.$i],
                            'result' => $data['result'.$i],
                            'drug' => $data['drugtype'.$i],
                            'alcoholreading1' => $data['pos1read'.$i],
                            'alcoholreading2' => $data['pos2read'.$i],
                            'lab' => $data['lab'.$i],
                            'sosid' => (int)$sosid
                        );
                        $this->db->insert(__DBC_SCHEMATA_DONER__, $donerAry);
                        if (!($this->db->affected_rows() > 0)){
                            $message = "Some error occurred while adding ".$data['name'.$i]." donor.";
                            array_push($failarr,$message);
                        }
                    }
                }
                return $failarr;
            }else{
                $failarr = array("No data inserted");
                return $failarr;
            }
        }
    }
    function getsosformdata($siteid){
                $whereAry = array('Clientid' => (int)$siteid);
                $query =  $this->db->select('id, testdate, Clientid, Drugtestid, ServiceCommencedOn, ServiceConcludedOn,
                                                FurtherTestRequired, TotalDonarScreeningUrine, TotalDonarScreeningOral, NegativeResultUrine,
                                                NegativeResultOral, FurtherTestUrine, FurtherTestOral, TotalAlcoholScreening, NegativeAlcohol, PositiveAlcohol,
                                                Refusals, DeviceName, ExtraUsed, BreathTesting, Comments, ClientRepresentative, RepresentativeSignature,
                                                RepresentativeSignatureTime, Status')
                    ->from(__DBC_SCHEMATA_SOS_FORM__)
                    ->where($whereAry)
                    ->get();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();
                    return $row;
                }else{
                    $this->addError("norecord", "No record found.");
                    return false;
                }
    }
    function set_szEmail($value,$field=false,$message=false , $flag = true)
    {
        $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, $field, $message, false, false, $flag);
    }

    function set_fieldReq($value,$field=false,$message=false , $flag = true,$validation=__VLD_CASE_ANYTHING__)
    {
        $this->data[$field] = $this->validateInput($value, $validation, $field, $message, false, false, $flag);
    }

    function set_szPassword($value, $flag=true)
    {
        $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szPassword", "Password", 5, false, $flag);
    }

}