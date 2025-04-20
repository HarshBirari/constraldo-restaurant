<?php 

	include('admin/db.php');

	if(isset($_POST['order_id']))
	{
		$order_id = $_POST['order_id'];
		$sel = "update comfirm_order set `order_status` = 'Cancelled' where `order_id` = '$order_id'";
		$qu5 = mysqli_query($con,$sel);
		echo "Your Order is Cancelled..!";
	}


 ?>