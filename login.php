<?php 
    ob_start();

    include('header.php'); 

    if(isset($_POST['submit']))
    {
      $email = $_POST['email'];
      $password1 = $_POST['password'];

      if($email=="")
      {
        $emailErr = "Email must be required*";
      }
      elseif($password1=="")
      {
        $passwordErr = "Password must be required*";
      }
      else
      {
        $password = md5($_POST['password']);
        $sel = "select * from users where `email` = '$email' AND `password` = '$password'";
        $qu = mysqli_query($con,$sel);
        $num = mysqli_num_rows($qu);

        if($num==1)
        {
          if(isset($_POST['remember']))
          {
            setcookie('Costraldo_Email',$email,time()+60*60*30*24);
            setcookie('Costraldo_Password',$password1,time()+60*60*30*24);
          }

          $fetch = mysqli_fetch_array($qu);
          $_SESSION['users'] = $fetch;
          header('location:index.php');
        }
        else
        {
          $msg = "Invalid Email/username or password";
        }
      }
    }



?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/8.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">LOGIN </h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>login</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					
					<div class="col-md-3"></div>
          <div class="col-md-6 ftco-animate" >
            <form method="post" class="contact-form">
              <?php if(isset($msg)) { ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
              <?php } ?>	
               <div class="form-group">
                <input type="text" class="form-control" name="email" value="<?php if(isset($email)) { echo $email; } elseif(isset($_COOKIE['Costraldo_Email'])) { echo $_COOKIE['Costraldo_Email']; } ?>" placeholder="Email Address">
                <?php if(isset($emailErr)) { ?>
                <small style="color: red;"><?php echo $emailErr ?></small>
              <?php } ?>
              </div>

         
               <div class="form-group">
                <input type="password" class="form-control" name="password" value="<?php if(isset($password)) { echo $password; } elseif(isset($_COOKIE['Costraldo_Password'])) { echo $_COOKIE['Costraldo_Password']; } ?>" placeholder="Enter The Password">
                <?php if(isset($passwordErr)) { ?>
                <small style="color: red;"><?php echo $passwordErr ?></small>
              <?php } ?>
              </div>

              <input type="checkbox" <?php if(isset($_COOKIE['Costraldo_Email']) AND isset($_COOKIE['Costraldo_Password'])) { echo "checked"; } ?> value="remember" id="rememberMe" name="remember"> <label for="rememberMe" style="color: #00c0ff;">Remember me</label><br><br>

               <div class="form-group">
                  <a href="forgot.php">Forgot Password ? </a>
              </div>

              <div class="form-group">
                <input type="submit" name="submit" value="Sign In" class="btn btn-primary py-3 px-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label style="color: #fff;">Not a member?</label><a href="user_register.php"> Signup now </a>
              </div><br>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('footer.php'); ?>