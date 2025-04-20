<?php 

include('header.php');

if(isset($_GET['cart_id']))
{
  $cart_id = $_GET['cart_id'];
  $del = "delete from cart where `cart_id` = '$cart_id'";
  mysqli_query($con,$del);
}

$sel= "select * from cart";
$sel1 = mysqli_query($con,$sel);



?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Cart Table</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>Cart id</th>
                  <th>Product_id</th>
                  <th>Username</th>
                  <th>Single price</th>
                  <th>Flavour</th>
                  <th>Size</th>
                  <th>Qty</th>
                  <th>Total price</th>
                  <th>Cart Status</th>
                  <th class="text-right">Actions</th>
                </tr>
                <?php while($data = mysqli_fetch_array($sel1)) { $username = $data['user_id']; ?>
                <?php $select = "select * from users where `user_id` = '$username'";
                $que = mysqli_query($con,$select);
                $que1 = mysqli_fetch_array($que); ?>
                <tr>
                  <td><?php echo $data['cart_id']; ?></td>
                  <td><?php echo $data['p_id']; ?></td>
                  <td><?php echo $que1['username']; ?></td>
                  <td><?php echo $data['single_price']; ?></td>
                  <td><?php echo $data['flavour']; ?></td>
                  <td><?php echo $data['size']; ?></td>
                  <td><?php echo $data['qty']; ?></td>
                  <td><?php echo $data['total_price']; ?></td>
                  <?php if($data['cart_status']=="Pending") { ?>
                    <td><button class="btn btn-danger"><?php echo $data['cart_status']; ?></button></td>
                  <?php } else { ?>
                    <td><button class="btn btn-success"><?php echo $data['cart_status']; ?></button></td>
                  <?php } ?>
                  <td class="td-actions text-right">
                    
                    <a href="cart.php?cart_id=<?php echo $data['cart_id']; ?>" rel="tooltip" class="btn btn-danger">
                      <i class="material-icons">close</i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end content-->
    </div>
    <!--  end card  -->
  </div>
  <!-- end col-md-12 -->
</div>
<!-- end row -->
</div>
</div>
<?php include('footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


