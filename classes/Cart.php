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

        public function addToCart($quantity, $id){
            $quantity = $this->fm->validate($quantity); // sanitize input
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $productId = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $sQuery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($sQuery)->fetch_assoc();

            $productName    = $result['productName'];
            $price          = $result['price'];
            $image          = $result['image'];

            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, qty, image) 
                VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image' )";

            $result = $this->db->insert($query);
            if ( $result ){
                header('location: cart.php');
                exit();
                // $msg = '<span class="success">Product is succesvol aan uw winkelwagen toegevoegd</span>';
                // return $msg;
            } else{
                header('location: 404.php');
                exit();
                // $msg = '<span class="error">Product is niet juist toegevoegd</span>';
                // return $msg;
            }
        }
}