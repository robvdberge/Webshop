<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}
?>
<style>
    .payment a{
        font-size: 18px;
        background-color: transparent;
        color: #00aaaa;
    }
    .payment a:hover{
        color: #00ffff;
        background-color: transparent;
    }
    .payment p{
        line-height: 2em;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <h2><span>Betaling gelukt</span></h2>
            <div class="payment">
                <h2>Bedankt voor uw bestelling</h2>
                <p>Uw bestelling wordt zo spoedig mogelijk aan u verzonden.<br>
                <a href="order.php">Hier</a> vindt u een overzicht van uw bestelling.</p>
                 
            </div>
            <div class="back">
                <a href="index.php">Terug naar Home</a>
            </div>
        </div>
    </div>
</div>

<?php include './inc/footer.php'; ?>