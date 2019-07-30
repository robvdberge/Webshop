<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/Brand.php';

$bd = new Brand;
$getSlider = $bd->getSliderImages();

if (isset($_GET['slideDel'])) {
	$id = $_GET['slideDel'];
	$slideDel = $bd->slideDelById($id);
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> ";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<?php if (isset($slideDel)){echo $slideDel;}?>
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if ($getSlider) {
					$i = 0;
					while ( $result = $getSlider->fetch_assoc() ){
						$i++;
						$image = $result['image'];
			?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['title'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"/></td>				
				<td>
					<a href="slideredit.php?slideId=<?php echo $result['id'];?>">Edit</a> || 
					<a onclick="return confirm('Weet je het zeker?')" href="?slideDel=<?php echo $result['id'];?>">Delete</a> 
				</td>
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
