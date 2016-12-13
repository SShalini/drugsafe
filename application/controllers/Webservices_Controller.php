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
}