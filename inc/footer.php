<div class="footer">
    <div class="wrapper">	
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>Informatie</h4>
                <ul>
                <li><a href="about.php">Over Ons</a></li>
                <li><a href="faq.php">Klantenservice</a></li>
                <li><a href="faq.php">Bestellingen en teruggave</a></li>
                <li><a href="contact.php"><span>Neem contact met ons op</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Waarom bij ons?</h4>
                <ul>
                    <li><a href="about.php">Over Ons</a></li>
                    <li><a href="faq.php">Klantenservice</a></li>
                    <li><a href="contact.php">Privacy Policy</a></li>
                    <li><a href="contact.php"><span>Site Map</span></a></li>
                    <li><a href="index.php"><span>Zoek opdrachten</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Mijn account</h4>
                <ul>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="cart.php">Bekijk Winkelwagen</a></li>
                    <li><a href="#">Mijn Verlanglijst</a></li>
                    <li><a href="#">Bekijk mijn order</a></li>
                    <li><a href="faq.php">Help</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Contact</h4>
                <ul>
                    <li><a href="contact.php"><span>Neem contact met ons op</span></a></li>
                </ul>
                <div class="social-icons">
                    <h4>Volg ons op Social Media</h4>
                    <ul>
                    <?php 
                    $socialLinks = $bd->getSocialLinks();
                    if ( $socialLinks ){
                        while ( $result = $socialLinks->fetch_assoc()){ ?> 
                        <li class="facebook"><a href="<?php echo $result['facebook']?>" target="_blank"> </a></li>
                        <li class="twitter"><a href="<?php echo $result['twitter']?>" target="_blank"> </a></li>
                        <li class="linkedin"><a href="<?php echo $result['linkedin']?>" target="_blank"> </a></li>
                        <li class="contact"><a href="<?php echo $result['google']?>" target="_blank"> </a></li>
                        <div class="clear"></div>
                    <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copy_right">
            <p><?php
            $copyrightTekst = $bd->getCopyright();
            if ($copyrightTekst){
                while ( $result = $copyrightTekst->fetch_assoc() ){
                   echo $result['tekst']; 
                }
            }
            ?>
            </p>
        </div>
     </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        /*
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear' 
        };
        */
        
        $().UItoTop({ easingType: 'easeOutQuart' });
        
    });
</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(function(){
		SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
