<?php
include '../lib/database.php';
include '../helpers/format.php';

// Brands class 

class Brand{
    private $fm;
    private $db;

    public function __construct(){
        $this->fm = new Format;
        $this->db = new Database;
    }
    // C
    public function brandInsert($brandName){
        $brandName = $this->fm->validate($brandName); // sanitize input
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if ( empty($brandName) || empty($brandName) ){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        };
        $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
        
        $brandInsert = $this->db->insert($query);
        if ( $brandInsert){
            $msg = '<span class="success">Brand is succesvol ingevoerd</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }
    // R
    public function getAllBrands(){
        $query = "SELECT * FROM tbl_brand ORDER BY brandName ASC";
        $allBrands = $this->db->select($query);
        return $allBrands;
    }
    public function getBrandById($id){
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    // U
    public function brandUpdate($brandName, $id){
        $brandName = $this->fm->validate($brandName); // sanitize input
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if ( empty($brandName) || empty($id) ){
            $msg = '<span class="error">Er mogen geen lege velden ingevoerd zijn</span>';
            return $msg;
        };
        $query = "UPDATE tbl_brand 
        SET 
            brandName = '$brandName' 
        WHERE 
            brandId = '$id'";
        
        $brandUpdate = $this->db->update($query);
        if ( $brandUpdate){
            $msg = '<span class="success">Het merk is succesvol geupdate</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }
    // D
    public function brandDelById($id){
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $brandDel = $this->db->delete($query);
        if ($brandDel) {
            $msg = "<span class='success'>Het merk is succesvol verwijdert</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Er is iets foutgegaan bij verwijdering</span>";
            return $msg;
        }
    }
}