<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
// tbl_product: productId (int),productName (varchar), catId (int), brandId(int), body (varchar),price (float 10,2), image (blob), type (0,1)

// User Class for front-view
class User{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;
    }

}