<?php 
ob_start();
include('header.php');

$dbpass = $_SESSION['user']['password'];

if(isset($_POST['submit']))
{
  $opass = md5($_POST['opass']);
  $npass = md5($_POST['npass']);
  $cpass = md5($_POST['cpass']);


  if($opass == $dbpass)
  {
    if($npass != $opass)
    {
      if($npass == $cpass)
      {
        $id = $_SESSION['user']['id'];
        $update = "update admin set `password` = '$npass' ,`created_at` = '' where `id` = '$id'";
        mysqli_query($con,$update);
        header('location:logout.php');
      }
      else
      {
        $msg = "Comfirm password not match as new password";
      }
    }
    else
    {
      $msg = "New password same as old password please try another..!";
    }
  }
  else
  {
    $msg = "Invalid Old Password";
  }
}


?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
     
      <div class="col-md-12" >
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Change Password</h4>
            </div>
          </div>
          
          
          <div class="card-body ">
            <form method="post" enctype="multipart/form-data" class="form-horizontal">
              

              <div class="row">
                <?php if(isset($msg)) { ?>
                  <div class="alert alert-danger"><?php echo $msg; ?></div>
                <?php } ?>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Old Password</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="password" name="opass" class="form-control" placeholder="Enter Old Password">
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="password" name="npass" class="form-control" placeholder="Enter New Password">
                  </div>
                </div>
              </div>


              <div class="row">
                <label class="col-sm-2 col-form-label">Comfirm Password</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="password" name="cpass" class="form-control" placeholder="Enter Comfirm Password">
                  </div>
                </div>
              </div>

              

              
              <button type="submit" name="submit" class="btn btn-info">Change Password</button>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php include('footer.php'); ?>