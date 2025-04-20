<?php 

include('header.php');

if(isset($_GET['blog_cmt_id']))
{
  $blog_cmt_id = $_GET['blog_cmt_id'];

  $del = "delete from blog_comment where `blog_cmt_id` = '$blog_cmt_id'";
  mysqli_query($con,$del);
}

$sel = "select * from blog_comment JOIN blog ON blog.blog_id = blog_comment.blog_id";
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
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Time</th>
                  <th class="text-right">Actions</th>
                </tr>
                <?php while($data = mysqli_fetch_array($qu)) { ?>
                  <tr>
                    <td><?php echo $data['blog_cmt_id']; ?></td>
                    <td><?php echo $data['blog_name']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['message']; ?></td>
                    <td><?php echo $data['created_at']; ?></td>
                    
                    <td class="td-actions text-right">
                      
                     
                      <a href="blog_comment.php?blog_cmt_id=<?php echo $data['blog_cmt_id']; ?>" rel="tooltip" class="btn btn-danger">
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


