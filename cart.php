<?php

ob_start();
include('header.php'); 

unset($_SESSION['promocode']);


@$user_id = $_SESSION['users']['user_id'];
$sel = "select * from cart where `user_id` = '$user_id' AND `cart_status` = 'Pending'";
$qu = mysqli_query($con,$sel);
$num = mysqli_num_rows($qu);

if($num!=0)
{

  if(isset($_SESSION['users']['user_id']))
  {
    $user_id = $_SESSION['users']['user_id'];
    $sel1 = "select * from cart JOIN product ON product.p_id = cart.p_id where cart.`user_id` = '$user_id' AND cart.`cart_status` = 'Pending'";
    $qu1 = mysqli_query($con,$sel1);

    $sel = "select * from cart where `user_id` = '$user_id' AND `cart_status` = 'Pending'";
    $qu = mysqli_query($con,$sel);
  }
  else
  {
    header('location:login.php');
  }

  if(isset($_POST['submit']))
  {
    $coupon_code = $_POST['coupon_code'];
    $user_id = $_SESSION['users']['user_id'];
    $sel_coupon = "select * from coupon where `username` = '$user_id' AND `coupon_code` = '$coupon_code'";
    $qu_coupon = mysqli_query($con,$sel_coupon);
    $num1  = mysqli_num_rows($qu_coupon);

    if($num1==1)
    {
      if($_SESSION['subtotal']>=3000)
      {
        $que = mysqli_fetch_array($qu_coupon);
        if($que['coupon_code']=="BMBCA05")
        {
          $promocode = $_SESSION['subtotal'] * 5 /100;
        }
        elseif($que['festival']=="yes")
        {
          $ex = explode('_',$que['coupon_code']);
  
          $promocode = $_SESSION['subtotal'] * $ex[1] /100;
        }
        else
        {
          $promocode = $_SESSION['subtotal'] * 10 /100;
        }
        $promo = $que['coupon_code'];
        $promocode_success = "Promocode ".$promo." Applied";
        $_SESSION['promocode'] = $promocode;
        $_SESSION['promocode_id'] = $que['coupon_id'];
      }
      else
      {
        $promocode_limit_error = "The value of the cart should be more than 3000";
      }
    }
    else
    {
      $coupon_code = $_POST['coupon_code'];
      $sele = "select * from festival_offer where `promocode` = '$coupon_code'";
      $qu_sel = mysqli_query($con,$sele);
      $promocode_number = mysqli_num_rows($qu_sel);

      if($promocode_number==0)
      {
        $promocode = 0;
        $promocode_error = "The Promocode you entered is not valid";
      }
      else
      {
        $promocode = 0;
        $promocode_error = "The Promocode $coupon_code has already been used";
      }

    }
  }
}

  $sel5 = "select * from festival_offer";
  $que5 = mysqli_query($con,$sel5);

  $festival = mysqli_num_rows($que5);


?>

<section class="home-slider owl-carousel">

  <div class="slider-item" style="background-image: url(images/3.jpg);" data-stellar-background-ratio="0.5">
   <div class="overlay"></div>
   <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

      <div class="col-md-7 col-sm-12 text-center ftco-animate">
       <h1 class="mb-3 mt-5 bread">Cart</h1>
       <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
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
            <th><a href="javascript:void(0)" onclick="return deletecartrec()" style="color: #fff;"><i class="fa fa-trash"></i>  Clear Cart</a></th>
            <th>&nbsp;</th>
            <th>Product</th>
            <th>Flavour / Size</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $subtotal = 0;
          while($cart = mysqli_fetch_array($qu)) { 
            $product = mysqli_fetch_array($qu1);
            $cat_id = $product['cat_id'];
            $sub_id = $product['sub_id'];
            $p_id = $product['p_id'];

            $product = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where category.`cat_id` = '$cat_id' AND subcategory.`sub_id` = '$sub_id' AND `p_id` = '$p_id'";
            $pro_fire = mysqli_query($con,$product);
            $product_item = mysqli_fetch_array($pro_fire);


            ?>

            <tr class="text-center tr">
              <td class="product-remove"><a href="javascript:void(0)" onclick="return deletecartrec('<?php echo $cart['cart_id']; ?>')"><span class="icon-close"></span></a></td>
              <input type="hidden" name="cart_id" id="cart_id" class="cart_id" value="<?php echo $cart['cart_id']; ?>">

              <td class="image-prod"><div class="img" style="background-image:url(admin/image/<?php echo $product_item['product_image']; ?>);"></div></td>

              <td class="product-name">
               <h3><?php echo $product_item['subcategory_name']; ?> <?php echo $product_item['category_name']; ?></h3>
               <p><?php echo $product_item['product_description']; ?></p>
             </td>
             <?php if($cart['flavour']=="") { ?>
               <td><h6 style="color: white;"><?php echo $cart['size']; ?></h6></td>
             <?php }else { ?>
               <td><h6 style="color: white;"><?php echo $cart['flavour']; ?> / <?php echo $cart['size']; ?></h6></td>
             <?php } ?>
             <td class="price"><?php echo $cart['pricewithsize']; ?></td>
             <input type="hidden" name="single_price" id="single_price" value="<?php echo $cart['pricewithsize']; ?>">

             <td class="quantity">
               <div class="input-group mb-3">
                 <input type="number" name="quantity" class="quantity itemQty form-control input-number" value="<?php echo $cart['qty']; ?>" min="1" max="100" id="qty">
               </div>
             </td>

             <td class="total" id="total_price"><?php echo $cart['total_price']; ?></td>
             <?php $subtotal = $subtotal + $cart['total_price']; ?>
             <?php $_SESSION['subtotal'] = $subtotal;  ?>
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


        <td><img src="images/cart.jpg" width="400px"></td>
        <td><h2>Unfortunately, Your Cart Is Currently Empty!</h2></td>


      </tr>


    </tbody>
  </table>

<?php } ?>
</div>
</div>
</div>
<div>
  <?php if($num!=0) { ?>
   <td>
    <div class="mt-5" >

      <form method="post" style="margin-left: auto;width: 30%;">
        <p><b style="color: #fff;">New user :</b> Steal Rs.5% OFF <a href="#" data-toggle="modal" data-target="#exampleModalCenter">Get Promocode</a></p>
        <p><b style="color: #fff;">Special Offer :</b> Get Instant Discount Rs.10% <a href="#" data-toggle="modal" data-target="#exampleModalCenter1"><br>T & C</a></p>
      <?php if(isset($festival)!=0) { foreach($que5 as $offer) { ?>
        <p><b style="color: #fff;"><?php echo $offer['festival_name']; ?> Offer :</b> <?php echo $offer['festival_name'] ?> Festival Discount Rs <?php echo $offer['discount']; ?>% Flat <a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $offer['festival_id']; ?>">Get Promocode</a></p>
      <?php } } ?>
        <div class="d-flex justify-content-end">
          <input type="text" name="coupon_code" id="coupon_code" value="<?php if(isset($coupon_code)) { echo $coupon_code; } ?>" placeholder="Promocode Code" style="height: 54px;text-indent: 10px;color:#fff;background: transparent;border: 0;width: 75%;border: 1px solid #c49b63;">
          <button type="submit" name="submit" style="width: 155px !important;color: #000 !important;" class="btn  btn-primary hover-btn addItemBtn">Apply Promocode</button>
        </div>

      </form>
      <?php if(isset($promocode_success)) { ?>
        <div style="text-align: right; margin: 10px 0;"><p style="color: lightgreen;"><?php echo $promocode_success; ?> <i class="fa fa-check-circle"></i></p></div>
      <?php } else if(isset($promocode_error)) { ?>
        <div style="text-align: right; margin: 10px 0;"><p style="color: red;"><?php echo $promocode_error; ?></p></div>
      <?php } else if(isset($promocode_limit_error)) { ?>
       <div style="text-align: right; margin: 10px 0;"><p style="color: red;"><?php echo $promocode_limit_error; ?></p></div>
     <?php } ?>
   </div>

 </td>
</div>
<div class="row justify-content-end">
 <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
  <div class="cart-total mb-3">
   <h3>Cart Totals</h3>
   <p class="d-flex">
    <span>Subtotal</span>
    <span><i  class="fa fa-rupee"></i><?php echo @$subtotal; ?>.00</span>

  </p>
  <p class="d-flex">
    <span>Delivery</span>
    <?php if(@$subtotal>=2000) { ?>
      <span>Free Delivery</span>
      <?php  @$delivery =0; ?>
    <?php } else { ?>
      <span><i class="fa fa-rupee"></i><?php echo $delivery = 50; ?>.00</span>
    <?php } ?>
  </p>

  <?php if(@$subtotal>=3000) { if(isset($promocode_success)) { ?>
    <p class="d-flex">
      <span>Promocode Discount</span>
      <span><i class="fa fa-rupee"></i><?php echo $promocode; ?>.00</span>
    </p>
  <?php } } ?>


  <hr>
  <p class="d-flex total-price">
    <span>Total</span>
    <span><i class="fa fa-rupee"></i><?php echo @$final_price = $subtotal - @$promocode + $delivery; ?>.00</span>
  </p>
  <?php $_SESSION['final_price'] = $final_price; ?>
</div>
<p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
<p class="text-center"><a href="shop.php" class="btn btn-primary py-3 px-4">Continue to shop</a></p>
<?php } else { ?>
  <br><br><p class="text-center"><a href="shop.php" class="btn btn-primary py-3 px-4">Continue to shop</a></p>
<?php } ?>
</div>
</div>
</div>
</section>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #c49b63">
        <h5 class="modal-title" id="exampleModalLongTitle">Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <h5 style="color: #000;">PROMOCODE <b>: BMBCA05</b></h5>
        <h5 style="color: #000;">Valid on all products</h5></center><hr>
      
          
            <ul>
              <li>Discount Amount: : <b style="color:#000">5% cashback of amount</b></li>
              <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
              <li>Maximum Usage : <b style="color:#17a2b8">Once new user</b></li>
              <li>Valid Till : <b style="color:#d28e33">Any time</b></li>
            </ul>

             <center>
          <small style="color: #000;">T & C Apply</small>
          </center>

 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #c49b63">
        <h5 class="modal-title" id="exampleModalLongTitle">Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <h5 style="color: #000;">COSTRALDO SHOP</h5>
        <h5 style="color: #000;">Valid on all products</h5></center><hr>
      
          
            <ul>
              <li>When Get Promocode : <b style="color:#000">Shop worth 10000 or more & get discount at next order and promocode recieved by order recipt and email. discount by costraldo shop</b></li>
              <li>Discount Amount: : <b style="color:#000">10% cashback of amount</b></li>
              <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
              <li>Maximum Usage : <b style="color:#17a2b8">Once per user</b></li>
              <li>Valid Till : <b style="color:#d28e33">Any time</b></li>
            </ul>
             <center>
          <small style="color: #000;">T & C Apply</small>
          </center>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<?php foreach($que5 as $offer1) { 
        $festival_id = $offer1['festival_id'];
  ?>
<div class="modal fade" id="exampleModalCenter<?php echo $offer1['festival_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #c49b63">
        <h5 class="modal-title" id="exampleModalLongTitle">Festival Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <?php $sel_festival = "select * from festival_offer where `festival_id` = '$festival_id'"; $qu_festival = mysqli_query($con,$sel_festival); $festival_fetch = mysqli_fetch_array($qu_festival); ?>
        <h5 style="color: #000;">PROMOCODE : <?php echo $festival_fetch['promocode']; ?></h5>
        <h5 style="color: #000;">Valid on all products</h5></center><hr>
      
          
            <ul>
              <li>When Get Promocode : <b style="color:#000">Festival Discount Rs <?php echo $festival_fetch['discount']; ?>% Flat</b></li>
              <li>Discount Amount: : <b style="color:#000"><?php echo $festival_fetch['discount']; ?>% cashback of amount</b></li>
              <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
              <li>Maximum Usage : <b style="color:#17a2b8">Once per user</b></li>
              <li>Valid Till : <b style="color:#d28e33">Limited time during <?php echo $festival_fetch['festival_name']; ?> festival</b></li>
            </ul>
            <center>
          <small style="color: #000;">T & C Apply</small>
          </center>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>


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


  function deletecartrec(cart_id)
  {
    $.ajax({
      url : "deletecartrecord.php",
      type : "post",
      data : {
        'cart_id' :cart_id
      },
      success : function(resp)
      {
        location.reload();
      }
    });
  }



</script>