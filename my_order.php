<?php
ob_start();
include('header.php'); 

if(isset($_SESSION['users']['user_id'])!="")
{
  $user_id = $_SESSION['users']['user_id'];
  $sel = "select * from comfirm_order where `user_id` = '$user_id' AND `order_status` = 'Confirm' ORDER BY order_id DESC";
  $qu = mysqli_query($con,$sel);
  $num = mysqli_num_rows($qu);


}
else
{
  header('location:login.php');
}


?>

<section class="home-slider owl-carousel">

  <div class="slider-item" style="background-image: url(images/37.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">

        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">My Order</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>My Order</span></p>
        </div>

      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
         <?php if($num!=0) { ?>
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>Order Id</th>
                <th colspan="2">Product</th>
                <th>On Order</th>
                <th>Track Order</th>
              </tr>
            </thead>
            <tbody>
              <?php while($record = mysqli_fetch_array($qu)) {
                $p_id = $record['p_id'];
                $sel1 = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id WHERE product.p_id IN($p_id)";
                $que = mysqli_query($con,$sel1);
                  $sel2 = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id WHERE product.p_id IN($p_id)";
                $que2 = mysqli_query($con,$sel2);
                
                 ?>
                 <tr class="text-center tr">
                  <input type="hidden" name="cart_id" id="cart_id" class="cart_id" value="<?php echo $wishlist['id']; ?>">
                  <td><?php echo $record['order_id']; ?></td>

                  
                  <td class="image-prod">  <?php $i=1;  while($fetch2 = mysqli_fetch_array($que2)) {  ?><div class="img" style="background-image:url(admin/image/<?php echo $fetch2['product_image']; ?>);"></div><br><?php } ?></td>

                  <td class="product-name">
                    <?php $i=1;  while($fetch1 = mysqli_fetch_array($que)) {  ?>
                    <h3><?php echo $i.'). '. $fetch1['subcategory_name']; ?> <?php echo $fetch1['category_name']; ?></h3>


                    <p><?php echo $fetch1['product_description']."<br>"; ?></p>
                  <?php $i++; } ?>
                  </td>

                  <td class="product-name">
                    <h3><?php echo $record['created_at']; ?></h3>

                  </td>

                  <!-- <td class="product-name">
                    <p><a href="single_product.php?p_id=<?php echo $fetch1['p_id']; ?>" class="btn btn-primary btn-outline-primary">Order Again</a></p>

                  </td> -->

                  <td class="product-name">
                       <p><a href="order_details.php?order_id=<?php echo $record['order_id']; ?>" class="btn btn-primary py-2 px-4">Track Order</a></p>

                  </td>
                </tr>
                <?php } ?>




              </tbody>
            </table>
          <?php } else { ?>

            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">

                </tr>
              </thead>
              <tbody>
               

             
                  <tr class="text-center tr">
                      <td><img src="images/order.png" width="400px"></td>
                      <td><h2>No Order Found..!</h2></td>

                    </td>

                  </tr>
              
                  
                </tbody>
              </table>

            <?php }  ?>
          </div>
        </div>
      </div>


    </div>
  </section>

  

  <?php include('footer.php'); ?>

  <script>

    $(document).ready(function(){

      $('.itemQty').on('change',function(){

        var click = $(this).closest('.tr');

        var cart_id = click.find('.cart_id').val();
        var qty = click.find('#qty').val();
        var single_price =  click.find('#single_price').val();

        $.ajax({
          url:"price_set.php",
          type :"post",
          data :{
            'cart_id' : cart_id,
            'qty' : qty,
            'single_price' : single_price
          },
          success: function(data)
          {
            location.reload(); 
          }
        });

      });
    });



    
  </script>