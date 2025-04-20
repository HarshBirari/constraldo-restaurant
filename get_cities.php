<?php

include('Admin/db.php');

if (isset($_POST['state_id'])) {
	$state_id = $_POST['state_id'];
	$sel = "select * from cities where `state_id` = '$state_id'";
	$qu = mysqli_query($con, $sel);
}

?>

<?php while ($cities = mysqli_fetch_array($qu)) { ?>
	<select name="city" class="form-control">
		<option style="color: #000;" value="<?php echo $cities['id']; ?>"><?php echo $cities['name']; ?></option>
	</select>
<?php
}
?>