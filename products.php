<?php include './inc/header.php'; ?>
<style>
	.rightsidebar{
		position: absolute;
		top: 16em;
		right: 8em;
		width: 250px;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="images/feature-pic1.png" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$505.22</span></p>
				     <div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-2.html"><img src="images/feature-pic2.jpg" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$620.87</span></p> 
				     <div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-2.html"><img src="images/feature-pic2.jpg" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$620.87</span></p> 
				     <div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
				</div>
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
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Latest from Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.html"><img src="images/new-pic1.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<p><span class="price">$403.66</span></p>
				
					<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-4.html"><img src="images/new-pic2.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<p><span class="price">$621.75</span></p>
					<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-4.html"><img src="images/new-pic2.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<p><span class="price">$621.75</span></p>
					<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-4.html"><img src="images/new-pic2.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<p><span class="price">$621.75</span></p>
					<div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
			</div>
    	</div>
 	</div>
</div>
<?php include './inc/footer.php'; ?>