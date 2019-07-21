<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';

// tbl_order: 
// orderId ,userId , productId , productName, qty ,  price ,   image
//  (int)     (int)     (int)       (varchar) (int)(float 10,2)(varchar)
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
    public function insertOrder($uId)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getCartData = $this->db->select($query);
        if ( $getCartData ){
            while ( $cartData = $getCartData->fetch_assoc() ){
                $productId      = $cartData['productId'];
                $productName    = $cartData['productName'];
                $qty            = $cartData['qty'];
                $price          = $cartData['price'];
                $image          = $cartData['image'];
                
                $query = "INSERT INTO tbl_order(userId, productId, productName, price, qty, image) 
                VALUES('$uId', '$productId', '$productName', '$price', '$qty', '$image' )";

            $result = $this->db->insert($query);
            
            }
            if ($result){
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    
    // Read
    public function getOrder($uId)
    {
        $query = "SELECT * FROM tbl_order WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkOrders($uId)
    {
        $query = "SELECT * FROM tbl_order WHERE userId = '$uId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllOrders()
    {
        $query = "SELECT * 
        FROM tbl_order 
        ORDER BY orderId";
        $result = $this->db->select($query);
        return $result; 
    }

    // Update
    public function updateStatus($id, $price, $datum)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        // $price = mysqli_real_escape_string($this->db->link, $price);
        $datum = mysqli_real_escape_string($this->db->link, $datum);

        $query = "UPDATE tbl_order 
        SET status = '1' 
        WHERE 
        userId = '$id' AND
        datum = '$datum' AND
        price LIKE '$price'";

        $statusUpdate = $this->db->update($query);
        if ( $statusUpdate){
            $msg = '<span class="success">Status is succesvol verandert</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Status is niet verandert</span>';
            return $msg;
        }
    }

    // Delete
    public function deleteOrder($id, $price, $datum)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $datum = mysqli_real_escape_string($this->db->link, $datum);

        $query = "DELETE FROM tbl_order  
        WHERE userId = '$id' AND
        datum = '$datum' AND
        price LIKE '$price'";
        $deleteOrder = $this->db->update($query);
        if ( $deleteOrder){
            $msg = '<span class="success">Bestelling succesvol verwijdert</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Bestelling is niet verwijdert</span>';
            return $msg;
        }
    }
}