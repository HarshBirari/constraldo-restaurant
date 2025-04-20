<?php 

include('Admin/db.php');

if(isset($_POST['cat_id']))
{
	$cat_id = $_POST['cat_id'];
	$sel = "select * from product JOIN subcategory ON subcategory.sub_id = product.sub_id where subcategory.`cat_id` = '$cat_id' AND subcategory.`sub_status` = '1' AND product.`product_status` = '1' ORDER BY p_id ASC LIMIT 4";
	$qu = mysqli_query($con,$sel);

}

?>
<?php while($que = mysqli_fetch_array($qu)) { ?>
	<div class="col-md-3">
		<div class="menu-entry">
			<a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $que['product_image']; ?>);"></a>
			<div class="text text-center pt-4">
				<h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $que['subcategory_name']; ?></a></h3>
				<p><?php echo $que['product_description']; ?></p>
				<p class="price"><span><i class="fa fa-rupee"><?php echo $que['product_price']; ?>.00</i></span></p>
				<p><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
			</div>
		</div>
	</div>

	<?php } ?>