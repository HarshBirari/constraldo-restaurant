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
        $fnameERR = "First Name must be required";
      }
      else if($lastname=="")
      {
        $lnameERR = "Last Name must be required";
      }
      else if($date=="")
      {
        $dateERR = "Date must be select";
      }
      else if($time=="")
      {
        $timeERR = "Time must be needed";
      }
      else if($phone_no=="")
      {
        $phoneERR = "Mobile Number must be required";
      }
      else if($book_msg=="")
      {
        $eventERR = "Event name must be required";
      }
      else if($email=="")
      {
        $emailERR = "Email must be required";
      }
      else
      {

      $select_data_forbooking = "select * from book_table where `date` = '$date' AND `time` = '$time'";
      $fire_forbooking = mysqli_query($con,$select_data_forbooking);
      $fetch_forbooking = mysqli_fetch_array($fire_forbooking);
      $booking_record = mysqli_num_rows($fire_forbooking);

      if($time=="8:30pm" || $time=="9:00pm" || $time=="9:30pm" || $time=="10:00pm" || $time=="10:30pm" || $time=="11:00pm" || $time=="11:30pm" || $time=="12:00am" || $time=="12:30am" || $time=="1:00am" || $time=="1:30am" || $time=="2:00am" || $time=="2:30am" || $time=="3:00am" || $time=="3:30am" || $time=="4:00am" || $time=="4:30am" || $time=="5:00am" || $time=="5:30am" || $time=="6:00am" || $time=="6:30am" || $time=="7:30am" || $time=="8:00am")
      {
        
        $booking_error1 = "Please choose time between 8:00am to 8:00pm";
      }
      else if($booking_record!=0)
      {
        $booking_error = "Sorry we are already booked table for this date/time please choose different one!";
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
          $booking_successfully = "Hey we have table successfully booked for you..!";
        }
      }
      }

    }
?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/31.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Our Menu</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Menu</span></p>
            </div>

          </div>
        </div>
      </div>

        <div class="slider-item" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Our Menu</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Menu</span></p>
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
	    						<p>	 Surat-395010 | India</p>
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

    <section class="ftco-section">
    	<div class="container">
        <div class="mt-1">
          <form style="margin-left: auto;width: 30%;">
            <div class="d-flex justify-content-end">
            <input type="text" name="search" placeholder="Category to search" style="height: 54px;text-indent: 10px;color:#fff;background: transparent;border: 0;width: 75%;border: 1px solid #c49b63;">
               <button type="submit" name="submit" style="width: 155px !important;color: #000 !important;" class="btn  btn-primary hover-btn addItemBtn">Apply to search</button>
            </div>

            </form>
            </div><br>
        <div class="row" >
        	<?php
 		       
            if(isset($_GET['search']))
            {
              $ser = $_GET['search'];
              $sel = "select * from category where `category_name` LIKE '%$ser%'";
            }
            else
            {
          		$sel = "select * from category where `cat_status` = 1"; 
            }
        	
        	    $qu = mysqli_query($con,$sel); 
        	    while($category = mysqli_fetch_array($qu)) {
        		
        	 ?>

        	<div class="col-md-12 mb-5 pb-3">
        		<h3 class="mb-5 heading-pricing ftco-animate"><?php echo $category['category_name']; ?></h3>
        	<?php
        		$cat_id = $category['cat_id'];
        		$sel1 = "select * from product JOIN subcategory ON subcategory.sub_id = product.sub_id where subcategory.`cat_id` = '$cat_id' AND subcategory.`sub_status` = 1"; 
        		$qu1 = mysqli_query($con,$sel1);

        		while($subcategory = mysqli_fetch_array($qu1)) { 
        		
        		  ?>
        		<div class="pricing-entry d-flex ftco-animate">
        			<div class="img" style="background-image: url(admin/image/<?php echo $subcategory['product_image']; ?>);"></div>
        			<div class="desc pl-3">
	        			<div class="d-flex text align-items-center">
	        				<h3><span><a href="single_product.php?p_id=<?php echo $subcategory['p_id']; ?>"><?php echo $subcategory['subcategory_name']; ?></a></span></h3>
	        				<span class="price"><i class="fa fa-rupee"> <?php echo $subcategory['product_price']; ?>.00</i></span>
	        			</div>
	        			<div class="d-block">
	        				<p><?php echo $subcategory['product_description']; ?></p>
	        			</div>
        			</div>
        		</div>
        	<?php } ?>
        	</div>
        <?php  } ?>
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
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		                <div class="row" id="subcat">
                      <?php 
                $sel = "select * from product JOIN subcategory ON subcategory.sub_id = product.sub_id ORDER BY p_id DESC LIMIT 8";     
                  $qu = mysqli_query($con,$sel); ?>
              <?php while($que = mysqli_fetch_array($qu)) { ?>
                      <div class="col-md-3">
                        <div class="menu-entry">
                          <a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $que['product_image']; ?>);"></a>
                          <div class="text text-center pt-4">
                            <h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $que['subcategory_name']; ?></a></h3>
                            <p><?php echo $que['product_description']; ?></p>
                            <p class="price"><span><i class="fa fa-rupee"> <?php echo $que['product_price']; ?>.00</i></span></p>
                            <p><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
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

 <?php include('footer.php'); ?>

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
      }
    });
  }


</script>