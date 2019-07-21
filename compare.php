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

if (isset( $_GET['delComp'] )){
	$pId = $_GET['delComp'];
	$delCompItem = $pd->delCompItemById($pId);
}

if ( !isset( $_GET['id'] ) ){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> "; // Live update or refresh screen!!!!
}
if (isset($_SESSION['userId']) && $_SESSION['userLogin']){
	$uId = Session::get('userId');
} else {
	$uId = 0;
}
?>

    <div class="main">
    	<div class="content">
    		<div class="cartoption">		
				<div class="cartpage">
					<h2>Vergelijk Producten</h2>
					<?php if (isset($delCompItem)){echo $delCompItem;}?>
                    <table class="tblone">
                        <tr>
                            <th width="5%">Nr</th>
                            <th width="30%">Product Name</th>
                            <th width="10%">Image</th>
                            <th width="10%">Price</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                            global $total ;
                            $total = 0;
                            $getProd = $pd->getCompProd($uId);
                            if ( $getProd ){
                                $i = 0;
                                while ( $fillCart = $getProd->fetch_assoc() ){
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $fillCart['productName'];?></td>
                            <td><img src="<?php echo "admin/" . $fillCart['image'];?>" alt=""/></td>
                            <td>€ <?php echo $fillCart['price'];?></td>
                            <td>
								<a href="preview.php?pId=<?php echo $fillCart['productId'];?>">Bekijk</a>
								<a href="compare.php?delComp=<?php echo $fillCart['productId'];?>">Verwijder</a>
							</td>
                        </tr>
                        <?php }} else {echo '<td></td><td>Uw vergelijklijst is leeg</td>';} ?>
                    </table>
						
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