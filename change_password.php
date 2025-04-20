
<?php 

    ob_start();

    include('header.php'); 

    $dbpass = $_SESSION['users']['password'];

    if(isset($_POST['submit']))
    {
      $opass = md5($_POST['opass']);
      $npass = md5($_POST['npass']);
      $cpass = md5($_POST['cpass']);

      if($opass == $dbpass)
      {
        if($opass!=$npass)
        {
          if($npass==$cpass)
          {
            $id = $_SESSION['users']['user_id'];
            $update = "update users set `password` = '$cpass' where `user_id` = '$id'";
            $qu = mysqli_query($con,$update);
            header('location:logout.php');
          }
          else
          {
            $msg = "New and Comfirm password did not match!";
          }
        }
        else 
        {
          $msg = "New and Old password are same try another.!";
        }
      }
      else
      {
        $msg = "Old password did not match!";
      }
    }



?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/5.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Change password </h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>change password</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					
					<div class="col-md-3"></div>
          <div class="col-md-6 ftco-animate" style="border-style: solid;border-color: #c49b63;">
            <form method="post" class="contact-form">
              <?php if(isset($msg)) { ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
              <?php } ?>	
                      
               <div class="form-group">
                <input type="password" class="form-control" name="opass" placeholder="Enter The Old Password">
              </div>

               <div class="form-group">
                <input type="password" class="form-control" name="npass" placeholder="Enter The New Password">
              </div>

               <div class="form-group">
                <input type="password" class="form-control" name="cpass" placeholder="Enter The Comfirm Password">
              </div>

              <div class="form-group">
                <input type="submit" name="submit" value="Change Password" class="btn btn-primary py-3 px-5">
               
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('footer.php'); ?>