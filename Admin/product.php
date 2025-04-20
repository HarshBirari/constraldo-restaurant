<?php 

  include('header.php');

  if(isset($_POST['submit']))
  {
    @$category = $_POST['category'];
    @$subcategory = $_POST['subcategory'];
    @$product_desc = $_POST['product_desc'];
    @$product_price = $_POST['price'];
    @$product_qty = $_POST['qty'];
    @$product_flavour = isset($_POST['flavour'])?implode(',',$_POST['flavour']):'';
    @$product_size = isset($_POST['size'])?implode(',',$_POST['size']):'';
    $rand = rand(1000,9999);
    @$product_image = $rand.$_FILES['product_image']['name'];

    move_uploaded_file($_FILES['product_image']['tmp_name'],"image/".$product_image);

    
      $insert = "insert into product (`cat_id`,`sub_id`,`product_description`,`product_price`,`product_qty`,`product_flavour`,`product_size`,`product_image`) values ('$category','$subcategory','$product_desc','$product_price','$product_qty','$product_flavour','$product_size','$product_image')";

    $qu = mysqli_query($con,$insert);

    if($qu)
    {
      $msg = "Product Detail inserted successfully";
    }
  }

  if(isset($_GET['p_id']))
  {
    $p_id = $_GET['p_id'];
    $sel = "select * from product where `p_id` = '$p_id'";
    $qu1 = mysqli_query($con,$sel);
    $que = mysqli_fetch_array($qu1);

  }


 ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
           
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Product Master</h4>
                  </div>
                </div>
                   
               
                <div class="card-body ">
                  <form method="post" enctype="multipart/form-data" class="form-horizontal">
                  
                    <input type="hidden" name="p_id" id="p_id" value="<?php echo $que['p_id']; ?>">
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
                          <select class="selectpicker" id="category" onchange="return change_category()" data-style="select-with-transition" name="category">
                            <option>- - -SELECT CATEGORY- - -</option>
                            <?php while($category = mysqli_fetch_array($qu1)) { ?>
                            <option <?php if(@$que['cat_id']) { if($category['cat_id']==$que['cat_id']) { echo "selected"; } } ?> value="<?php echo $category['cat_id']; ?>"><?php echo $category['category_name']; ?> </option>
                          <?php } ?>
                          </select>
                        </div>
                    </div><br>


                    <div class="row">
                      <label class="col-sm-2 col-form-label">Subategory name</label>

                      <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="form-control" name="subcategory" id="subcategory">
                            <?php $sel1 = "select * from subcategory"; 
                                 $qu1 = mysqli_query($con,$sel1);
                     
                       ?>
                              <option>- - -SELECT SUBCATEGORY- - -</option>
                              <?php while($subcategory = mysqli_fetch_array($qu1)) { ?>
                              <option <?php if(@$que['sub_id']) { if($que['sub_id']==$subcategory['sub_id']) { echo "selected"; } } ?>><?php echo $subcategory['subcategory_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div><br>

                    <div class="row" id="flavour">
                      
                    </div><br>
                  
                  <?php if(isset($_GET['p_id'])) { ?>
                  <div class="row">
                   <label class="col-sm-2 col-form-label">Image</label>
                         <div class="col-lg-5 col-md-6 col-sm-3">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="image/<?php echo $que['product_image']; ?>" alt="...">
                        </div>
                         
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="product_image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    </div>
                  <?php } else { ?>
                     <div class="row">
                   <label class="col-sm-2 col-form-label">Image</label>
                         <div class="col-lg-5 col-md-6 col-sm-3">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="../assets/img/1.jpg" alt="...">
                        </div>
                         
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="product_image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    </div>
                  <?php } ?>

                    <?php if(isset($_GET['id'])) { ?>
                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                    <?php } else { ?>
                    <button type="submit" name="submit" class="btn btn-info">Add Product</button>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    <?php include('footer.php'); ?>

    <script>
      
      function change_category()
      {
        var cat_id = $('#category').val();
        var p_id = $('#p_id').val();

        $.ajax({
          url : "get_subcategory.php",
          type : "post",
          data :{
            'cat_id' : cat_id
          },
          success : function(subcat)
          {
            $('#subcategory').html(subcat);
          }
        });

        $.ajax({
          url : "get_flavour.php",
          type : "post",
          data :{
            'cat_id' : cat_id
          },
          success : function(flavour)
          {
            // alert(flavour);
            $('#flavour').html(flavour);

            // console.log(subcat);
          }
        });
      }



    </script>