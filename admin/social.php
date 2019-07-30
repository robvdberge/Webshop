<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';

$bd = new Brand;
$socialLinks = $bd->getSocialLinks();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateSocial']) ){
    $updateSocial = $bd->socialUpdate($_POST);
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> ";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">               
         <form action=" " method="post">
         <?php if ( $socialLinks ){
                    while ( $result = $socialLinks->fetch_assoc()){ ?> 
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $result['facebook'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $result['twitter'];?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin" value="<?php echo $result['linkedin'];?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="updateSocial" Value="Update" />
                    </td>
                </tr>
            </table>
            <?php }} ?>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>