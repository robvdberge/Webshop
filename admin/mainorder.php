<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$or = new Order;
$fm = new Format;

if ( isset( $_GET['shiftId'] ) ){
	$id = $_GET['shiftId'];
	$price = $_GET['price'];
	$time = $_GET['time'];
	$statusUpdate = $or->updateStatus($id, $price, $time);
}
if ( isset( $_GET['delId']) ){
	$id = $_GET['delId'];
	$price = $_GET['price'];
	$time = $_GET['time'];
	$deleteOrder = $or->deleteOrder($id, $price, $time);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Bestellingen</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<?php if (isset($statusUpdate)){echo $statusUpdate;}?>
					<?php if (isset($deleteOrder)){echo $deleteOrder;}?>
					<thead>
						<tr>
							<th>Order Id</th>
							<th>Datum</th>
							<th>Productnaam</th>
							<th>Hoeveelheid</th>
							<th>Prijs</th>
							<th>KlantId</th>
							<th>Adres</th>
							<th>Actie</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getOrderData = $or->getAllOrders();
						if ( $getOrderData ){
							while ( $result = $getOrderData->fetch_assoc() ){
						
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['orderId'];?></td>
							<td><?php echo $result['datum'];?></td>
							<td><?php echo $result['productName'];?></td>
							<td><?php echo $result['qty'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><?php echo $result['userId'];?></td>
							<td><a href="customer.php?uId=<?php echo $result['userId'];?>">Bekijk gegevens</a></td>
							<?php if ($result['status'] == '0' ){ ?>
							<td><a href="?shiftId=<?php echo $result['userId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['datum'];?>"><?php echo $status = $fm->getStatus($result['status']);?></a></td>
							<?php } else { ?>
							<td><a href="?delId=<?php echo $result['userId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['datum'];?>">Verwijder</a></td>
							<?php } ?>
						</tr>
							<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
