<?php 

  include('header.php');

  if(isset($_GET['blog_id']))
  {
    $blog_id = $_GET['blog_id'];
    $sel1 = "select * from blog where `blog_id` = '$blog_id'";
    $qu1 = mysqli_query($con,$sel1);
    $fetch = mysqli_fetch_array($qu1);

    @unlink("image/blog/".$fetch['image']);
    @unlink("image/blog/".$fetch['chef_image']);

    $del = "delete from blog where `blog_id` = '$blog_id'";
    mysqli_query($con,$del);
  }

  $sel = "select * from blog";
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
                  <h4 class="card-title">Blog Commentator</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Id</th>
                          <th>Blog Name</th>
                          <th>Blog Description</th>
                          <th>Chef Name</th>
                          <th>Chef Image</th>
                          <th>Image</th>
                          <th>Blog Header</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { ?>
                        <tr>
                          <td><?php echo $data['blog_id']; ?></td>
                          <td><?php echo $data['blog_name']; ?></td>
                          <td><?php echo $data['blog_desc']; ?></td>
                          <td><?php echo $data['chef_name']; ?></td>
                          <td><img src="image/blog/<?php echo $data['chef_image']; ?>" width="100px"></td>
                          <td><img src="image/blog/<?php echo $data['image']; ?>" width="100px"></td>
                          <td><?php echo $data['blog_header']; ?></td>
                       
                          <td class="td-actions text-right">
                            
                           
                            <a href="view_blog.php?blog_id=<?php echo $data['blog_id']; ?>" rel="tooltip" class="btn btn-danger">
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


    