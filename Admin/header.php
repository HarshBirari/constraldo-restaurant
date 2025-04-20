  <?php 

  include('db.php');

  session_start();

  if(isset($_SESSION['user']['id'])=="")
  {
    header('location:index.php');
  }

  $id = $_SESSION['user']['id'];
  $date = date('Y-m-d');
  $sel = "select * from admin where `id` = '$id' AND `update_at` = '$date'";
  $qu = mysqli_query($con,$sel);
  $num = mysqli_num_rows($qu);

  $sel1 = "select * from comfirm_order JOIN users ON users.user_id = comfirm_order.user_id where `order_status` = 'Confirm' AND `date` = '$date' AND `track_status` != 'Food Delivered'";
  $qu1 = mysqli_query($con,$sel1);

  $sel2 = "select * from book_table where `created_at` LIKE '%$date%' AND `response` = ''";
  $qu2 = mysqli_query($con,$sel2);

  $num1 = mysqli_num_rows($qu1);
  $num2 = mysqli_num_rows($qu2);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/favicon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      Costraldo Admin
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  </head>


</style>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
      -->
      <div class="logo"><a href="dashboard.php" class="simple-text logo-mini">
        CT
      </a>
      <a href="dashboard.php" class="simple-text logo-normal">
        Costraldo Team
      </a></div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="image/<?php echo $_SESSION['user']['image']; ?>" width="150px"/>
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php echo $_SESSION['user']['name']; ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">

                <li class="nav-item">
                  <a class="nav-link" href="table.php">
                    <span class="sidebar-mini"> AR </span>
                    <span class="sidebar-normal"> Admin Record </span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="../admin/dashboard.php">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>

            <li class="nav-item ">
          <a class="nav-link" data-toggle="collapse" href="#formsExamples">
            <i class="fa fa-shield" aria-hidden="true"></i>

            <p> Make Admin
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="formsExamples">
            <ul class="nav">
              <li class="nav-item ">
                <a class="nav-link" href="../admin/register.php">
                  <span class="sidebar-mini"> RA </span>
                  <span class="sidebar-normal"> Register Admin </span>
                </a>
              </li>

            </ul>
          </div>
        </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
              <i class="material-icons">apps</i>
              <p> Add Category Item
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="componentsExamples">
              <ul class="nav">

                <li class="nav-item ">
                  <a class="nav-link" href="../admin/category.php">
                    <span class="sidebar-mini"> CI </span>
                    <span class="sidebar-normal"> Category </span>
                  </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="../admin/subcategory.php">
                    <span class="sidebar-mini"> SCI </span>
                    <span class="sidebar-normal"> Subcategory </span>
                  </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="../admin/product.php">
                    <span class="sidebar-mini"> PD </span>
                    <span class="sidebar-normal"> Product </span>
                  </a>
                </li>

              </ul>
              <ul class="nav">



              </ul>
            </div>

          </li>

          

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#mapsExamples">

              <i class="material-icons">content_paste</i>
              <p> View Categories
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="mapsExamples">
              <ul class="nav">
               <li class="nav-item ">
                <a class="nav-link" href="../admin/view_category.php">
                  <span class="sidebar-mini"> VC </span>
                  <span class="sidebar-normal"> View Category </span>
                </a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="../admin/view_subcategory.php">
                  <span class="sidebar-mini"> VSC </span>
                  <span class="sidebar-normal"> View Subcategory </span>
                </a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="../admin/view_product.php">
                  <span class="sidebar-mini"> VP </span>
                  <span class="sidebar-normal"> View Product </span>
                </a>
              </li>

            </ul>
          </div>
        </li>

      
        <li class="nav-item ">
          <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
            <i class="material-icons">widgets</i>
            <p> Blogs
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="tablesExamples">
            <ul class="nav">

              <li class="nav-item ">
                <a class="nav-link" href="add_blog.php">
                  <span class="sidebar-mini"> AB </span>
                  <span class="sidebar-normal"> Add Blog </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="view_blog.php">
                  <span class="sidebar-mini"> VB </span>
                  <span class="sidebar-normal"> View Blogs </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="blog_comment.php">
                  <span class="sidebar-mini"> VBC </span>
                  <span class="sidebar-normal"> View Blog Comments </span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item ">
          <a class="nav-link" data-toggle="collapse" href="#tables1Examples">
            <i class="fa fa-shopping-cart"></i>
            <p> Cart Table
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="tables1Examples">
            <ul class="nav">

              <li class="nav-item ">
                <a class="nav-link" href="../admin/cart.php">
                  <span class="sidebar-mini"> CT </span>
                  <span class="sidebar-normal"> Cart Table </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      

        <li class="nav-item ">
          <a class="nav-link" data-toggle="collapse" href="#tables2Examples">
           <i class="fa fa-ticket"></i>
           <p> Order Master
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="tables2Examples">
          <ul class="nav">


            <li class="nav-item ">
              <a class="nav-link" href="view_notconfirm_order.php">
                <span class="sidebar-mini"> NCO </span>
                <span class="sidebar-normal"> Not Comfirm Order </span>
              </a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="view_delivered_order.php">
                <span class="sidebar-mini"> DO </span>
                <span class="sidebar-normal"> Delivered Order </span>
              </a>
            </li>


            <li class="nav-item ">
              <a class="nav-link" href="view_cancelled_order.php">
                <span class="sidebar-mini"> CO </span>
                <span class="sidebar-normal"> Cancelled Order </span>
              </a>
            </li>
            
            <li class="nav-item ">
              <a class="nav-link" href="order_master.php">
                <span class="sidebar-mini"> AO </span>
                <span class="sidebar-normal"> All Order </span>
              </a>
            </li>

          </ul>
        </div>
      </li>

      

      <li class="nav-item">
        <a class="nav-link" href="../admin/payment_table.php">
          <i class="fa fa-credit-card"></i>
          <p> Payment </p>
        </a>
      </li>

        <li class="nav-item ">
          <a class="nav-link" data-toggle="collapse" href="#tables3Examples">
            <i class="fa fa-table"></i>
            <p> Table Booking
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="tables3Examples">
            <ul class="nav">

              <li class="nav-item ">
                <a class="nav-link" href="../admin/booking_table.php">
                  <span class="sidebar-mini"> TB </span>
                  <span class="sidebar-normal"> Table Booking </span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      <li class="nav-item">
        <a class="nav-link" href="view_wishlist.php">
          <i class="fa fa-heart"></i>
          <p> Wishlist </p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="view_promocode.php">
          <i class="fa fa-gift"></i>
          <p> Promocodes </p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="give_promocode.php">
          <i class="fa fa-gift"></i>
          <p> Give Promocode Offer </p>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="view_review.php">
          <i class="fa fa-star"></i>
          <p> Reviews </p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../admin/users.php">
          <i class="fa fa-user"></i>
          <p> Users </p>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="main-panel">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
          </button>
        </div>
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p class="d-lg-none d-md-block">
                Stats
              </p>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="notification"><?php echo $num1+$num2; ?></span>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
              <div class="ripple-container"></div></a>
              <div class="dropdown-menu dropdown-menu-right ps" aria-labelledby="navbarDropdownMenuLink">

                <?php if($num1!=0) { while($order = mysqli_fetch_array($qu1)) { ?>
                  <a class="dropdown-item" href="view_order.php?order_id=<?php echo $order['order_id']; ?>"><i class="fa fa-envelope">&nbsp;&nbsp;<b>#<?php echo $order['order_id']; ?></b> Order Received from <b><?php echo $order['name']; ?></b> </i></a><?php }} if($num2!=0) { while($booking = mysqli_fetch_array($qu2)) { ?><a class="dropdown-item" href="response_table_booking.php?book_table_id=<?php echo $booking['book_table_id']; ?>"><i class="fa fa-bell"></i>&nbsp;&nbsp;<b>#<?php echo $booking['book_table_id']; ?></b>&nbsp; Table Booking Requested from&nbsp;<b><?php echo $booking['name']; ?></b> </a><?php }} elseif($num1==0 && $num2==0) { ?><a class="dropdown-item" href="#"><i class="fa fa-bell"></i>&nbsp;&nbsp;You have no new notification* </a><?php } ?>
                  <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                      Account
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="change_password.php"><i class="fa fa-edit"></i>&nbsp;&nbsp;Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="lock.php"><i class="fa fa-lock"></i>&nbsp;&nbsp;Lock Screen</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log out</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
