<?php 
  
    ob_start();
    include('header.php'); 

    if(isset($_POST['submit']))
    {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $name = $fname." ".$lname;
      $username = $_POST['username'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      @$password = $_POST['password'];
      @$comfirm_password = $_POST['comfirm_password'];

      if($fname=="")
      {
        $fnameERR = "First Name must be required";
      }
      elseif($lname=="")
      {
        $lnameERR = "Last Name must be required";
      }
      elseif(strlen($username)<=4) { 
        $UserErr = "[0-9A-Za-z_],alphanumeric & longer than or equals 5 chars!";
      }
      else if ($email=="") {
        $emailErr = "You Forgot to Enter Your Email!";
      } 
      else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
      {
        $emailErr = "You Entered An Invalid Email Format"; 
      }
      else if($password=="")
      {
        $passErr= "Password Must Be Required..!";
      }
      else if(strlen($password)<=7)
      {
        $passErr= "Your Password Must Contain At Least 8 Characters!";
      }
      else if(!preg_match("#[A-Z]+#",$password)) {
        $passErr = "Your Password Must Contain At Least 1 Capital Letter!";
      }
      else if($comfirm_password=="")
      {
        $cErr= "Comfirm Password Must Be Required..!";
      }
      else if($comfirm_password != $password)
      {
        echo "<script>alert('Comfirm password and password does not match');</script>";
      }
      else
      {

      $password = md5($_POST['password']);
      $email = $_POST['email'];

      $sel = "select * from users where `email` = '$email'";
      $que1 = mysqli_query($con,$sel);
      $num = mysqli_num_rows($que1);

      if($num!=0)
      {
        $msg = "This Emaid Address Has Already Been Registered Please Login OR Use Forgot Password to Access Your Account.!";
      }
      else
      {

      $register = "insert into users (`username`,`email`,`contact_no`,`password`,`name`) values ('$username','$email','$contact','$password','$name')";
      $qu = mysqli_query($con,$register);

    


      $_SESSION['email_register'] = $email;
      header('location:register_message.php');
    }
  }
}
    else if(isset($_POST['update']))
    {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $name = $fname." ".$lname;
      $username = $_POST['username'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];

      $user_id = $_SESSION['users']['user_id'];
        $update = "update users set `name`='$name',`username` = '$username',`email`='$email',`contact_no`='$contact' where `user_id` = '$user_id'";
        $qu2 = mysqli_query($con,$update);

        if($qu2)
        {
          header('location:logout.php');
        }
    }

    if(isset($_SESSION['users']['user_id'])!="")
    {
      @$user_id = $_SESSION['users']['user_id'];
      $sel = "select * from users where `user_id` = '$user_id'";
      $qu1 = mysqli_query($con,$sel);
      $data = mysqli_fetch_array($qu1);
      $n = explode(' ',$data['name']);
    }

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/6.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
              <?php if(@!$_SESSION['users']['user_id']) { ?>
            	<h1 class="mb-3 mt-5 bread">Register </h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Register</span></p>
            <?php } else { ?>
                <h1 class="mb-3 mt-5 bread">Profile </h1>
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>profile</span></p>
            <?php } ?>
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
              <?php if(@$msg) { ?>
              <div class="alert alert-danger"><?php echo $msg; ?></div>
            	<?php } ?>
              <div class="form-group" >
                <input type="text" class="form-control" value="<?php if(isset($fname)) { echo $fname; } else { echo @$n[0];} ?>" name="fname" placeholder="First Name">
                <small style="color:red;"><?php if(@$fnameERR) { echo $fnameERR; } ?></small>

              </div>

              <div class="form-group">
                <input type="text" class="form-control" value="<?php if(isset($lname)) { echo $lname; } else { echo @$n[1];} ?>" name="lname" placeholder="Last Name">
                <small style="color:red;"><?php if(@$lnameERR) { echo $lnameERR; } ?></small>

              </div>

              <div class="form-group">
                <input type="text" class="form-control" value="<?php if(isset($username)) { echo $username; } else { echo @$data['username'];} ?>" name="username" placeholder="Username">
                <small style="color:red;"><?php if(@$UserErr) { echo $UserErr; } ?></small>

              </div>

               <div class="form-group">
                <input type="text" class="form-control" name="email" value="<?php if(isset($email)) { echo $email; } else { echo @$data['email']; }?>" placeholder="Enter Your Email">
                <small style="color: red"><?php if(@$emailErr) { echo $emailErr; } ?></small>
              </div>

               <div class="form-group">
                <input type="text" class="form-control" name="contact" value="<?php if(isset($contact)) { echo $contact; } else { echo @$data['contact_no'];} ?>" placeholder="Enter Contact Number">
                <small style="color: red"><?php if(@$contactErr) { echo $contactErr; } ?></small>

              </div>

              <?php if(!@$_SESSION['users']['user_id']) { ?>
               <div class="form-group">
                <input type="password" class="form-control" id="password" value="<?php if(isset($password)) { echo $password; } ?>" name="password" placeholder="Password">
                <small style="color:red;"><?php if(@$passErr) { echo $passErr; } ?></small>
              </div>

               <div class="form-group">
                <input type="password" class="form-control" name="comfirm_password" id="comfirm_password" onkeyup="return checkpass()" value="<?php if(isset($comfirm_password)) { echo $comfirm_password; } ?>" placeholder="Comfirm Password">
                <small id="errorpass" style="color: yellow;">Comfirm Password need to match as password</small><br>
                <small style="color:red;"><?php  if(@$cErr) { echo $cErr; } ?></small>
              </div>
            <?php } ?>

              <div class="form-group">
                <?php if(isset($_SESSION['users']['user_id'])) { ?>
                <input type="submit" name="update" value="Edit Your Account" class="btn btn-primary py-3 px-5">
              
              <?php } else { ?>
                <input type="submit" name="submit" value="Sign Up" class="btn btn-primary py-3 px-5">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="login.php">Already have an account?</a>
              <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('footer.php'); ?>

    <script>
      
        function checkpass()
        {
          var password = $('#password').val();
          var comfirm_password = $('#comfirm_password').val();

          if(password==comfirm_password)
          {
            var check = "<i class='fa fa-check-circle'></i>";
            $('#errorpass').html('Comfirm Password is match '+check);
            document.getElementById('errorpass').style.color = "lightgreen"; 
          }
          else
          {
            var check = "<i class='fa fa-times-circle-o'></i>";

            $('#errorpass').html('Comfirm Password not match yet '+check);
            document.getElementById('errorpass').style.color = "red"; 
          }

        }

    </script>