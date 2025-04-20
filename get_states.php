<?php 

	include('Admin/db.php');

	if(isset($_POST['country_id']))
	{
		$country_id = $_POST['country_id']; 
		$sel = "select * from states where `country_id` = '$country_id'";
		$qu = mysqli_query($con,$sel);
	}

 ?>

 					<?php while($states = mysqli_fetch_array($qu)) { ?>
  						<select name="state" id="states" class="form-control" onchange="return change_states()">
		                  	<option style="color: #000;" value="<?php echo $states['id']; ?>"><?php echo $states['name']; ?></option>
		                </select>
		                <?php } ?>