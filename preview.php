<?php include './inc/header.php';

if ( !isset($_GET['pId']) || $_GET['pId'] == NULL ){
    echo '<script>window.location = "404.php" </script>';
} else{
    $id = $_GET['pId'];
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $id);
}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$getFpd = $pd->getSingleProd($id);
				if ($getFpd){
					while ( $result = $getFpd->fetch_assoc() ){ // iterate the featured products

			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="<?php echo "admin/" . $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<p><?php echo $fm->textShorten($result['body'],200); ?></p>					
					<div class="price">
						<p>Price: <span class="price"><?php echo '€' . $result['price']; ?></span></p>
						<p>Category: <span class="price"><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span class="price"><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action=" " method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Add to cart"/>
					</form>				
				</div>
				<?php if (isset($addCart)){echo $addCart;} // geef de melding?> 
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