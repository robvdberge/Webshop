<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';
// tbl_product: cartId,  sId,    productId, productName, price,    qty,   image 
//                (int)(varchar)    (int)    (varchar)(float 10,2)  (int)(varchar)
// Cart Class for front-view
class Cart{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    // Create
    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validate($quantity); // sanitize input
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $sQuery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($sQuery)->fetch_assoc();

        $productName    = $result['productName'];
        $price          = $result['price'];
        $image          = $result['image'];

        $checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $checkDouble = $this->db->select($checkQuery);
        if ( $checkDouble ){
            $msg = "<span class='error'>Het product is al toegevoegd aan uw winkelwagen</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, qty, image) 
                VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image' )";

            $result = $this->db->insert($query);
            if ( $result ){
                header('location: cart.php');
                exit();
            } else{
                header('location: 404.php');
                exit();
            }
        }
    }
    // Read
    public function getCartProd()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkCart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    // Update
    public function updateCartQty($cartId, $qty)
    {
        $qty = $this->fm->validate($qty); // sanitize input
        $qty = mysqli_real_escape_string($this->db->link, $qty);
        $cartId = $this->fm->validate($cartId); // sanitize input
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET qty = '$qty' WHERE cartId = '$cartId'";

        $cartUpdate = $this->db->update($query);
        if ( $cartUpdate){
            header('location: cart.php');
            exit();
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }
    // Delete
    public function cartDelById($id)
    {
        $query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
        $cartDel = $this->db->delete($query);
        if ($cartDel) {
            echo "<script> window.location = 'cart.php'</script>";
            exit();
        } else {
            $msg = "<span class='error'>Er is iets foutgegaan bij verwijdering</span>";
            return $msg;
        }
    }

    public function clearCartInDb()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->delete($query);
        return;
    }
}