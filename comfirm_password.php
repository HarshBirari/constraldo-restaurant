<?php 
    
    ob_start();
    include('header.php'); 

    $email = $_SESSION['email']['email'];

    if(isset($_POST['submit']))
    {
      $cpass = md5($_POST['cpass']);
      $npass = md5($_POST['npass']);

      if($npass==$cpass)
      {
        $update = "update users set `password` = '$cpass' where `email` = '$email'";
        $qu = mysqli_query($con,$update);
        header('location:forgorpassmsg.php');
      }
      else
      {
        $msg = "please enter comfirm and new password should be same";
      }

    }
   

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/5.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">comfirm password </h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Comfirm Password</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					
					<div class="col-md-3"></div>
          <div class="col-md-6 ftco-animate">
            <form method="post" class="contact-form">
              <?php if(isset($msg)) { ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
              <?php } ?>	
             
               <div class="form-group">
                <input type="password" class="form-control" name="npass" placeholder="Enter New Password">
              </div>

               <div class="form-group">
                <input type="password" class="form-control" name="cpass" placeholder="Enter Comfirm Password">
              </div>

         
              

              <div class="form-group">
                <input type="submit" name="submit" value="Reset Password" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('footer.php'); ?> 