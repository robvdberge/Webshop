<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}
?>

<div class="main">
    <div class="content">
    	<div class="section group">
            <h2><span>Betaling</span></h2>
            <div class="payment">
                <h2>Kies u betalingsmethode</h2>
                <a href="offline.php">Offline betalingen</a>
                <a href="online.php">Online betalingen</a>
            </div>
            <div class="back">
                <a href="cart.php">Terug</a>
            </div>
        </div>
    </div>
</div>

<?php include './inc/footer.php'; ?>