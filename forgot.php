<?php 

    ob_start();
    include('header.php'); 

    if(isset($_POST['submit']))
    {
      $email = $_POST['email'];

      $sel = "select * from users where `email` = '$email'";
      $qu = mysqli_query($con,$sel);
      $num =  mysqli_num_rows($qu);

      if($num==1)
      {
        $que = mysqli_fetch_array($qu);
        $_SESSION['email'] = $que;
        header('location:email.php');
      }
      else
      {
        $msg = "Invalid Email id";
      }
    }
   

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Forgot Password </h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>forgot password</span></p>
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
                <input type="text" class="form-control" name="email" placeholder="Email Address">
              </div>

              <div class="form-group">
                <input type="submit" name="submit" value="Recover Password" class="btn btn-primary py-3 px-5">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="login.php">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('footer.php'); ?> 