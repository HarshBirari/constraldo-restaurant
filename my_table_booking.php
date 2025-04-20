<?php
    ob_start();
    include('header.php'); 

    $email = $_SESSION['users']['email'];

    $sel = "select * from book_table where `email` = '$email'";
    $qu = mysqli_query($con,$sel);
    $num = mysqli_num_rows($qu);

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/27.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">My Table Booking</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>My Table Booking</span></p>
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
						        <th>Booking ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Message</th>
						        <th>Status</th>
						      </tr>
						    </thead>
						    <tbody>
                  <?php $subtotal = 0;
                     while($wishlist = mysqli_fetch_array($qu)) { 
                      

                    ?>
                    
						      <tr class="text-center tr">
                    
                    <td><?php echo $wishlist['booking_id']; ?></td>
						        
                    <td><?php echo $wishlist['date']; ?></td>
						        <td><?php echo $wishlist['time']; ?></td>
                    <td><?php echo $wishlist['message']; ?></td>
                    <?php if($wishlist['response']=="Booked") { ?><td > <a style="color: lightgreen;" href="javascript:void(0)" onclick="return response('<?php echo $wishlist['book_table_id']; ?>')">Booked</a> </td><?php } elseif($wishlist['response']=="Cancelled") { ?><td ><a style="color: red;" href="javascript:void(0)" onclick="return response('<?php echo $wishlist['book_table_id']; ?>')">Cancelled</a></td><?php } else { ?><td style="color: royalblue;">Not Confirm Yet</td><?php } ?>

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
                 
                      <td><h2>Unfortunately, Your Table Booking Request Empty!</h2></td>
                   
                  </tr>
                  
                  
                </tbody>
              </table>
              <?php } ?><br><br><br><br>
					  </div>
    			</div>
    		</div>
       
  <br><br><p class="text-center"><a href="index.php" class="btn btn-primary py-3 px-4">Home</a></p>
    
			</div>
		</section>

  

  <?php include('footer.php'); ?>

<script>


 function response(book_table_id)
 {
     $.ajax({
          url : "get_response.php",
          type : "post",
          data :{
            'book_table_id' : book_table_id
          },
          success : function(resp)
          {
            alert(resp);
          }
        });
 }



</script>
  