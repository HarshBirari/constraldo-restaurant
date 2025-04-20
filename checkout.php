<?php 
  ob_start();
  include('header.php');
  unset($_SESSION['successMessage']);
  unset($_SESSION['transction_id']);
  
  
  @$user_id = $_SESSION['users']['user_id'];

  @$subtotal = $_SESSION['subtotal'];

  $sel = "select * from cart JOIN product ON product.p_id = cart.p_id where cart.`user_id` = '$user_id' AND cart.`cart_status` = 'Pending'";
  $qu = mysqli_query($con,$sel);
  @$num = mysqli_num_rows($qu);

if($num>=1)
  {
  $cart_id = array();
  $product_id = array();

  while($que1 = mysqli_fetch_array($qu))
  {
    $cart_id[] = $que1['cart_id'];
    $p_id[] = $que1['p_id'];
  }

  @$cart_ids = implode(',',$cart_id);
  @$p_ids = implode(',',$p_id);

  if(isset($_POST['submit']))
  {
    $p_id = $_POST['p_id'];
    $cart_id = $_POST['cart_id'];
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname." ".$lname;
    $country = (isset($_POST['country']))?$_POST['country']:'';
    $state = (isset($_POST['state']))?$_POST['state']:'';
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $address = $add1." ".$add2;
    $city = (isset($_POST['city']))?$_POST['city']:'';
    $zip = $_POST['zip'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $payment = $_POST['payment'];
    $discount = $_POST['discount'];
    $date = date('Y-m-d');

    $payment_method = isset($_POST['payment_method'])?$_POST['payment_method']:"";
    $_SESSION['payment_method'] = $payment_method;

    if($fname=="")
    {
      $fnameErr = "First Name must be required!";
    }
    else if($lname=="")
    {
      $lnameErr = "Last Name must be required!";
    }
     else if($country=="")
    {
      $counErr = "Country must be required!";
    }
     else if($state=="")
    {
      $stateErr = "States must be required!";
    }
     else if($add1=="")
    {
      $add1Err = "Address1 must be required!";
    }
     else if($add2=="")
    {
      $add2Err = "Address2 must be required!";
    }
    else if($city=="")
    {
      $cityErr = "City Must be required!";
    }
     else if($zip=="")
    {
      $zipErr = "Zip Code must be required!";
    }
     else if($contact_no=="")
    {
      $conErr = "Mobile No.conErr must be required!";
    }
     else if($email=="")
    {
      $emailErr = "Email must be required!";
    }
    else if($payment_method=="")
    {
      echo "<script>alert('Please select payment method');</script>";
    }
    else
    {
      $place_order = "insert into comfirm_order (`payment_method`,`p_id`,`user_id`,`cart_id`,`name`,`country`,`state`,`address`,`city`,`zip`,`contact_no`,`email`,`payment`,`discount`,`order_status`,`date`) values ('$payment_method','$p_id','$user_id','$cart_id','$name','$country','$state','$address','$city','$zip','$contact_no','$email','$payment','$discount','Pending','$date')";   
      $place_order_fire = mysqli_query($con,$place_order); 
      $last_id = mysqli_insert_id($con);

      $last_id_select = "select * from comfirm_order where `order_id` = '$last_id'";
      $last_id_fire = mysqli_query($con,$last_id_select);
      $get_order_id = mysqli_fetch_array($last_id_fire);
      $order_id  = $get_order_id['order_id'];

      $_SESSION['order_id'] = $get_order_id['order_id'];
      $_SESSION['user_id'] = $get_order_id['user_id'];
      $_SESSION['p_id'] = $get_order_id['p_id'];

      $order_track = "insert into order_track (`order_id`,`order_remarks`) values ('$order_id','Waiting For Restaurant Confirmation...')";
      $que_track = mysqli_query($con,$order_track);

      if($place_order_fire && $payment_method=="CreDeb")
      {
        header('location:payment/index.php');
      }
      else if($place_order_fire && $payment_method=="COD")
      {
        header('location:confirm_order_cod.php');
   
      }
      else
      {
        $msg = "Something went wrong";
      }
    }

  }
}
else
{
  header('location:shop.php');
}


 ?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/4.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Checkout</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 ftco-animate">
						<form method="post" class="billing-form ftco-bg-dark p-3 p-md-5">
              <?php if(isset($msg)) { ?>
                <div class="alert alert-success"><?php echo $msg; ?></div>
              <?php } ?>
              <input type="hidden" name="cart_id" value="<?php echo $cart_ids; ?>">
              <input type="hidden" name="p_id" value="<?php echo $p_ids; ?>">
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
           
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">First Name</label>
	                  <input type="text" name="fname" class="form-control" value="<?php if(@$fname) { echo $fname; } ?>" placeholder="">
                    <small style="color: red;"><?php if(isset($fnameErr)) { echo $fnameErr; } ?></small>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Last Name</label>
	                  <input type="text" name="lname" class="form-control" value="<?php if(@$lname) { echo $lname; } ?>" placeholder="">
                    <small style="color: red;"><?php if(isset($lnameErr)) { echo $lnameErr; } ?></small>
	                </div>
                </div>
                 <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="country">Select Country </label>
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="country" id="country" class="form-control" onchange="return change_country()">
                        <option value="">- -countries- -</option>
                        <?php

                          $sel = "select * from countries";
                          $qu = mysqli_query($con,$sel);

                         
                          while($fetch = mysqli_fetch_array($qu))
                          {

                         ?>
                        <option style="color: #000" value="<?php if(isset($fetch['id'])) { echo $fetch['id']; } ?>"><?php echo $fetch['name']; ?></option>
                      <?php } ?>
                      </select>
                    <small style="color: red;"><?php if(isset($counErr)) { echo $counErr; } ?></small>

                    </div>
                  </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
		            		<label for="country">Select State </label>
		            		<div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="state" onchange="return change_states()" id="states" class="form-control">
		                  	<option value="">- -States- -</option>
                        <option></option>
		                  </select>
		                </div>
		            	</div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="streetaddress">Street Address</label>
	                  <input type="text" value="<?php if(@$add1) { echo $add1; } ?>" name="add1" class="form-control" placeholder="House number and street name">
                    <small style="color: red;"><?php if(isset($add1Err)) { echo $add1Err; } ?></small>

	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input type="text"  value="<?php if(@$add2) { echo $add2; } ?>" name="add2" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
                    <small style="color: red;"><?php if(isset($add2Err)) { echo $add2Err; } ?></small>

	                </div>
		            </div>
		           
                 <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="country">Select city </label>
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="city" id="cities" class="form-control">
                        <option value="">- -Cities- -</option>
                        <option></option>
                      </select>
                      <small style="color: red;"><?php if(isset($cityErr)) { echo $cityErr; } ?></small>
                    </div>
                  </div>
                </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip">Postcode / ZIP</label>
	                  <input type="text" name="zip"  value="<?php if(@$zip) { echo $zip; } ?>" class="form-control" placeholder="">
                    <small style="color: red;"><?php if(isset($zipErr)) { echo $zipErr; } ?></small>

	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="text" name="contact_no"  value="<?php if(@$contact_no) { echo $contact_no; } ?>" class="form-control" placeholder="">
                    <small style="color: red;"><?php if(isset($conErr)) { echo $conErr; } ?></small>

	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email Address</label>
	                  <input type="text" name="email" value="<?php if(@$email) { echo $email; } ?>" class="form-control" placeholder="">
                    <small style="color: red;"><?php if(isset($emailErr)) { echo $emailErr; } ?></small>

	                </div>
                </div>
                
	            </div>

        <?php $que = mysqli_fetch_array($qu); ?>

	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
                    <span><i  class="fa fa-rupee"></i><?php echo @$subtotal ?>.00</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
              <?php if($subtotal>=2000) { ?>
                    <span>Free Delivery</span>
                    <?php $delivery = 0; ?>
              <?php } else { ?>
                    <span><i class="fa fa-rupee"></i><?php echo $delivery = 50; ?>.00</span>
              <?php } ?>
		    					</p>

		    			<?php if(isset($_SESSION['promocode'])) { if($subtotal>=3000) { ?>
              <p class="d-flex">
                <span>Promocode Discount</span>
                <span><i class="fa fa-rupee"></i><?php echo @$promocode = $_SESSION['promocode']; ?>.00</span>
              </p>
              <?php } else { $promocode = 0; } } ?>

		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
                <span><i class="fa fa-rupee"></i><?php echo $final_price = $subtotal - @$promocode + $delivery; ?>.00</span>
                <?php $_SESSION['payment'] = $final_price; ?>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="payment_method" class="mr-2" value="COD"> Cash on delivery</label>
											</div>
										</div>
									</div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                         <label><input type="radio" name="payment_method" class="mr-2" value="CreDeb"> Credit Card / Debit Card</label>
                      </div>
                    </div>
                  </div>
									
								  <input type="hidden" name="discount" value="<?php if(@$promocode) { echo $promocode; } else { echo 0; } ?>">
                  <button type="submit" style="height:55px;" name="submit" class="btn btn-primary">Proceed to Payment</button>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
             <input type="hidden" name="payment" value="<?php echo $final_price; ?>">
          </form>


          <div class="col-xl-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form class="search-form">
                <div class="form-group">
                	<div class="icon">
	                  <span class="icon-search"></span>
                  </div>
                  <input type="text" class="form-control" id="category" onkeyup="return choose_category()" name="category" placeholder="Search...">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories" id="category_echo">
                <h3>Categories</h3>
                <?php 
                $cat_sel = "select * from category";
                $cat_fire = mysqli_query($con,$cat_sel);

                $cat_num_rows = mysqli_num_rows($cat_fire);

                while($cat_fetch_data = mysqli_fetch_array($cat_fire)) { ?>
                      
                  <?php 
                         $cat_id = $cat_fetch_data['cat_id'];
                         $sub_sel = "select * from subcategory where `cat_id` = '$cat_id'";
                         $sub_fire = mysqli_query($con,$sub_sel);
                         $sub_num_rows = mysqli_num_rows($sub_fire);

                   ?>
                <li><a href="shop.php" ><?php echo $cat_fetch_data['category_name']; ?><span><?php echo $sub_num_rows; ?></span></a></li>
              <?php } ?>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <?php $sel2 = "select * from blog ORDER BY blog_id DESC limit 6";
          $qu2 = mysqli_query($con,$sel2); 
          while($que2 = mysqli_fetch_array($qu2)) {  ?>
         
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(admin/image/blog/<?php echo $que2['image']; ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="blog_single.php?blog_id=<?php echo $que2['blog_id']; ?>"><?php echo $que2['blog_header']; ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> <?php echo $que2['created_at']; ?></a></div>
                    <div><a href="contact_us.php"><span class="icon-person"></span> Admin</a></div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>

          

            <div class="sidebar-box ftco-animate">
              <h3>Our Quotes</h3>
              <p>“Eating at fast food outlets and other restaurants is simply a manifestation of the commodification of time coupled with the relatively low value many Americans have placed on the food they eat.“</div>
          </div>

        </div>
      </div>
    </section> <!-- .section -->

   <?php include("footer.php"); ?>

   <script>
     
    function change_country()
    {
      var country_id = $('#country').val();

      $.ajax({
        url : "get_states.php",
        type :"post",
        data :
        {
          'country_id' : country_id
        },
        success :function(state)
        {
          $('#states').html(state);
        }
      });

    }

    function change_states()
    {
       var state_id = $('#states').val();

      $.ajax({
        url : "get_cities.php",
        type :"post",
        data :
        {
          'state_id' : state_id
        },
        success :function(cities)
        {
          // alert(cities);
          $('#cities').html(cities);
        }
      });
    }

    function choose_category()
    {
      var search = $('#category').val();

        $.ajax({
        url : "search_category.php",
        type :"post",
        data :
        {
          'search' : search,
          'search_record' : 'search_record'
        },
        success :function(sear)
        {
          // alert(sear);
          $('#category_echo').html(sear);
        }
      });
    }

   </script>