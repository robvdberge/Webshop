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
            <div class="notFound">
            <h2><span>Order page</span>nothing found</h2>
            
            </div>
        </div>
				 	
        <div class="clear"></div>
    </div>
</div>

<?php include './inc/footer.php'; ?>