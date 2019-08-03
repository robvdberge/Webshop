<?php 
if ( !isset($_GET['catId']) ){
	header('location: 404.php');
	exit();
} else {
	$id = $_GET['catId'];
}
include './inc/header.php';
$bcArray = ['Producten'=>'products.php'];
include './inc/breadcrumb.php';
?>

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
    	<div class="content_top">
    		<div class="heading">
				<?php  
					$pageTitle = $cat->getCatById($id);
					if ( $pageTitle ){
						while ($result = $pageTitle->fetch_assoc()){
				?>
    			<h3>Onze <?php echo $result['catName'];?></h3>
				<?php } }?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php
				$getProds = $pd->getProdsByCatId($id);
				if ( $getProds ){
					$i = 1;
					while ( $result = $getProds->fetch_assoc() ){
						if ($i !== 4){
							
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?pId=<?php echo $result['productId'];?>"><img src="<?php echo "admin/" . $result['image'];?>" alt="" /></a>
				<h2><?php echo $fm->textShorten($result['productName'],20);?></h2>
				<p><?php echo html_entity_decode($fm->textShorten($result['body'],70))?></p>
				<p><span class="price">€ <?php echo $result['price'];?></span></p>
				<div class="button"><span><a href="preview.php?pId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
			</div>
			
						<?php 
						$i++;
						} else { ?>
							<div class="grid_1_of_4 no_border images_1_of_4"></div>
							<div class="grid_1_of_4 images_1_of_4">
								<a href="preview.php?pId=<?php echo $result['productId'];?>"><img src="<?php echo "admin/" . $result['image'];?>" alt="" /></a>
								<h2><?php echo $fm->textShorten($result['productName'],20);?></h2>
								<p><?php echo html_entity_decode($fm->textShorten($result['body'],70))?></p>
								<p><span class="price">€ <?php echo $result['price'];?></span></p>
								<div class="button"><span><a href="preview.php?pId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
							</div>
						<?php
							$i++;
						}
					}
				} else {
					echo "<div class='not-found'><h2>Er zijn momenteel geen producten gevonden in deze categorie</h2></div>";
				} 
		?>
		</div>
 	</div>
</div>

<?php include './inc/footer.php'; ?>