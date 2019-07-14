<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';
// tbl_product: orderId ,userId , productId , productName, qty ,  price ,   image
//              (int)     (int)     (int)       (varchar) (int)(float 10,2)(varchar)
// 
// Class Order
class Order
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    // Create
    public function insertOrder()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getCartData = $this->db->select($query);
        if ( $getCartData ){
            while ( $cartData = $getCartData->fetch_assoc() ){
                // Continue Here!!!
            }
        }
    }
    // Read

    // Update

    // Delete
}