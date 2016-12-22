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

    function validateuser($data)
    {
        $this->set_szEmail(sanitize_all_html_input(trim($data['szEmail'])), 'szEmail', 'Email Address', true);
        $this->set_szPassword(sanitize_all_html_input(trim($data['szPassword'])), true);
        if ($this->error) {
            return false;
        } else {
            if ($this->checkUserExist($data['szEmail'])) {
                if ($data['szrole'] == 'fr') {
                    $role = "`iRole` = '2'";
                } else {
                    $role = "(`iRole` = '3'
                    OR `iRole` = '4')";
                }
                $where = "szEmail='" . $data['szEmail'] . "' AND `szPassword` = '" . encrypt($data['szPassword']) . "' AND " . $role . " AND isDeleted = 0 ";
                //$whereAry = array('szEmail' => $data['szEmail'], 'szPassword' => encrypt($data['szPassword']),'iRole' => $role, 'isDeleted' => 0);
                $query = $this->db->select('id, szName, szEmail, iRole')
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
                } else {
                    $this->addError("szPassword", "Wrong credentials. Please try again.");
                    return false;
                }
            } else {
                return false;
            }

        }

    }

    function set_szEmail($value, $field = false, $message = false, $flag = true)
    {
        $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, $field, $message, false, false, $flag);
    }

    function set_szPassword($value, $flag = true)
    {
        $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szPassword", "Password", 5, false, $flag);
    }

    function checkUserExist($emailid)
    {
        $whereAry = array('szEmail' => trim($emailid), 'isDeleted' => 0);
        $query = $this->db->select('szEmail')
            ->from(__DBC_SCHEMATA_USERS__)
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            $this->addError("szEmail", "You are not registered with us.");
            return false;
        }
    }

    function getuserdetails($userid)
    {
        $array = array('id' => (int)$userid, 'isDeleted' => 0);
        $query = $this->db->select('id, szName, szEmail, iRole')
            ->from(__DBC_SCHEMATA_USERS__)
            ->where($array)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("usernotexist", "User does not exist.");
        }
    }

    function getclientdetails($franchiseeid, $parent = 0)
    {
        $array = array(__DBC_SCHEMATA_CLIENT__ . '.franchiseeId' => (int)$franchiseeid, __DBC_SCHEMATA_CLIENT__ . '.clientType' => (int)$parent);
        $query = $this->db->select(__DBC_SCHEMATA_USERS__ . '.id, szName, szEmail')
            ->from(__DBC_SCHEMATA_USERS__)
            ->join(__DBC_SCHEMATA_CLIENT__, __DBC_SCHEMATA_CLIENT__ . '.clientId = ' . __DBC_SCHEMATA_USERS__ . '.id')
            ->where($array)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("usernotexist", "User does not exist.");
        }
    }

    function addsosdata($data)
    {
        $datearr = explode('/', $data['sosdate']);
        $data['testdate'] = $datearr['2'] . '-' . $datearr['1'] . '-' . $datearr['0'];
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

        if ($this->error) {
            return false;
        } else {
            $dataAry = array(
                'testdate' => date('Y-m-d', strtotime($data['testdate'])),
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
                for ($i = 1; $i <= $data['donercount']; $i++) {
                    if (!empty($data['name' . $i])) {
                        $donerAry = array(
                            'donerName' => $data['name' . $i],
                            'result' => $data['result' . $i],
                            'drug' => $data['drugtype' . $i],
                            'alcoholreading1' => $data['pos1read' . $i],
                            'alcoholreading2' => $data['pos2read' . $i],
                            'lab' => $data['lab' . $i],
                            'sosid' => (int)$sosid
                        );
                        $this->db->insert(__DBC_SCHEMATA_DONER__, $donerAry);
                        if(($this->db->affected_rows() > 0) && (($data['result' . $i] == '1') || ($data['drugnewcounter' . $i] == '1') || ($data['doneralcohol' . $i] == '1'))){
                            $donerid = $this->db->insert_id();
                            $cocdatearr = array( 'cocdate' => date('Y-m-d', strtotime($data['testdate'])));
                            $this->db->insert(__DBC_SCHEMATA_COC_FORM__, $cocdatearr);
                            if($this->db->affected_rows() > 0){
                                $cocid = $this->db->insert_id();
                                $updatearr = array('cocid' => (int)$cocid);
                                $whereAry = array('id' => (int)$donerid);
                                $this->db->where($whereAry)
                                        ->update(__DBC_SCHEMATA_DONER__, $updatearr);

                                if (!($this->db->affected_rows() > 0)) {
                                    $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                    array_push($failarr, $message);
                                }
                            }
                        }elseif (!($this->db->affected_rows() > 0)) {
                            $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                            array_push($failarr, $message);
                        }
                    }
                }
                $datacocarr = $this->getcocdonorsbysosid($sosid);
                if(!empty($datacocarr)){
                    if($datacocarr['totalcoc'] > '1'){
                        $failarr = array("totalcoccount"=>$datacocarr, "sosid"=>$sosid);
                    }else{
                        $singlecocarr = $this->getcocidbysosid($sosid);
                        $failarr = array("totalcoccount"=>$datacocarr, "sosid"=>$sosid, "cocid"=>$singlecocarr);
                    }
                }
                return $failarr;
            } else {
                $failarr = array("No data inserted");
                return $failarr;
            }
        }
    }

    function set_fieldReq($value, $field = false, $message = false, $flag = true, $validation = __VLD_CASE_ANYTHING__)
    {
        $this->data[$field] = $this->validateInput($value, $validation, $field, $message, false, false, $flag);
    }
    function getcocidbysosid($sosid)
    {
        $whereAry = 'sosid ='.(int)$sosid.' AND cocid > 0';
        $query = $this->db->select('cocid')
            ->from(__DBC_SCHEMATA_DONER__)
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }
    function getcocdonorsbysosid($sosid)
    {
        $whereAry = 'sosid ='.(int)$sosid.' AND cocid > 0';
        $query = $this->db->select('COUNT(id) as totalcoc')
            ->from(__DBC_SCHEMATA_DONER__)
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }
    function getsosformdata($siteid)
    {
        $whereAry = array('Clientid' => (int)$siteid);
        $query = $this->db->select('id, testdate, Clientid, Drugtestid, ServiceCommencedOn, ServiceConcludedOn,
                                                FurtherTestRequired, TotalDonarScreeningUrine, TotalDonarScreeningOral, NegativeResultUrine,
                                                NegativeResultOral, FurtherTestUrine, FurtherTestOral, TotalAlcoholScreening, NegativeAlcohol,
                                                PositiveAlcohol, Refusals, DeviceName, ExtraUsed, BreathTesting, Comments, ClientRepresentative,
                                                RepresentativeSignature, RepresentativeSignatureTime, Status')
            ->from(__DBC_SCHEMATA_SOS_FORM__)
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getclientsites($clientid)
    {
        $whereAry = array('client.clientType' => (int)$clientid, 'user.isDeleted' => '0');
        $query = $this->db->select('site.id, site.siteid, site.per_form_complete, site.sp_name, site.sp_mobile, site.sp_email, 
                                     site.iis_name, site.iis_mobile, site.iis_email, site.rlr_name, site.rlr_mobile, site.rlr_email, site.orlr_name,
                                     site.orlr_mobile, site.orlr_email, site.psc_name, site.psc_mobile, site.psc_phone, site.ssc_name, 
                                     site.ssc_mobile, site.ssc_phone, site.instructions, site.site_people, site.test_count, site.initial_testing_req,
                                     site.site_visit, site.ongoing_testing_req, site.onsite_service, site.start_time, site.power_access,
                                     site.randomisation, site.risk_assessment, site.req_comp_induction,
                                     site.req_ppe, site.paperwork, site.specify_contact, user.id as userid, user.szName,
                                     user.szEmail, user.szContactNumber, user.szAddress, user.szZipCode,
                                     user.szCity, user.szState, user.szCountry')
            ->from(__DBC_SCHEMATA_SITES__ . ' as site')
            ->join(__DBC_SCHEMATA_CLIENT__ . ' as client', 'client.id = site.siteid')
            ->join(__DBC_SCHEMATA_USERS__ . ' as user', 'user.id = client.clientId')
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getfranchiseeclients($franchiseeid)
    {
        $whereAry = array('client.franchiseeId' => (int)$franchiseeid, 'client.clientType' => '0', 'user.isDeleted' => '0');
        $query = $this->db->select('client.id, client.clientId, client.szBusinessName, client.szContactEmail, client.szContactPhone, 
        client.szContactMobile, user.szName,
                                     user.szEmail, user.szContactNumber, user.szAddress, user.szZipCode,
                                     user.szCity, user.szState, user.szCountry')
            ->from(__DBC_SCHEMATA_CLIENT__ . ' as client')
            ->join(__DBC_SCHEMATA_USERS__ . ' as user', 'user.id = client.clientId')
            ->where($whereAry)
            ->get();
        /*$q = $this->db->last_query();
        die($q);*/
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getfranchiseesites($franchiseeid)
    {
        $resultarr = array();
        $franchiseeclientsarr = $this->getfranchiseeclients($franchiseeid);
        if(!empty($franchiseeclientsarr)){
            foreach ($franchiseeclientsarr as $franchiseeclient){
                $clientsitearr = $this->getclientsites($franchiseeclient['clientId']);
                if(!empty($clientsitearr)){
                    array_push($resultarr,$clientsitearr);
                }
            }
            if(!empty($resultarr)){
                return $resultarr;
            }else{
                $this->addError("norecord", "No record found.");
                return false;
            }
        }else{
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getclientsosformdata($clientid)
    {
        $resultarr = array();
        $clientsitesarr = $this->getclientsites($clientid);

        if(!empty($clientsitesarr)){
            foreach ($clientsitesarr as $clientsite){
                $sosdataarr = $this->getsosformdata($clientsite['userid']);
                if(!empty($sosdataarr)){
                    array_push($resultarr,$sosdataarr);
                }
            }
            if(!empty($resultarr)){
                return $resultarr[0];
            }else{
                $this->addError("norecord", "No record found.");
                return false;
            }
        }else{
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getfranchiseesosformdata($franchiseeid)
    {
        $resultarr = array();
        $franchiseeclientsarr = $this->getfranchiseeclients($franchiseeid);
        if(!empty($franchiseeclientsarr)){
            foreach ($franchiseeclientsarr as $franchiseeclient){
                $clientsosdataarr = $this->getclientsosformdata($franchiseeclient['clientId']);
                if(!empty($clientsosdataarr)){
                    foreach ($clientsosdataarr as $key=>$val){
                        $clientsosdataarr[$key]['parentclientid'] = $franchiseeclient['clientId'];
                    }
                    array_push($resultarr,$clientsosdataarr);
                }
            }
            if(!empty($resultarr)){
                return $resultarr;
            }else{
                $this->addError("norecord", "No record found.");
                return false;
            }
        }else{
            $this->addError("norecord", "No record found.");
            return false;
        }
    }
} 