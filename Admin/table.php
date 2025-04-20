<?php 

  include('header.php');

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    $sel = "select * from admin where `id` = '$id'";
    $qu1 = mysqli_query($con,$sel);
    $que = mysqli_fetch_array($qu1);
    @unlink('image/'.$que['image']);
    $del = "delete from admin where `id` = '$id'";
    mysqli_query($con,$del);
  }
  $sel = "select * from admin";
  $qu = mysqli_query($con,$sel);


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
                  <h4 class="card-title">Admin Record</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Gender</th>
                          <th>Hobbies</th>
                          <th>Country</th>
                          <th>Image</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr>
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $data['email']; ?></td>
                          <td><?php echo $data['gender']; ?></td>
                          <td><?php echo $data['hobby']; ?></td>
                          <td><?php echo $data['country']; ?></td>
                          <td><img src="image/<?php echo $data['image']; ?>" width="70px"></td>
                        <td class="td-actions text-right">
                            
                            <a href="register.php?id=<?php echo $data['id']; ?>" rel="tooltip" class="btn btn-success">
                              <i class="material-icons">edit</i>
                            </a>
                            <a href="table.php?id=<?php echo $data['id']; ?>" rel="tooltip" class="btn btn-danger">
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


    