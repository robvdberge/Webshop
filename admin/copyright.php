<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';

$bd = new Brand;
$copyrightTekst = $bd->getCopyright();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCopyright']) ){
    $tekst = stripslashes( $_POST['copyright']);
    $updateCopyright = $bd->copyrightUpdate($tekst);
    echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}'/> ";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
         <?php if ( $copyrightTekst ){
                    while ( $result = $copyrightTekst->fetch_assoc()){ ?>   
         <form action=" " method="POST">
            <table class="form">	
                <?php if (isset($updateCopyright)){echo $updateCopyright;} ?>			
                <tr>
                    <td>
                        <input type="text" name="copyright" class="large" value="<?php echo $result['tekst'];?>">
                    </td>
                </tr>
				 <tr> 
                    <td>
                        <input type="submit" name="updateCopyright" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>