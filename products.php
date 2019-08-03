<?php 
include './inc/header.php'; 
$bcArray = ['Producten'=>'products.php'];
include './inc/breadcrumb.php';

?>

<style>
	.cont-desc{
		height: auto;
		border: none;
	}
	.images_3_of_2{
		height: 15vh;
	}
	.images_3_of_2 img{
		width: 20vw;
		height: 12vh;
	}
</style>

<div class="main">
    <div class="content">
		<div class="rightsidebar span_3_of_1">
			<h2>Categoriën</h2>
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
		<div class="clear"></div>
	    <div class="section group">
			<div class="content_bottom">
    			<div class="heading">
    				<h3>Nieuwste producten</h3>
    			</div>
    		<div class="clear"></div>
    	
			<div class="section group">
			<?php
				$latestProd = $pd->getLatestProd(3);
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