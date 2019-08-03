<?php 
include './inc/header.php'; 
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){ // wanneer op de Deleteknop is gedrukt
	$quantity = $_POST['qty'];
	$cartId = $_POST['cartId'];

	if ($quantity < 1){
		$cartDelItem = $ct->cartDelById($cartId);
	} else {
	$updateCart = $ct->updateCartQty($cartId, $quantity);
	}
}

if (isset($_GET['delCartItem'])) { 
	$id = $_GET['delCartItem'];
	$cartDelItem = $ct->cartDelById($id);
}

if ( !isset( $_GET['id'] ) ){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> "; // Live update or refresh screen!!!!
}
?>

    <div class="main">
    	<div class="content">
    		<div class="cartoption">		
				<div class="cartpage">
					<h2>Winkelwagen</h2>
					<?php if (isset($updateCart)){echo $updateCart;} // melding bij updateQty in cart?>
					<?php if (isset($cartDelItem)){echo $cartDelItem;} // melding bij verwijdering uit cart?>
						<table class="tblone">
							<tr>
								<th width="5%">Nr</th>
								<th width="30%">Product Naam</th>
								<th width="10%">Afbeelding</th>
								<th width="10%">Prijs</th>
								<th width="15%">Aantal</th>
								<th width="20%">Totaal</th>
								<th width="10%">Actie</th>
							</tr>
							<?php
								global $total ;
								$total = 0;
								$getProd = $ct->getCartProd();
								if ( $getProd ){
									$i = 0;
									$qty = 0;
									while ( $fillCart = $getProd->fetch_assoc() ){
										$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $fillCart['productName'];?></td>
								<td><img src="<?php echo "admin/" . $fillCart['image'];?>" alt=""/></td>
								<td>€ <?php echo $fillCart['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $fillCart['cartId'];?>"/>
										<input type="number" name="qty" value="<?php echo $fillCart['qty'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									€ <?php printf("%.2f", $subTotal = $fillCart['qty'] * $fillCart['price']); ?>
								</td>
								<td><a onclick="return confirm('Weet je het zeker?');" href="?delCartItem=<?php echo $fillCart['cartId'];?>">delete</a></td>
							</tr>
							<?php 
								$qty += $fillCart['qty'];
								$total += $subTotal;
								$totalCart = round($total, 2); // geef totaalprijs in winkelwagen + btw

								Session::set('total', $totalCart); // is prijs inclusief btw
								Session::set('qty', $qty);
								}}
							?>
							
						</table>
						<?php
							$checkCart = $ct->checkCart();
							if ( $checkCart ){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Totaalprijs : </th>
								<td>€ <?php printf("%.2f", $total);?></td>
							</tr>
							<tr>
								<th>BTW (21%) : </th>
								<td>€ <?php printf("%.2f", $btw = round($total  * 0.21, 2));?></td>
							</tr>
							
						</table>
						<?php
							} else {
								echo "<span>Winkelwagen is leeg</span>";
							}
						?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    			</div>  	
        	<div class="clear"></div>
    	</div>
 	</div>
</div>

<?php include './inc/footer.php'; ?>