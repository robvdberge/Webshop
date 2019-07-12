<?php 
include './inc/header.php';

?>
 <div class="main">
    <div class="content">
    <div class="section group">
        <div class="cont-desc span_1_of_2">				
            <div class="grid images_3_of_2">
                <img src="images/team1.jpg" alt="" />
            </div>
        <div class="desc span_3_of_2">
            <h2>Browse onze categoriën</h2>
            <p>
                Hiernaast vindt u al onze producten overzichtelijk ingedeelt in categoriën.

            </p>					
            
        <div class="add-cart">
                        
        </div> 
    </div>
    <div class="product-desc">
        <h2>Overzicht</h2>
        <p>Hiernaast vindt u al onze producten overzichtelijk ingedeelt in categoriën.</p>
    </div>
				
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