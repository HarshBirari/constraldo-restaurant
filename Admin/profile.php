<?php 

  include('header.php');


  if(isset($_POST['submit']))
  {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname." ".$lname;
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    @$password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $hobby = implode('/',$_POST['hobby']);
    $country = $_POST['country'];
    $rand = rand(10000,99999);
    $image = $_FILES['image']['name'];

    if(isset($_SESSION['user']))
    {
      $id = $_SESSION['user']['id'];
      $sel = "select * from admin where `id` ='$id'";
      $qu2 = mysqli_query($con,$sel);
      $fetch = mysqli_fetch_array($qu2);
      $password = $fetch['password'];

      if($image == "")
      {
        $image = $fetch['image'];
      }
      else
      {
        @unlink("image/".$fetch['image']);
        $image = $rand.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],"image/".$image);
      }

      $insert = "update admin set `name`='$name',`email`='$email',`contact_no` ='$contact_no',`password`='$password',`gender`='$gender',`hobby`='$hobby',`country`='$country',`image`='$image' where `id` = '$id'";

    }
    else
    {
      $image = $rand.$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],"image/".$image);
      $insert = "insert into admin (`name`,`email`,`contact_no`,`password`,`gender`,`hobby`,`country`,`image`) values ('$name','$email','$contact_no','$password','$gender','$hobby','$country','$image')";
    }

    $qu = mysqli_query($con,$insert);

    if($qu)
    {
      $msg = "Profile Changed Successfully..!";
    }
  }

  if(isset($_SESSION['user']))
  {
    $id = $_SESSION['user']['id'];
    $sel = "select * from admin where `id` = '$id'";
    $qu1 = mysqli_query($con,$sel);
    $que = mysqli_fetch_array($qu1);
    $name = explode(' ',$que['name']);
    $ho = explode('/',$que['hobby']);
  }


 ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
           
            <div class="col-md-8" style="margin: 0 200px;">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Admin Profile</h4>
                  </div>
                </div>
                   
               
                <div class="card-body ">
                  <form method="post" enctype="multipart/form-data" class="form-horizontal">
                  

                    <div class="row">
                      <?php if(isset($msg)) { ?>
                <div class="alert alert-success"><?php echo $msg; ?></div>
              <?php } ?>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Fisrt name</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="fname" value="<?php if(isset($que['name'])) { echo $name[0]; } ?>" class="form-control" placeholder="Enter First name">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Last name</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="lname" class="form-control" value="<?php if(isset($que['name'])) { echo $name[1]; } ?>" placeholder="Enter Last name">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Email  </label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="email" value="<?php if(isset($que['email'])) { echo $que['email']; } ?>" class="form-control" placeholder="Enter Email Address">
                        </div>
                      </div>
                    </div>
                      <div class="row">
                      <label class="col-sm-2 col-form-label">Contact No.  </label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="contact_no" value="<?php if(isset($que['contact_no'])) { echo $que['contact_no']; } ?>" class="form-control" placeholder="Enter Contact No.">
                        </div>
                      </div>
                    </div>
                    <?php if(!isset($_SESSION['user'])) { ?>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="password" class="form-control" value="<?php if(isset($que['password'])) { echo $que['password']; } ?>" name="password" placeholder="Enter password">
                        </div>
                      </div>
                    </div>
                  <?php } ?>

                     <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox">Gender</label>
                      <div class="col-sm-10 checkbox-radios">
                        
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" <?php if(isset($que['gender'])) { if($que['gender']=="male") { echo "checked"; } } ?> type="radio" name="gender" value="male"> Male
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" <?php if(isset($que['gender'])) { if($que['gender']=="female") { echo "checked"; } } ?> type="radio" name="gender" value="female"> Female
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox"> Hobbies </label>
                      <div class="col-sm-10 checkbox-radios">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" <?php if(isset($que['hobby'])) { if(in_array("cricket",$ho)) { echo "checked"; } } ?> type="checkbox" name="hobby[]" value="cricket"> Cricket
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" <?php if(isset($que['hobby'])) { if(in_array("travelling",$ho)) { echo "checked"; } } ?> type="checkbox" value="travelling" name="hobby[]"> Travelling
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" <?php if(isset($que['hobby'])) { if(in_array("movie",$ho)) { echo "checked"; } } ?> type="checkbox" value="movie" name="hobby[]"> Movie
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <label class="col-sm-2 col-form-label">Country</label>
                      <?php $country = array("INDIA","USA","CANADA","UK","AFGHANISTAN");  ?>
                         <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-style="select-with-transition" name="country">
                            <option>--SELECT COUNTRY--</option>
                            <?php for($i=0;$i<count($country);$i++) { ?>
                            <option <?php if(isset($que['country'])) { if($que['country']==$country[$i]) { echo "selected"; } } ?>><?php echo $country[$i]; ?> </option>
                          
                          <?php } ?>
                          </select>
                        </div>
                    </div><br>

                    <?php if(!isset($_SESSION['user']['id'])) { ?>
                    <div class="row">
                   <label class="col-sm-2 col-form-label">Image</label>
                         <div class="col-lg-5 col-md-6 col-sm-3">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="../assets/img/image_placeholder.jpg" alt="...">
                        </div>
                         
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    </div>
                      <?php } else { ?>

                         <div class="row">
                   <label class="col-sm-2 col-form-label">Image</label>
                         <div class="col-lg-5 col-md-6 col-sm-3">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="image/<?php echo $que['image']; ?>">
                        </div>
                         
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    </div>

                  <?php } ?>

                    <?php if(isset($_SESSION['admin']['id'])) { ?>
                    <button type="submit" name="submit" class="btn btn-info">Edit Profile</button>
                    <?php } else { ?>
                    <button type="submit" name="submit" class="btn btn-info">Register</button>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    <?php include('footer.php'); ?>