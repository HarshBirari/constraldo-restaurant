<?php
    ob_start();
   include('header.php'); 


   unset($_SESSION['promocode']);
  
    @$user_id = $_SESSION['users']['user_id'];
    $sel = "select * from wishlist where `user_id` = '$user_id'";
    $qu = mysqli_query($con,$sel);
    $num = mysqli_num_rows($qu);
  
    if($num!=0)
    {

  

   if(isset($_SESSION['users']['user_id']))
   {
      $user_id = $_SESSION['users']['user_id'];
      $sel1 = "select * from wishlist JOIN product ON product.p_id = wishlist.p_id where wishlist.`user_id` = '$user_id'";
      $qu1 = mysqli_query($con,$sel1);

      $sel = "select * from wishlist where `user_id` = '$user_id'";
      $qu = mysqli_query($con,$sel);
   }
   else
   {
    header('location:login.php');
   }

   if(isset($_POST['submit']))
   {
      $coupon_code = $_POST['coupon_code'];
      $user_id = $_SESSION['users']['user_id'];
      $sel_coupon = "select * from coupon where `username` = '$user_id' AND `coupon_code` = '$coupon_code'";
      $qu_coupon = mysqli_query($con,$sel_coupon);
      $num  = mysqli_num_rows($qu_coupon);
      
      if($num==1)
      {
        if($_SESSION['subtotal']>=5000)
        {
          $promocode = 500;
          $que = mysqli_fetch_array($qu_coupon);
          $promocode_success = "Promocode Applied";
          $_SESSION['promocode'] = $promocode;
          $_SESSION['promocode_id'] = $que['coupon_id'];
        }
        else
        {
          $promocode_limit_error = "The value of the cart should be more than 5000";
        }
      }
      else
      {
        $promocode = 0;
        $promocode_error = "Invalid Promocode";
      }
   }      
}
?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/27.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Wishlist</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Wishlist</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
                  <?php  if($num!=0) { ?>
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
                    <th>Product</th>
						        <th><a href="javascript:void(0)" onclick="return deletewishlistrec('clear')" style="color: #fff;"><i class="fa fa-trash"></i>  Clear Wishlist</a></th>
						      </tr>
						    </thead>
						    <tbody>
                  <?php $subtotal = 0;
                     while($wishlist = mysqli_fetch_array($qu)) { 
                        $product = mysqli_fetch_array($qu1);
                        $cat_id = $product['cat_id'];
                        $sub_id = $product['sub_id'];

                        $product = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where category.`cat_id` = '$cat_id' AND subcategory.`sub_id` = '$sub_id'";
                        $pro_fire = mysqli_query($con,$product);
                        $product_item = mysqli_fetch_array($pro_fire);

                    ?>
                    
						      <tr class="text-center tr">
                    <input type="hidden" name="cart_id" id="cart_id" class="cart_id" value="<?php echo $wishlist['id']; ?>">
						        
						        <td class="image-prod"><div class="img" style="background-image:url(admin/image/<?php echo $product_item['product_image']; ?>);"></div></td>
						        
						        <td class="product-name">
						        	<h3><a href="single_product.php?p_id=<?php echo $product_item['p_id']; ?>"><?php echo $product_item['subcategory_name']; ?> <?php echo $product_item['category_name']; ?></a></h3>
						        	<p><?php echo $product_item['product_description']; ?></p>
						        </td>
						        
						        <td class="product-remove"><a href="javascript:void(0)" onclick="return deletewishlistrec('<?php echo $wishlist['id']; ?>')"><span class="icon-close"></span></a></td>
						        
						     
						      </tr>
                    <?php } ?>
						      
						    </tbody>
						  </table>
                <?php } else { ?>
                      <table class="table">
                <thead class="thead-primary">
                  <tr class="text-center">
                  </tr>
                </thead>
                <tbody>
            
                  <tr class="text-center tr">
                 
                      <td><img src="images/wishlist.png" width="375px"></td>
                      <td><h2>Unfortunately, Your Wishlist Is Currently Empty!</h2></td>
                    
                  </tr>
                  
                  
                </tbody>
              </table>
              <?php } ?>
					  </div>
    			</div>
    		</div>
       
  <br><br><p class="text-center"><a href="shop.php" class="btn btn-primary py-3 px-4">Continue to shop</a></p>
    
			</div>
		</section>

  

  <?php include('footer.php'); ?>

<script>


  function deletewishlistrec(wishlist_id)
  {

    $.ajax({
      url : "deletewishlistrecord.php",
      type : "post",
      data : {
        'wishlist_id' :wishlist_id
      },
      success : function(res)
      {
        location.reload();
      }
    });
  }

</script>
  