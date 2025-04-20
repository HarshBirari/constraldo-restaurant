<?php 

include('header.php');

if(isset($_POST['submit']))
{
  $festival = $_POST['festival'];
  $offer = $_POST['offer'];
  $coupon_code = $festival.'_'.$offer;

  $sel = "select * from users";
  $qu = mysqli_query($con,$sel);

  $insert1 = "insert into festival_offer (`festival_name`,`discount`,`promocode`) values ('$festival','$offer','$coupon_code')";
  $que1 = mysqli_query($con,$insert1);

  while($fetch = mysqli_fetch_array($qu))
  {
    $username = $fetch['user_id'];
    $insert ="insert into coupon (`username`,`coupon_code`,`festival`) values ('$username','$coupon_code','yes')";
    $que1 = mysqli_query($con,$insert);
  }
}


  if(isset($_GET['festival_id']))
  {
    $festival_id = $_GET['festival_id'];
    
    $del = "delete from festival_offer where `festival_id` = '$festival_id'";
    mysqli_query($con,$del);

    $sel2 = "select * from users";
    $qu2 = mysqli_query($con,$sel2);

    while($fetch1 = mysqli_fetch_array($qu2))
    {
      $coupon_code = $_GET['coupon_code'];
      $username1 = $fetch1['user_id'];
      $del1 = "delete from coupon where `username` = '$username1' AND `coupon_code` = '$coupon_code'"; 
      mysqli_query($con,$del1);
    }
  }

  $sel1 = "select * from festival_offer";
  $qu4 = mysqli_query($con,$sel1);



?>
<div class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-3">
      </div>
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Promocode Offer </h4>
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
                <label class="col-sm-2 col-form-label">Festival</label>


                <div class="col-lg-5 col-md-6 col-sm-3">
                  <select class="selectpicker" data-style="select-with-transition" name="festival">
                    <option>--SELECT FESTIVAL--</option>
                    <option value="UTARAYAN">Utarayan</option>
                    <option value="HOLI">Holi</option>
                    <option value="JANMASTAMI">Janmastami</option>
                    <option value="NAVRATRI">Navratri</option>
                    <option value="DHANTERAS">Dhanteras</option>
                    <option value="DIWALI">Diwali</option>
                    <option value="NEWYEAR">New Year</option>
                    <option value="CHRISTMAS">Christmas</option>
                  </select>
                </div>
              </div><br>

              <div class="row">
                <label class="col-sm-2 col-form-label">Discount Offer</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="offer" class="form-control" placeholder="Enter Discount in percentages [e.g. = 5]">
                  </div>
                </div>
              </div>


              <div style="text-align: center;">
                <?php if(isset($_GET['id'])) { ?>
                  <button type="submit" name="submit" class="btn btn-info">Update</button>
                <?php } else { ?>
                  <button type="submit" name="submit" class="btn btn-info">Add Offer</button>
                <?php } ?>
              </div>
            </form>
          </div>

        </div>
             <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>#</th>
                          <th>Festival Name</th>
                          <th>Discount Offer</th>
                          <th>Promocode</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu4)) { ?>
                        <tr>
                          <td><?php echo $data['festival_id']; ?></td>
                          <td><?php echo $data['festival_name']; ?></td>
                          <td><?php echo $data['discount']; ?>%</td>
                          <td style="color: green;"><?php echo $data['promocode']; ?></td>
                        
                          <td class="td-actions text-right">
                            
                           
                            <a href="give_promocode.php?festival_id=<?php echo $data['festival_id']; ?>&coupon_code=<?php echo $data['promocode']; ?>" rel="tooltip" class="btn btn-danger">
                              <i class="material-icons">close</i>
                            </a>
                            
                          </td>
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                  </div>
      </div>

    </div>
  </div>
</div>
<?php include('footer.php'); ?>