<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/brand.php'; 

$brand = new Brand;
if (isset($_GET['brandDel'])) {
	$id = $_GET['brandDel'];
	$brandDel = $brand->brandDelById($id);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">        
					<?php if (isset($brandDel)){echo $brandDel;}; ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php  
						$getBrand = $brand->getAllBrands();
						if ( $getBrand ){
							$i = 0;
							while ( $result = $getBrand->fetch_assoc() ){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandId=<?php echo $result['brandId']; ?>">Edit</a> || <a onclick="return confirm('Weet je het zeker?')" href="?brandDel=<?php echo $result['brandId']; ?>">Delete</a></td>
						</tr>

					<?php
							}
						}
					?>
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