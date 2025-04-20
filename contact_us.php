<?php 
  
  ob_start();
  include('header.php');

  if(isset($_POST['submit']))
  {
    $_SESSION['name']  = $_POST['name'];
    $_SESSION['email']  = $_POST['email'];
    $_SESSION['subject']  = $_POST['subject'];
    $_SESSION['msg'] = $_POST['msg'];

    if($_SESSION['name']=="")
    {
      echo "<script>alert('Name must be required!')</script>";
    }
    else if($_SESSION['email']=="")
    {
      echo "<script>alert('Email must be required!')</script>";
    }
    else if($_SESSION['subject']=="")
    {
      echo "<script>alert('Subject must be required!')</script>";
    }
    else if($_SESSION['msg']=="")
    {
      echo "<script>alert('Message must be required!')</script>";
    }
    else
    {
      header('location:contact_mail.php');
    }

  }


?>
    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/35.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Contact Us</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					<div class="col-md-4 contact-info ftco-animate">
						<div class="row">
							<div class="col-md-12 mb-4">
	              <h2 class="h4">Contact Information</h2>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Address:</span> <a href="https://maps.app.goo.gl/cTBtheKWYbGSx51JA"> Surat, Gujarat</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Phone:</span> <a href="tel://1234567920">+91 9054208529</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Email:</span> <a href="mailto:info@yoursite.com">harshbirari10@gmail.com</a></p>
	            </div>
	           
						</div>
					</div>
					<div class="col-md-1"></div>
          <div class="col-md-6 ftco-animate">
            <form method="post" class="contact-form">
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" name="name" value="<?php echo @$_SESSION['users']['name']; ?>" placeholder="Your Name">
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" name="email" value="<?php echo @$_SESSION['users']['email']; ?>" placeholder="Your Email">
	                </div>
	                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea cols="30" rows="7" name="msg" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" name="submit" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


 <?php include('footer.php'); ?>