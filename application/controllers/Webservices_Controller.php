<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservices_Controller extends CI_Controller
{
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Error_Model');
        $this->load->model('Webservices_Model');
    }

    public function index()
    {
        $message = 'Permission Denied!!!';
        $responsedata = array("message"=>$message);
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    public function userlogin(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['user']['szEmail'] = !empty($jsondata->szEmail) ? $jsondata->szEmail : "";
        $data['user']['szPassword'] = !empty($jsondata->szPassword) ? $jsondata->szPassword : "";
        $data['user']['szrole'] = !empty($jsondata->szrole) ? $jsondata->szrole : "cl";
        $userLoginArr = $this->Webservices_Model->validateuser($data['user']);
        if(!empty($userLoginArr))
        {
            $responsedata = array("code" => 200,"message"=>"User logged in sucessfully.","userid"=>$userLoginArr['id'], "role"=>$userLoginArr['iRole']);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['szEmail'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['szEmail']);
                header('Content-Type: application/json');

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['szPassword'])){
                $responsedata = array("code" => 202,"message"=>"Wrong credentials");
                header('Content-Type: application/json');
            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getuserdetails(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $userid = !empty($jsondata->userid) ? $jsondata->userid : "";
        $userDetailsArr = $this->Webservices_Model->getuserdetails($userid);
        if(!empty($userDetailsArr))
        {
            $responsedata = array("code" => 200,
                "message"=>"User record retrieved successfully.",
                "userid"=>$userDetailsArr[0]['id'],
                "szName"=>$userDetailsArr[0]['szName'],
                "szEmail"=>$userDetailsArr[0]['szEmail'],
                "iRole"=>$userDetailsArr[0]['iRole']);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['usernotexist'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['usernotexist']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getclientdetails(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $franchiseeid = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $parentid = !empty($jsondata->parentid) ? $jsondata->parentid : "0";
        $agentid = !empty($jsondata->agentid) ? $jsondata->agentid : "0";
        $userDetailsArr = $this->Webservices_Model->getclientdetails($franchiseeid,$parentid,$agentid);
        if(!empty($userDetailsArr))
        {
            $responsedata = array("code" => 200,
                "message"=>"Franchisee clients"/"sites record retrieved successfully.",
                "userid"=>$userDetailsArr[0]['id'],
                "szName"=>$userDetailsArr[0]['szName'],
                "szEmail"=>$userDetailsArr[0]['szEmail'],
                "dataarr"=>$userDetailsArr);
            header('Content-Type: application/json');
        }else{
                $responsedata = array("code" => 111,"message"=>$userDetailsArr);
                header('Content-Type: application/json');
        }
        echo json_encode($responsedata);
    }

    function addsosdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $dataArr['sosdate'] = !empty($jsondata->sosdate) ? $jsondata->sosdate : "";
        $dataArr['reqclient'] = !empty($jsondata->reqclient) ? $jsondata->reqclient : "";
        $dataArr['site'] = !empty($jsondata->site) ? $jsondata->site : "";
        $drug = '';
        $dsarrcount = count($jsondata->drugtest);
        if($dsarrcount == '1'){
            $drug = $jsondata->drugtest;
        }elseif(($dsarrcount > '1') && !empty($jsondata->drugtest)){
            foreach ($jsondata->drugtest as $key=>$value){
                $drug .= $value.',';
            }
            if(!empty($drug)){
                $drug = substr($drug,0,-1);
            }
        }
        $dataArr['drugtest'] = $drug;
        $dataArr['formtype'] = $jsondata->formtype;
        $dataArr['status'] = !empty($jsondata->status) ? $jsondata->status : "0";
        $dataArr['servicecomm'] = !empty($jsondata->servicecomm) ? $jsondata->servicecomm : "";
        $dataArr['donercount'] = !empty($jsondata->donercount) ? $jsondata->donercount : "1";
        $dataArr['servicecon'] = !empty($jsondata->servicecon) ? $jsondata->servicecon : "";
        $dataArr['totscreenu'] = $jsondata->totscreenu;
        $dataArr['totscreeno'] = $jsondata->totscreeno;
        $dataArr['negresu'] = $jsondata->negresu;
        $dataArr['negreso'] = $jsondata->negreso;
        $dataArr['furtestu'] = $jsondata->furtestu;
        $dataArr['furtesto'] = $jsondata->furtesto;
        $dataArr['totalcscreen'] = $jsondata->totalcscreen;
        $dataArr['negalcres'] = $jsondata->negalcres;
        $dataArr['posalcres'] = $jsondata->posalcres;
        $dataArr['refusals'] = $jsondata->refusals;
        $dataArr['devicename'] = !empty($jsondata->devicename) ? $jsondata->devicename : "";
        $dataArr['extraused'] = !empty($jsondata->extraused) ? $jsondata->extraused : "";
        $dataArr['breathtest'] = !empty($jsondata->breathtest) ? $jsondata->breathtest : "";
        $dataArr['collsign'] = !empty($jsondata->collsign) ? $jsondata->collsign : "";
        $dataArr['comments'] = !empty($jsondata->comments) ? $jsondata->comments : "";
        $dataArr['nominated'] = !empty($jsondata->nominated) ? $jsondata->nominated : "";
        $dataArr['nominedec'] = !empty($jsondata->nominedec) ? $jsondata->nominedec : "";
        $dataArr['sign'] = !empty($jsondata->sign) ? $jsondata->sign : "";
        $dataArr['update'] = !empty($jsondata->update) ? $jsondata->update : "";
        $dataArr['donercountpre'] = !empty($jsondata->donercountpre) ? $jsondata->donercountpre : "";
        $dataArr['donercountpost'] = !empty($jsondata->donercountpost) ? $jsondata->donercountpost : "";
        $dataArr['newdonerids'] = !empty($jsondata->newdonerids) ? $jsondata->newdonerids : "";
        $dataArr['idsos'] = !empty($jsondata->idsos) ? $jsondata->idsos : "";
        $dataArr['cocstat'] = !empty($jsondata->cocstat) ? $jsondata->cocstat : "0";
        $dataArr['kitcount'] = !empty($jsondata->kitcount) ? $jsondata->kitcount : "1";
        $dataArr['oldkitcount'] = !empty($jsondata->oldkitcount) ? $jsondata->oldkitcount : "0";
        $dataArr['totalkitcount'] = !empty($jsondata->totalkitcount) ? $jsondata->totalkitcount : "0";
        $dataArr['newkitids'] = !empty($jsondata->newkitids) ? $jsondata->newkitids : "";
        for($i=1;$i<=$dataArr['donercount'];$i++){
            $namevar = 'name'.$i;
            $resultvar = 'result'.$i;
            $drugvar = 'drug'.$i;
            $alcoholvar = 'alcohol'.$i;
            $labvar = 'lab'.$i;
            $drugtypevar = 'drugtype'.$i;
            $pos1readvar = 'pos1read'.$i;
            $pos2readvar = 'pos2read'.$i;
            $idcoc = 'idcoc'.$i;
            $iddonor = 'iddonor'.$i;
            $dataArr['name'.$i] = !empty($jsondata->$namevar) ? $jsondata->$namevar : "";
            $dataArr['result'.$i] = !empty($jsondata->$resultvar) ? $jsondata->$resultvar : "0";
            $dataArr['drug'.$i] = !empty($jsondata->$drugvar) ? $jsondata->$drugvar : "0";
            $dataArr['alcohol'.$i] = !empty($jsondata->$alcoholvar) ? $jsondata->$alcoholvar : "0";
            $dataArr['lab'.$i] = !empty($jsondata->$labvar) ? $jsondata->$labvar : "";
            $dataArr['idcoc'.$i] = !empty($jsondata->$idcoc) ? $jsondata->$idcoc : "0";
            $dataArr['iddonor'.$i] = !empty($jsondata->$iddonor) ? $jsondata->$iddonor : "";
            $drugtype = '';
            if(!empty($jsondata->$drugtypevar)){
                $drugtype = '';
                if(count($jsondata->$drugtypevar)>'1'){
                    foreach ($jsondata->$drugtypevar as $key=>$value){
                        $drugtype .= $value.',';
                    }
                    if(!empty($drugtype)){
                        $drugtype = substr($drugtype,0,-1);
                    }
                }else{
                    $drugtype = $jsondata->$drugtypevar;
                }

            }
            $dataArr['drugtype'.$i] = $drugtype;
            $dataArr['pos1read'.$i] = !empty($jsondata->$pos1readvar) ? $jsondata->$pos1readvar : "";
            $dataArr['pos2read'.$i] = !empty($jsondata->$pos2readvar) ? $jsondata->$pos2readvar : "";
        }

        for($dc=1;$dc<=$dataArr['kitcount'];$dc++){
            $prodvar = 'kit'.$dc;
            $qtyvar = 'kitqty'.$dc;
            $kitidvar = 'kitid'.$dc;
            $dataArr['kit'.$dc] = !empty($jsondata->$prodvar) ? $jsondata->$prodvar : "";
            $dataArr['kitqty'.$dc] = !empty($jsondata->$qtyvar) ? $jsondata->$qtyvar : "0";
            $dataArr['kitid'.$dc] = !empty($jsondata->$kitidvar) ? $jsondata->$kitidvar : "0";
        }

        if(($dataArr['furtestu']>0) || ($dataArr['furtesto']>0)){
            $dataArr['furthertestreq'] = '1';
        }else{
            $dataArr['furthertestreq'] = '0';
        }

        if(!empty($dataArr))
        {
            $sosdatares = $this->Webservices_Model->addsosdata($dataArr);
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['testdate'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['testdate']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['site'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['site']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['drugtest'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['drugtest']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['servicecomm'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['servicecomm']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['servicecon'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['servicecon']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['totscreenu'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['totscreenu']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['totscreeno'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['totscreeno']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['negresu'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['negresu']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['negreso'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['negreso']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['furtestu'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['furtestu']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['furtesto'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['furtesto']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['totalcscreen'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['totalcscreen']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['negalcres'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['negalcres']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['posalcres'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['posalcres']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['refusals'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['refusals']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['devicename'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['devicename']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['extraused'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['extraused']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['breathtest'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['breathtest']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['collsign'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['collsign']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['nominated'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['nominated']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['nominedec'])){
                $responsedata = array("code" => 203, "message"=>$errorMsgArr['nominedec']);
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['sign'])){
                $responsedata = array("code" => 203, "message"=>"Nominated Client Representative signature required.");
            }elseif(!empty($sosdatares['totalcoccount'][0]['totalcoc'])){
                $coccount = (int)$sosdatares['totalcoccount'][0]['totalcoc'];
                $cocid = (int)$sosdatares['cocid'][0]['cocid'];
                if((int)$coccount > '1'){
                    $responsedata = array("code" => 200, "count"=>(int)$coccount, "sosid"=>$sosdatares['sosid'],"message"=>"SOS form data saved successfully.");
                }else{
                    $responsedata = array("code" => 200, "count"=>(int)$coccount, "sosid"=>$sosdatares['sosid'], "cocid" => $cocid,"message"=>"SOS form data saved successfully.");
                }

            }elseif(!empty($sosdatares)){
                $responsedata = array("code" => 201, "errordata"=>$sosdatares);
            }else{
                $responsedata = array("code" => 200, "message"=>"SOS form data added successfully.");
            }
        }else{
            $responsedata = array("code" => 111,"message"=>"Bad Request.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getsosformdatabysiteid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['siteid'] = !empty($jsondata->siteid) ? $jsondata->siteid : "";
        $data['status'] = !empty($jsondata->status) ? $jsondata->status : "0";
        $sosformdata = $this->Webservices_Model->getsosformdata($data['siteid'],$data['status']);
        if(!empty($sosformdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$sosformdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getsossitesbyfranchiseeid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['siteid'] = !empty($jsondata->siteid) ? $jsondata->siteid : "";
        $sosformdata = $this->Webservices_Model->getsossitesbyfranchiseeid($data['siteid']);
        if(!empty($sosformdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$sosformdata);
            header('Content-Type: application/json');
        }else{
                $responsedata = array("code" => 201,"message"=>'No site found');
                header('Content-Type: application/json');
        }
        echo json_encode($responsedata);
    }

    function getclientsites(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['clientid'] = !empty($jsondata->clientid) ? $jsondata->clientid : "";
        $clientdata = $this->Webservices_Model->getclientsites($data['clientid']);
        if(!empty($clientdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$clientdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getfranchiseeclients(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $franchiseedata = $this->Webservices_Model->getfranchiseeclients($data['franchiseeid']);
        if(!empty($franchiseedata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$franchiseedata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }
    function getfranchiseesites(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $franchiseesitesdata = $this->Webservices_Model->getfranchiseesites($data['franchiseeid']);
        if(!empty($franchiseesitesdata[0]))
        {
            $responsedata = array("code" => 200,"dataarr"=>$franchiseesitesdata[0]);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getclientsallsosdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['clientid'] = !empty($jsondata->clientid) ? $jsondata->clientid : "";
        $clientsosdata = $this->Webservices_Model->getclientsosformdata($data['clientid']);
        if(!empty($clientsosdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$clientsosdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getfranchiseesosdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $data['status'] = $jsondata->status == '1' ? true : false;
        $franchiseesosdata = $this->Webservices_Model->getfranchiseesosformdata($data['franchiseeid']);
        if(!empty($franchiseesosdata[0]))
        {
            $responsedata = array("code" => 200,"dataarr"=>$franchiseesosdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getagentsosdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['agentid'] = !empty($jsondata->agentid) ? $jsondata->agentid : "";
        $data['status'] = $jsondata->status == '1' ? true : false;
        $agentsosdata = $this->Webservices_Model->getagentsosformdata($data['agentid']);
        if(!empty($agentsosdata[0]))
        {
            $responsedata = array("code" => 200,"dataarr"=>$agentsosdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getdonorsbysosid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['sosid'] = !empty($jsondata->sosid) ? $jsondata->sosid : "";
        $donordata = $this->Webservices_Model->getdonorsbysosid($data['sosid']);
        if(!empty($donordata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$donordata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function getsosbycocid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['cocid'] = !empty($jsondata->cocid) ? $jsondata->cocid : "";
        $sosdata = $this->Webservices_Model->getsosdatabycocid($data['cocid']);
        if(!empty($sosdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$sosdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function addcocdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['coc']['cocdate'] = !empty($jsondata->cocdate) ? $jsondata->cocdate : "";
        $data['coc']['drugtest'] = !empty($jsondata->drugtest) ? $jsondata->drugtest : "";
        $data['coc']['dob'] = !empty($jsondata->dob) ? $jsondata->dob : "";
        $data['coc']['employeetype'] = !empty($jsondata->employeetype) ? $jsondata->employeetype : "";
        $data['coc']['contractor'] = !empty($jsondata->contractor) ? $jsondata->contractor : "";
        $data['coc']['idtype'] = !empty($jsondata->idtype) ? $jsondata->idtype : "";
        $data['coc']['idnumber'] = !empty($jsondata->idnumber) ? $jsondata->idnumber : "";
        $data['coc']['lastweekq'] = !empty($jsondata->lastweekq) ? $jsondata->lastweekq : "";
        $data['coc']['donorsign'] = !empty($jsondata->donorsign) ? $jsondata->donorsign : "";
        $data['coc']['voidtime'] = trim($jsondata->voidtime) == ':' ? "":$jsondata->voidtime;
        $data['coc']['sampletempc'] = !empty($jsondata->sampletempc) ? $jsondata->sampletempc : "";
        $data['coc']['tempreadtime'] = trim($jsondata->tempreadtime) == ':' ? "":$jsondata->tempreadtime;
        $data['coc']['intect'] = !empty($jsondata->intect) ? $jsondata->intect : "";
        $data['coc']['intectexpiry'] = !empty($jsondata->intectexpiry) ? $jsondata->intectexpiry : "";
        $data['coc']['visualcolor'] = !empty($jsondata->visualcolor) ? $jsondata->visualcolor : "";
        $data['coc']['creatinine'] = !empty($jsondata->creatinine) ? $jsondata->creatinine : "";
        $data['coc']['otherintegrity'] = !empty($jsondata->otherintegrity) ? $jsondata->otherintegrity : "";
        $data['coc']['hudration'] = !empty($jsondata->hudration) ? $jsondata->hudration : "";
        $data['coc']['devicename'] = !empty($jsondata->devicename) ? $jsondata->devicename : "";
        $data['coc']['lotno'] = !empty($jsondata->lotno) ? $jsondata->lotno : "";
        $data['coc']['lotexpiry'] = !empty($jsondata->lotexpiry) ? $jsondata->lotexpiry : "";
        $data['coc']['cocain'] = !empty($jsondata->cocain) ? $jsondata->cocain : "";
        $data['coc']['amp'] = !empty($jsondata->amp) ? $jsondata->amp : "";
        $data['coc']['mamp'] = !empty($jsondata->mamp) ? $jsondata->mamp : "";
        $data['coc']['thc'] = !empty($jsondata->thc) ? $jsondata->thc : "";
        $data['coc']['opiates'] = !empty($jsondata->opiates) ? $jsondata->opiates : "";
        $data['coc']['benzo'] = !empty($jsondata->benzo) ? $jsondata->benzo : "";
        $data['coc']['collectorone'] = !empty($jsondata->collectorone) ? $jsondata->collectorone : "";
        $data['coc']['collectorsignone'] = !empty($jsondata->collectorsignone) ? $jsondata->collectorsignone : "";
        $data['coc']['commentscol1'] = !empty($jsondata->commentscol1) ? $jsondata->commentscol1 : "";
        $data['coc']['collectortwo'] = !empty($jsondata->collectortwo) ? $jsondata->collectortwo : "";
        $data['coc']['collectorsigntwo'] = !empty($jsondata->collectorsigntwo) ? $jsondata->collectorsigntwo : "";
        $data['coc']['comments'] = !empty($jsondata->comments) ? $jsondata->comments : "";
        $data['coc']['onsitescreeningrepo'] = !empty($jsondata->onsitescreeningrepo) ? $jsondata->onsitescreeningrepo : "";
        $data['coc']['receiverone'] = !empty($jsondata->receiverone) ? $jsondata->receiverone : "";
        $data['coc']['receiveronesign'] = !empty($jsondata->receiveronesign) ? $jsondata->receiveronesign : "";
        $data['coc']['receiveronedate'] = !empty($jsondata->receiveronedate) ? $jsondata->receiveronedate : "";
        $data['coc']['receiveronetime'] = trim($jsondata->receiveronetime) == ': AM' || trim($jsondata->receiveronetime) == ': PM'? "":$jsondata->receiveronetime;
        $data['coc']['receiveroneseal'] = !empty($jsondata->receiveroneseal) ? $jsondata->receiveroneseal : "";
        $data['coc']['receiveronelabel'] = !empty($jsondata->receiveronelabel) ? $jsondata->receiveronelabel : "";
        $data['coc']['receivertwo'] = !empty($jsondata->receivertwo) ? $jsondata->receivertwo : "";
        $data['coc']['receivertwosign'] = !empty($jsondata->receivertwosign) ? $jsondata->receivertwosign : "";
        $data['coc']['receivertwodate'] = !empty($jsondata->receivertwodate) ? $jsondata->receivertwodate : "";
        $data['coc']['receivertwotime'] = trim($jsondata->receivertwotime) == ': AM' || trim($jsondata->receivertwotime) == ': PM' ? "":$jsondata->receivertwotime;
        $data['coc']['receivertwoseal'] = !empty($jsondata->receivertwoseal) ? $jsondata->receivertwoseal : "";
        $data['coc']['receivertwolabel'] = !empty($jsondata->receivertwolabel) ? $jsondata->receivertwolabel : "";
        $data['coc']['reference'] = (!empty($jsondata->reference) ? $jsondata->reference : "");
        $data['coc']['cocid'] = (!empty($jsondata->cocid) ? $jsondata->cocid : "");
        $data['coc']['status'] = (!empty($jsondata->status) ? $jsondata->status : "0");
        $data['coc']['devicesrno'] = !empty($jsondata->devicesrno) ? $jsondata->devicesrno : "";
        $data['coc']['cutoff'] = !empty($jsondata->cutoff) ? $jsondata->cutoff : "";
        $data['coc']['donwaittime'] = !empty($jsondata->donwaittime) ? $jsondata->donwaittime : "";
        $data['coc']['dontest1'] = $jsondata->dontest1;
        $data['coc']['dontesttime1'] = trim($jsondata->dontesttime1) == ':' ? "":$jsondata->dontesttime1;
        $data['coc']['dontest2'] = $jsondata->dontest2;
        $data['coc']['dontesttime2'] = trim($jsondata->dontesttime2) == ':' ? "":$jsondata->dontesttime2;
        $data['coc']['donordecdate'] = !empty($jsondata->donordecdate) ? $jsondata->donordecdate : "";
        $data['coc']['donordecsign'] = !empty($jsondata->donordecsign) ? $jsondata->donordecsign : "";
        $donordata = $this->Webservices_Model->addcocdata($data['coc']);
        $errorMsgArr = $this->Webservices_Model->arErrorMessages;
        if($donordata)
        {
            if(!empty($errorMsgArr) && !empty($errorMsgArr['success'])){
                $responsedata = array("code" => 200,"message"=>$errorMsgArr['success']);
            }elseif (!empty($errorMsgArr) && !empty($errorMsgArr['successcomplete'])){
                $responsedata = array("code" => 202,"message"=>$errorMsgArr['successcomplete']);
            }
        }else{

            if(!empty($errorMsgArr) && !empty($errorMsgArr['cocdate'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['cocdate']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['drugtest'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['drugtest']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['dob'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['dob']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['employeetype'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['employeetype']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['idtype'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['idtype']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['idnumber'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['idnumber']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['lastweekq'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['lastweekq']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['donorsign'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['donorsign']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['devicesrno'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['devicesrno']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['cutoff'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['cutoff']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['donwaittime'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['donwaittime']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['dontest1'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['dontest1']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['dontesttime1'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['dontesttime1']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['dontest2'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['dontest2']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['dontesttime2'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['dontesttime2']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['voidtime'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['voidtime']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['sampletempc'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['sampletempc']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['tempreadtime'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['tempreadtime']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['intect'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['intect']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['intectexpiry'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['intectexpiry']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['visualcolor'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['visualcolor']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['creatinine'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['creatinine']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['otherintegrity'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['otherintegrity']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['hudration'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['hudration']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['devicename'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['devicename']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['reference'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['reference']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['lotno'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['lotno']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['lotexpiry'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['lotexpiry']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['cocain'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['cocain']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['amp'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['amp']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['mamp'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['mamp']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['thc'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['thc']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['opiates'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['opiates']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['benzo'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['benzo']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['donordecdate'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['donordecdate']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['donordecsign'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['donordecsign']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['collectorone'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['collectorone']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['collectorsignone'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['collectorsignone']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['collectortwo'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['collectortwo']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['collectorsigntwo'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['collectorsigntwo']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['onsitescreeningrepo'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['onsitescreeningrepo']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiverone'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiverone']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiveronedate'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiveronedate']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiveronetime'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiveronetime']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiveroneseal'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiveroneseal']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiveronelabel'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiveronelabel']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['receiveronesign'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['receiveronesign']);

            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['error'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['error']);

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getuserhierarchybysiteid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['siteid'] = !empty($jsondata->siteid) ? $jsondata->siteid : "";
        $hierdata = $this->Webservices_Model->getuserhierarchybysiteid($data['siteid']);
        if(!empty($hierdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$hierdata);
            header('Content-Type: application/json');
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['norecord'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['norecord']);
                header('Content-Type: application/json');

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
            }
        }
        echo json_encode($responsedata);
    }

    function marksoscomplete(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['sosid'] = !empty($jsondata->sosid) ? $jsondata->sosid : "";
        $sosdata = $this->Webservices_Model->marksoscomplete($data['sosid']);
        if($sosdata){
            $responsedata = array("code" => 200,"message"=>"Status changed sucessfully");
        }else{
            $errorMsgArr = $this->Webservices_Model->arErrorMessages;
            if(!empty($errorMsgArr) && !empty($errorMsgArr['error'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['error']);

            }else{
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function delcoc(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['cocid'] = !empty($jsondata->cocid) ? $jsondata->cocid : "0";
        $delstatus = $this->Webservices_Model->delcoc($data['cocid']);
        if($delstatus)
        {
            $responsedata = array("code" => 200,"message"=>"COC form cancelled successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Some error occured while cancelling COC form. Please try again.");

        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function deldonor(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['donorid'] = !empty($jsondata->donorid) ? $jsondata->donorid : "0";
        $delstatus = $this->Webservices_Model->deldonor($data['donorid']);
        if($delstatus)
        {
            $responsedata = array("code" => 200,"message"=>"Donor deleted successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Some error occured while deleting Donor. Please try again.");

        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getallprodbycatid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['catid'] = !empty($jsondata->catid) ? $jsondata->catid : "0";
        $prodarr = $this->Webservices_Model->getallprodbycatid($data['catid']);
        if($prodarr)
        {
            $responsedata = array("code" => 200,"prodarr"=>$prodarr);
        }else{
            $responsedata = array("code" => 201,"message"=>"No product found.");

        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getallcategories(){
        $catarr = $this->Webservices_Model->getallcategories();
        if($catarr)
        {
            $responsedata = array("code" => 200,"catarr"=>$catarr);
        }else{
            $responsedata = array("code" => 201,"message"=>"No product category found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function addtocart(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['cart']['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $data['cart']['productid'] = !empty($jsondata->productid) ? $jsondata->productid : "";
        $data['cart']['quantity'] = !empty($jsondata->quantity) ? $jsondata->quantity : "";
        $cartAditionStatus = $this->Webservices_Model->addtocart($data['cart']);
        $errorMsgArr = $this->Webservices_Model->arErrorMessages;
        if($cartAditionStatus)
        {
            $responsedata = array("code" => 200,"message"=>"Product successfully added to your cart.");
        }else{
            if(!empty($errorMsgArr) && !empty($errorMsgArr['franchiseeid'])){
                $responsedata = array("code" => 201,"message"=>"Something wrong with franchisee. Please logout and try again.");
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['productid'])){
                $responsedata = array("code" => 201,"message"=>"Something wrong with this product. Please logout and try again.");
            }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['quantity'])){
                $responsedata = array("code" => 201,"message"=>$errorMsgArr['quantity']);
            }else{
                $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function emptycart(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $cartStatus = $this->Webservices_Model->emptycart($data);
        if($cartStatus){
            $responsedata = array("code" => 200,"message"=>"No product is in your cart.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function deleteitemfromcart(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['cart']['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "";
        $data['cart']['productid'] = !empty($jsondata->productid) ? $jsondata->productid : "";
        $cartStatus = $this->Webservices_Model->deleteitemfromcart($data['cart']);
        $errorMsgArr = $this->Webservices_Model->arErrorMessages;
        if($cartStatus){
            $responsedata = array("code" => 200,"message"=>"Product successfully removed from your cart.");
        }elseif(!empty($errorMsgArr) && !empty($errorMsgArr['cartproductid'])){
            $responsedata = array("code" => 201,"message"=>$errorMsgArr['cartproductid']);
        }else{
            $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getfranchiseecartitems(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "0";
        $franchiseeCartArr = $this->Webservices_Model->getfranchiseecartitems($data['franchiseeid']);
        if(!empty($franchiseeCartArr)){
            $responsedata = array("code" => 200,"cartarr"=>$franchiseeCartArr);
        }else{
            $responsedata = array("code" => 201,"message"=>"No product found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function updatecart(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $dataArr['totcartitems'] = !empty($jsondata->totcartitems) ? $jsondata->totcartitems : "0";
        for($i=1;$i<=$dataArr['totcartitems'];$i++){
            $cartidvar = 'cartid'.$i;
            $qtyvar = 'qty'.$i;
            $dataArr['cartid'.$i] = !empty($jsondata->$cartidvar) ? $jsondata->$cartidvar : "0";
            $dataArr['qty'.$i] = !empty($jsondata->$qtyvar) ? $jsondata->$qtyvar : "0";
        }

        if($dataArr['totcartitems']>'0'){
            $updatecartstatus = $this->Webservices_Model->updatecart($dataArr);
            if($updatecartstatus){
                $responsedata = array("code" => 200,"message"=>"Cart updated successfully.");
            }else{
                $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
            }
            header('Content-Type: application/json');
            echo json_encode($responsedata);
        }
    }

    function addorder(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $dataArr['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "0";
        $dataArr['totalprice'] = !empty($jsondata->totalprice) ? $jsondata->totalprice : "0";

        $orderstatus = $this->Webservices_Model->addorder($dataArr);
        if($orderstatus){
            $responsedata = array("code" => 200,"message"=>"Your order has been placed successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);

    }

    function getorderdetails(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $orderid = !empty($jsondata->orderid) ? $jsondata->orderid : "0";
        $orderdetailsArr = $this->Webservices_Model->getorderdetails($orderid);
        if(!empty($orderdetailsArr))
        {
            $responsedata = array("code" => 200,"orderdetailsArr"=>$orderdetailsArr);
        }else{
            $responsedata = array("code" => 201,"message"=>"No order found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function canceldonorcoc(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $donorid = !empty($jsondata->donorid) ? $jsondata->donorid : "0";
        $changestatus = $this->Webservices_Model->canceldonorcoc($donorid);
        if($changestatus)
        {
            $responsedata = array("code" => 200,"message"=>"COC form cancelled successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Something goes wrong. Please try again.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getsavedkitsbysosid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['sosid'] = !empty($jsondata->sosid) ? $jsondata->sosid : "0";
        $data['used'] = !empty($jsondata->used) ? $jsondata->used : "0";
        $kitarr = $this->Webservices_Model->getSavedKitsBySosid($data['sosid'],$data['used']);
        if($kitarr){
            $responsedata = array("code" => 200,"kitarr"=>$kitarr);
        }else{
            $responsedata = array("code" => 201,"message"=>"No product found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function delusedkit(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['kitid'] = !empty($jsondata->kitid) ? $jsondata->kitid : "0";
        $delstatus = $this->Webservices_Model->delUsedKit($data['kitid']);
        if($delstatus)
        {
            $responsedata = array("code" => 200,"message"=>"Selected product removed successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Some error occured while deleting selected product. Please try again.");

        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function testcompletebyinventorycheck(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "0";
        $data['sosid'] = !empty($jsondata->sosid) ? $jsondata->sosid : "0";
        $inventoryStatus = $this->Webservices_Model->inventoryCheck($data['franchiseeid'],$data['sosid']);
        if($inventoryStatus){
            $responsedata = array("code" => 200,"message"=>"Your inventory updated successfully.");
        }else{
            $responsedata = array("code" => 201,"message"=>"Your inventory don't have sufficient amount of products to complete this test. Please upgrade your inventory and try again.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getclientdetailsbyclientid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['clientid'] = !empty($jsondata->clientid) ? $jsondata->clientid : "0";
        $clientdata = $this->Webservices_Model->getclientdetailsbyclientid($data['clientid']);
        if(!empty($clientdata)){
            $responsedata = array("code" => 200,"dataarr"=>$clientdata);
        }else{
            $responsedata = array("code" => 201,"message"=>"No record found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function getsosformdatabysosid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['sosid'] = !empty($jsondata->sosid) ? $jsondata->sosid : "";
        $sosformdata = $this->Webservices_Model->getsosformdatabysosid($data['sosid']);
        if(!empty($sosformdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$sosformdata);
            header('Content-Type: application/json');
        }else{
            $responsedata = array("code" => 201,"message"=>'No site found');
            header('Content-Type: application/json');
        }
        echo json_encode($responsedata);
    }

    function getcocdatabycocid(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['cocid'] = !empty($jsondata->cocid) ? $jsondata->cocid : "";
        $cocformdata = $this->Webservices_Model->getcocdatabycocid($data['cocid']);
        if(!empty($cocformdata))
        {
            $responsedata = array("code" => 200,"dataarr"=>$cocformdata);
            header('Content-Type: application/json');
        }else{
            $responsedata = array("code" => 201,"message"=>'No COC form recorded for this donor.');
            header('Content-Type: application/json');
        }
        echo json_encode($responsedata);
    }

    function getfranchiseeorders(){
            $jsondata = json_decode(file_get_contents("php://input"));
            $data['franchiseeid'] = !empty($jsondata->franchiseeid) ? $jsondata->franchiseeid : "0";
            $franchiseeOrderArr = $this->Webservices_Model->getfranchiseeorders($data['franchiseeid']);
            if(!empty($franchiseeOrderArr)){
                $responsedata = array("code" => 200,"orderarr"=>$franchiseeOrderArr);
            }else{
                $responsedata = array("code" => 201,"message"=>"No order found.");
            }
            header('Content-Type: application/json');
            echo json_encode($responsedata);
    }

    function getagentfranchisee(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $data['agentid'] = !empty($jsondata->agentid) ? $jsondata->agentid : "0";
        $agentArr = $this->Webservices_Model->getagentfranchisee($data['agentid']);
        if(!empty($agentArr)){
            $responsedata = array("code" => 200,"franchiseeid"=>$agentArr[0]['franchiseeid']);
        }else{
            $responsedata = array("code" => 201,"message"=>"No data found.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }
}