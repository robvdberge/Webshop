<?php include './inc/header.php'; ?>
<?php include './inc/slider.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Featured Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      	<div class="section group">
			<?php
				$getFpd = $pd->getFeaturedProduct();
				if ($getFpd){
					while ( $result = $getFpd->fetch_assoc() ){ // iterate the featured products

			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?pId=<?php echo $result['productId'];?>">
					 <img src="<?php echo "admin/" . $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price"><?php echo '€' . $result['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?pId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php }} // close while loop ?> 
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
				$latestProd = $pd->getLatestProd();
				if ( $latestProd ){
					while ( $latest = $latestProd->fetch_assoc() ){ // iterate the latest created products
				
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?pId=<?php echo $latest['productId'];?>">
					 <img src="<?php echo "admin/" . $latest['image']; ?>" alt="" height="250px" /></a>
					 <h2><?php echo $latest['productName']; ?></h2>
					 <!-- <p><?php echo $fm->textShorten($latest['body'],60); ?></p> -->
					 <p><span class="price"><?php echo '€' . $latest['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?pId=<?php echo $latest['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php
					}};
				?>
			</div>
    </div>
 </div>
</div>
<?php include './inc/footer.php'; ?>