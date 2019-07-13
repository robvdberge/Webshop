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
    public function getUser($id)
    {
        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function checkMail($email)
    {
        $query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $result = $this->db->select($query);
        return $result;
    }

    public function UserLogin($data)
    {
        $naam = $data['naam'];
        $pwd = $data['pwd'];
        // sanitize input
        $naam           = $this->fm->validate($naam); // sanitize input
        $pwd            = $this->fm->validate($pwd); // sanitize input
        $naam           = mysqli_real_escape_string($this->db->link, $naam);
        $pwd            = mysqli_real_escape_string($this->db->link, $pwd);
        if ( $naam == "" || $pwd == ""){
            $msg = "Er mogen geen lege velden zijn";
            return $msg;
        } 
        $query = "SELECT * FROM tbl_user WHERE naam = '$naam' OR email = '$naam'";
        $result = $this->db->select($query);
        if ( !$result ){
            $msg = "<span class='error'>Deze naam of emailadres is niet bekend</span>";
            return $msg;
        } else { // user bekend in database -> checkpassword
            $checkPwd = $this->checkPwd($naam, $pwd);
            if ( !$checkPwd ){
                $msg = "<span class='error'>Onjuist wachtwoord</span>";
                return $msg;
            } else {
                $value = $result->fetch_assoc();
                Session::set('userLogin', TRUE );
                Session::set('userId', $value['id']);
                Session::set('userName', $value['naam']);

                header('location: profile.php');
            }
        }
    }

    public function checkPwd($naam, $pwd)
    {
        $query = "SELECT * FROM tbl_user WHERE naam = '$naam' OR email = '$naam'";
        $result = $this->db->select($query);
        $result = $result->fetch_assoc();
        $pwdDb = $result['pwd'];
        $pwdCheck = password_verify($pwd, $pwdDb);
        if ( $pwdCheck ){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // Update
    public function userUpdate($data)
    {
        $naam           = $this->fm->validate($data['naam']); // sanitize input
        $adres          = $this->fm->validate($data['adres']); // sanitize input
        $woonplaats     = $this->fm->validate($data['woonplaats']); // sanitize input
        $postcode       = $this->fm->validate($data['postcode']); // sanitize input
        $land           = $this->fm->validate($data['land']); // sanitize input
        $telnummer      = $this->fm->validate($data['telnummer']); // sanitize input
        $email          = $this->fm->validate($data['email']); // sanitize input

        $naam           = mysqli_real_escape_string($this->db->link, $naam);
        $adres          = mysqli_real_escape_string($this->db->link, $adres);
        $woonplaats     = mysqli_real_escape_string($this->db->link, $woonplaats);
        $postcode       = mysqli_real_escape_string($this->db->link, $postcode);
        $land           = mysqli_real_escape_string($this->db->link, $land);
        $telnummer      = mysqli_real_escape_string($this->db->link, $telnummer);
        $email          = mysqli_real_escape_string($this->db->link, $email);
        $id = $data['id'];
        
        if ( $naam == "" || $adres == "" || $woonplaats == "" || $postcode == "" || $land == "" || $telnummer == "" || $email == ""){
            $msg = '<span class="error">Er mogen geen lege velden ingevoerd zijn</span>';
            return $msg;
        } else{
            $query = "UPDATE tbl_user 
            SET
                naam = '$naam', 
                adres = '$adres', 
                woonplaats = '$woonplaats', 
                postcode = '$postcode', 
                land = '$land', 
                telnummer = '$telnummer', 
                email = '$email'
            WHERE id = '$id' ";

            $result = $this->db->update($query);
            if ( $result ){
                $msg = "<span class='success'>Uw wijzigingen zijn opgeslagen</span>";
                return $msg;
            } else{
                $msg = "<span class='error'>Uw wijzigingen zijn NIET opgeslagen</span>";
                return $msg;
            }
        }
    }

    // Delete
}
