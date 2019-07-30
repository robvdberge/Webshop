<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include_once '../classes/Product.php';
include_once '../helpers/Format.php';

$pd = new Product;
$fm = new Format;

if (isset($_GET['prodDel'])) {
	$id = $_GET['prodDel'];
	$prodDel = $pd->prodDelById($id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Products List</h2>
        <div class="block"> 
		<?php if (isset($prodDel)){echo $prodDel;}; ?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Nr</th>
					<th>Product name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$getPd = $pd->getAllProducts();
				if ($getPd) {
					$i = 0;
					while ( $result = $getPd->fetch_assoc() ){
						$i++;
						$pName = $fm->textShorten($result['productName'],20);
						$catId = $result['catName'];
						$brand = $result['brandName'];
						$body = $fm->textShorten($result['body'],30); // shorten the description
						$image = $result['image'];
						$price = $result['price'];
						$type = $result['type'];

			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $pName; ?></td>
					<td><?php echo $catId; ?></td>
					<td><?php echo $brand; ?></td>
					<td><?php echo $body; ?></td>
					<td><?php echo $price; ?></td>
					<td><img src="<?php echo $image; ?>" height="40px" width="60px"></td>
					<td><?php 
					if ( $type == 0 ){
						echo "Featured";
					} else { 
						echo "General";
					}
						?></td>
					<td><a href="productEdit?pId=<?php echo $result['productId'];?>">Edit</a> || 
					<a onclick="return confirm('Weet je het zeker?')" href="?prodDel=<?php echo $result['productId'];?>">Delete</a></td>
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
