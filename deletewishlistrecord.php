<?php 

	session_start();

	include('admin/db.php');
	
	if(@$_POST['wishlist_id']!="clear")
	{
	  $wishlist_id = $_POST['wishlist_id'];
	  $del_cart_item = "delete from wishlist where `id` = '$wishlist_id'";
	  mysqli_query($con,$del_cart_item);
	}
	else
	{
	  $user_id = $_SESSION['users']['user_id'];
	  $del = "delete from wishlist where `user_id` = '$user_id'";
	  mysqli_query($con,$del);
	}

 ?>