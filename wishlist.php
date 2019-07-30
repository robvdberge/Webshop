<?php 
include './inc/header.php'; 
$uId = Session::get('userId');

if (isset( $_GET['delWish'] )){
	$pId = $_GET['delWish'];
	$delWishItem = $pd->delWish($pId, $uId);
}

// if ( !isset( $_GET['id'] ) ){
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> "; // Live update or refresh screen!!!!
// }


?>

    <div class="main">
    	<div class="content">
    		<div class="cartoption">		
				<div class="cartpage">
					<h2>Wenslijst</h2>
					<?php if (isset($delWishItem)){echo $delWishItem;}?>
                    <table class="tblone">
                        <tr>
                            <th width="5%">Nr</th>
                            <th width="30%">Product Name</th>
                            <th width="10%">Image</th>
                            <th width="10%">Price</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                            global $total ;
                            $total = 0;
                            $getWish = $pd->checkAnyWish($uId);
                            if ( $getWish ){
                                $i = 0;
                                while ( $result = $getWish->fetch_assoc() ){
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['productName'];?></td>
                            <td><img src="<?php echo "admin/" . $result['image'];?>" alt=""/></td>
                            <td>€ <?php echo $result['price'];?></td>
                            <td>
								<a href="preview.php?pId=<?php echo $result['productId'];?>">Bekijk</a>||
								<a href="wishlist.php?delWish=<?php echo $result['productId'];?>">Verwijder</a>
							</td>
                        </tr>
                        <?php }} else {echo '<td></td><td><h3>Uw wenslijst is leeg</h3></td>';} ?>
                    </table>
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    			</div>  	
        	<div class="clear"></div>
    	</div>
 	</div>
</div>

<?php include './inc/footer.php'; ?>