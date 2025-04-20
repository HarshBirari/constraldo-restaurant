<?php 

  include('header.php');

 

  if(isset($_GET['coupon_id']))
  {
    $coupon_id = $_GET['coupon_id'];
    
    $del = "delete from coupon where `coupon_id` = '$coupon_id'";
    mysqli_query($con,$del);
  }

  $sel = "select * from coupon join users ON coupon.username  = users.user_id";
  $qu = mysqli_query($con,$sel);


 ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-gift"></i>
                  </div>

                  <h4 class="card-title">Promocode</h4>
                  
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Promocode_id</th>
                          <th>Username</th>
                          <th>Promocode</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr>
                          <td><?php echo $data['coupon_id']; ?></td>
                          <td><?php echo $data['username']; ?></td>
                          <td><?php echo $data['coupon_code']; ?></td>
                          <td class="td-actions text-right">
                            
                           
                            <a href="view_promocode.php?coupon_id=<?php echo $data['coupon_id']; ?>" rel="tooltip" class="btn btn-danger">
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


    