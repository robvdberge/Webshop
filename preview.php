<?php 
include './inc/header.php';
$bcArray = ['Producten'=>'products.php'];
if ( !isset($_GET['pId']) || $_GET['pId'] == NULL ){
    echo '<script>window.location = "404.php" </script>';
} else{
    $pId = $_GET['pId']; // declare ProductId
}
include './inc/breadcrumb.php';



if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity']) ){
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $pId);
}
if (!$uId = Session::get('userId')){
	$uId = 0;
}; // declare UserId

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare']) ){
	if (isset($_POST['userId'])){
		$pId = $_POST['productId'];
		$createComp = $pd->createComp($pId, $uId);
		echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}&id=live'/> "; // Live update or refresh screen!!!!
	} else {
		$createCompBySid = $pd->createCompBySid($pId);
		echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}&id=live'/> "; // Live update or refresh screen!!!!
	}
} 
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addWish']) ){
	if (isset($_POST['userId'])){
		$pId = $_POST['productId'];
		$createWish = $pd->createWish($pId, $uId);
		echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}'/> "; // Live update or refresh screen!!!!
	}
} 
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delWish']) ){
	if (isset($_POST['userId'])){
		$pId = $_POST['productId'];
		$createWish = $pd->delWish($pId, $uId);
		echo "<meta http-equiv='refresh' content='0;URL=?pId={$pId}'/> "; // Live update or refresh screen!!!!
	}
} 

$loggedIn = Session::get('userLogin'); // Kijk if er is ingelogd

?>
<style>
.btn-container{
	width: 100px;
	float: left;
	margin-right: 5px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$getFpd = $pd->getSingleProd($pId);
				if ($getFpd){
					while ( $result = $getFpd->fetch_assoc() ){ // iterate the featured products

			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_2_of_2">
						<img src="<?php echo "admin/" . $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_1_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<p><?php echo $fm->textShorten($result['body'],200); ?></p>					
					<div class="price">
						<p>Merk: <span class="price"><?php echo $result['brandName']; ?></span></p>
						<p>Categorie: <span class="price"><?php echo $result['catName']; ?></span></p>
						<p>Prijs: <span class="price"><?php echo '€' . $result['price']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action=" " method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="In winkelwagen"/>
					</form>				
				</div>
				<?php if (isset($addCart)){echo $addCart;} 					// geef melding winkelwagen toegevoegd?> 
				<?php if (isset($createComp)){echo $createComp;} 			// geef melding vergelijk-login?>
				<?php if (isset($createCompBySid)){echo $createCompBySid;} 	// geef melding vergelijk-logout?>
				<?php if ( isset($createWish)){echo $createWish;}; 			// geef melding Wishlist?>
				<div class="add-cart">
					<div class="btn-container">
						<form action=" " method="post">
							<input type="hidden" class="buyfield" name="userId" value="<?php echo $uId;?>"/>
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $pId;?>"/>
							<input type="submit" class="buysubmit" name="compare" value="Vergelijk"/>	
						</form>	
					</div>
					<?php 
					
					if ($loggedIn){ // alleen zichtbaar als ingelogd
						$checkWens = $pd->checkWens($pId, $uId);
						if ($checkWens){
							$wensBtnNaam = 'delWish'; 
							$wensBtnTekst = 'Verwijder van wenslijst';
						} else {
							$wensBtnNaam = 'addWish'; 
							$wensBtnTekst = 'Voeg toe aan wenslijst';
						}
					?>
					<div class="btn-container">
						<form action=" " method="post">
							<input type="hidden" class="buyfield" name="userId" value="<?php echo $uId;?>"/>
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $pId;?>"/>
							<input type="submit" class="buysubmit" name="<?php echo $wensBtnNaam;?>" value="<?php echo $wensBtnTekst;?>"/>	
						</form>	
					</div>
					<?php } ?>
				</div>
			</div>	
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo htmlspecialchars_decode($result['body']); ?></p>
	    </div>
		<?php }} ?>
				
	</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php 
					$getAllCats = $cat->getAllCats();
					if ( $getAllCats ){
						while ( $result = $getAllCats->fetch_assoc() ){ ?>
							<li><a href="productbycat.php?catId=<?php echo $result['catId'];?>"><?php echo $result["catName"];?></a></li>
							<?php
					  	}
					}
					?>
				</ul>
			</div>
 		</div>
 	</div>
</div>

<?php include './inc/footer.php'; ?>