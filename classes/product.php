<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/Database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/Format.php';
// tbl_product: productId (int),productName (varchar), catId (int), brandId(int), body (varchar),price (float 10,2), image (blob), type (0,1)

// Product Class
class Product{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database;
        $this->fm = new Format;
    }
    // Create
    public function productInsert($data, $file){
        $productName    = $this->fm->validate($data['productName']); // sanitize input
        $catId          = $this->fm->validate($data['catId']);
        $brandId        = $this->fm->validate($data['brandId']);
        $body           = $this->fm->validate($data['body']);
        $price          = $this->fm->validate($data['price']);
        $type           = $this->fm->validate($data['type']);
        $productName    = mysqli_real_escape_string($this->db->link, $productName);
        $catId          = mysqli_real_escape_string($this->db->link, $catId);
        $brandId        = mysqli_real_escape_string($this->db->link, $brandId);
        $body           = mysqli_real_escape_string($this->db->link, $body);
        $price          = mysqli_real_escape_string($this->db->link, $price);
        $type           = mysqli_real_escape_string($this->db->link, $type);

        $permitted = array('jpg', 'jpeg', 'gif', 'png');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));                              // make everything lowercase
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   // give the image a unique name made with timestamp
        $uploaded_image = "upload/" . $unique_image;                    // destination folder

        if ( $productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);            // upload the image
            $query = "INSERT INTO tbl_product(productName, catId, brandId, body, image, price, type) VALUES('$productName', '$catId', '$brandId', '$body', '$uploaded_image', '$price', '$type' )";

            $result = $this->db->insert($query);
            if ( $result ){
                $msg = '<span class="success">Product is succesvol ingevoerd</span>';
                return $msg;
            } else{
                $msg = '<span class="error">Product is niet juist ingevoerd</span>';
                return $msg;
            }
        }
    }

    // Read
    public function getAllProducts(){
        $query = "SELECT * 
        FROM tbl_product 
        LEFT JOIN tbl_category on tbl_product.catId = tbl_category.catId 
        LEFT JOIN tbl_brand on tbl_product.brandId = tbl_brand.brandId 
        ORDER BY productId DESC";

        $result = $this->db->select($query);
        return $result;
    }

    public function getProdById($id){
        $query = "SELECT * 
        FROM tbl_product 
        WHERE productId = '$id'";

        $result = $this->db->select($query);
        return $result;
    }

    // Update
    public function productUpdate($data, $file, $id){
        $productName    = $this->fm->validate($data['productName']); // sanitize input
        $catId          = $this->fm->validate($data['catId']);
        $brandId        = $this->fm->validate($data['brandId']);
        $body           = $this->fm->validate($data['body']);
        $price          = $this->fm->validate($data['price']);
        $type           = $this->fm->validate($data['type']);
        $productName    = mysqli_real_escape_string($this->db->link, $productName);
        $catId          = mysqli_real_escape_string($this->db->link, $catId);
        $brandId        = mysqli_real_escape_string($this->db->link, $brandId);
        $body           = mysqli_real_escape_string($this->db->link, $body);
        $price          = mysqli_real_escape_string($this->db->link, $price);
        $type           = mysqli_real_escape_string($this->db->link, $type);

        $permitted = array('jpg', 'jpeg', 'gif', 'png');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));                              // make everything lowercase
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   // give the image a unique name made with timestamp
        $uploaded_image = "upload/" . $unique_image;                    // destination folder

        if ( $productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        } else {
        if (!empty($file_name)) { // if a image IS added
        
            if ( in_array($file_ext, $permitted ) === FALSE ) {
                echo "<span class='error'> You can only upload " . implode(', ', $permitted ) . " files </span>";  //only .jpg, jpeg, png and gif files
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);            // upload the image
                    $query = "UPDATE tbl_product
                    SET
                    productName     = '$productName', 
                    catId           = '$catId', 
                    brandId         = '$brandId', 
                    body            = '$body', 
                    image           = '$uploaded_image',
                    price           = '$price', 
                    type            = '$type' 
                    WHERE productId = '$id'";

                    $result = $this->db->update($query);
                    if ( $result ){
                        $msg = '<span class="success">Product is succesvol geupdate</span>';
                        return $msg;
                    } else{
                        $msg = '<span class="error">Product is niet juist geupdate</span>';
                        return $msg;
                    }
                }
            }else { // when no image is added
                $query = "UPDATE tbl_product
                SET
                productName     = '$productName', 
                catId           = '$catId', 
                brandId         = '$brandId', 
                body            = '$body', 
                price           = '$price', 
                type            = '$type' 
                WHERE productId = '$id'";

                $result = $this->db->update($query);
                if ( $result ){
                    $msg = '<span class="success">Product is succesvol geupdate</span>';
                    return $msg;
                } else {
                    $msg = '<span class="error">Product is niet juist geupdate</span>';
                    return $msg;
                } 
            }
        }
    }

    // Delete
    public function prodDelById($pdId){
        // first delete the uploaded image files
        $linkQuery = "SELECT * FROM tbl_product where productId = '$pdId'"; // find imagenames
        $getData = $this->db->select($linkQuery);
        if ( $getData ){
            while ( $delImg = $getData->fetch_assoc() ){
                $delLink = $delImg['image'];
                unlink($delLink); // delete uploaded images
            }
        }
        $query = "DELETE FROM tbl_product WHERE productId = '$pdId'";
        $prodDel = $this->db->delete($query);
        if ($prodDel) {
            $msg = "<span class='success'>Het product is succesvol verwijdert</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Er is iets foutgegaan bij verwijdering</span>";
            return $msg;
        }
    }

    // Get the Featured products 
    public function getFeaturedProduct(){
        $query = "SELECT * 
        FROM tbl_product 
        LEFT JOIN tbl_category on tbl_product.catId = tbl_category.catId 
        LEFT JOIN tbl_brand on tbl_product.brandId = tbl_brand.brandId 
        WHERE type = '0'
        ORDER BY productId DESC LIMIT 4";

        $featured = $this->db->select($query);
        return $featured;
    }
}