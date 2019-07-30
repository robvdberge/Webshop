<?php

include_once '../lib/session.php';
Session::checkLogin();
include_once '../lib/database.php';
include_once '../helpers/format.php';
// table = tbl_admin 
// adminId, adminName, adminUser, adminEmail, adminPass, level
//   int     varchar    varchar     varchar    varchar   tinyint
//
// Class adminlogin

class AdminLogin{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;

    }
    // check de naam en password voor de admin login methode
    public function adminLogin($user, $pass)
    {
        $adminUser = $this->fm->validate($user); // sanitize input
        $adminPass = $this->fm->validate($pass); // sanitize input

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if ( empty($adminUser) || empty($adminPass) ){
            $loginMsg = 'Er mogen geen lege velden ingevoerd zijn';
            return $loginMsg;
        } else {

            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);

            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                Session::set('adminLogin', TRUE);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                header('location: dashboard.php');
                exit();
            } else {
                $loginMsg = 'Loginnaam of passwoord is onjuist';
                return $loginMsg;
            }
            
        }
    }
    

}
