<?php 


  $con = mysqli_connect("localhost","root","","restaurant") or die ("db not connected");

  session_start();

  @$order_id = $_SESSION['order_id'];
  @$user_id = $_SESSION['users']['user_id'];
  @$txn_id = $_SESSION['transction_id'];

  if(isset($_SESSION['payment_method'])=="COD")
  {
    $order_id = $_SESSION['order_id'];
    $update = "update comfirm_order set `order_status` = 'Confirm' where `order_id` = '$order_id'";
    $qu = mysqli_query($con,$update);

    if(@$_SESSION['promocode_id'])
    {
            $promocode_id = $_SESSION['promocode_id'];
            $del = "delete from coupon where `coupon_id` = '$promocode_id'";
            mysqli_query($con,$del);
            unset($_SESSION['promocode_value']);
    }

       $qe = "select * from comfirm_order where `order_id`='$order_id'";
       $qe1 = mysqli_query($con,$qe);
       $qe2 = mysqli_fetch_array($qe1);
       $cart_record =  $qe2['cart_id'];
       $cart_re =  explode(',',$cart_record);

       for($i=0;$i<sizeof($cart_re);$i++)
       {
          $qn ="update cart set `cart_status`='Completed' where `cart_id`='$cart_re[$i]'";
          mysqli_query($con,$qn);
           $sel2 = "select * from cart where `cart_id`  = '$cart_re[$i]'";
          $fetch = mysqli_query($con,$sel2);

          $cart_reco = mysqli_fetch_array($fetch);
          $qty_rec = $cart_reco['qty'];
          $pro_id = $cart_reco['p_id'];

          $sel_pro = "select * from product where `p_id` = '$pro_id'";
          $fetch1 = mysqli_query($con,$sel_pro);

          $pro_rec = mysqli_fetch_array($fetch1);

          $pro_qty = $pro_rec['product_qty'];
          $cat_id = $pro_rec['cat_id'];


          if($cat_id!=5 || $cat_id!=1)
          {
            $quantity = $pro_qty - $qty_rec;
            if($pro_qty>0)
            {
              $qty_update = "update product set `product_qty` = '$quantity' where `p_id` = '$pro_id'";
              $quer1 = mysqli_query($con,$qty_update);
            }
          }
       }
  }

  if(isset($_GET['order_id']))
  {
    $order_id = $_GET['order_id'];
    $sel = "select * from comfirm_order where `order_id` = '$order_id' AND `user_id`= '$user_id'";
    $qu = mysqli_query($con,$sel);

    $sele = "select * from tbl_payment JOIN comfirm_order ON comfirm_order.order_id = tbl_payment.order_id where comfirm_order.`order_id` = '$order_id'";
    $que1 = mysqli_query($con,$sele);
    $order_rec = mysqli_fetch_array($que1);
  }
  else
  {
    $sel = "select * from comfirm_order where `order_id` = '$order_id' AND `user_id`= '$user_id'";
    $qu = mysqli_query($con,$sel);
  }

  @$que = mysqli_fetch_array($qu);

  $p_id = explode(',',$que['p_id']);
  $cart_id = explode(',',$que['cart_id']);

  for($i=0;$i<count($p_id);$i++)
  {
    $select = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where `p_id` = '$p_id[$i]'";
    $prod = mysqli_query($con,$select);
    $products[] = mysqli_fetch_array($prod); 
  }
 

 ?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Costraldo Coffee</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Invoicebus Invoice Template">
    <meta name="author" content="Invoicebus">

    <meta name="template-hash" content="ff0b4f896b757160074edefba8cfab3b">

    <link rel="stylesheet" href="css/template.css">
  </head>


<style>
  ib-span{
    display:none !important;
  }
  html{
    background:url(../images/bg_4.jpg) no-repeat fixed;
  }
  .btnAction{
    background: #c49b63;
    border: 1px solid #c49b63;
    color: #000;
    position: absolute;
    top: 0;
    left: 10px;
    padding: 10px;
    border-radius: 4px;
    text-decoration: none;
}
.btnAction1{
  background: #c49b63;
    border: 1px solid #c49b63;
    color: #000;
    position: absolute;
    top: 0;
    right: 10px;
    padding: 10px;
    border-radius: 4px;
    text-decoration: none;
}
</style>



  <body>
  <a href="../my_order.php" class="btnAction">Back To Your Order</a>
    <div id="container">
      <div class="invoice-top">
        <section id="memo">
          <div class="logo">
            <img src="logo.png" />
          </div>
          
          <div class="company-info">
            <span class="company-name">Costraldo</span>

            <span class="spacer"></span>

            <div>395006</div>
            <div>Bhagwan mahavir college.| Surat | Gujarat |</div>
            

            <span class="clearfix"></span>

            <div>9998012456</div>
            <div>chandan.bhalala1@gmail.com |</div>
          </div>

        </section>
        
        <section id="invoice-info">
          <div>
            <span>{issue_date_label}</span>
            <span>Bill no.:</span>
            <span>Payment Method:</span>
            <span>Payment Transaction Id:</span>
          </div>
          
          <div>
            <span><?php echo $que['date']; ?></span>
            <span><?php echo $order_id; ?></span>
            <?php if($que['payment_method']=="COD") { ?>
            <span>Cash On Delivery</span>
          <?php } else { ?>
            <span>Debit / Credit Card</span>
          <?php } ?>
            <span><?php if(isset($order_rec['txn_id'])) { echo $order_rec['txn_id']; } elseif(isset($txn_id)) { echo $txn_id; } else { echo "-"; } ?></span>
          </div>

          <span class="clearfix"></span>

          <section id="invoice-title-number">
        
            <span id="title"></span>
            <span id="number"></span>
            
          </section>
        </section>
        
        <section id="client-info">
          <span>{bill_to_label}</span>
          <div>
            <span class="bold"><?php echo $que['name']; ?></span>
          </div>
          
          <div>
            <span><?php echo $que['address']; ?></span>
          </div>
          <?php 
            $country = $que['country'];
            $sel1 = "select * from countries where `id` = '$country'";
            $qu1 = mysqli_query($con,$sel1);
            $country_name = mysqli_fetch_array($qu1);

            $state = $que['state'];
            $sel2 = "select * from states where `id` = '$state'";
            $qu2 = mysqli_query($con,$sel2);
            $state_name = mysqli_fetch_array($qu2);

            $city = $que['city'];
            $sel3 = "select * from cities where `id` = '$city'";
            $qu3 = mysqli_query($con,$sel3);
            $city_name = mysqli_fetch_array($qu3);
             ?>

          <div>
            <span><?php echo @$city_name['name']; ?> | <?php echo @$state_name['name']; ?> | <?php echo @$country_name['name']; ?></span>
          </div>
          
          <div>
            <span><?php echo $que['contact_no']; ?></span>
          </div>
          
          <div>
            <span><?php echo $que['email']; ?></span>
          </div>
          
          
        </section>

        <div class="clearfix"></div>
      </div>

      <div class="clearfix"></div>

      <div class="invoice-body">
        <section id="items">
          
          <table cellpadding="0" cellspacing="0">
          
            <tr>
              <th>id</th> <!-- Dummy cell for the row number and row commands -->
              <th>{item_description_label}</th>
              <th>Image</th>
              <th>{item_quantity_label}</th>
              <th>{item_price_label}</th>
              <th>{item_discount_label}</th>
              <!-- <th>{item_tax_label}</th> -->
              <th>{item_line_total_label}</th>
            </tr>
            <?php for($i=0;$i<count($products);$i++) { ?>
              <?php 

              $cart = "select * from cart where `user_id` = '$user_id' AND `cart_id` = '$cart_id[$i]'";
              $fire = mysqli_query($con,$cart);
              $cart_data[] = mysqli_fetch_array($fire);

              ?>
            <tr>
              <td><?php echo $i+1; ?></td>
              <td><?php echo $products[$i]['subcategory_name']; ?> <?php echo $products[$i]['category_name']; ?></td> 
              <td><img src="../admin/image/<?php echo $products[$i]['product_image']; ?>" width="75px"></td>
              <td><?php echo $cart_data[$i]['qty']; ?></td> 
              <td><?php echo $cart_data[$i]['pricewithsize']; ?>.00</td> 
              <td>-</td>
              <!-- <td>-</td>  -->
             
              <td><?php echo $cart_data[$i]['qty'] * $cart_data[$i]['pricewithsize']; ?>.00</td> 
            </tr>
            <?php } ?>              
          </table>
          
        </section>
        
        <section id="sums">
        
          <table cellpadding="0" cellspacing="0">
            <?php if(@$_SESSION['promocode']) { ?>
            <tr>
              <th>Promocode</th>
              <td>: <?php echo $_SESSION['promocode']; ?></td>
              <td></td>
            </tr>
            <?php } elseif(@$que['discount']!=0) { ?>
            <tr>
              <th>Promocode Discount</th>
              <td>-<?php echo $que['discount']; ?>.00</td>
              <td></td>
            </tr>
          <?php } elseif($que['payment']<2000) { ?>
            <tr>
              <th>Delivery Charge</th>
              <td>50.00</td>
              <td></td>
            </tr>
          <?php } ?>

            <tr data-iterate="tax">
              <th>{tax_name}</th>
              <td>{tax_value}</td>
              <td></td>
            </tr>
            
            <tr class="amount-total">
              <th>{amount_total_label}</th>
            <?php if(isset($que['payment'])) { ?>
              <td><?php echo $que['payment']; ?>.00</td>
            <?php } else { ?>
              <td><?php echo $_SESSION['final_price'] ?>.00</td>
            <?php } ?>
              <td>
                <div class="currency">
                  <span>{currency_label}</span> <span>Rupee</span>
                </div>
              </td>
            </tr>
       
          </table>
          
        </section>

        <div class="clearfix"></div>
        
        <section id="terms">
        
          <span class="hidden">{terms_label}</span>
          <div>Fred, thank you very much. We really appreciate your order.</div>

        </section>

             
      </div>

        
    </div>

    <script src="http://cdn.invoicebus.com/generator/generator.min.js?data=data.js"></script>
  </body>
</html>
<script>
  
  function print_invoice()
  {
    alert('success');
    // window.print();
  }

</script>
