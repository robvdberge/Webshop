<?php 
include './inc/header.php'; 
if ( !isset( $_GET['search']) || $_GET['search'] === NULL ){
	echo '<script>window.location = 404.php; </script>';
} else {
	$search = $_GET['search'];
}
?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
				
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php
				$getProds = $pd->getProdsBySearch($search); // use search function
				if ( $getProds ){
					while ( $result = $getProds->fetch_assoc() ){
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?pId=<?php echo $result['productId'];?>"><img src="<?php echo "admin/" . $result['image'];?>" alt="" /></a>
				<h2><?php echo $fm->textShorten($result['productName'],20);?></h2>
				<p><?php echo html_entity_decode($fm->textShorten($result['body'],70))?></p>
				<p><span class="price">€ <?php echo $result['price'];?></span></p>
				<div class="button"><span><a href="preview.php?pId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
			</div>
			
			<?php 
					}
				} else {
					echo "<p><h4>Er zijn geen producten gevonden met deze zoekopdracht</h4></p>";
				} 
		?>
		</div>
 	</div>
</div>

<?php include './inc/footer.php'; ?>