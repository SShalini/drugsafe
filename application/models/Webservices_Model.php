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
                $whereAry = array('szEmail' => $data['szEmail'], 'szPassword' => encrypt($data['szPassword']), 'isDeleted' => 0);
                $query =  $this->db->select('id, szName, szEmail, iRole')
                                    ->from(__DBC_SCHEMATA_USERS__)
                                    ->where($whereAry)
                                    ->get();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();

                    $userAry['id'] = $row[0]['id'];
                    $userAry['szName'] = $row[0]['szName'];
                    $userAry['szEmail'] = $row[0]['szEmail'];
                    $userAry['iRole'] = $row[0]['iRole'];
                    return $userAry;
                }else{
                    $this->addError("szPassword", "You have entered wrong password, please try again.");
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

    function set_szEmail($value,$field=false,$message=false , $flag = true)
    {
        $this->data['szEmail'] = $this->validateInput($value, __VLD_CASE_EMAIL__, $field, $message, false, false, $flag);
    }

    function set_szPassword($value, $flag=true)
    {
        $this->data['szPassword'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szPassword", "Password", 5, false, $flag);
    }

}