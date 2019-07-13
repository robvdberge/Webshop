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

$loggedIn = Session::get('userLogin');
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
                        $checkCart = $ct->checkCart(); // vul winkelwagenicoon in menu
                            if ( $checkCart ){
                                $som = Session::get('total');
                                $qty = Session::get('qty');
                                echo "€ " . $som . " Stuks: " . $qty; 
                            } else { 
                                echo "(empty)";
                            }
                    ?>
                    </span>
                    </a>
                </div>
            </div>
            <?php if ( !$loggedIn ){ ?>
                <div class="login"><a href="login.php">Login</a>
            <?php } else { ?>
                <div class="login"><a href="?uId=<?php echo Session::get('userId');?>">Logout</a>
            <?php } ?>
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
        <!-- <li><a href="categories.php">Categories</a></li> -->
        <li><a href="topbrands.php">Top Brands</a></li>
        <?php
            $checkCart = $ct->checkCart(); 
            if ( $checkCart ){?>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="payment.php">Betalen</a></li>
            <?php } ?>
        <li><a href="contact.php">Contact</a> </li>
        <?php if ( $loggedIn ){ // laat alleen zien als ingelogd is ?>
            <li><a href="profile.php">Instellingen</a> </li>
        <?php } ?>
        <div class="clear"></div>
        </ul>
    </div>
    <?php 
    if ( isset($_GET['uId']) ){
        $ct->clearCartInDb(); // verwijder alle cartinformatie in db -> leeg winkelwagen
        Session::destroy();
    }?>