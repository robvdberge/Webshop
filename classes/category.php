<?php
include '../lib/database.php';
include '../helpers/format.php';

class Category{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;
    }

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
}