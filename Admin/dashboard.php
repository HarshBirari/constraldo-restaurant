<?php 

include('header.php'); 

$sel = "select * from book_table";
$qu = mysqli_query($con,$sel);
$num = mysqli_num_rows($qu);

$sel1 = "select * from users";
$qu1 = mysqli_query($con,$sel1);
$num1 = mysqli_num_rows($qu1);

$sel2 = "select * from cart";
$qu2 = mysqli_query($con,$sel2);
$num2 = mysqli_num_rows($qu2);

$sel3 = "select * from comfirm_order";
$qu3 = mysqli_query($con,$sel3);
$num3 = mysqli_num_rows($qu3);

$sel4 = "select * from blog";
$qu4 = mysqli_query($con,$sel4);
$num4 = mysqli_num_rows($qu4);

$sel5 = "select * from tbl_payment";
$qu5 = mysqli_query($con,$sel5);
$num5 = mysqli_num_rows($qu5);

$sel7 = "select * from review_by";
$qu7 = mysqli_query($con,$sel7);
$num7 = mysqli_num_rows($qu7);

$num6 = 0;

while($payment = mysqli_fetch_array($qu3))
{
  $num6 = $num6 + ceil($payment['payment']);
}

$current = date('Y-m-d');
$agodate = date('Y-m-d',strtotime("-11 days", strtotime($current)));

$start_date = $agodate;
$end_date = $current;

$num_order = array();
while (strtotime($start_date) <= strtotime($end_date)) { 
  $sel_order = "select * from comfirm_order where `order_status` = 'Confirm' AND `date` = '$start_date'";
  $qu_sel_order = mysqli_query($con,$sel_order);
  $num_order[] = mysqli_num_rows($qu_sel_order);
  $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date))); 
}


$start_date = $agodate;
$end_date = $current;

$current1 = date('Y-m-d');
$agodate1 = date('Y-m-d',strtotime("-11 days", strtotime($current1)));

$start_date1 = $agodate1;
$end_date1 = $current1;

$num_order1 = array();
while (strtotime($start_date1) <= strtotime($end_date1)) { 
  $sel_order1 = "select * from book_table where `response` = 'Booked' AND `created_date` = '$start_date1'";
  $qu_sel_order1 = mysqli_query($con,$sel_order1);
  $num_order1[] = mysqli_num_rows($qu_sel_order1);
  $start_date1 = date ("Y-m-d", strtotime("+1 days", strtotime($start_date1))); 
}

$start_date1 = $agodate1;
$end_date1 = $current1;

   
?>


<div class="content">
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">weekend</i>
              </div>
              <p class="card-category">Table Bookings</p>
              <h3 class="card-title"><?php echo $num; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style=" background: linear-gradient(60deg, #c08836, #e98507);" href="booking_table.php">Show Booking Data...</a>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="fa fa-user"></i>
              </div>
              <p class="card-category">Website Users</p>
              <h3 class="card-title"><?php echo $num1; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style=" background: linear-gradient(60deg, #d81b60, #ec407a);" href="users.php">Show Users Data...</a>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <p class="card-category">Cart Record</p>
              <h3 class="card-title"><?php echo $num2; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style="background: linear-gradient(60deg, #2e7631, #13d31b);" href="cart.php">Show Cart Record...</a>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-first-order"></i>
              </div>
              <p class="card-category">Total Orders</p>
              <h3 class="card-title"><?php echo $num3; ?></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a style="color: #FF0000;" href="pending_order.php">Show Order Pending...</a>

              </div>
              <div class="stats">
                <a style="color: #198C78;" href="comfirm_order.php">Show Order Comfirm...</a>

              </div>

            </div>
            <div class="card-footer">
              <a class="btn btn" style="background: linear-gradient(60deg, #3d8f99, #01e3ff);" href="order_master.php">Show All Order</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-red card-header-icon">
              <div class="card-icon">
               <i class="material-icons">widgets</i>
              </div>
              <p class="card-category">All Blog</p>
              <h3 class="card-title"><?php echo $num4; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style="background: linear-gradient(60deg, #b43737, #f10000);" href="view_blog.php">Show Blog Record...</a>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-purple card-header-icon">
              <div class="card-icon">
                <i class="fa fa-money" aria-hidden="true"></i>

              </div>
              <p class="card-category">All Payments</p>
              <h3 class="card-title"><?php echo $num5; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style="background: linear-gradient(60deg, #6c2f76, #d300f8);" href="payment_table.php">Show Payment Record...</a>

            </div>
          </div>
        </div>  

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-yellow card-header-icon">
              <div class="card-icon">
                <i class="fa fa-star" aria-hidden="true"></i>


              </div>
              <p class="card-category">Total Reviews</p>
              <h3 class="card-title"><?php echo $num7; ?></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style="background: linear-gradient(60deg, #8f843c, #f8d900);" href="view_review.php">View Reviews...</a>

            </div>
          </div>
        </div>  

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-violet card-header-icon">
              <div class="card-icon">
                <i class="fa fa-cc-diners-club" aria-hidden="true"></i>


              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title"></h3>
            </div>
            <div class="card-footer">

              <a class="btn btn" style="background: linear-gradient(60deg, #337456, #00f886);" href="#"><?php echo $num6; ?>/-</a>

            </div>
          </div>
        </div> 
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-icon card-header-rose">
              <div class="card-icon">
                <i class="material-icons">insert_chart</i>
              </div>
              <h4 class="card-title">Orders & Table Booking
                <small>- Bar Chart</small>

                <small><i class="fa fa-square" style="color: #00bcd4"></i>Orders</small>
                <small><i class="fa fa-square" style="color: #f44336"></i>Table Booking</small>
              </h4>
            </div>
            <div class="card-body">
              <div id="multipleBarsChart" class="ct-chart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="300px" class="ct-chart-bar" style="width: 100%; height: 300px;"><g class="ct-grids">


                <line y1="265" y2="265" x1="50" x2="555" class="ct-grid ct-vertical"></line>

                <line y1="237.22222222222223" y2="237.22222222222223" x1="50" x2="555" class="ct-grid ct-vertical"></line>

                <line y1="209.44444444444446" y2="209.44444444444446" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="181.66666666666669" y2="181.66666666666669" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="153.88888888888889" y2="153.88888888888889" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="126.11111111111111" y2="126.11111111111111" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="98.33333333333334" y2="98.33333333333334" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="70.55555555555554" y2="70.55555555555554" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="42.77777777777777" y2="42.77777777777777" x1="50" x2="555" class="ct-grid ct-vertical"></line>
                <line y1="15" y2="15" x1="50" x2="555" class="ct-grid ct-vertical"></line></g>


                <g><g class="ct-series ct-series-a">

                <?php $x1 = 66.0416; for($i=0;$i<sizeof($num_order);$i++) {

                  if($num_order[$i] == 0)
                  {
                    $y2 = 250;
                  }
                  elseif($num_order[$i] == 1)
                  {
                    $y2 = 237.5;
                  }
                  elseif($num_order[$i] == 2)
                  {
                    $y2 = 225;
                  }
                  elseif($num_order[$i] == 3)
                  {
                    $y2 = 212.5;
                  }
                  elseif($num_order[$i] == 4)
                  {
                    $y2 = 200;
                  }
                  elseif($num_order[$i] == 5)
                  {
                    $y2 = 187.5;
                  }
                  elseif($num_order[$i] == 6)
                  {
                    $y2 = 175;
                  }
                  elseif($num_order[$i] == 7)
                  {
                    $y2 = 162.5;
                  }
                  elseif($num_order[$i] == 8)
                  {
                    $y2 = 150;
                  }
                  elseif($num_order[$i] == 9)
                  {
                    $y2 = 137.5;
                  }
                  elseif($num_order[$i] == 10)
                  {
                    $y2 = 125;
                  }
                  elseif($num_order[$i] == 11)
                  {
                    $y2 = 112.5;
                  }
                  elseif($num_order[$i] == 12)
                  {
                    $y2 = 100;
                  }
                  elseif($num_order[$i] == 13)
                  {
                    $y2 = 87.5;
                  }
                  elseif($num_order[$i] == 14)
                  {
                    $y2 = 75;
                  }
                  elseif($num_order[$i] == 16)
                  {
                    $y2 = 62.5;
                  }
                  elseif($num_order[$i] == 17)
                  {
                    $y2 = 50;
                  }
                  elseif($num_order[$i] == 18)
                  {
                    $y2 = 37.5;
                  }
                  elseif($num_order[$i] == 19)
                  {
                    $y2 = 25;
                  }
                  elseif($num_order[$i] == 20)
                  {
                    $y2 = 12.5;
                  }
                  else
                  {
                    $y2 = 0;
                  }
                 
                 ?>

                  <line x1="<?php echo $x1; ?>" x2="<?php echo $x1; ?>" y1="265" y2="<?php echo $y2; ?>" class="ct-bar" ct:value="1000" opacity="1"></line>
                <?php $x1 = $x1 + 42; } ?>
                </g>

                  <g class="ct-series ct-series-b">
                   <?php $x1 = 76.0416; for($i=0;$i<sizeof($num_order1);$i++) {

                  if($num_order1[$i] == 0)
                  {
                    $y2 = 250;
                  }
                  elseif($num_order1[$i] == 1)
                  {
                    $y2 = 237.5;
                  }
                  elseif($num_order1[$i] == 2)
                  {
                    $y2 = 225;
                  }
                  elseif($num_order1[$i] == 3)
                  {
                    $y2 = 212.5;
                  }
                  elseif($num_order1[$i] == 4)
                  {
                    $y2 = 200;
                  }
                  elseif($num_order1[$i] == 5)
                  {
                    $y2 = 187.5;
                  }
                  elseif($num_order1[$i] == 6)
                  {
                    $y2 = 175;
                  }
                  elseif($num_order1[$i] == 7)
                  {
                    $y2 = 162.5;
                  }
                  elseif($num_order1[$i] == 8)
                  {
                    $y2 = 150;
                  }
                  elseif($num_order1[$i] == 9)
                  {
                    $y2 = 137.5;
                  }
                  elseif($num_order1[$i] == 10)
                  {
                    $y2 = 125;
                  }
                  elseif($num_order1[$i] == 11)
                  {
                    $y2 = 112.5;
                  }
                  elseif($num_order1[$i] == 12)
                  {
                    $y2 = 100;
                  }
                  elseif($num_order1[$i] == 13)
                  {
                    $y2 = 87.5;
                  }
                  elseif($num_order1[$i] == 14)
                  {
                    $y2 = 75;
                  }
                  elseif($num_order[$i] == 16)
                  {
                    $y2 = 62.5;
                  }
                  elseif($num_order1[$i] == 17)
                  {
                    $y2 = 50;
                  }
                  elseif($num_order1[$i] == 18)
                  {
                    $y2 = 37.5;
                  }
                  elseif($num_order1[$i] == 19)
                  {
                    $y2 = 25;
                  }
                  elseif($num_order1[$i] == 20)
                  {
                    $y2 = 12.5;
                  }
                  else
                  {
                    $y2 = 0;
                  }
                 
                 ?>
                    <line x1="<?php echo $x1; ?>" x2="<?php echo $x1; ?>" y1="265" y2="<?php echo $y2; ?>" class="ct-bar" ct:value="412" opacity="1"></line>
                  <?php $x1 = $x1 + 42; } ?>
                  </g></g>

                    <g class="ct-labels">

                    <?php $x = 50; while (strtotime($start_date) <= strtotime($end_date)) { ?>
                      <foreignObject style="overflow: visible;" x="<?php echo $x; ?>" y="270" width="42.083333333333336" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 42px; height: 20px;"><?php echo date('d-m',strtotime($start_date)); ?></span></foreignObject>
                    <?php $x = $x + 42; $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date))); } ?>
                    

                     <?php $y = 237; for($i=0;$i<20;$i = $i+2) { ?>
                      <foreignObject style="overflow: visible;" y="<?php echo $y; ?>" x="10" height="27.77777777777778" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 28px; width: 30px;"><?php echo $i; ?></span></foreignObject>
                    <?php $y = $y - 28; } ?>

                     </g></svg></div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
<?php include('footer.php'); ?>