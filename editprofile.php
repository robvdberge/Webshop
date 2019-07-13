<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ){
    $updateUser = $ur->userUpdate($_POST);
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
    .tblone input[type="text"], input[type="email"]{
        width: 400px;
        padding: 5px;
        font-size: 15px;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <h2><span>Wijzig instellingen</span></h2>
            <form action="" method="post">
                <?php 
                $id = Session::get('userId');
                $getUser = $ur->getUser($id);
                if ( $getUser ){
                    while ( $result = $getUser->fetch_assoc() ){
                ?>
                <table class="tblone">
                <?php 
                   if (isset($updateUser)){echo "<tr><td colspan='2'>" .  $updateUser ."</h2></td></tr>";}
                ?>
                    <tr>
                        <td colspan="2"><h2>Uw instellingen  </h2></td>
                    </tr>
                    <input type="hidden" name="id" value="<?php echo $result['id'];?>">
                    <tr>
                        <td width="20%"">Naam </td>
                        <td><input type="text" name="naam" value="<?php echo $result['naam']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Telefoonnummer </td>
                        <td><input type="text" name="telnummer" value="<?php echo $result['telnummer']; ?>"> </td>
                    </tr>
                    <tr>
                        <td>email </td>
                        <td><input type="email" name="email" value="<?php echo $result['email']; ?>"> </td>
                    </tr>
                    <tr>
                        <td>Adres </td>
                        <td><input type="text" name="adres" value="<?php echo $result['adres']; ?>"> </td>
                    </tr>
                    <tr>
                        <td>Woonplaats </td>
                        <td><input type="text" name="woonplaats" value="<?php echo $result['woonplaats']; ?>"> </td>
                    </tr>
                    <tr>
                        <td>Postcode </td>
                        <td><input type="text" name="postcode" value="<?php echo $result['postcode']; ?>"> </td>
                    </tr>
                    <tr>
                        <td>Land </td>
                        <td><input type="text" name="land" value="<?php echo $result['land']; ?> "></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td><input type="submit" name="submit" value="Sla Wijzigingen Op"></td>
                    </tr>
                    <?php }} ?>
                </table>
            </form>
        </div>
				 	
        <div class="clear"></div>
    </div>
</div>
  
<?php include './inc/footer.php'; ?>