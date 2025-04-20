<?php 

  include('header.php');

  if(isset($_GET['Active'])=="Active" && isset($_GET['cat_id']))
  {
    $cat_id = $_GET['cat_id'];
    $q1 = "update category set `cat_status` = '0' where `cat_id` = '$cat_id'";
  }
  else 
  {
    @$cat_id = $_GET['cat_id'];
    $q1 = "update category set `cat_status` = '1' where `cat_id` = '$cat_id'";
  }
  $que2 = mysqli_query($con,$q1);


  if(isset($_GET['cat_id']) && isset($_GET['delete']))
  {
    $cat_id = $_GET['cat_id'];
    $sel = "select * from category where `cat_id` = '$cat_id'";
    $qu1 = mysqli_query($con,$sel);
    $que = mysqli_fetch_array($qu1);
    @unlink('image/'.$que['image']);
    $del = "delete from category where `cat_id` = '$cat_id'";
    mysqli_query($con,$del);
  }

  $sel = "select * from category";
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
                  <h4 class="card-title">Categories</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Category status</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr>
                          <td><?php echo $data['cat_id']; ?></td>
                          <td><?php echo $data['category_name']; ?></td>
                          <?php if($data['cat_status']!=1) { ?>
                          <td>
                            <a href="view_category.php?Inactive=Inactive&cat_id=<?php echo $data['cat_id']; ?>" class="btn btn-rose"><i class="fa fa-low-vision"></i> INACTIVE</a>
                          </td>
                        <?php } else { ?>
                          <td>
                            <a href="view_category.php?Active=Active&cat_id=<?php echo $data['cat_id']; ?>" class="btn btn-info"><i class="fa fa-eye"></i> ACTIVE</a>
                          </td>
                          <?php } ?>
                          <td class="td-actions text-right">
                            
                           
                            <a href="view_category.php?cat_id=<?php echo $data['cat_id']; ?>&delete" rel="tooltip" class="btn btn-danger">
                              <i class="material-icons">close</i>
                            </a>
                             <a href="category.php?cat_id=<?php echo $data['cat_id']; ?>" rel="tooltip" class="btn btn-success">
                              <i class="material-icons">edit</i>
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


    