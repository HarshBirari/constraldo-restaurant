<?php 

include('header.php');


if(isset($_POST['submit']))
{
  if($_POST['remarks']=="Order Confirmed")
  {
    $remarks = $_POST['remarks'];
    $order_id = $_GET['order_id'];

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $update = "update order_track set `order_remarks` = '$remarks',`updated_at`='$date' where `order_id` = '$order_id'";
    mysqli_query($con,$update);

    $update1 = "update comfirm_order set `track_status` = '$remarks' where `order_id` = '$order_id'";
    mysqli_query($con,$update1);
  }
  else
  {
    $remarks = $_POST['remarks'];
    $order_id = $_GET['order_id'];

    $insert = "insert into order_track (`order_id`,`order_remarks`) values ('$order_id','$remarks')";
    mysqli_query($con,$insert);

    $update1 = "update comfirm_order set `track_status` = '$remarks' where `order_id` = '$order_id'";
    mysqli_query($con,$update1);

  }
}

  $order_id = $_GET['order_id'];
  $sel4 = "select * from order_track where `order_id` = '$order_id'";
  $qu4 = mysqli_query($con,$sel4);

if(isset($_GET['order_id']))
{
  $order_id = $_GET['order_id'];
  $sel = "select * from comfirm_order JOIN order_track ON order_track.order_id = comfirm_order.order_id where comfirm_order.`order_id` = '$order_id'";
  $qu = mysqli_query($con,$sel);
  $record = mysqli_fetch_array($qu);
  $city_id = $record['city'];
  $state_id = $record['state'];
  $p_id = $record['p_id'];

  $order_id = $_GET['order_id'];
  $sel2 = "select * from comfirm_order JOIN order_track ON order_track.order_id = comfirm_order.order_id where comfirm_order.`order_id` = '$order_id' AND comfirm_order.`order_status` = 'Confirm' ORDER BY track_id DESC LIMIT 1";
  $qu2 = mysqli_query($con,$sel2);
  $fetch2 = mysqli_fetch_array($qu2);

  $sel1 = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where product.p_id IN ($p_id)";
  $qu1 = mysqli_query($con,$sel1);
}
else
{
  header('location:dashboard.php');
}

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Order Details #<?php echo $record['order_id']; ?></h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>Order Number</th>
                  <td><?php echo $record['order_id']; ?></td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <?php $name = explode(' ',$record['name']); ?>
                  <td><?php echo $name[0]; ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?php echo $name[1]; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $record['email']; ?></td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td><?php echo $record['address']; ?></td>
                </tr>
                <tr>
                  <th>City</th>
                  <?php $sel1 = "select * from cities where `id` = '$city_id'"; $que = mysqli_query($con,$sel1); $city = mysqli_fetch_array($que); ?>
                  <td><?php echo $city['name']; ?></td>
                </tr>
                <tr>
                  <th>State</th>
                  <?php $sel2 = "select * from states where `id` = '$state_id'"; $que1 = mysqli_query($con,$sel2); $state = mysqli_fetch_array($que1); ?>
                  <td><?php echo $state['name']; ?></td>
                </tr>
                <tr>
                  <th>Zip code</th>
                  <td><?php echo $record['zip']; ?></td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td><?php echo $record['date']; ?></td>
                </tr>
                <tr>
                  <th>Order Final Status</th>
                  <td><?php echo $fetch2['order_remarks']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Order Details</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>#</th>
                  <th>Item</th>
                  <th>Item Name</th>
                  <th>Price</th>
                </tr>
                <?php $i=1; while($product = mysqli_fetch_array($qu1)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="image/<?php echo $product['product_image']; ?>" width="75px"></td>
                    <td><?php echo $product['subcategory_name']; ?> <?php echo $product['category_name']; ?></td>
                    <td><?php echo $fetch2['payment']; ?></td>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">

        </div>


        <div class="card-body ">
          <form method="post" enctype="multipart/form-data" class="form-horizontal">


            <div class="row">
              <?php if(isset($msg)) { ?>
                <div class="alert alert-success"><?php echo $msg; ?></div>
              <?php } ?>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label" style="color: #000;">Restaurant Remarks : </label>
              <div class="col-sm-10">
                <div class="form-group">
                 <select  class="form-select" name="remarks" style="width: 200px; height:40px; padding: 0 10px;" aria-label="Default select example">
                  <option selected>- - -Give response- - -</option>
                  <option>Order Confirmed</option>
                  <option>Food being prepared</option>
                  <option>Food Pickup</option>
                  <option>Food Delivered</option>
                </select>
              </div>

            </div>
          </div>

          <div style="text-align: center;">
            <button type="submit" name="submit" class="btn btn-info">Update order</button>
          </div>
        </form>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
             <i class="fa fa-truck"></i>
            </div>
            <h4 class="card-title">Order Tracking History</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>#</th>
                  <th>Order Status</th>
                  <th>Time</th>
                </tr>
                <?php $i=1; while($record1 = mysqli_fetch_array($qu4)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $record1['order_remarks']; ?></td>
                    <td><?php echo $record1['updated_at']; ?></td>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
</div>
</div>
<?php include('footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


