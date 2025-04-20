<?php 

  include('header.php');

  if(isset($_GET['order_id']))
  {
    $order_id = $_GET['order_id'];
    $del = "delete from comfirm_order where `order_id` = '$order_id'";
    mysqli_query($con,$del);
  }

  $sel= "select * from comfirm_order where `order_status` = 'Cancelled'";
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
                  <h4 class="card-title">Not Comfirm Yet</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Order id</th>
                          <th>Product_id</th>
                          <th>Username</th>
                          <th>Cart id</th>
                          <th>Bill name</th>
                          <th>Address</th>
                          <th>Contact</th>
                          <th>Email</th>
                          <th>Payment</th>
                          <th>Payment Status</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($sel1)) { $username = $data['user_id']; $city = $data['city'];  
                        $state = $data['state']; ?>
                        <?php $select = "select * from users where `user_id` = '$username'";
                        $que = mysqli_query($con,$select);
                        $que1 = mysqli_fetch_array($que);
                        $select1 = "select * from cities where `id` = '$city'";
                        $que3 = mysqli_query($con,$select1);
                        $que3 = mysqli_fetch_array($que3);
                        $select2 = "select * from states where `id` = '$state'";
                        $que4 = mysqli_query($con,$select2);
                        $que4 = mysqli_fetch_array($que4);

                         ?>
                        <tr>
                          <td><?php echo $data['order_id']; ?></td>
                          <td><?php echo $data['p_id']; ?></td>
                          <td><?php echo $que1['username']; ?></td>
                          <td><?php echo $data['cart_id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $data['address']; ?> <?php echo $que3['name']; ?> <?php echo $que4['name']; ?> <?php echo $data['zip']; ?></td>
                          <td><?php echo $data['contact_no']; ?></td>
                          <td><?php echo $data['email']; ?></td>
                          <td><?php echo $data['payment']; ?></td>
                          <?php if($data['order_status']=="Confirm") { ?>
                          <td><button class="btn btn-success"><?php echo $data['order_status']; ?></button></td>
                        <?php } elseif($data['order_status']=="Pending") {  ?>
                          <td><button class="btn btn-warning"><?php echo $data['order_status']; ?></button></td>
                        <?php } else { ?>
                          <td><button class="btn btn-danger"><?php echo $data['order_status']; ?></button></td>
                        <?php } ?>
                          <td class="td-actions text-right">
                            
                            <a href="view_order.php?order_id=<?php echo $data['order_id']; ?>" rel="tooltip" class="btn btn-info">
                              <i class="fa fa-eye"></i>
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


    