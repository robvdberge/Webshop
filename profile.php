<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}



?>
<style> 
    .tblone{
        width: 550px;
        margin: 0 auto;
        border: 2px solid #ddd;
    }
    .tblone tr td{
        text-align: justify;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <h2><span>Instellingen</span></h2>
            <table class="tblone">
            <?php
                $id = Session::get('userId');
                $getUser = $ur->getUser($id);
                if ( $getUser ){
                    while ( $result = $getUser->fetch_assoc() ){
                ?>
                <tr>
                    <td colspan="3"><h2>Uw instellingen  </h2></td>
                </tr>
                <tr>
                    <td width="20%"">Naam </td>
                    <td width="5%">: </td>
                    <td><?php echo $result['naam'];?></td>
                </tr>
                <tr>
                    <td>Telefoonnummer </td>
                    <td>: </td>
                    <td><?php echo $result['telnummer'];?></td>
                </tr>
                <tr>
                    <td>email </td>
                    <td>: </td>
                    <td><?php echo $result['email'];?></td>
                </tr>
                <tr>
                    <td>Adres </td>
                    <td>: </td>
                    <td><?php echo $result['adres'];?></td>
                </tr>
                <tr>
                    <td>Woonplaats </td>
                    <td>: </td>
                    <td><?php echo $result['woonplaats'];?></td>
                </tr>
                <tr>
                    <td>Postcode </td>
                    <td>: </td>
                    <td><?php echo $result['postcode'];?></td>
                </tr>
                <tr>
                    <td>Land </td>
                    <td>: </td>
                    <td><?php echo $result['land'];?></td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td><a href="editprofile.php">Update instellingen</a> </td>
                </tr>
                <?php }} ?>
            </table>
            
        </div>
				 	
        <div class="clear"></div>
    </div>
</div>

<?php include './inc/footer.php'; ?>