<?php 

  include('header.php');

 

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    
    $del = "delete from wishlist where `id` = '$id'";
    mysqli_query($con,$del);
  }

  $sel = "select * from wishlist JOIN product ON product.p_id = wishlist.p_id JOIN users ON users.user_id = wishlist.user_id";
  $qu = mysqli_query($con,$sel);


 ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-heart"></i>
                  </div>
                  <h4 class="card-title">Wishlist</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                          <th>Id</th>
                          <th>User Id</th>
                          <th>Product_name</th>
                          <th>Product_image</th>
                          <th class="text-right">Actions</th>
                        </tr>
                        <?php while($data = mysqli_fetch_array($qu)) { $p_id = $data['p_id']; $se_pro = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where `p_id` = '$p_id'";
                        $qu_pro = mysqli_query($con,$se_pro);
                        $fetch = mysqli_fetch_array($qu_pro); ?>
                        <tr>
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $fetch['subcategory_name']; ?> <?php echo $fetch['category_name']; ?></td>
                          <td><img src="image/<?php echo $fetch['product_image']; ?>" width="100px"></td>
                          <td class="td-actions text-right">
                            
                           
                            <a href="view_wishlist.php?id=<?php echo $data['id']; ?>" rel="tooltip" class="btn btn-danger">
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


    