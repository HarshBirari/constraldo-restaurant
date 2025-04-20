<?php 

	session_start();

	include('admin/db.php');

	if(isset($_POST['cart_id']))
	{
	  $cart_id = $_POST['cart_id'];
	  $del_cart_item = "delete from cart where `cart_id` = '$cart_id'";
	  mysqli_query($con,$del_cart_item);
	}
	else
	{
	  $user_id = $_SESSION['users']['user_id'];
	  $del = "delete from cart where `user_id` = '$user_id'";
	  mysqli_query($con,$del);

	}

 ?>