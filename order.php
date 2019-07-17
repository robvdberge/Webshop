<?php 
include './inc/header.php'; 
$loggedIn = Session::get('userLogin');

if ( !$loggedIn ){
	header('location: login.php');
	exit();
}
$uId = Session::get('userId');
$fm = new Format;

?>
<style>
.tblone{
    border: 1px solid #ddd;
}
.tbltwo{
    float:right;
    text-align:left;
    border: 1px solid #ddd;
}
</style>

<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="notfound">
            <h2>Uw bestellingsgegevens:</h2>
                <div>
                <table class="tblone">
                    <tr>
                        <th>Nr</th>
                        <th>Productnaam</th>
                        <th>Afbeelding</th>
                        <th>Prijs</th>
                        <th>Hoeveelheid</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Actie</th>
                    </tr>
                    <?php
                        global $total ;
                        $total = 0;
                        $getOrder = $or->getOrder($uId);
                        if ( $getOrder ){
                            $i = 0;
                            $qty = 0;
                            while ( $showOrder = $getOrder->fetch_assoc() ){
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $showOrder['productName'];?></td>
                        <td><img src="<?php echo "admin/" . $showOrder['image'];?>" alt=""/></td>
                        <td>€ <?php echo $showOrder['price'];?></td>
                        <td><?php echo $showOrder['qty'];?></td>
                        <td><?php echo $fm->datumFormat($showOrder['datum']);?></td>
                        <td>
                            <?php 
                            echo $status = $fm->getStatus($showOrder['status']);
                            ?>
                        </td>
                        <td>
                        <?php if ($showOrder['status']){ ?>
                        <p class="success"><a onclick="return confirm('Weet je het zeker?');" href="">X</a></p>
                        <?php } else { ?>
                        <p class="error"> Niet beschikbaar</p>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php 
                        }}
                    ?>
                </table>
                </div>
            
            </div>
        </div>
				 	
        <div class="clear"></div>
    </div>
</div>

<?php include './inc/footer.php'; ?>