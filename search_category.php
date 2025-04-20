<?php 

 include('Admin/db.php');
	
  if(isset($_POST['search']) && isset($_POST['search_record'])=="search_record")
  {
  	@$ser = $_POST['search'];
  	@$cat_sel = "select * from category where `category_name` LIKE '%$ser%'";
    @$cat_fire = mysqli_query($con,$cat_sel);
    @$cat_num_rows = mysqli_num_rows($cat_fire);

  }
 


   while($cat_fetch_data = mysqli_fetch_array($cat_fire)) { 
                      
                  
                         $cat_id = $cat_fetch_data['cat_id'];
                         $sub_sel = "select * from subcategory where `cat_id` = '$cat_id'";
                         $sub_fire = mysqli_query($con,$sub_sel);
                         $sub_num_rows = mysqli_num_rows($sub_fire);

                  

 ?>

                <li><a href="shop.php"><?php echo $cat_fetch_data['category_name']; ?><span><?php echo $sub_num_rows; ?></span></a></li>
<?php } ?>