<?php 

  ob_start();

  include('header.php');

  if(isset($_POST['submit']))
  {
    $order_id = $_POST['order_id'];

    header('location:order_details.php?order_id='.$order_id);
  }

   ?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/36.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Track Order</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Track Order</span></p>
            </div>

          </div>
        </div>
      </div>

        <div class="slider-item" style="background-image: url(images/37.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Track Order</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Menu</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>


 <br><br><br><br><br>
        

    <section class="ftco-section">
    	<div class="container">
        <div class="mt-1">

          <div>
            <h3>Track Your order</h3>
            <h6>Get updates about your Order status. Enter your Order ID</h6>
            <hr style="background: #fff">
          </div><br><br><br>
          <form style="width: 40%; margin: 0 auto;" method="post">
              <label style="color: #fff;">Order ID</label>
            <div class="d-flex justify-content-end">
            <input type="text" name="order_id" placeholder="Order Number to track order" style="height: 54px;text-indent: 10px;color:#fff;background: transparent;border: 0;width: 100%;border: 1px solid #c49b63;">
               <button type="submit" name="submit" style="width: 155px !important;color: #000 !important;" class="btn  btn-primary hover-btn addItemBtn"><i class="fa fa-truck" aria-hidden="true"></i> Track Order</button>
            </div>

            </form>
            </div><br>

    	</div>
    </section>
    <br><br><br><br><br>
    <div></div>

 <?php include('footer.php'); ?>

