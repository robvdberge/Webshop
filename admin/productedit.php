<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include_once '../classes/brand.php';
include_once '../classes/category.php';
include_once '../classes/product.php'; 

if ( !isset($_GET['pId']) || $_GET['pId'] == NULL ){
    echo '<script>window.location = "productlist.php" </script>';
} else{
    $id = $_GET['pId'];
}

$pd = new Product;
$fm = new Format;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ){
    $updateProd = $pd->ProductUpdate($_POST, $_FILES, $id);
}
$getProd = $pd->getProdById($id);
if ( $getProd ){
    while ( $value = $getProd->fetch_assoc() ){


?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit a Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
         <?php if (isset($updateProd)){echo $updateProd;}?> 
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                    <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                            $cat = new Category;
                            $getCats = $cat->getAllCats();
                            if ($getCats){
                                while ( $result = $getCats->fetch_assoc() ){ ?>

                                <option 
                                <?php 
                                if ( $value['catId'] == $result['catId']){
                                    echo 'selected="' . $value['catId'] . '"';
                                }
                                ?>
                                value="<?php echo $result['catId'];?>"><?php echo $result['catName']; ?></option>

                            <?php 
                                }
                            }; ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId" >
                            <option>Select Brand</option>
                            <?php 
                            $brand = new Brand;
                            $getBrands = $brand->getAllBrands();
                            if ($getBrands){
                                while ( $result = $getBrands->fetch_assoc() ){ ?>

                                <option 
                                <?php 
                                if ( $value['brandId'] == $result['brandId']){
                                    echo 'selected="' . $value['brandId'] . '"';
                                }
                                ?>
                                value="<?php echo $result['brandId'];?>"><?php echo $result['brandName']; ?></option>

                            <?php 
                                }
                            }; ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce" ><?php echo $value['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Uploaded Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image']; ?>" height="60px" width="80px">    
                        <input name="image" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type" value="<?php echo $value['type'];?>">
                            <option>Select Type</option>
                            <option <?php 
                                if ( $value['type'] == 0){
                                    echo 'selected="' . $value['type'] . '"';
                                }?> value="0">Featured</option>
                            <option <?php 
                                if ( $value['type'] == 1){
                                    echo 'selected="' . $value['type'] . '"';
                                }?> value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php 
            }} // einde while-loop
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
