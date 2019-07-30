<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/webshop/helpers/format.php';
// table = tbl_brand
// brandId, brandName
//  int      varchar
//
// table = tbl_copyright
//  id,  tekst
//  int  varchar
//
// table = tbl_social
//  id, facebook, twitter, linkedin, google
//  int varchar   varchar  varchar  varchar
//
// table = tbl_slider
//  id,  title,  image
//  int varchar varchar
//
// Brands class 

class Brand{
    private $fm;
    private $db;

    public function __construct(){
        $this->fm = new Format;
        $this->db = new Database;
    }
    // C
    public function brandInsert($brandName)
    {
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

    public function addSliderImage($data, $file)
    {
        $titel = $this->fm->validate($data['title']);
        $titel = mysqli_real_escape_string($this->db->link, $titel);

        $permitted = array('jpg', 'jpeg', 'gif', 'png');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));                              // make everything lowercase
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   // give the image a unique name made with timestamp
        $uploaded_image = "upload/" . $unique_image;                    // destination folder

        if ( $titel == "" || $file_name == ""){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);                // upload the image
            $query = "INSERT INTO tbl_slider(title, image) VALUES('$titel', '$uploaded_image')";
            $result = $this->db->insert($query);
            
            if ( $result){
                $msg = '<span class="success">De sliderplaatjes zijn succesvol geupdate</span>';
                return $msg;
            } else {
                $msg = '<span class="error">Er is iets fout gegaan</span>';
                return $msg;
            }
        }
    }

    // R
    public function getAllBrands()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandName ASC";
        $allBrands = $this->db->select($query);
        return $allBrands;
    }
    public function getBrandById($id)
    {
        $id = $this->fm->validate($id);
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSliderImages()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY id";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSlideById($id)
    {
        $id = $this->fm->validate($id);
        $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    // U
    public function brandUpdate($brandName, $id)
    {
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

    public function editSlide($data, $file, $id)
    {
        $title          = $this->fm->validate($data['title']); // sanitize input
        $id             = $this->fm->validate($id);
        $title          = mysqli_real_escape_string($this->db->link, $title);
        $id             = mysqli_real_escape_string($this->db->link, $id);

        $permitted = array('jpg', 'jpeg', 'gif', 'png');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));                              // make everything lowercase
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   // give the image a unique name made with timestamp
        $uploaded_image = "upload/" . $unique_image;                    // destination folder

        if ( $title == ""){
            $msg = 'Er mogen geen lege velden ingevoerd zijn';
            return $msg;
        } else {
        if (!empty($file_name)) { // if a image IS added
        
            if ( in_array($file_ext, $permitted ) === FALSE ) {
                echo "<span class='error'> You can only upload " . implode(', ', $permitted ) . " files </span>";  //only .jpg, jpeg, png and gif files
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);            // upload the image
                    $query = "UPDATE tbl_slider
                    SET
                    title     = '$title', 
                    image     = '$uploaded_image' 
                    WHERE  id = '$id'";

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
                $query = "UPDATE tbl_slider
                SET
                title    = '$title' 
                WHERE id = '$id'";

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

    // D
    public function brandDelById($id)
    {
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

    public function slideDelById($id)
    {
        $query = "DELETE FROM tbl_slider WHERE id = '$id'";
        $brandDel = $this->db->delete($query);
        if ($brandDel) {
            $msg = "<span class='success'>De slide is succesvol verwijdert</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Er is iets foutgegaan bij verwijdering van de slide</span>";
            return $msg;
        }
    }

    // De copyright tekst in de footer
    // Read
    public function getCopyright()
    {
        $query = "SELECT * FROM tbl_copyright";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSocialLinks()
    {
        $query = "SELECT * FROM tbl_social";
        $result = $this->db->select($query);
        return $result;
    }

    // Update
    public function copyrightUpdate($tekst)
    {
        $tekst = $this->fm->validate($tekst);
        $tekst = mysqli_real_escape_string($this->db->link, $tekst);
        $query = "UPDATE tbl_copyright SET tekst = '$tekst'";
        $result = $this->db->update($query);
        
        if ( $result){
            $msg = '<span class="success">De Copyright is succesvol geupdate</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }
    public function socialUpdate($data)
    {
        $facebook = $this->fm->validate($data['facebook']);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);
        $twitter = $this->fm->validate($data['twitter']);
        $twitter = mysqli_real_escape_string($this->db->link, $twitter);
        $linkedin = $this->fm->validate($data['linkedin']);
        $linkedin = mysqli_real_escape_string($this->db->link, $linkedin);

        $query = "UPDATE tbl_social SET facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin'";
        $result = $this->db->update($query);
        
        if ( $result){
            $msg = '<span class="success">De sociallinks zijn succesvol geupdate</span>';
            return $msg;
        } else {
            $msg = '<span class="error">Er is iets fout gegaan</span>';
            return $msg;
        }
    }
}