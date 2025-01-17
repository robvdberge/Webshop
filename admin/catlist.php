﻿<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Category.php'; 

$cat = new Category;
if (isset($_GET['catDel'])) {
	$id = $_GET['catDel'];
	$catDel = $cat->catDelById($id);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
					<?php if (isset($catDel)){echo $catDel;}; ?>
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
						$getCat = $cat->getAllCats();
						if ( $getCat ){
							$i = 0;
							while ( $result = $getCat->fetch_assoc() ){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catId=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Weet je het zeker?')" href="?catDel=<?php echo $result['catId']; ?>">Delete</a></td>
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

