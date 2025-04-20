<?php 

include('header.php');

if(isset($_POST['submit']))
{
  @$category = $_POST['category'];
  @$subcategory = $_POST['subcategory'];
  @$product_desc = $_POST['product_desc'];
  @$product_price = $_POST['price'];
  @$product_qty = $_POST['qty'];
  @$product_flavour = implode(',',$_POST['flavour']);
  @$product_size = implode(',',$_POST['size']);
  $rand = rand(1000,9999);
  @$product_image = $_FILES['product_image']['name'];


  if(isset($_GET['p_id']))
  {
    $p_id = $_GET['p_id'];
    $sel5 = "select * from product where `p_id` = '$p_id'";
    $qu5 = mysqli_query($con,$sel5);
    $que5 = mysqli_fetch_array($qu5);

    if($product_image=="")
    {
     $product_image = $que5['product_image'];
   }
   else
   {
     @unlink("image/".$que5['product_image']);
     @$product_image = $rand.$_FILES['product_image']['name'];
     move_uploaded_file($_FILES['product_image']['tmp_name'],"image/".$product_image);
   }

   $update = "update product set `cat_id`='$category',`sub_id`='$subcategory',`product_description`='$product_desc',`product_price`='$product_price',`product_qty`='$product_qty',`product_flavour`='$product_flavour',`product_size`='$product_size',`product_image`='$product_image' where `p_id` = '$p_id'";
   $fire = mysqli_query($con,$update);

   if($fire)
   {
     $msg = "Product Detail Updated Successfully";
   }
 }
}

if(isset($_GET['p_id']))
{
  $p_id = $_GET['p_id'];
  $sel2 = "select * from product where `p_id` = '$p_id'";
  $qu = mysqli_query($con,$sel2);
  $que = mysqli_fetch_array($qu);
  $flavour = explode(',',$que['product_flavour']);
  $size = explode(',',$que['product_size']);
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
                    <option>--SELECT CATEGORY--</option>
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
                    <option>--Select subcategory--</option>
                    <?php while($subcategory = mysqli_fetch_array($qu1)) { ?>
                      <option value="<?php echo $subcategory['sub_id']; ?>" <?php if(@$que['sub_id']) { if($que['sub_id']==$subcategory['sub_id']) { echo "selected"; } } ?>><?php echo $subcategory['subcategory_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><br>

              <?php if($que['cat_id']==1) { ?>
                <div class="row">
                 <label class="col-sm-2 col-form-label">Product Description</label>
                 <div class="col-sm-10">
                  <div class="form-group">
                    <textarea name="product_desc" style="width: 100%;"><?php if(isset($que['product_description'])) { echo $que['product_description']; } ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
               <label class="col-sm-2 col-form-label">Product price</label>
               <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" value="<?php if(isset($que['product_price'])) { echo $que['product_price']; } ?>" name="price" class="form-control" placeholder="Enter Product price">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox"> Flavour </label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Espresso",$flavour)) { echo "checked"; } } ?> type="checkbox" name="flavour[]" value="Espresso"> Espresso
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Water",$flavour)) { echo "checked"; } } ?> type="checkbox" name="flavour[]" value="Water"> Water
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Milkfoam",$flavour)) { echo "checked"; } } ?> type="checkbox" name="flavour[]" value="Milkfoam"> Milkfoam
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Liquor",$flavour)) { echo "checked"; } } ?> type="checkbox" name="flavour[]" value="Liquor"> Liquor
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Cream",$flavour)) { echo "checked"; } } ?> type="checkbox" name="flavour[]" value="Cream"> Cream
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Medium",$flavour)) { echo "checked"; } } ?> type="checkbox" value="Medium" name="flavour[]"> Medium
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Lemon",$flavour)) { echo "checked"; } } ?> type="checkbox" value="Lemon" name="flavour[]"> Lemon
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_flavour']) { if(in_array("Chocolate",$flavour)) { echo "checked"; } } ?> type="checkbox" value="Chocolate" name="flavour[]"> Chocolate
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_size']) { if(in_array("Small",$size)) { echo "checked"; } } ?> type="checkbox" name="size[]" value="Small"> Small
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_size']) { if(in_array("Medium",$size)) { echo "checked"; } } ?> type="checkbox" value="Medium" name="size[]"> Medium
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_size']) { if(in_array("Large",$size)) { echo "checked"; } } ?> type="checkbox" value="Large" name="size[]"> Large
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" <?php if(@$que['product_size']) { if(in_array("Extra Large",$size)) { echo "checked"; } } ?> type="checkbox" value="Extra Large" name="size[]"> Extra large
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

          <?php } else if($que['cat_id']==2) { ?>
           <div class="row">
            <label class="col-sm-2 col-form-label">Product Description</label>
            <div class="col-sm-10">
              <div class="form-group">
                <textarea name="product_desc" style="width: 100%;"><?php echo @$que['product_description']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="row">
           <label class="col-sm-2 col-form-label">Product price</label>
           <div class="col-sm-10">
            <div class="form-group">
              <input type="text" name="price" class="form-control" value="<?php echo @$que['product_price']; ?>" placeholder="Enter Product price">
            </div>
          </div>
        </div>

      <?php } else if($que['cat_id']==5) {  ?>

       <div class="row">
         <label class="col-sm-2 col-form-label">Product Description</label>
         <div class="col-sm-10">
          <div class="form-group">
            <textarea name="product_desc" style="width: 100%;"><?php echo @$que['product_description']; ?></textarea>
          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-2 col-form-label">Product price</label>
        <div class="col-sm-10">
          <div class="form-group">
            <input type="text" name="price" value="<?php echo @$que['product_price']; ?>" class="form-control" placeholder="Enter Product price">
          </div>
        </div>
      </div>

      <div class="row">

        <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
        <div class="col-sm-10 checkbox-radios">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" <?php if(@in_array("150 ML",$size)) { echo "checked"; } ?> name="size[]" value="150 ML"> 150 ML
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" <?php if(@in_array("250 ML",$size)) { echo "checked"; } ?> name="size[]" value="250 ML"> 250 ML
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" <?php if(@in_array("500 ML",$size)) { echo "checked"; } ?> name="size[]" value="500 ML"> 500 ML
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" <?php if(@in_array("1.0 L",$size)) { echo "checked"; } ?> value="1.0 L" name="size[]"> 1.0 L
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" <?php if(@in_array("2.25 L",$size)) { echo "checked"; } ?> value="2.25 L" name="size[]"> 2.25 L
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
            </label>
          </div>
        </div>
      </div>

    <?php } else {  ?>

      <div class="row">
       <label class="col-sm-2 col-form-label">Product Description</label>
       <div class="col-sm-10">
        <div class="form-group">
          <textarea name="product_desc" style="width: 100%;"><?php echo @$que['product_description']; ?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-2 col-form-label">Product price</label>
      <div class="col-sm-10">
        <div class="form-group">
          <input type="text" name="price" class="form-control" value="<?php echo @$que['product_price']; ?>" placeholder="Enter Product price">
        </div>
      </div>
    </div>

    <div class="row">

      <label class="col-sm-2 col-form-label">Product Quantity</label>
      <div class="col-sm-10">
        <div class="form-group">
          <input type="text" name="qty" class="form-control" value="<?php echo @$que['product_qty']; ?>" placeholder="Enter Product Qty">
        </div>
      </div>
    </div>

    <div class="row">

      <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
      <div class="col-sm-10 checkbox-radios">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" <?php if(@in_array("Small",$size)) { echo "checked"; } ?> name="size[]" value="Small"> Small
            <span class="form-check-sign">
              <span class="check"></span>
            </span>
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" <?php if(@in_array("Medium",$size)) { echo "checked"; } ?> value="Medium" name="size[]"> Medium
            <span class="form-check-sign">
              <span class="check"></span>
            </span>
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" <?php if(@in_array("Large",$size)) { echo "checked"; } ?> value="Large" name="size[]"> Large
            <span class="form-check-sign">
              <span class="check"></span>
            </span>
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" <?php if(@in_array("Extra Large",$size)) { echo "checked"; } ?> value="Extra Large" name="size[]"> Extra large
            <span class="form-check-sign">
              <span class="check"></span>
            </span>
          </label>
        </div>
      </div>
    </div>
  <?php } ?>

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

<button type="submit" name="submit" class="btn btn-info">Update</button>

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
        // alert('success');
        var cat_id = $('#category').val();

        $.ajax({
          url : "get_subcategory.php",
          type : "post",
          data :{
            'cat_id' : cat_id
          },
          success : function(subcat)
          {
            $('#subcategory').html(subcat);
            // console.log(subcat);
          }
        });
      }
    </script>