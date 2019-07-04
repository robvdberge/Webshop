<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/category.php'; 

if ( !isset($_GET['catId']) || $_GET['catId'] == NULL ){
    echo '<script>window.location = "catlist.php" </script>';
} else{
    $id = $_GET['catId'];
}

$cat = new Category;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $catName = stripslashes( $_POST['catName']);

    $insertCat = $cat->catInsert($catName);
}

$getCat = $cat->getCatById($id);
if ( $getCat ){
    while ( $result = $getCat->fetch_assoc() ){
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">
               <?php if (isset($insertCat)){echo $insertCat;} ?> 
                 <form action=" " method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" Value="<?php echo $result['catName']; ?>" class="medium" />
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