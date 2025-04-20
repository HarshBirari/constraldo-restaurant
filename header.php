<?php 

  include('admin/db.php');

  session_start();

  if(isset($_SESSION['users']['user_id'])!="")
  {
    @$user_id = $_SESSION['users']['user_id'];
    $sel = "select * from cart where `user_id` = '$user_id' AND `cart_status` = 'Pending'";
    $qu = mysqli_query($con,$sel);
    $num = mysqli_num_rows($qu);


    $sel1 = "select * from wishlist where `user_id` = '$user_id'";
    $qu1 = mysqli_query($con,$sel1);
    $num1 = mysqli_num_rows($qu1);
  }

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Costraldo Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

  </head>
  <body>

  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Costraldo<small>Restaurant</small></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php
              " class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
	          <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
            <li class="nav-item"><a href="contact_us.php" class="nav-link">Contact</a></li>
            
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.php">Shop</a>
                <a class="dropdown-item" href="cart.php">Cart</a>
                <a class="dropdown-item" href="checkout.php">Checkout</a>
                <a class="dropdown-item" href="offers.php">Offers For You</a>
              </div>
            </li>
            <?php if(isset($_SESSION['users']['user_id'])!="") { ?>
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['users']['name']; ?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="user_register.php"><i class="fa fa-user">&nbsp;&nbsp;&nbsp;</i>My Profile</a>
                <a class="dropdown-item" href="change_password.php"><i class="fa fa-edit">&nbsp;</i>Change Password</a>
                <a class="dropdown-item" href="my_order.php"><i class="fa fa-first-order">&nbsp;&nbsp;</i>My Orders</a>
                <a class="dropdown-item" href="my_table_booking.php"><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;&nbsp;My Table Booking</a>
                <a class="dropdown-item" href="track_order.php"><i class="fa fa-truck">&nbsp;&nbsp;</i>Track Orders</a>
                <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out">&nbsp;&nbsp;</i>Logout</a>
              </div>
            </li>
          <?php } else { ?>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="login.php"><i class="fa fa-sign-in">&nbsp;&nbsp;&nbsp;&nbsp;Login</i></a>
                <a class="dropdown-item" href="user_register.php"><i class="fa fa-user-plus">&nbsp;&nbsp;&nbsp;Register</i></a>
                
              </div>
            </li>
          <?php } ?>

	          <li class="nav-item cart"><a href="cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><?php if(@$_SESSION['users']['user_id']) { ?><small><b><?php echo @$num; ?></b></small><?php } else { ?><small><b><?php echo 0; ?></b></small><?php } ?></span></a></li>

            <li class="nav-item cart"><a href="wishlist.php" class="nav-link"><span class="icon icon-heart"></span><span class="bag d-flex justify-content-center align-items-center"><?php if(@$_SESSION['users']['user_id']) { ?><small><b><?php echo @$num1; ?></b></small><?php } else { ?><small><b><?php echo 0; ?></b></small><?php } ?></span></a></li>


	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->