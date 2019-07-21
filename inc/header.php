<?php
include 'lib/Session.php';
Session::init();
include $_SERVER['DOCUMENT_ROOT'].'/webshop/lib/Database.php';
include 'helpers/Format.php';
/* or this way:
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
*/

spl_autoload_register(function($class){
    include_once 'classes/' . $class . '.php';
});

$db = new Database;
$fm = new Format;
$pd = new Product;
$ct = new Cart;
$cat = new Category;
$ur = new User;
$or = new Order;

$loggedIn = Session::get('userLogin');
if (!$uId = Session::get('userId')){
	$uId = 0;
} 
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
                    <input type="text" value="Zoek producten" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="Zoek">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="cart.php" title="Bekijk winkelwagen" rel="nofollow">
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
        <li><a href="products.php">Producten</a> </li>
        <!-- <li><a href="categories.php">Categories</a></li> -->
        <!-- <li><a href="topbrands.php">Top Merken</a></li> -->
        <?php
            $checkCart = $ct->checkCart();                  // menu items Winkelwagen en Betalen
            if ( $checkCart ){?>
        <li><a href="cart.php">Winkelwagen</a></li> 
        <li><a href="payment.php">Betalen</a></li>
            <?php } ?>
            <?php
            $checkOrders = $or->checkOrders($uId);          // menu item Bestellingen
            if ( $checkOrders ){?>
        <li><a href="order.php">Bestellingen</a></li>
            <?php } ?>
            <?php
            $checkComp = $pd->getCompProd($uId);          // menu item Bestellingen
            if ( $checkComp ){?>
        <li><a href="compare.php">Vergelijk</a> </li>
            <?php } ?>
        <li><a href="contact.php">Contact</a> </li>
        <?php if ( $loggedIn ){                             // menu item Instellingen ?>
            <li><a href="profile.php">Instellingen</a> </li>
        <?php } ?>
        <div class="clear"></div>
        </ul>
    </div>
    <?php 
    if ( isset($_GET['uId']) ){
        $ct->clearCartInDb(); // verwijder alle cartinformatie in db -> leeg winkelwagen
        $pd->clearComp();     // verwijder alle data in de vergelijklijst
        Session::destroy();
    }?>