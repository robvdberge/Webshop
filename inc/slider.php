<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php 
            $getBrands = array('Acer', 'Samsung', 'Apple', 'Nikon'); // kies 4 merken!!!
            for ( $i = 0; $i < 4; $i++){
                $getLatestBrand = $pd->getLatestSingle($getBrands[$i]);
                if ( $getLatestBrand ){
                    while ( $result = $getLatestBrand->fetch_assoc() ){
                ?>
                        <div class="listview_1_of_2 images_1_of_2">
                            <div class="listimg listimg_2_of_1">
                                <a href="preview.php?pId=<?php echo $result['productId'];?>"> <img src="<?php echo 'admin/'.$result['image'];?>" alt="" /></a>
                            </div>
                            <div class="text list_2_of_1">
                                <h2><?php echo $result['brandName'];?></h2>
                                <p><?php echo $fm->textShorten($result['productName'], 45);?><p>
                                <div class="button"><span><a href="preview.php?pId=<?php echo $result['productId'];?>">Add to cart</a></span></div>
                            </div>
                        </div>		
                        <?php 
                        if ( $i == 1 ){ // om de bovenste en onderste div te splitsen
                            echo '
                            </div>
                            <div class="section group">'; 
                        }
                    }   // einde while loop
                }   // einde if statement
            } // einde for loop
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->     
        <section class="slider">
                <div class="flexslider">
                <ul class="slides">
                <?php 
                    $getSlides = $bd->getSliderImages();
                    if ($getSlides){
                        while ($result = $getSlides->fetch_assoc() ){

                ?>
                    <li><img src="<?php echo 'admin/' . $result['image'];?>" alt="<?php echo $result['title'];?>" class="sliderImage"/></li>

                <?php }} ?>
                </ul>
                </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>	
