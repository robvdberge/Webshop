<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Category.php'; 
include_once '../classes/User.php';
$ur = new User;

if ( !isset($_GET['uId']) || $_GET['uId'] == NULL ){
    echo '<script>window.location = "mainorder.php" </script>';
} else{
    $id = $_GET['uId'];
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    echo '<script>window.location = "mainorder.php" </script>';
}

$getUser = $ur->getUser($id);
if ( $getUser ){
    while ( $result = $getUser->fetch_assoc() ){
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Klant Gegevens</h2>
               <div class="block copyblock">
                 <form action=" " method="post">
                    <table class="form">				
                        <tr>
                            <td>Klantnummer</td>
                            <td><?php echo $result['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Naam</td>
                            <td><?php echo $result['naam'];?></td>
                        </tr>
                        <tr>
                            <td>Adres</td>
                            <td><?php echo $result['adres'];?></td>
                        </tr>
                        <tr>
                            <td>Woonplaats</td>
                            <td><?php echo $result['woonplaats'];?></td>
                        </tr>
                        <tr>
                            <td>Postcode</td>
                            <td><?php echo $result['postcode'];?></td>
                        </tr>
                        <tr>
                            <td>Land</td>
                            <td><?php echo $result['land'];?></td>
                        </tr>
                        <tr>
                            <td>Telefoon</td>
                            <td><?php echo $result['telnummer'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $result['email'];?></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Ok"></td>
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