<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}
if ( isset($_GET['orderId']) && $_GET['orderId'] == 'order'){
    $uId = Session::get('userId');
    $insertOrder = $or->insertOrder();
}
?>
<style>
    .payment_cart, .payment_user{
        width: 50;
        float: left;

    }
    .tblone{
        width: 500px;
        margin: 10px;
        border: 2px solid #ddd;
        padding: 5px 10px 0;
        font-size: 13px;
    }
    .tblone tr td{
        text-align: justify;
    }
    .payment_cart h2, .payment_user h2{
        margin-left: 50px;
        color: #000;
    }
    .tbltwo{
        float:right;
        text-align:left;
        width: 45%;
        margin: 10px 10px 0;
        border: 2px solid #ddd;
    }
    .tbltwo tr td{
        text-align: justify;
        padding: 5px 10px;
    }
    .back{
        margin-bottom: 2em;
    }
    .back a{
        background-color: #00aaaa;
    }
</style>

<div class="main">
    <div class="content">
    	<div class="section group">
        <h2><span>Offline betaling</span></h2>
            <div class="payment_cart">
            <table class="tblone">
            <h2><span>Uw producten: </span></h2>
                <tr>
                    <td>Nr</td>
                    <td>Product Name</td>
                    <td>Image</td>
                    <td>Price</td>
                    <td>Qty</td>
                    <td>Price</td>
                </tr>
                <?php
                    global $total ;
                    $total = 0;
                    $getProd = $ct->getCartProd();
                    if ( $getProd ){
                        $i = 0;
                        $qty = 0;
                        while ( $fillCart = $getProd->fetch_assoc() ){
                            $i++;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $fillCart['productName'];?></td>
                    <td><img src="<?php echo "admin/" . $fillCart['image'];?>" alt=""/></td>
                    <td><?php echo '€ ' . $fillCart['price'];?></td>
                    <td><?php echo $fillCart['qty'];?></td>
                    <td>
                        <?php echo '€ ' . $subTotal = $fillCart['qty'] * $fillCart['price']; ?>
                    </td>
                </tr>
                <?php 
                    $qty += $fillCart['qty'];
                    $total += $subTotal;
                    $totalCart = $total + round($total * 0.21, 2); // geef totaalprijs in winkelwagen + btw

                    Session::set('total', $totalCart); // is prijs inclusief btw
                    Session::set('qty', $qty);
                    }}
                ?>
            </table>
            <?php
                $checkCart = $ct->checkCart();
                if ( $checkCart ){
            ?>
            <table class="tbltwo">
                <tr>
                    <th>Sub Total : </th>
                    <td>€ <?php echo $total;?></td>
                </tr>
                <tr>
                    <th>BTW (21%) : </th>
                    <td>€ <?php echo $btw = round($total  * 0.21, 2);?></td>
                </tr>
                <tr>
                    <th style="font-weight:bold;">Grand Total :</th>
                    <td style="font-weight:bold;">€ <?php echo $grandTotal = $total + $btw;?></td>
                </tr>
            </table>
            <?php
                }
            ?>
            </div>
            <div class="payment_user">
                <table class="tblone">
                <h2><span>Uw gegevens: </span></h2>
                <?php
                    $id = Session::get('userId');
                    $getUser = $ur->getUser($id);
                    if ( $getUser ){
                        while ( $result = $getUser->fetch_assoc() ){
                    ?>
                    <tr>
                        <td width="20%"">Naam </td>
                        <td width="5%">: </td>
                        <td><?php echo $result['naam'];?></td>
                    </tr>
                    <tr>
                        <td>Telefoonnummer </td>
                        <td>: </td>
                        <td><?php echo $result['telnummer'];?></td>
                    </tr>
                    <tr>
                        <td>email </td>
                        <td>: </td>
                        <td><?php echo $result['email'];?></td>
                    </tr>
                    <tr>
                        <td>Adres </td>
                        <td>: </td>
                        <td><?php echo $result['adres'];?></td>
                    </tr>
                    <tr>
                        <td>Woonplaats </td>
                        <td>: </td>
                        <td><?php echo $result['woonplaats'];?></td>
                    </tr>
                    <tr>
                        <td>Postcode </td>
                        <td>: </td>
                        <td><?php echo $result['postcode'];?></td>
                    </tr>
                    <tr>
                        <td>Land </td>
                        <td>: </td>
                        <td><?php echo $result['land'];?></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td><a href="editprofile.php">Update instellingen</a> </td>
                    </tr>
                    <?php }} ?>
                </table>
                
            </div>
            
        </div>
    </div>
    <div class="back">
        <a href="?orderId=order">Verder >></a>
    </div>
</div>

<?php include './inc/footer.php'; ?>