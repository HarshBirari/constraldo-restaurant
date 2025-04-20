<?php 
    ob_start();
    include('header.php'); 

    if(isset($_GET['p_id']))
    {
        $p_id = $_GET['p_id'];
        $sel = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where product.`p_id` = '$p_id'";
        $qu = mysqli_query($con,$sel);
        $que = mysqli_fetch_array($qu);
    }
    else 
    {
        header('location:index.php');
    }

    if(isset($_POST['submit']) && isset($_POST['product_size1']))
    {
        $p_id = $_POST['p_id'];
        $cat_name = $_POST['cat_name'];
        $single_price = $_POST['product_price'];
        @$flavour = $_POST['flavour'];
        $product_size1 = $_POST['product_size1'];
        $quantity = $_POST['quantity'];
        $product_total_price = $_POST['product_total_price'];
        $pricewithsize = $product_total_price/$quantity;

        if($flavour=="" && $cat_name=="Coffee")
        {
            echo "<script>alert('Flavour Must Be Select');</script>";
        }
        elseif($product_size1=="")
        {
            echo "<script>alert('Product Size Must Be Select');</script>";
        }
        else if(isset($_SESSION['users']['user_id'])!="")
        {
           $user_id = $_SESSION['users']['user_id'];
           $sel1 = "select * from cart where `p_id` = '$p_id' AND `user_id` = '$user_id' AND `flavour` = '$flavour' AND `cart_status` != 'Completed'";
            $que2 = mysqli_query($con,$sel1);
            $num = mysqli_num_rows($que2);

            if($num==0)
            {
                $insert = "insert into cart (`p_id`,`user_id`,`single_price`,`flavour`,`size`,`qty`,`total_price`,`pricewithsize`,`cart_status`) values ('$p_id','$user_id','$single_price','$flavour','$product_size1','$quantity','$product_total_price','$pricewithsize','Pending')";
                 $ins_fire = mysqli_query($con,$insert);

                 $sel1 = "select * from cart where  `user_id` = '$user_id' AND `cart_status` = 'Pending'";
                 $que2 = mysqli_query($con,$sel1);
                 $num = mysqli_num_rows($que2);

                 $_SESSION['cart_record'] = $num;

                 if($ins_fire)
                 {
                    header('location:cart.php');
                 }
            }
            else
            { ?>

                <script>
                    var cart_exist = "Product Already Added in Cart!";
                    alert(cart_exist);
                </script>
           <?php }

        }
        else
        {
            header('location:login.php');
        }
    }


    if(isset($_POST['wishlist']))
    {
        $p_id = $_POST['p_id'];

        if(isset($_SESSION['users']['user_id'])!="")
        {
            $user_id = $_SESSION['users']['user_id'];
            $sel1 = "select * from wishlist where `p_id` = '$p_id' AND `user_id` = '$user_id'";
            $que2 = mysqli_query($con,$sel1);
            $num = mysqli_num_rows($que2);

            if($num==0)
            {
                $insert = "insert into wishlist (`p_id`,`user_id`) values ('$p_id','$user_id')";
                $ins_fire = mysqli_query($con,$insert);

                if($ins_fire)
                {
                    header('location:wishlist.php');
                }
            }
            else
            { ?>
                 <script>
                    var cart_exist = "Product Already Added in Wishlist!";
                    alert(cart_exist);
                </script>
            <?php }
        }
        else
        {
            header('location:login.php');
        }
    }


?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/23.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Product Detail</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

<form method="post">
    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
                <input type="hidden" name="cat_name" value="<?php echo $que['category_name']; ?>">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="admin/image/<?php echo $que['product_image']; ?>" class="image-popup"><img src="admin/image/<?php echo $que['product_image']; ?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
               <!--  <?php if(isset($product_exist)) { ?>
                    <h5 style="color:#721c24;" class="comfirm"></h5>
                <?php } ?> -->
                <input type="hidden" name="p_id" id="p_id" value="<?php echo $que['p_id']; ?>">
    				<h3><?php echo $que['subcategory_name']; ?> <?php echo $que['category_name']; ?></h3>
    				<p class="price"><span><i class="fa fa-rupee"></i> <?php echo $que['product_price']; ?>.00</span></p>
                    <div class="mt-3 d-flex">
                        <label class="col-lg-3">Description</label>
                        <p class="flavour-select">: &nbsp;&nbsp;<?php echo $que['product_description']; ?></p>
                        <input type="hidden" name="product_price" id="price" value="<?php echo $que['product_price']; ?>">
                    </div>

                    <?php if($que['cat_id']==1) { ?>
                    <div class="d-flex flex-wrap">
                        <p class="col-lg-3">Flavour :</p>
                            <?php $flavour = explode(',',$que['product_flavour']);
                            for($i=0;$i<count($flavour);$i++) { 
                             ?>
                          <label id="form" class="col-lg-3"><button name="flavour" onclick="return choose_flavour()" value="<?php echo $flavour[$i]; ?>" id="flavour" style="width: 112px !important;" class="btn  btn-primary hover-btn addItemBtn"><?php echo $flavour[$i]; ?></button></label>
                            <?php } ?>
                    </div>
                    <div class="mt-3 ml-4">
                        <label style="margin-left: -8px;">Flavour Selected :</label>
                        <input type="hidden" readonly style="border: none;" name="flavour" class="flavour-select" id="set_flavour">
                    </div>
                <?php } else if($que['cat_id']!=5){ ?>
                    <?php if($que['product_qty']!=0) { ?>
                     <div class="mt-3 d-flex">
                        <label class="col-lg-3">In Stock</label>
                        <p class="flavour-select">: &nbsp;&nbsp;<?php echo $que['product_qty']; ?></p>
                    </div>
                <?php } ?>

                    <?php if($que['product_qty']<=10 && !$que['product_qty']==0) { ?>
                        <div class="mt-3 ml-4">
                        <label style="margin-left: -8px; color: green">Hurry up guys only <?php echo $que['product_qty']; ?> quantity left!!  </label>
                    </div>
                    <?php } else if($que['product_qty']==0) { ?>
                         <div class="mt-3 ml-4">
                        <label style="margin-left: -8px; color: red;">Now This Product Out of Stock..! </label>
                         </div>
                    <?php } ?>
                <?php } ?>

                 <div class="mt-3 d-flex">
                        <label class="col-lg-3">Return Policy</label>
                        <p class="flavour-select">: &nbsp;&nbsp;Yes</p>
                    </div>


					<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select onchange="return product_size_select()" class="form-control" id="product_size">
                        <option>Select Size</option>
                        <?php 
                        $product_size = explode(',',$que['product_size']);?>
                        <?php for($i=0;$i<count($product_size);$i++) { ?>
	                  	<option value="<?php echo $product_size[$i]; ?>"><?php echo $product_size[$i]; ?></option>
                      <?php } ?>
	                  </select>
	                </div>
		            </div>
                    <input type="hidden" name="product_size1" id="product_size1">

							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn" onclick="return change_qty_minus()"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" onclick="return change_qty_plus()" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button>
	             	</span>
	          	</div>
          	</div>
            <div class="product-details">
            <p class="price1"><span><i id="total_price" class="fa fa-rupee"><?php echo $que['product_price']; ?></i></span></p>
            </div>
            <input type="hidden" name="product_total_price" id="total_price1" value="<?php echo $que['product_price']; ?>">
             <?php if($que['cat_id']!=5 && $que['cat_id']!=1) { ?>
                <?php if($que['product_qty']!=0) { ?>
                    <button type="submit" class="btn btn-primary hover-btn" name="submit" style="width: 200px;">Add to Cart</button>
                <?php } else { ?>
                     <p><a href="notify.php" class="btn btn-primary py-3 px-5" style="width: 200px;">Notify Me</a></p>
                <?php } ?>

            <?php } else { ?>
                <button type="submit" class="btn btn-primary hover-btn" name="submit" style="width: 200px;">Add to Cart</button>
            <?php } ?>
                 <button type="submit" class="btn btn-primary hover-btn" name="wishlist" style="width: 200px;">Add to Wishlist</button>
    			</div>
    		</div>
    	</div>
    </section>
</form>

<?php 

    $related_select = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where `p_id` = '$p_id'";
    $related_query_fire = mysqli_query($con,$related_select);

 ?>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">

            <?php $related_data = mysqli_fetch_array($related_query_fire);

            $related_cat_id = $related_data['cat_id'];
            $related_product = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where product.`cat_id` = '$related_cat_id' LIMIT 0,9";
            $related_product_fire = mysqli_query($con,$related_product);
            while($related_product_data = mysqli_fetch_array($related_product_fire)) {
                if($related_product_data['p_id']!=$p_id) {
             ?>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $related_product_data['product_image']; ?>);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $related_product_data['subcategory_name']; ?> <?php echo $related_product_data['category_name']; ?></a></h3>
    						<p style="height: 80px;overflow: hidden;"><?php echo $related_product_data['product_description']; ?></p>
    						<p class="price" ><span><i class="fa fa-rupee"><?php echo $related_product_data['product_price']; ?></i></span></p>
    					   <p><a href="single_product.php?p_id=<?php echo $related_product_data['p_id']; ?>" class="btn btn-primary btn-outline-primary">Show Product</a></p>
    					</div>
    				</div>
        	</div>
        	<?php } } ?>
        </div>
    	</div>
    </section>

   <?php include('footer.php'); ?>

   <script>

   $(document).ready(function(){
        $(".addItemBtn").click(function(f){
        f.preventDefault();
        var $form = $(this).closest("#form");
        var flavour = $form.find("#flavour").val();

        $('#set_flavour').val(flavour);
        var myform = document.getElementById('set_flavour');
        myform.type = "text";
        });
    });
       
    function change_qty_minus()
    {
       
        var product_size = $('#product_size').val();

        if(product_size=="Small")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price;
           $('#total_price').html(qty);
           $('#total_price1').val(qty);
        }

        if(product_size=="Medium")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 100);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }


        if(product_size=="Large")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 300);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }


        if(product_size=="Extra Large")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 500);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         if(product_size=="150 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 500);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         if(product_size=="250 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 50);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         if(product_size=="500 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 100);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

        if(product_size=="1.0 L")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 200);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

          if(product_size=="2.25 L")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();

             if(quantity>=2)
            {
                qty = quantity-1;
            }
            else
            {
                qty = 1;
            }

            $('#quantity').val(qty);

            qty = qty * price + (qty * 400);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }
       
    }

    function change_qty_plus()
    {
        
        var product_size = $('#product_size').val();

        if(product_size=="Small")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price;
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

        else if(product_size=="Medium")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 100);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

          else if(product_size=="Large")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 300);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

          else if(product_size=="Extra Large")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 500);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         else if(product_size=="150 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price;
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         else if(product_size=="250 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 50);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }


         else if(product_size=="500 ML")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 100);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         else if(product_size=="1.0 L")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 200);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

         else if(product_size=="2.25 L")
        {
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            qty = quantity-0+1;
            $('#quantity').val(qty);

             qty = qty * price + (qty * 400);
            // alert(qty);
            $('#total_price').html(qty);
            $('#total_price1').val(qty);
        }

    }

    function product_size_select()
    {
        var product_size = $('#product_size').val();

        if(product_size=="Small")
        {
            var quantity = $('#quantity').val();
            product_price = $('#price').val();
            product_price = product_price * quantity;
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }
        else if(product_size=="Medium")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (100 * quantity);
            // alert(product_price);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }
        else if(product_size=="Large")
        {
            product_price = $('#price').val();
             var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (300 * quantity);

            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }
        else if(product_size=="Extra Large")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (500 * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        else if(product_size=="150 ML")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        else if(product_size=="250 ML")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (50 * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        else if(product_size=="500 ML")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (100 * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        else if(product_size=="1.0 L")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (200 * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        else if(product_size=="2.25 L")
        {
            product_price = $('#price').val();
            var quantity = $('#quantity').val();
            product_price = (product_price * quantity) + (400 * quantity);
            $('#total_price').html(product_price);
            $('#total_price1').val(product_price);
        }

        $('#product_size1').val(product_size);
    }


  

   </script>
   