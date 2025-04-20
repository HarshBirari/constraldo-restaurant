<?php 

  include('header.php');

  if(isset($_GET['user_id']))
  {
    $user_id = $_GET['user_id'];
    $del = "delete from users where `user_id` = '$user_id'";
    mysqli_query($con,$del);
  }

  $sel= "select * from users";
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
                  <h4 class="card-title">Users Website</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>User Id</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Contact no</th>
                         
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($sel1)) { ?>
                        <tr>
                          <td><?php echo $data['user_id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $data['username']; ?></td>
                          <td><?php echo $data['email']; ?></td>
                          <td><?php echo $data['contact_no']; ?></td>
                         
                         
                          <td class="td-actions text-right">
                            
                            <a href="users.php?user_id=<?php echo $data['user_id']; ?>" rel="tooltip" class="btn btn-danger">
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


    