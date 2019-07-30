<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';

$bd = new Brand;

if ( !isset($_GET['slideId']) || $_GET['slideId'] == NULL ){
    echo '<script>window.location = "sliderlist.php" </script>';
} else{
    $id = $_GET['slideId'];
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveSlider']) ){
    $editSlide = $bd->editSlide($_POST, $_FILES, $id);
    //echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}'/> ";
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit a slide</h2>
        <div class="block">               
            <form action=" " method="post" enctype="multipart/form-data">
            <?php if (isset($editSlide)){echo $editSlide;} ?>
                <table class="form">     
                    <?php 
                        $getSlide = $bd->getSlideById($id);
                        if ($getSlide){
                            while ($result = $getSlide->fetch_assoc()){

                    ?>
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result['title'];?>" class="medium" />
                        </td>
                    </tr>           
        
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $result['image']; ?>" height="100px" width="140px"><br>
                            <input name="image" type="file" />
                        </td>
                    </tr>
                
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="saveSlider" Value="Save" />
                        </td>
                    </tr>
                    <?php }} ?>
                </table>
            </form>
            <a href="sliderlist.php">Back to list</a>
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