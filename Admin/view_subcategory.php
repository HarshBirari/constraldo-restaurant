<?php 

  include('header.php');

  if(isset($_GET['Active'])=="Active" && isset($_GET['sub_id']))
  {
    $sub_id = $_GET['sub_id'];
    $q1 = "update subcategory set `sub_status` = '0' where `sub_id` = '$sub_id'";
  }
  else 
  {
    @$sub_id = $_GET['sub_id'];
    $q1 = "update subcategory set `sub_status` = '1' where `sub_id` = '$sub_id'";
  }
  $que2 = mysqli_query($con,$q1);


  if(isset($_GET['sub_id']) && isset($_GET['delete']))
  {
    $sub_id = $_GET['sub_id'];
    $sel = "select * from subcategory where `sub_id` = '$sub_id'";
    $qu1 = mysqli_query($con,$sel);
    $que = mysqli_fetch_array($qu1);
    @unlink('image/'.$que['image']);
    $del = "delete from subcategory where `sub_id` = '$sub_id'";
    mysqli_query($con,$del);
  }

  if(isset($_GET['page']))
  {
    $page = $_GET['page'];
  }
  else
  {
    $page = 0;
  }

  $per_page = 10;
  $page = $page * $per_page;

  if(isset($_GET['search']))
  {
    $ser = $_GET['search'];
    $sel = "select * from subcategory JOIN category ON category.cat_id = subcategory.cat_id where `category_name` LIKE '%$ser%' OR `subcategory_name` LIKE '%$ser%'";
  }
  else
  {
    $sel = "select * from subcategory JOIN category ON category.cat_id = subcategory.cat_id";
  }

  $qu1 = mysqli_query($con,$sel);
  $num = mysqli_num_rows($qu1);
  $num1 = ceil($num/$per_page);

  if(isset($_GET['search']))
  {
    $ser = $_GET['search'];
    $sel = "select * from subcategory JOIN category ON category.cat_id = subcategory.cat_id where `category_name` LIKE '%$ser%' OR `subcategory_name` LIKE '%$ser%' limit $page,$per_page";
  }
  else
  {
    $sel = "select * from subcategory JOIN category ON category.cat_id = subcategory.cat_id limit $page,$per_page";
  }

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
                  <h4 class="card-title">Subcategory</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <form>
                    <input type="text" name="search" style="height: 40px" placeholder="Type to search...">
                     <button type="submit" name="submit" class="btn btn-warning"> Search</button>
                  </form><br>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>S_ID</th>
                          <th>Category Name</th>
                          <th>Subcategory Name</th>
                          <th>Subcategory status</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr>
                          <td><?php echo $data['sub_id']; ?></td>
                          <td><?php echo $data['category_name']; ?></td>
                          <td><?php echo $data['subcategory_name']; ?></td>
                          <?php if($data['sub_status']!=1) { ?>
                          <td>
                            <a href="view_subcategory.php?Inactive=Inactive&sub_id=<?php echo $data['sub_id']; ?>" class="btn btn-rose"><i class="fa fa-low-vision"></i> INACTIVE</a>
                          </td>
                        <?php } else { ?>
                          <td>
                            <a href="view_subcategory.php?Active=Active&sub_id=<?php echo $data['sub_id']; ?>" class="btn btn-info"><i class="fa fa-eye"></i> ACTIVE</a>
                          </td>
                          <?php } ?>
                          <td class="td-actions text-right">
                            <a href="subcategory.php?sub_id=<?php echo $data['sub_id']; ?>" rel="tooltip" class="btn btn-success">
                              <i class="material-icons">edit</i>
                            </a>
                           
                            <a href="view_subcategory.php?sub_id=<?php echo $data['sub_id']; ?>&delete" rel="tooltip" class="btn btn-danger">
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
              <div style="text-align: center;">
                <?php for ($i=0; $i <  $num1; $i++) { 
                  # code...
                ?>
                <a href="view_subcategory.php?page=<?php echo $i; ?>&search=<?php echo @$_GET['search']; ?>" class="btn btn-rose" style="padding:15px;"><?php echo $i+1; ?></a>
              <?php } ?>
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


    