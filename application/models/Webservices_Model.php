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
        $data['testdate'] = $this->formatdate($data['sosdate']);
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
        $this->set_fieldReq(sanitize_all_html_input(trim($data['sign'])), 'sign', 'Signature', true);

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
            if ($data['update'] == '1') {
                $wheresosAry = array('id' => (int)$data['idsos']);
                $newdonors = (int)$data['donercountpost'] - (int)$data['donercountpre'];
                $this->db->where($wheresosAry)
                    ->update(__DBC_SCHEMATA_SOS_FORM__, $dataAry);

                $sosid = (int)$data['idsos'];
                $failarr = array();
                $newupdate = false;
                for ($i = 1; $i <= $data['donercount']; $i++) {
                    $oldupdate = true;
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
                        if ($newdonors > '0') {
                            $totalnewdonors = explode(',', $data['newdonerids']);
                            foreach ($totalnewdonors as $newkey => $newval) {
                                if ($i == $newval) {
                                    $newupdate = true;
                                    $this->db->insert(__DBC_SCHEMATA_DONER__, $donerAry);
                                    if (($this->db->affected_rows() > 0) && (($data['result' . $i] == '1') || ($data['drugnewcounter' . $i] == '1') || ($data['doneralcohol' . $i] == '1'))) {
                                        $donerid = $this->db->insert_id();
                                        $cocdatearr = array('cocdate' => date('Y-m-d', strtotime($data['testdate'])));
                                        $this->db->insert(__DBC_SCHEMATA_COC_FORM__, $cocdatearr);
                                        if ($this->db->affected_rows() > 0) {
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
                                    } elseif (!($this->db->affected_rows() > 0)) {
                                        $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                        array_push($failarr, $message);
                                    }
                                } else {
                                    if($oldupdate && !$newupdate){
                                        $oldupdate = false;
                                        $weherecocarr = array('id' => (int)$data['iddonor' . $i]);
                                        $this->db->where($weherecocarr)
                                            ->update(__DBC_SCHEMATA_DONER__, $donerAry);
                                        if (($data['idcoc' . $i] == '0') && (($data['result' . $i] == '1') || ($data['drugnewcounter' . $i] == '1') || ($data['doneralcohol' . $i] == '1'))) {
                                            $cocdateupdatearr = array('cocdate' => date('Y-m-d', strtotime($data['testdate'])));
                                            $this->db->insert(__DBC_SCHEMATA_COC_FORM__, $cocdateupdatearr);
                                            if ($this->db->affected_rows() > 0) {
                                                $cocupdateid = $this->db->insert_id();
                                                $updatedonorarr = array('cocid' => (int)$cocupdateid);
                                                $whereupdateAry = array('id' => (int)$data['iddonor' . $i]);
                                                $this->db->where($whereupdateAry)
                                                    ->update(__DBC_SCHEMATA_DONER__, $updatedonorarr);
                                                if (!($this->db->affected_rows() > 0)) {
                                                    $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                                    array_push($failarr, $message);
                                                }
                                            }
                                        } elseif (!($this->db->affected_rows() > 0)) {
                                            $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                            array_push($failarr, $message);
                                        }
                                    }
                                }
                            }
                        } else {
                            $weherecocarr = array('id' => (int)$data['iddonor' . $i]);
                            $this->db->where($weherecocarr)
                                ->update(__DBC_SCHEMATA_DONER__, $donerAry);
                            if (($data['idcoc' . $i] == '0') && (($data['result' . $i] == '1') || ($data['drugnewcounter' . $i] == '1') || ($data['doneralcohol' . $i] == '1'))) {
                                $cocdateupdatearr = array('cocdate' => date('Y-m-d', strtotime($data['testdate'])));
                                $this->db->insert(__DBC_SCHEMATA_COC_FORM__, $cocdateupdatearr);
                                if ($this->db->affected_rows() > 0) {
                                    $cocupdateid = $this->db->insert_id();
                                    $updatedonorarr = array('cocid' => (int)$cocupdateid);
                                    $whereupdateAry = array('id' => (int)$data['iddonor' . $i]);
                                    $this->db->where($whereupdateAry)
                                        ->update(__DBC_SCHEMATA_DONER__, $updatedonorarr);

                                    if (!($this->db->affected_rows() > 0)) {
                                        $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                        array_push($failarr, $message);
                                    }
                                }
                            } elseif (!($this->db->affected_rows() > 0)) {
                                $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                array_push($failarr, $message);
                            }
                        }
                    }
                }
                $datacocarr = $this->getcocdonorsbysosid($sosid);
                if (!empty($datacocarr)) {
                    if ($datacocarr['totalcoc'] > '1') {
                        $failarr = array("totalcoccount" => $datacocarr, "sosid" => $sosid);
                    } else {
                        $singlecocarr = $this->getcocidbysosid($sosid);
                        $failarr = array("totalcoccount" => $datacocarr, "sosid" => $sosid, "cocid" => $singlecocarr);
                    }
                }
                return $failarr;
            } else {
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
                            if (($this->db->affected_rows() > 0) && (($data['result' . $i] == '1') || ($data['drugnewcounter' . $i] == '1') || ($data['doneralcohol' . $i] == '1'))) {
                                $donerid = $this->db->insert_id();
                                $cocdatearr = array('cocdate' => date('Y-m-d', strtotime($data['testdate'])));
                                $this->db->insert(__DBC_SCHEMATA_COC_FORM__, $cocdatearr);
                                if ($this->db->affected_rows() > 0) {
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
                            } elseif (!($this->db->affected_rows() > 0)) {
                                $message = "Some error occurred while adding " . $data['name' . $i] . " donor.";
                                array_push($failarr, $message);
                            }
                        }
                    }
                    $datacocarr = $this->getcocdonorsbysosid($sosid);
                    if (!empty($datacocarr)) {
                        if ($datacocarr['totalcoc'] > '1') {
                            $failarr = array("totalcoccount" => $datacocarr, "sosid" => $sosid);
                        } else {
                            $singlecocarr = $this->getcocidbysosid($sosid);
                            $failarr = array("totalcoccount" => $datacocarr, "sosid" => $sosid, "cocid" => $singlecocarr);
                        }
                    }
                    return $failarr;
                } else {
                    $failarr = array("No data inserted");
                    return $failarr;
                }
            }
        }
    }

    function formatdate($date)
    {
        $datearr = explode('/', $date);
        $res = $datearr['2'] . '-' . $datearr['1'] . '-' . $datearr['0'];
        return $res;
    }

    function set_fieldReq($value, $field = false, $message = false, $flag = true, $validation = __VLD_CASE_ANYTHING__)
    {
        $this->data[$field] = $this->validateInput($value, $validation, $field, $message, false, false, $flag);
    }

    function getcocdonorsbysosid($sosid)
    {
        $whereAry = 'sosid =' . (int)$sosid . ' AND cocid > 0';
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

    function getcocidbysosid($sosid)
    {
        $whereAry = 'sosid =' . (int)$sosid . ' AND cocid > 0';
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

    function getfranchiseesites($franchiseeid)
    {
        $resultarr = array();
        $franchiseeclientsarr = $this->getfranchiseeclients($franchiseeid);
        if (!empty($franchiseeclientsarr)) {
            foreach ($franchiseeclientsarr as $franchiseeclient) {
                $clientsitearr = $this->getclientsites($franchiseeclient['clientId']);
                if (!empty($clientsitearr)) {
                    array_push($resultarr, $clientsitearr);
                }
            }
            if (!empty($resultarr)) {
                return $resultarr;
            } else {
                $this->addError("norecord", "No record found.");
                return false;
            }
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

    function getfranchiseesosformdata($franchiseeid, $status = false)
    {
        $resultarr = array();
        $franchiseeclientsarr = $this->getfranchiseeclients($franchiseeid);
        if (!empty($franchiseeclientsarr)) {
            foreach ($franchiseeclientsarr as $franchiseeclient) {
                $clientsosdataarr = $this->getclientsosformdata($franchiseeclient['clientId'], $status);

                if (!empty($clientsosdataarr)) {
                    foreach ($clientsosdataarr as $key => $val) {
                        $clientsosdataarr[$key][0]['parentclientid'] = $franchiseeclient['clientId'];
                        $clientdetarr = $this->getuserdetails($franchiseeclient['clientId']);
                        if (!empty($clientdetarr)) {
                            $clientsosdataarr[$key][0]['clientname'] = $clientdetarr[0]['szName'];
                        }
                        $sitedetarr = $this->getuserdetails($clientsosdataarr[$key][0]['Clientid']);
                        if (!empty($sitedetarr)) {
                            $clientsosdataarr[$key][0]['sitename'] = $sitedetarr[0]['szName'];
                        }
                    }
                    array_push($resultarr, $clientsosdataarr);
                }
            }

            if (!empty($resultarr)) {
                return $resultarr;
            } else {
                $this->addError("norecord", "No record found.");
                return false;
            }
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getclientsosformdata($clientid, $status = false)
    {
        $resultarr = array();
        $clientsitesarr = $this->getclientsites($clientid);
        if (!empty($clientsitesarr)) {
            foreach ($clientsitesarr as $clientsite) {
                $sosdataarr = $this->getsosformdata($clientsite['userid'], $status);
                if (!empty($sosdataarr)) {
                    array_push($resultarr, $sosdataarr);
                }
            }
            if (!empty($resultarr)) {
                return $resultarr;
            } else {
                $this->addError("norecord", "No record found.");
                return false;
            }
        } else {
            $this->addError("norecord", "No record found.");
            return false;
        }
    }

    function getsosformdata($siteid, $status = false)
    {
        $whereAry = 'sos.Clientid =' . (int)$siteid . ($status ? ' AND sos.Status = 0' : '');
        $query = $this->db->select('sos.id, sos.testdate, sos.Clientid, sos.Drugtestid, sos.ServiceCommencedOn, sos.ServiceConcludedOn,
                                                sos.FurtherTestRequired, sos.TotalDonarScreeningUrine, sos.TotalDonarScreeningOral, sos.NegativeResultUrine,
                                                sos.NegativeResultOral, sos.FurtherTestUrine, sos.FurtherTestOral, sos.TotalAlcoholScreening, sos.NegativeAlcohol,
                                                sos.PositiveAlcohol, sos.Refusals, sos.DeviceName, sos.ExtraUsed, sos.BreathTesting, sos.Comments, sos.ClientRepresentative,
                                                sos.RepresentativeSignature, sos.RepresentativeSignatureTime, sos.Status, client.clientType, client.franchiseeId')
            ->from(__DBC_SCHEMATA_SOS_FORM__ . ' as sos')
            ->join(__DBC_SCHEMATA_CLIENT__ . ' as client', 'sos.Clientid = client.clientId')
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

    function getdonorsbysosid($sosid)
    {
        $array = array('sosid' => (int)$sosid);
        $query = $this->db->select('id, donerName, result, drug, alcoholreading1, alcoholreading2, lab, sosid, cocid, cocstatus')
            ->from(__DBC_SCHEMATA_DONER__)
            ->where($array)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
        }
    }

    function getsosdatabycocid($cocid)
    {
        $whereAry = 'donor.cocid =' . (int)$cocid . ' AND sos.Status = 0 AND donor.cocstatus = 0';
        $query = $this->db->select('sos.id, sos.testdate, sos.Clientid, sos.Drugtestid, sos.ServiceCommencedOn, sos.ServiceConcludedOn,
                                    sos.FurtherTestRequired, sos.TotalDonarScreeningUrine, sos.TotalDonarScreeningOral, sos.NegativeResultUrine,
                                    sos.NegativeResultOral, sos.FurtherTestUrine, sos.FurtherTestOral, sos.TotalAlcoholScreening, sos.NegativeAlcohol,
                                    sos.PositiveAlcohol, sos.Refusals, sos.DeviceName, sos.ExtraUsed, sos.BreathTesting, sos.Comments, sos.ClientRepresentative,
                                    sos.RepresentativeSignature, sos.RepresentativeSignatureTime, sos.Status, donor.donerName, donor.cocid, 
                                    coc.cocdate, coc.drugtest, coc.dob, coc.employeetype, coc.contractor, coc.idtype, coc.idnumber, coc.donorsign,
                                    coc.voidtime, coc.sampletempc, coc.tempreadtime, 
                                    coc.intect, coc.intectexpiry, coc.visualcolor, coc.creatinine,coc.otherintegrity,coc.hudration,coc.devicename as cocdevice,coc.lotno,coc.lotexpiry,coc.cocain,
                                    coc.amp,coc.mamp,coc.thc, coc.opiates, coc.benzo, coc.collectorone, coc.collectorsignone, coc.collectortwo, coc.collectorsigntwo, coc.comments,
                                    coc.onsitescreeningrepo, coc.receiverone, coc.receiveronesign, coc.receiveronedate, coc.receiveronetime,coc.receiveroneseal,
                                    coc.receiveronelabel, coc.receivertwo, coc.receivertwosign, coc.receivertwodate, coc.receivertwotime, coc.receivertwoseal, coc.receivertwolabel,
                                    coc.reference')
            ->from(__DBC_SCHEMATA_SOS_FORM__ . ' as sos')
            ->join(__DBC_SCHEMATA_DONER__ . ' as donor', 'sos.id = donor.sosid')
            ->join(__DBC_SCHEMATA_COC_FORM__ . ' as coc', 'coc.id = donor.cocid')
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
        }
    }

    function addcocdata($data)
    {

        $data['cocdate'] = $this->formatdate($data['cocdate']);
        $data['dob'] = $this->formatdate($data['dob']);
        $data['intectexpiry'] = $this->formatdate($data['intectexpiry']);
        $data['lotexpiry'] = $this->formatdate($data['lotexpiry']);
        $data['receiveronedate'] = $this->formatdate($data['receiveronedate']);
        $data['receivertwodate'] = $this->formatdate($data['receivertwodate']);
        $drugtestdata = '';
        if (!empty($data['drugtest'])) {
            if (!empty($data['drugtest'][0])) {
                $drugtestdata = $data['drugtest'][0];
            }
            if (!empty($data['drugtest'][1])) {
                $drugtestdata = $drugtestdata . ',' . $data['drugtest'][1];
            }
        }
        $data['drugtest'] = $drugtestdata;
        $this->set_fieldReq(sanitize_all_html_input(trim($data['cocdate'])), 'cocdate', 'Date', true, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['drugtest'])), 'drugtest', 'Drug to be tested', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['dob'])), 'dob', 'DOB', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['employeetype'])), 'employeetype', 'Employment Type', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['contractor'])), 'contractor', 'Contractor Details', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['idtype'])), 'idtype', 'ID Type', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['idnumber'])), 'idnumber', 'ID Number', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['donorsign'])), 'donorsign', 'Donor Signature', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['voidtime'])), 'voidtime', 'Void Time', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['sampletempc'])), 'sampletempc', 'Sample Temp C', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['tempreadtime'])), 'tempreadtime', 'Temp Read Time within 4 min', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['intect'])), 'intect', 'Intect 7 Lot. No.', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['intectexpiry'])), 'intectexpiry', 'Intect 7 Expiry', true, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['visualcolor'])), 'visualcolor', 'Visual Color', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['creatinine'])), 'creatinine', 'Creatinine', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['otherintegrity'])), 'otherintegrity', 'Other Integrity', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['hudration'])), 'hudration', 'Hudration', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['devicename'])), 'devicename', 'Device Name', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['reference'])), 'reference', 'Reference', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['lotno'])), 'lotno', 'Lot No.', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['lotexpiry'])), 'lotexpiry', 'Lot Expiry', true, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['cocain'])), 'cocain', 'Cocain', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['amp'])), 'amp', 'AMP', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['mamp'])), 'mamp', 'MAMP', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['thc'])), 'thc', 'THC', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['opiates'])), 'opiates', 'Opiates', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['benzo'])), 'benzo', 'Benzo', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['collectorone'])), 'collectorone', 'Collector 1 Name Number', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['collectorsignone'])), 'collectorsignone', 'Collector 1 Sign', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['collectortwo'])), 'collectortwo', 'Collector 2 Name Number', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['collectorsigntwo'])), 'collectorsigntwo', 'Collector 2 Sign', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['comments'])), 'comments', 'Comments', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['onsitescreeningrepo'])), 'onsitescreeningrepo', 'On-Site Screening Report', true, __VLD_CASE_NUMERIC__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiverone'])), 'receiverone', 'Received By (print)', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiveronedate'])), 'receiveronedate', 'Receiving Date', true, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiveronetime'])), 'receiveronetime', 'Receiving Time', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiveroneseal'])), 'receiveroneseal', 'Seal Intact', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiveronelabel'])), 'receiveronelabel', 'Label/Bar Code', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receiveronesign'])), 'receiveronesign', 'Receiver Signature', true);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwo'])), 'receivertwo', 'Received By (print)', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwodate'])), 'receivertwodate', 'Receiving Date', false, __VLD_CASE_DATE__);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwotime'])), 'receivertwotime', 'Receiving Time', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwoseal'])), 'receivertwoseal', 'Seal Intact', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwolabel'])), 'receivertwolabel', 'Label/Bar Code', false);
        $this->set_fieldReq(sanitize_all_html_input(trim($data['receivertwosign'])), 'receivertwosign', 'Receiver Signature', false);

        if ($this->error) {
            return false;
        } else {
            $updatearr = array(
                'cocdate' => date('Y-m-d', strtotime($data['cocdate'])),
                'drugtest' => $data['drugtest'],
                'dob' => date('Y-m-d', strtotime($data['dob'])),
                'employeetype' => $data['employeetype'],
                'contractor' => $data['contractor'],
                'idtype' => $data['idtype'],
                'idnumber' => $data['idnumber'],
                'donorsign' => $data['donorsign'],
                'voidtime' => $data['voidtime'],
                'sampletempc' => $data['sampletempc'],
                'tempreadtime' => $data['tempreadtime'],
                'intect' => $data['intect'],
                'intectexpiry' => date('Y-m-d', strtotime($data['intectexpiry'])),
                'visualcolor' => $data['visualcolor'],
                'creatinine' => $data['creatinine'],
                'otherintegrity' => $data['otherintegrity'],
                'hudration' => $data['hudration'],
                'devicename' => $data['devicename'],
                'reference' => $data['reference'],
                'lotno' => $data['lotno'],
                'lotexpiry' => date('Y-m-d', strtotime($data['lotexpiry'])),
                'cocain' => $data['cocain'],
                'amp' => $data['amp'],
                'mamp' => $data['mamp'],
                'thc' => $data['thc'],
                'opiates' => $data['opiates'],
                'benzo' => $data['benzo'],
                'collectorone' => $data['collectorone'],
                'collectorsignone' => $data['collectorsignone'],
                'collectortwo' => $data['collectortwo'],
                'collectorsigntwo' => $data['collectorsigntwo'],
                'comments' => $data['comments'],
                'onsitescreeningrepo' => $data['onsitescreeningrepo'],
                'receiverone' => $data['receiverone'],
                'receiveronedate' => date('Y-m-d', strtotime($data['receiveronedate'])),
                'receiveronetime' => $data['receiveronetime'],
                'receiveroneseal' => $data['receiveroneseal'],
                'receiveronelabel' => $data['receiveronelabel'],
                'receiveronesign' => $data['receiveronesign'],
                'receivertwo' => $data['receivertwo'],
                'receivertwodate' => date('Y-m-d', strtotime($data['receivertwodate'])),
                'receivertwotime' => $data['receivertwotime'],
                'receivertwoseal' => $data['receivertwoseal'],
                'receivertwolabel' => $data['receivertwolabel'],
                'receivertwosign' => $data['receivertwosign']
            );
            $cocid = $data['cocid'];

            $whereAry = array('id' => (int)$cocid);
            $this->db->where($whereAry)
                ->update(__DBC_SCHEMATA_COC_FORM__, $updatearr);
            /*$q = $this->db->last_query();
            echo $q;*/
            if ($this->db->affected_rows() > 0) {
                if ($data['status'] == '1') {
                    $statusarr = array('cocstatus' => '1');
                    $conditionarr = array('cocid' => (int)$cocid);
                    $this->db->where($conditionarr)
                        ->update(__DBC_SCHEMATA_DONER__, $statusarr);
                    if ($this->db->affected_rows() > 0) {
                        $this->addError("success", "COC data saved successfully");
                        return true;
                    }
                }
                $this->addError("success", "COC data saved successfully");
                return true;
            } else {
                if ($data['status'] == '1') {
                    $statusarr = array('cocstatus' => '1');
                    $conditionarr = array('cocid' => (int)$cocid);
                    $this->db->where($conditionarr)
                        ->update(__DBC_SCHEMATA_DONER__, $statusarr);
                    if ($this->db->affected_rows() > 0) {
                        $this->addError("successcomplete", "COC data saved successfully");
                        return true;
                    }
                } else {
                    $this->addError("error", "Due to some error COC data is not saved successfully. Please try again.");
                    return false;
                }

            }
        }
    }

    function getuserhierarchybysiteid($siteid)
    {
        $whereAry = 'client.clientId =' . (int)$siteid . ' AND user.isDeleted = 0';
        $query = $this->db->select('client.franchiseeId, user.szName')
            ->from(__DBC_SCHEMATA_CLIENT__ . ' as client')
            ->join(__DBC_SCHEMATA_USERS__ . ' as user', 'client.franchiseeId = user.id')
            ->where($whereAry)
            ->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            $this->addError("norecord", "No record found.");
        }
    }

    function marksoscomplete($sosid)
    {
        $statusarr = array('Status' => '1');
        $conditionarr = array('id' => (int)$sosid);
        $this->db->where($conditionarr)
            ->update(__DBC_SCHEMATA_SOS_FORM__, $statusarr);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            $this->addError("error", "Something went wrong. Please try again.");
            return false;
        }
    }

} 