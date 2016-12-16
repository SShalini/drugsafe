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
                $responsedata = array("code" => 202,"message"=>$errorMsgArr['szPassword']);
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
        $userDetailsArr = $this->Webservices_Model->getclientdetails($franchiseeid,$parentid);
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
                $responsedata = array("code" => 111,"message"=>"Bad Request.");
                header('Content-Type: application/json');
        }
        echo json_encode($responsedata);
    }
    function addsosdata(){
        $jsondata = json_decode(file_get_contents("php://input"));
        $dataArr['sosdate'] = !empty($jsondata->sosdate) ? $jsondata->sosdate : date('d/m/Y');
        $dataArr['reqclient'] = !empty($jsondata->reqclient) ? $jsondata->reqclient : "0";
        $dataArr['site'] = !empty($jsondata->site) ? $jsondata->site : "0";
        $drug = '';
        if(!empty($jsondata->drugtest)){
            foreach ($jsondata->drugtest as $key=>$value){
                $drug .= $value.',';
            }
            if(!empty($drug)){
                $drug = substr($drug,0,-1);
            }
        }
        $dataArr['drugtest'] = $drug;
        $dataArr['status'] = !empty($jsondata->status) ? $jsondata->status : "0";;
        $dataArr['servicecomm'] = !empty($jsondata->servicecomm) ? $jsondata->servicecomm : "";
        $dataArr['donercount'] = !empty($jsondata->donercount) ? $jsondata->donercount : "1";
        $dataArr['servicecon'] = !empty($jsondata->servicecon) ? $jsondata->servicecon : "";
        $dataArr['totscreenu'] = !empty($jsondata->totscreenu) ? $jsondata->totscreenu : "0";
        $dataArr['totscreeno'] = !empty($jsondata->totscreeno) ? $jsondata->totscreeno : "0";
        $dataArr['negresu'] = !empty($jsondata->negresu) ? $jsondata->negresu : "0";
        $dataArr['negreso'] = !empty($jsondata->negreso) ? $jsondata->negreso : "0";
        $dataArr['furtestu'] = !empty($jsondata->furtestu) ? $jsondata->furtestu : "0";
        $dataArr['furtesto'] = !empty($jsondata->furtesto) ? $jsondata->furtesto : "0";
        $dataArr['totalcscreen'] = !empty($jsondata->totalcscreen) ? $jsondata->totalcscreen : "0";
        $dataArr['negalcres'] = !empty($jsondata->negalcres) ? $jsondata->negalcres : "0";
        $dataArr['posalcres'] = !empty($jsondata->posalcres) ? $jsondata->posalcres : "0";
        $dataArr['refusals'] = !empty($jsondata->refusals) ? $jsondata->refusals : "0";
        $dataArr['devicename'] = !empty($jsondata->devicename) ? $jsondata->devicename : "";
        $dataArr['extraused'] = !empty($jsondata->extraused) ? $jsondata->extraused : "0";
        $dataArr['breathtest'] = !empty($jsondata->breathtest) ? $jsondata->breathtest : "0";
        $dataArr['comments'] = !empty($jsondata->comments) ? $jsondata->comments : "";
        $dataArr['nominated'] = !empty($jsondata->nominated) ? $jsondata->nominated : "";
        $dataArr['sign'] = !empty($jsondata->sign) ? $jsondata->sign : "";
        for($i=1;$i<=$dataArr['donercount'];$i++){
            $namevar = 'name'.$i;
            $resultvar = 'result'.$i;
            $drugvar = 'drug'.$i;
            $alcoholvar = 'alcohol'.$i;
            $labvar = 'lab'.$i;
            $drugtypevar = 'drugtype'.$i;
            $pos1readvar = 'pos1read'.$i;
            $pos2readvar = 'pos2read'.$i;
            $dataArr['name'.$i] = !empty($jsondata->$namevar) ? $jsondata->$namevar : "";
            $dataArr['result'.$i] = !empty($jsondata->$resultvar) ? $jsondata->$resultvar : "0";
            $dataArr['drug'.$i] = !empty($jsondata->$drugvar) ? $jsondata->$drugvar : "0";
            $dataArr['alcohol'.$i] = !empty($jsondata->$alcoholvar) ? $jsondata->$alcoholvar : "0";
            $dataArr['lab'.$i] = !empty($jsondata->$labvar) ? $jsondata->$labvar : "";
            $drugtype = '';
            if(!empty($jsondata->$drugtypevar)){
                $drugtype = '';
                foreach ($jsondata->$drugtypevar as $key=>$value){
                    $drugtype .= $value.',';
                }
                if(!empty($drugtype)){
                    $drugtype = substr($drugtype,0,-1);
                }
            }
            $dataArr['drugtype'.$i] = $drugtype;
            $dataArr['pos1read'.$i] = !empty($jsondata->$pos1readvar) ? $jsondata->$pos1readvar : "";
            $dataArr['pos2read'.$i] = !empty($jsondata->$pos2readvar) ? $jsondata->$pos2readvar : "";
        }
        if(($dataArr['furtestu']>0) || ($dataArr['furtesto']>0)){
            $dataArr['furthertestreq'] = '1';
        }else{
            $dataArr['furthertestreq'] = '0';
        }


        if(!empty($dataArr))
        {
            $sosdatares = $this->Webservices_Model->addsosdata($dataArr);
            if(!empty($sosdatares)){
                $responsedata = array("code" => 201,
                    "errordata"=>$sosdatares);
            }else{
                $responsedata = array("code" => 200,
                    "message"=>"SOS form data added successfully.");
            }
        }else{
            $responsedata = array("code" => 111,"message"=>"Bad Request.");
        }
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }
}