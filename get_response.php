<?php 

	include('admin/db.php');

	if(isset($_POST['book_table_id']))
	{
		$book_table_id = $_POST['book_table_id'];
		$sel = "select * from book_table where `book_table_id` = '$book_table_id'";
		$qu = mysqli_query($con,$sel);
		$fetch = mysqli_fetch_array($qu);
		echo $status = $fetch['remarks'];
	}

 ?>