<?php 

include('header.php');

if(isset($_POST['submit']))
{
  $category = $_POST['category'];
  $subcategory = $_POST['subcategory'];

  if($category=="")
  {
    echo  "<script>alert('Category must be required!')</script>";
  }
  elseif($subcategory=="")
  {
    echo  "<script>alert('Subcategory must be required!')</script>";
  }
  else
  {
    if(isset($_GET['sub_id']))
    {
      $sub_id = $_GET['sub_id'];
      $insert = "update subcategory set `cat_id` = '$category',`subcategory_name`='$subcategory' where `sub_id` = '$sub_id'";
      $qu = mysqli_query($con,$insert);
      if($qu)
    {
      $msg = "Subcategory Updated..!";
    }
    }
    else
    {
      $insert = "insert into subcategory (`cat_id`,`subcategory_name`) values ('$category','$subcategory')";
      $qu = mysqli_query($con,$insert);
      if($qu)
    {
      $msg = "Subcategory Added Successfully..!";
    }
    }


    
  }

}

if(isset($_GET['sub_id']))
{
  $sub_id = $_GET['sub_id'];
  $sel = "select * from subcategory where `sub_id` = '$sub_id'";
  $qu1 = mysqli_query($con,$sel);
  $que = mysqli_fetch_array($qu1);
  
}


?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
     
   
      <div class="col-md-9">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Subcategory Item</h4>
            </div>
          </div>
          
          
          <div class="card-body ">
            <form method="post" enctype="multipart/form-data" class="form-horizontal">
              

              <div class="row">
                <?php if(isset($msg)) { ?>
                  <div class="alert alert-success"><?php echo $msg; ?></div>
                <?php } ?>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Category</label>
                <?php $sel = "select * from category";
                $qu1 = mysqli_query($con,$sel); ?>
                <div class="col-lg-5 col-md-6 col-sm-3">
                  <select class="selectpicker" data-style="select-with-transition" name="category">
                    <option value="">--SELECT CATEGORY--</option>
                    <?php while($category = mysqli_fetch_array($qu1)) { ?>
                      <option <?php if(@$que['cat_id']) { if($category['cat_id']==$que['cat_id']) { echo "selected"; } } ?> value="<?php echo $category['cat_id']; ?>"><?php echo $category['category_name']; ?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div><br>

              <div class="row">
                <label class="col-sm-2 col-form-label">Subategory name</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="subcategory" value="<?php if(@$que['subcategory_name']) { echo $que['subcategory_name']; } ?>" class="form-control" placeholder="Enter Subcategory">
                  </div>
                </div>
              </div>

              
              <div style="text-align: center;">
                <?php if(isset($_GET['id'])) { ?>
                  <button type="submit" name="submit" class="btn btn-info">Update</button>
                <?php } else { ?>
                  <button type="submit" name="submit" class="btn btn-info">Add Subcategory</button>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php include('footer.php'); ?>