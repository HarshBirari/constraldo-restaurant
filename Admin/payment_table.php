<?php 

  include('header.php');

 

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    
    $del = "delete from tbl_payment  where `id` = '$id'";
    mysqli_query($con,$del);
  }

  $sel = "select * from tbl_payment JOIN users ON users.user_id = tbl_payment.user_id";
  $qu = mysqli_query($con,$sel);


 ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-credit-card"></i>
                  </div>
                  <h4 class="card-title">Payment Table</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr style="text-align: center;">
                          <th>Id</th>
                          <th>OrderID</th>
                          <th>User Name</th>
                          <th>Payment Amount</th>
                          <th>Currency Code</th>
                          <th>Txn Id</th>
                          <th>Payment Status</th>
                          <th>Payment Time</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr style="text-align: center;">
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['order_id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $data['amount']; ?></td>
                          <td><?php echo $data['currency_code']; ?></td>
                          <td><?php echo $data['txn_id']; ?></td>
                          <?php if($data['payment_status']=="succeeded") { ?>
                          <td style="color: green;"><?php echo $data['payment_status']; ?></td>
                        <?php }else { ?>
                          <td style="color: red;"><?php echo $data['payment_status']; ?></td>
                        <?php } ?>
                          <td><?php echo $data['created_at']; ?></td>
                          <td class="td-actions text-right">
                            
                           
                            <a href="payment_table.php?id=<?php echo $data['id']; ?>" rel="tooltip" class="btn btn-danger">
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


    