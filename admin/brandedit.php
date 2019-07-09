<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php'; 

if ( !isset($_GET['brandId']) || $_GET['brandId'] == NULL ){
    echo '<script>window.location = "brandlist.php" </script>';
} else{
    $id = $_GET['brandId'];
}

$brand = new Brand;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $brandName = stripslashes( $_POST['brandName']);

    $updateBrand = $brand->brandUpdate($brandName, $id); //!
}

$getBrand = $brand->getBrandById($id); //!
if ( $getBrand ){
    while ( $result = $getBrand->fetch_assoc() ){
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brands</h2>
               <div class="block copyblock">
               <?php if (isset($updateBrand)){echo $updateBrand;} ?> 
                 <form action=" " method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" Value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php
                        }} //closing the while loop
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>