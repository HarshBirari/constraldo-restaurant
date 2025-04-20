<?php 
ob_start();
include('header.php'); 

if(isset($_POST['book_table']))
{
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $fullname =$firstname." ".$lastname;
  $date =$_POST['date'];
  $time =$_POST['time'];
  $phone_no =$_POST['phone_no'];
  $book_msg =$_POST['book_msg'];
  $email =$_POST['email'];

  if($firstname=="")
  {
    echo "<script>alert('First Name must be required');</script>";
  }
  else if($lastname=="")
  {
    echo "<script>alert('Last Name must be required');</script>";
  }
  else if($date=="")
  {
    echo "<script>alert('Date must be select');</script>";
  }
  else if($time=="")
  {
    echo "<script>alert('Time must be needed');</script>";

  }
  else if($phone_no=="")
  {
    echo "<script>alert('Mobile Number must be required');</script>";
  }
  else if($book_msg=="")
  {
    echo "<script>alert('Event name must be required');</script>";

  }
  else if($email=="")
  {
    echo "<script>alert('Email must be required');</script>";
  }
  else
  {

    $select_data_forbooking = "select * from book_table where `date` = '$date' AND `time` = '$time'";
    $fire_forbooking = mysqli_query($con,$select_data_forbooking);
    $fetch_forbooking = mysqli_fetch_array($fire_forbooking);
    $booking_record = mysqli_num_rows($fire_forbooking);

    if($time=="8:30pm" || $time=="9:00pm" || $time=="9:30pm" || $time=="10:00pm" || $time=="10:30pm" || $time=="11:00pm" || $time=="11:30pm" || $time=="12:00am" || $time=="12:30am" || $time=="1:00am" || $time=="1:30am" || $time=="2:00am" || $time=="2:30am" || $time=="3:00am" || $time=="3:30am" || $time=="4:00am" || $time=="4:30am" || $time=="5:00am" || $time=="5:30am" || $time=="6:00am" || $time=="6:30am" || $time=="7:30am" || $time=="8:00am")
    {
      echo "<script>alert('Please choose time between 8:00am to 8:00pm');</script>";
    }
    else if($booking_record!=0)
    {
      echo "<script>alert('Sorry we are already booked table for this date/time please choose different one!');</script>";
    }
    else
    {
      $booking_id = uniqid();
      $insert_booking = "insert into book_table (`name`,`date`,`time`,`contact_no`,`message`,`email`,`booking_id`) values ('$fullname','$date','$time','$phone_no','$book_msg','$email','$booking_id')";
      $fire_booking = mysqli_query($con,$insert_booking);
      $last_id = mysqli_insert_id($con);
      $select_booking_data = "select * from book_table where `book_table_id` = '$last_id'";
      $fire_booking_id = mysqli_query($con,$select_booking_data);
      $fetch_booking_id = mysqli_fetch_array($fire_booking_id);
      $fetch_forbooking_id = $fetch_booking_id['booking_id'];
      $fetch_message= $fetch_booking_id['message'];
      $fetch_date = $fetch_booking_id['date'];
      $fetch_time = $fetch_booking_id['time'];
      $_SESSION['booking_table_id'] = $fetch_forbooking_id;
      $_SESSION['message'] = $fetch_message;
      $_SESSION['email'] = $email;
      $_SESSION['date'] = $fetch_date;
      $_SESSION['time'] = $fetch_time;
      header('location:book_table.php');

      if($fire_booking)
      {
        echo "<script>alert('Hey we have table successfully booked for you..!');</script>";
      }
    }
  }

}

?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(images/30.jpg);">
   <div class="overlay"></div>
   <div class="container">
    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      <div class="col-md-8 col-sm-12 text-center ftco-animate">
       <span class="subheading">Welcome</span>
       <h1 class="mb-4">The Best Coffee Testing Experience</h1>
       <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
       <p><a href="shop.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
     </div>

   </div>
 </div>
</div>

<div class="slider-item" style="background-image: url(images/29.jpg);">
 <div class="overlay"></div>
 <div class="container">
  <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

    <div class="col-md-8 col-sm-12 text-center ftco-animate">
     <span class="subheading">Welcome</span>
     <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
     <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
     <p><a href="shop.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
   </div>

 </div>
</div>
</div>

<div class="slider-item" style="background-image: url(images/11.jpg);">
 <div class="overlay"></div>
 <div class="container">
  <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

    <div class="col-md-8 col-sm-12 text-center ftco-animate">
     <span class="subheading">Welcome</span>
     <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
     <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
     <p><a href="shop.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
   </div>

 </div>
</div>
</div>
</section>

<section class="ftco-intro">
 <div class="container-wrap">
  <div class="wrap d-md-flex align-items-xl-end">
   <div class="info">
    <div class="row no-gutters">
     <div class="col-md-4 d-flex ftco-animate">
      <div class="icon"><span class="icon-phone"></span></div>
      <div class="text">
       <h3>+91 9054208529</h3>
       <p>This is own and soul</p>
     </div>
   </div>
   <div class="col-md-4 d-flex ftco-animate">
    <div class="icon"><span class="icon-my_location"></span></div>
    <div class="text">
     <h3>Surat | Gujarat</h3>
     <p>	| India</p>
   </div>
 </div>
 <div class="col-md-4 d-flex ftco-animate">
  <div class="icon"><span class="icon-clock-o"></span></div>
  <div class="text">
   <h3>Open Monday-Saturday</h3>
   <p>8:00am - 9:00pm</p>
 </div>
</div>
</div>
</div>
<div class="book p-4">
  <h3>Book a Table</h3>
  <form method="post" class="appointment-form">
    <?php if(isset($booking_successfully)) { ?>
      <div class="alert alert-success"><?php echo @$booking_successfully; ?></div>
    <?php } else if(isset($booking_error)) { ?>
      <div class="alert alert-danger"><?php echo @$booking_error; ?></div>
    <?php } else if(isset($booking_error1)) { ?>
      <div class="alert alert-danger"><?php echo @$booking_error1; ?></div>
    <?php } ?>
    <div class="d-md-flex">
      <div class="form-group">
        <?php @$name = explode(' ',$_SESSION['users']['name']); ?>
        <input type="text" class="form-control" name="firstname" value="<?php if(isset($firstname)) { echo $firstname; } elseif(isset($name[0])) { echo $name[0]; } ?>" placeholder="First Name">
        <?php if(isset($fnameERR)) { ?>
          <small style="color: red;"><?php echo $fnameERR; ?></small>
        <?php } ?>
      </div>
      <div class="form-group ml-md-4">
       <input type="text" class="form-control" name="lastname" value="<?php if(isset($lastname)) { echo $lastname; } elseif(isset($name[1])) { echo $name[1]; } ?>" placeholder="Last Name">
       <?php if(isset($lnameERR)) { ?>
        <small style="color: red;"><?php echo $lnameERR; ?></small>
      <?php } ?>
    </div>
  </div>
  <div class="d-md-flex">
    <div class="form-group">
     <div class="input-wrap">
      <div class="icon"><span class="ion-md-calendar"></span></div>
      <input type="text" name="date" class="form-control appointment_date" placeholder="Date">
      <?php if(isset($dateERR)) { ?>
        <small style="color: red;"><?php echo $dateERR; ?></small>
      <?php } ?>
    </div>
  </div>
  <div class="form-group ml-md-4">
   <div class="input-wrap">
    <div class="icon"><span class="ion-ios-clock"></span></div>
    <input type="text" name="time" class="form-control appointment_time" placeholder="Time">
    <?php if(isset($timeERR)) { ?>
      <small style="color: red;"><?php echo $timeERR; ?></small>
    <?php } ?>
  </div>
</div>
<div class="form-group ml-md-4">
 <input type="text" name="phone_no" class="form-control" value="<?php if(isset($contact_no)) { echo $contact_no; } elseif(isset($_SESSION['users']['contact_no'])) { echo $_SESSION['users']['contact_no']; } ?>" placeholder="Phone">
 <?php if(isset($phoneERR)) { ?>
  <small style="color: red;"><?php echo $phoneERR; ?></small>
<?php } ?>
</div>
</div>
<div class="d-md-flex">
  <div class="form-group">
    <textarea name="book_msg" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
    <?php if(isset($eventERR)) { ?>
      <small style="color: red;"><?php echo $eventERR; ?></small>
    <?php } ?>
  </div>
  <div class="form-group ml-md-4">
    <input type="text" name="email" placeholder="Email" value="<?php if(isset($email)) { echo $email; } elseif(isset($_SESSION['users']['email'])) { echo $_SESSION['users']['email']; } ?>" class="form-control">
    <?php if(isset($emailERR)) { ?>
      <small style="color: red;"><?php echo $emailERR; ?></small>
    <?php } ?>
  </div>
</div>

<div class="d-md-flex">
  <div class="form-group">
    <input type="submit" name="book_table" value="Appointment" class="btn btn-white py-3 px-4">
  </div>
</div>
</form>
</div>
</div>
</div>
</section>


<section class="ftco-about d-md-flex">
 <div class="one-half img" style="background-image: url(images/about.jpg);"></div>
 <div class="one-half ftco-animate">
  <div class="overlap">
   <div class="heading-section ftco-animate ">
    <span class="subheading">Discover</span>
    <h2 class="mb-4">Our Story</h2>
  </div>
  <div>
   <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
 </div>
</div>
</div>
</section>

<section class="ftco-section ftco-services">
 <div class="container">
  <div class="row">
    <div class="col-md-4 ftco-animate">
      <div class="media d-block text-center block-6 services">
        <div class="icon d-flex justify-content-center align-items-center mb-5">
         <span class="flaticon-choices"></span>
       </div>
       <div class="media-body">
        <h3 class="heading">Easy to Order</h3>
        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
      </div>
    </div>      
  </div>
  <div class="col-md-4 ftco-animate">
    <div class="media d-block text-center block-6 services">
      <div class="icon d-flex justify-content-center align-items-center mb-5">
       <span class="flaticon-delivery-truck"></span>
     </div>
     <div class="media-body">
      <h3 class="heading">Fastest Delivery</h3>
      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
    </div>
  </div>      
</div>
<div class="col-md-4 ftco-animate">
  <div class="media d-block text-center block-6 services">
    <div class="icon d-flex justify-content-center align-items-center mb-5">
     <span class="flaticon-coffee-bean"></span></div>
     <div class="media-body">
      <h3 class="heading">Quality Coffee</h3>
      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
    </div>
  </div>    
</div>
</div>
</div>
</section>

<section class="ftco-section">
 <div class="container">
  <div class="row align-items-center">
   <div class="col-md-6 pr-md-5">
    <div class="heading-section text-md-right ftco-animate">
      <span class="subheading">Discover</span>
      <h2 class="mb-4">Our Menu</h2>
      <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
      <p><a href="menu.php" class="btn btn-primary btn-outline-primary px-4 py-3">View Full Menu</a></p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
     <div class="col-md-6">
      <div class="menu-entry">
       <a href="shop.php" class="img" style="background-image: url(admin/image/1085pexels-bich-tran-2362391.jpg);"></a>
     </div>
   </div>
   <div class="col-md-6">
    <div class="menu-entry mt-lg-4">
     <a href="shop.php" class="img" style="background-image: url(admin/image/3741pexels-valeria-boltneva-580612.jpg);"></a>
   </div>
 </div>
 <div class="col-md-6">
  <div class="menu-entry">
   <a href="shop.php" class="img" style="background-image: url(admin/image/8450pexels-thanachat-chantaramanee-887853.jpg);"></a>
 </div>
</div>
<div class="col-md-6">
  <div class="menu-entry mt-lg-4">
   <a href="shop.php" class="img" style="background-image: url(admin/image/6708pexels-daria-obymaha-1691924.jpg);"></a>
 </div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php 

$sel3 = "select * from users";
$qu3 = mysqli_query($con,$sel3);
$user = mysqli_num_rows($qu3);

$sel4 = "select * from comfirm_order";
$qu4 = mysqli_query($con,$sel4);
$orders = mysqli_num_rows($qu4);

$sel5 = "select * from blog";
$qu5 = mysqli_query($con,$sel5);
$blog = mysqli_num_rows($qu5);

?>
<section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(images/4.jpg);" data-stellar-background-ratio="0.5">
 <div class="overlay"></div>
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="row">
      <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
          <div class="text">
            <div class="icon"><span class="flaticon-coffee-cup"></span></div>
            
            <strong class="number" data-number="<?php echo $orders; ?>">0</strong>
            <span>Total Orders</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
          <div class="text">
           <div class="icon"><span class="flaticon-coffee-cup"></span></div>
           <strong class="number" data-number="85">0</strong>
           <span>Number of Awards</span>
         </div>
       </div>
     </div>
     <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
      <div class="block-18 text-center">
        <div class="text">
         <div class="icon"><span class="flaticon-coffee-cup"></span></div>
         <strong class="number" data-number="<?php echo $user; ?>">0</strong>
         <span>Happy Customer</span>
       </div>
     </div>
   </div>
   <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
    <div class="block-18 text-center">
      <div class="text">
       <div class="icon"><span class="flaticon-coffee-cup"></span></div>
       <strong class="number" data-number="<?php echo $blog; ?>">0</strong>
       <span>Our Blog</span>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</div>
</section>

<section class="ftco-section">
 <div class="container">
  <div class="row justify-content-center mb-5 pb-3">
    <div class="col-md-7 heading-section ftco-animate text-center">
     <span class="subheading">Discover</span>
     <h2 class="mb-4">Best Coffee Sellers</h2>
     <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
   </div>
 </div>
 <div class="row">
  <?php 
  $sel = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id ORDER BY category.cat_id ASC LIMIT 4";
  $qu1 = mysqli_query($con,$sel);
  while($que = mysqli_fetch_array($qu1)) { 
   ?>
   <div class="col-md-3">
    <div class="menu-entry">
     <a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $que['product_image']; ?>);"></a>
     <div class="text text-center pt-4">
      <h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $que['category_name']; ?> <?php echo $que['subcategory_name']; ?></a></h3>
      <p><?php echo $que['product_description']; ?></p>
      <p class="price"><span><i class="fa fa-rupee"></i><?php echo $que['product_price']; ?></span></p>
      <p><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="btn btn-primary btn-outline-primary">View Product</a></p>
    </div>
  </div>
</div>
<?php } ?>

</div>
</div>
</section>



<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(images/18.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

        
      </div>
    </div>
  </div>



  <div class="slider-item" style="background-image: url(images/19.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

       

      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image: url(images/20.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image: url(images/14.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image: url(images/15.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image: url(images/16.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image: url(images/17.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

      </div>
    </div>
  </div>
</section>

<section class="ftco-menu">
 <div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 heading-section text-center ftco-animate">
     <span class="subheading">Discover</span>
     <h2 class="mb-4">Our Products</h2>
     <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
   </div>
 </div>
 <div class="row d-md-flex">
   <div class="col-lg-12 ftco-animate p-md-5">
    <div class="row">
      <div class="col-md-12 nav-link-wrap mb-5">
        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <?php $category = "select * from category";
          $qu_fire = mysqli_query($con,$category);

          while($que_fetch = mysqli_fetch_array($qu_fire)) {
            $cat_id = $que_fetch['cat_id'];
            if($que_fetch['cat_id']!=1 && $que_fetch['cat_id']!=2) {
             ?>
             <a href="javascript:void(0)" class="nav-link" id="v-pills-1-tab" data-toggle="pill" role="tab" aria-controls="v-pills-1" aria-selected="false" onclick="return set_category(<?php echo $que_fetch['cat_id']; ?>)"><?php echo $que_fetch['category_name']; ?></a>
           <?php }  }?>
         </div>
       </div>
       <div class="col-md-12 d-flex align-items-center">
        
        <div class="tab-content ftco-animate w-100" id="v-pills-tabContent">

          <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
            <div class="row" id="subcat">
              <?php 
              $sel = "select * from product JOIN subcategory ON subcategory.sub_id = product.sub_id where subcategory.`cat_id` = '$cat_id' AND subcategory.`sub_status` = '1' ORDER BY p_id ASC LIMIT 4";     
              $qu = mysqli_query($con,$sel); ?>
              <?php while($que = mysqli_fetch_array($qu)) { ?>
                <div class="col-md-3">
                  <div class="menu-entry">
                    <a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $que['product_image']; ?>);"></a>
                    <div class="text text-center pt-4">
                      <h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $que['subcategory_name']; ?></a></h3>
                      <p style="height: 80px;overflow: hidden;"><?php echo $que['product_description']; ?></p>
                      <p class="price"><span><i class="fa fa-rupee"> <?php echo $que['product_price']; ?>.00</i></span></p>
                      <p><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="btn btn-primary btn-outline-primary">View Product</a></p>
                    </div>
                  </div>  
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/21.jpg);"  data-stellar-background-ratio="0.5">
 <div class="overlay"></div>
 <div class="container">
   <div class="row justify-content-center mb-5">
     <div class="col-md-7 heading-section text-center ftco-animate">
      <span class="subheading">Testimony</span>
      <h2 class="mb-4">Customers Says</h2>
      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
    </div>
  </div>
</div>
<div class="container-wrap">
 <div class="row d-flex no-gutters">
  <?php  $odd_sel = "select * from review_by "; 
  $odd = mysqli_query($con,$odd_sel);
  
  while($odd_data = mysqli_fetch_array($odd)) {
    ?>
    <div class="col-lg align-self-sm-end ftco-animate">
     <div class="testimony">
      <blockquote>
       <p>&ldquo;<?php echo $odd_data['msg']; ?>&rdquo;</p>
     </blockquote>
     <div class="author d-flex mt-4">
      
       <div class="name align-self-center" style="color: #000;"><?php echo $odd_data['name']; ?> <span class="position" style="color: #000;"><?php echo $odd_data['designation']; ?></span></div>
     </div>
   </div>
 </div>
<?php } ?>


</div>
</div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <h2 class="mb-4">Recent from blog</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
      </div>
    </div>
    <div class="row d-flex">
     <?php  $sel_blog = "select * from blog ORDER BY `blog_id` DESC LIMIT 3";
     $qu_blog = mysqli_query($con,$sel_blog);


     while($que_blog = mysqli_fetch_array($qu_blog)) {  $blog_id = $que_blog['blog_id']; ?>

     <?php $sel_blog1 = "select * from blog JOIN blog_comment ON blog_comment.blog_id = blog.blog_id where blog_comment.`blog_id` = '$blog_id'";
     $qu1_blog = mysqli_query($con,$sel_blog1);
     $num_blog = mysqli_num_rows($qu1_blog); ?>

     <div class="col-md-4 d-flex ftco-animate">
       <div class="blog-entry align-self-stretch">
        <a href="blog_single.php?blog_id=<?php echo $que_blog['blog_id']; ?>" class="block-20" style="background-image: url(admin/image/blog/<?php echo $que_blog['image']; ?>);">
        </a>
        <div class="text py-4 d-block">
         <div class="meta">
          <div><a href="#"><?php echo $que_blog['created_at']; ?></a></div>
          <div><a href="#">Admin</a></div>
          <div><a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo $num_blog; ?></a></div>
        </div>
        <h3 class="heading mt-2"><a href="blog_single.php?blog_id=<?php echo $que_blog['blog_id']; ?>"><?php echo $que_blog['blog_name']; ?></a></h3>
        <p><?php echo $que_blog['blog_header']; ?></p>
      </div>
    </div>
  </div>
<?php } ?>
</div>
</div>
</section>


<section class="ftco-appointment">
 <div class="overlay"></div>
 <div class="container-wrap">
  <div class="row no-gutters d-md-flex align-items-center">
   
   <div class="col-md-6 appointment ftco-animate">
    <h3 class="mb-3">Book a Table</h3>
    <form method="post" class="appointment-form">
     <?php if(isset($booking_successfully)) { ?>
      <div class="alert alert-success"><?php echo @$booking_successfully; ?></div>
    <?php } else if(isset($booking_error)) { ?>
      <div class="alert alert-danger"><?php echo @$booking_error; ?></div>
    <?php } else if(isset($booking_error1)) { ?>
      <div class="alert alert-danger"><?php echo @$booking_error1; ?></div>
    <?php } ?>
    <div class="d-md-flex">
      <div class="form-group">
       <input type="text" class="form-control" name="firstname" placeholder="First Name">
     </div>
     <div class="form-group ml-md-4">
       <input name="lastname" type="text" class="form-control" placeholder="Last Name">
     </div>
   </div>
   <div class="d-md-flex">
    <div class="form-group">
     <div class="input-wrap">
      <div class="icon"><span class="ion-md-calendar"></span></div>
      <input type="text" name="date" class="form-control appointment_date" placeholder="Date">
    </div>
  </div>
  <div class="form-group ml-md-4">
   <div class="input-wrap">
    <div class="icon"><span class="ion-ios-clock"></span></div>
    <input type="text" name="time" class="form-control appointment_time" placeholder="Time">
  </div>
</div>
<div class="form-group ml-md-4">
 <input type="text" name="phone_no" class="form-control" placeholder="Phone">
</div>
</div>
<div class="d-md-flex">
  <div class="form-group">
    <textarea name="book_msg" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
  </div>
  <div class="form-group ml-md-4">
    <input type="text" name="email" class="form-control" placeholder="Email">
  </div>
</div>
<div class="d-md-flex">
  <div class="form-group ml-md-4">
    <input type="submit" name="book_table" value="Appointment" style="width: 470px" class="btn btn-primary py-3 px-4">
  </div>
  
</div>
</form>
</div>   


<?php 

if(isset($_POST['submit']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $name = $fname." ".$lname;
  $msg = $_POST['msg'];
  $contact_no = $_POST['contact_no'];
  $desg = $_POST['desg'];

  if($fname=="")
  {
    echo "<script>alert('First name must be required')</script>";
  }
  elseif($lname=="")
  {
    echo "<script>alert('Last name must be required')</script>";
  }
  elseif($msg=="")
  {
    echo "<script>alert('Message must be required')</script>";
  }
  elseif($contact_no=="")
  {
    echo "<script>alert('Contact must be required')</script>";
  }
  elseif($desg=="")
  {
    echo "<script>alert('Designation must be required')</script>";
  }
  else
  {
   $sel = "select * from review_by where `contact_no` = '$contact_no'";
   $que1 = mysqli_query($con,$sel);
   $num = mysqli_num_rows($que1);

   if($num==0)
   {

     $ins = "insert into review_by (`name`,`msg`,`contact_no`,`designation`) values ('$name','$msg','$contact_no','$desg')";
     $qu = mysqli_query($con,$ins);
     if($qu)
     {
       echo "<script>alert('Thank you for review us')</script>";
     }
   }
   else
   {
     echo "<script>alert('Sorry you did already reviewed')</script>";
   }
 }
}

if(isset($_SESSION['users']['user_id']))
{
 $user_id = $_SESSION['users']['user_id'];
 $sel_rec = "select * from users where `user_id` = '$user_id'";
 $que2 = mysqli_query($con,$sel_rec);
 $user_rec = mysqli_fetch_array($que2);
 $n = explode(' ',$user_rec['name']);
}


?>

<div class="col-md-6 appointment ftco-animate">
  <h3 class="mb-3">Add a Review</h3>
  <form method="post" enctype="multipart/form-data" class="appointment-form">
    <?php if(isset($msg1)) { ?>
      <div class="alert alert-success"><?php echo $msg1; ?></div>
    <?php } ?>
    <div class="d-md-flex">
      <div class="form-group">
        <input type="text" class="form-control" value="<?php echo @$n[0]; ?>" name="fname" placeholder="First Name">
        <?php if(isset($fnameERR)) { ?>
          <small style="color: red;"><?php echo $fnameERR; ?></small>
        <?php } ?>
      </div>
      <div class="form-group ml-md-4">
        <input type="text" name="lname" class="form-control" value="<?php echo @$n[1]; ?>" placeholder="Last Name">
        <?php if(isset($lnameERR)) { ?>
          <small style="color: red;"><?php echo $lnameERR; ?></small>
        <?php } ?>
      </div>
    </div>
    <div class="form-group">
      <textarea cols="30" rows="2" name="msg" class="form-control" placeholder="Message"></textarea>
      <?php if(isset($msgERR)) { ?>
        <small style="color: red;"><?php echo $msgERR; ?></small>
      <?php } ?>
    </div>
    <div class="d-md-flex">
      <div class="form-group">
        <input type="text" class="form-control" value="<?php if(isset($_SESSION['users'])) { echo $_SESSION['users']['contact_no']; } ?>" name="contact_no" value="<?php echo @$user_rec['contact_no']; ?>" placeholder="Phone">
        <?php if(isset($contactERR)) { ?>
          <small style="color: red;"><?php echo $contactERR; ?></small>
        <?php } ?>
      </div>
      <div class="form-group ml-md-4">
        <input name="desg" cols="30" rows="2" class="form-control" placeholder="Designation">
        <?php if(isset($designationERR)) { ?>
          <small style="color: red;"><?php echo $designationERR; ?></small>
        <?php } ?>
      </div>
    </div>
    
    <div class="d-md-flex">
      <div class="form-group ">
        <input type="submit" name="submit" value="Submit to Review" class="btn btn-primary py-3 px-4">
      </div>
    </div>
  </form>
</div>    			
</div>
</div>
</section>

<?php include('footer.php');   ?>

<script type="text/javascript">

  function set_category(cat_id)
  {
    $.ajax({
      url : "set_subcategory1.php",
      type : "post",
      data :
      {
        'cat_id' : cat_id
      },
      success :function(sub)
      {
        $('#subcat').html(sub);
        // console.log(sub);
      }
    });
  }


</script>