<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';

$bd = new Brand;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSlider']) ){
    $addSliderImage = $bd->addSliderImage($_POST, $_FILES);
    //echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}'/> ";
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
    <div class="block">               
        <form action=" " method="post" enctype="multipart/form-data">
        <?php if (isset($addSliderImage)){echo $addSliderImage;} ?>
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="addSlider" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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