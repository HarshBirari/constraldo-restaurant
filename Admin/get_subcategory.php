<?php 

	include('db.php');

	if(isset($_POST['cat_id']))
	{
		$cat_id = $_POST['cat_id'];
		$sel = "select * from subcategory where `cat_id` = '$cat_id'";
		$qu = mysqli_query($con,$sel);

	}

 ?>

                   
                      <label class="col-sm-2 col-form-label">Subategory name</label>

                      <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="form-control" name="subcacategory">
                            <option>- - -SELECT SUBCATEGORY- - -</option>
                            <?php while($data = mysqli_fetch_array($qu)) { ?>
                            <option value="<?php echo $data['sub_id']; ?>"><?php echo $data['subcategory_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>


                   











