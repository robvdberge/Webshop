<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';
// table = tbl_cart
// catId, catName
//  int   varchar
// Category class
class Category{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;
    }

    // Create
    public function catInsert($catName){
        $catName = $this->fm->validate($catName); // sanitize input
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if ( empty($catName) || empty($catName) ){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        };
        $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
        
        $catInsert = $this->db->insert($query);
        if ( $catInsert){
            $msg = '<span class="success">Category is succesvol ingevoerd</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }

    // Read
    public function getAllCats(){
        $query = "SELECT * FROM tbl_category ORDER BY catName ASC";
        $allCats = $this->db->select($query);
        return $allCats;
    }

    public function getCatById($id){
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    // Update
    public function catUpdate($catName, $catId){
        $catName = $this->fm->validate($catName); // sanitize input
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        if ( empty($catName) || empty($catId) ){
            $msg = '<span class="error">Er mogen geen lege velden ingevoerd zijn</span>';
            return $msg;
        };
        $query = "UPDATE tbl_category 
        SET 
            catName = '$catName' 
        WHERE 
            catId = '$catId'";
        
        $catUpdate = $this->db->update($query);
        if ( $catUpdate){
            $msg = '<span class="success">Category is succesvol geupdate</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }

    // Delete
    public function catDelById($catId){
        $query = "DELETE FROM tbl_category WHERE catId = '$catId'";
        $catDel = $this->db->delete($query);
        if ($catDel) {
            $msg = "<span class='success'>Category succesvol verwijdert</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Er is iets foutgegaan bij verwijdering</span>";
            return $msg;
        }
    }
}