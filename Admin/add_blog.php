<?php 

include('header.php');

if(isset($_POST['submit']))
{
  $blog_name = $_POST['blog_name'];
  $blog_desc = $_POST['blog_desc'];
  $blog_header = $_POST['blog_header'];
  $chef_name = $_POST['chef_name'];
  $chef_desc = $_POST['chef_desc'];
  $rand = rand(10000,99999);
  $image = $rand.$_FILES['image']['name'];
  $rand = rand(10000,99999);
  $chef_image = $rand.$_FILES['chef_image']['name'];
  
  move_uploaded_file($_FILES['image']['tmp_name'],"image/blog/".$image);
  move_uploaded_file($_FILES['chef_image']['tmp_name'],"image/blog/".$chef_image);

  $blog_insert = "insert into blog (`blog_name`,`blog_desc`,`blog_header`,`image`,`chef_name`,`chef_desc`,`chef_image`) values ('$blog_name','$blog_desc','$blog_header','$image','$chef_name','$chef_desc','$chef_image')";
  $qu = mysqli_query($con,$blog_insert);

  if($qu)
  {
    $msg = "Blog Successfully Added";
  }
}

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
     
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Form Elements</h4>
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
                <label class="col-sm-2 col-form-label">Blog name</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="blog_name" value="<?php if(isset($que['name'])) { echo $name[0]; } ?>" class="form-control" placeholder="Enter Blog name">
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Blog Header</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <textarea name="blog_header" rows="2" style="width: 100%"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">Blog Description</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <textarea name="blog_desc" rows="5" style="width: 100%"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Chef name</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="chef_name" value="<?php if(isset($que['name'])) { echo $name[0]; } ?>" class="form-control" placeholder="Enter Blog name">
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Chef Description</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <textarea name="chef_desc" rows="5" style="width: 100%"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
               <label class="col-sm-2 col-form-label">Blog Image</label>
               <div class="col-lg-5 col-md-6 col-sm-3">

                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    <img src="../assets/img/2.jpg" alt="...">
                  </div>
                  
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                  <div>
                    <span class="btn btn-rose btn-round btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
             <label class="col-sm-2 col-form-label">Chef Image</label>
             <div class="col-lg-5 col-md-6 col-sm-3">

              <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                  <img src="../assets/img/2.jpg" alt="...">
                </div>
                
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                  <span class="btn btn-rose btn-round btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="chef_image" />
                  </span>
                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
              </div>
            </div>
          </div>
          

          
          


          <?php if(isset($_GET['id'])) { ?>
            <button type="submit" name="submit" class="btn btn-info">Update</button>
          <?php } else { ?>
            <button type="submit" name="submit" class="btn btn-info">Add a Blog</button>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  
</div>
</div>
</div>
<?php include('footer.php'); ?>