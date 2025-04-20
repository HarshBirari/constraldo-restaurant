<?php 

	include('Admin/db.php');

	if(isset($_POST['cart_id']))
	{
		$cart_id = $_POST['cart_id'];
		$qty = $_POST['qty'];
		$single_price = $_POST['single_price'];

		$total_price = $single_price * $qty;

		$qu = "update cart set `total_price` = '$total_price',`qty`='$qty' where `cart_id` = '$cart_id'";
		$que = mysqli_query($con,$qu);


	}


 ?>

