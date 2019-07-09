<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';
// tbl_product: productId (int),productName (varchar), catId (int), brandId(int), body (varchar),price (float 10,2), image (blob), type (0,1)

// Cart Class for front-view
class Cart{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;
    }

}