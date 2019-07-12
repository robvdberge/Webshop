<?php
include 'lib/Session.php';
Session::init();
include $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/Database.php';
include 'helpers/Format.php';

spl_autoload_register(function($class){
    include_once 'classes/' . $class . '.php';
});

$db = new Database;
$fm = new Format;
$pd = new Product;
$ct = new Cart;
$cat = new Category;
$ur = new User;

?>

<!DOCTYPE HTML>
<head>
	<title>Webshop</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script> 
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
	$(document).ready(function($){
		$('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
	});
	</script>
</head>
<body>
<div class="wrap">
    <div class="header_top">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="" /></a>
        </div>
        <div class="header_top_right">
            <div class="search_box">
                <form>
                    <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="cart.php" title="View my shopping cart" rel="nofollow">
                    <span class="cart_title"></span>
                    <span class="no_product">
                    <?php
                        $checkCart = $ct->checkCart();
                            if ( $checkCart ){
                                $som = Session::get('total');
                                $qty = Session::get('qty');
                                //$som = $som + round(($som * 0.21), 2); 
                                echo "€ " . $som . " Stuks: " . $qty; 
                            } else { 
                                echo "(empty)";
                            }
                    ?>
                    </span>
                    </a>
                </div>
            </div>
            <div class="login"><a href="login.php">Login</a>
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="menu">
        <ul id="dc_mega-menu-orange" class="dc_mm-orange">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a> </li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="topbrands.php">Top Brands</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="contact.php">Contact</a> </li>
        <div class="clear"></div>
        </ul>
    </div>