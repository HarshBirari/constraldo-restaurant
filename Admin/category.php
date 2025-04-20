<?php 

include('header.php');

if(isset($_POST['submit']))
{
  $category = $_POST['category'];

  if($category=="")
  {
    echo "<script>alert('Category must be required!')</script>";
  }
  else
  {

    if(isset($_GET['cat_id']))
    {
      $cat_id = $_GET['cat_id'];
      $insert = "update category set `category_name` = '$category' where `cat_id` = '$cat_id'";
      $qu = mysqli_query($con,$insert);
      if($qu)
      {
        $msg = "Category Updated Successfully";
      }
    }
    else
    {
      $insert = "insert into category (`category_name`) values ('$category')";
      $qu = mysqli_query($con,$insert);
      if($qu)
      {
        $msg = "Category Inserted Successfully";
      }
    }

  }

}

if(isset($_GET['cat_id']))
{
  $cat_id = $_GET['cat_id'];
  $sel = "select * from category where `cat_id` = '$cat_id'";
  $qu1 = mysqli_query($con,$sel);
  $que = mysqli_fetch_array($qu1);

}


?>
<div class="content" >
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-9">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Category Item</h4>
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
                <label class="col-sm-2 col-form-label">Category name</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="category" value="<?php echo @$que['category_name']; ?>" class="form-control" placeholder="Enter Category Name">
                  </div>
                </div>
              </div>


              <div style="text-align: center;">
                <?php if(isset($_GET['cat_id'])) { ?>
                  <button type="submit" name="submit" class="btn btn-info">Update</button>
                <?php } else { ?>
                  <button type="submit" name="submit" class="btn btn-info">Add Category</button>
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