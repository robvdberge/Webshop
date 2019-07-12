<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';

// tbl_user: id ,  naam   ,  adres , woonplaats, postcode ,  land, telnummer ,email,   pwd 
//   type:  (int) (varchar)(varchar)(varchar)    (varchar) (varchar)  (int) (varchar)(varchar)

// User Class for front-view
class User{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    // Create
    public function userRegistrate($data)
    {
        $naam           = $this->fm->validate($data['naam']); // sanitize input
        $adres          = $this->fm->validate($data['adres']); // sanitize input
        $woonplaats     = $this->fm->validate($data['woonplaats']); // sanitize input
        $postcode       = $this->fm->validate($data['postcode']); // sanitize input
        $land           = $this->fm->validate($data['land']); // sanitize input
        $telnummer      = $this->fm->validate($data['telnummer']); // sanitize input
        $pwd            = $this->fm->validate($data['pwd']); // sanitize input
        $email          = $this->fm->validate($data['email']); // sanitize input
        
        $naam           = mysqli_real_escape_string($this->db->link, $naam);
        $adres          = mysqli_real_escape_string($this->db->link, $adres);
        $woonplaats     = mysqli_real_escape_string($this->db->link, $woonplaats);
        $postcode       = mysqli_real_escape_string($this->db->link, $postcode);
        $land           = mysqli_real_escape_string($this->db->link, $land);
        $telnummer      = mysqli_real_escape_string($this->db->link, $telnummer);
        $email          = mysqli_real_escape_string($this->db->link, $email);
        $pwd            = mysqli_real_escape_string($this->db->link, $pwd);

        // Password hash
        $pwd = password_hash($pwd, PASSWORD_DEFAULT); // check with password_verify($pwd, $pwdFromDb);

        if ( $naam == "" || $adres == "" || $woonplaats == "" || $postcode == "" || $land == "" || $telnummer == "" || $email == "" || $pwd == ""){
            $msg = '<span class="error">Er mogen geen lege velden ingevoerd zijn</span>';
            return $msg;
        } elseif ($this->checkMail($email)) {
            // check of het Emailadres al bestaat
            return "<span class='error'>Het ingevoerde emailadres bestaat al, kies een andere of klik op wachtwoord vergeten</span>";
            
        } else {
            $query = "INSERT INTO tbl_user(
                naam, 
                adres, 
                woonplaats, 
                postcode, 
                land, 
                telnummer, 
                email,
                pwd) 
                VALUES(
                    '$naam', 
                    '$adres', 
                    '$woonplaats', 
                    '$postcode', 
                    '$land', 
                    '$telnummer', 
                    '$email',
                    '$pwd' )";

            $result = $this->db->insert($query);
            if ( $result ){
                $msg = '<span class="success">Uw account is succesvol aangemaakt</span>';
                return $msg;
            } else{
                $msg = '<span class="error">Er is iets foutgegaan tijdens het aanmaken</span>';
                return $msg;
            }
        }
       
    }

    // Read
    public function checkMail($email)
    {
        $query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $result = $this->db->select($query);
        return $result;
    }

    public function login($naam, $pwd)
    {
        // sanitize input
        $naam           = $this->fm->validate($naam); // sanitize input
        $pwd          = $this->fm->validate($pwd); // sanitize input
        $naam           = mysqli_real_escape_string($this->db->link, $naam);
        $pwd          = mysqli_real_escape_string($this->db->link, $pwd);

        $query = "SELECT * FROM tbl_user WHERE naam OR email = '$naam'";
        $result = $this->db->select($query)->fetch_assoc();
        $pwdCheck = password_verify($result['pwd'], $pwd);
        if ( !$pwdCheck ){
            return "De naam/email en wachtwoord combinatie is niet juist";
        } else {

        }
    }
    // Update

    // Delete
}