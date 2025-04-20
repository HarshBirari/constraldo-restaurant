<?php 
  ob_start();
  include('header.php'); 

  if(isset($_GET['blog_id']))
  {
    $blog_id = $_GET['blog_id'];
    $select = "select * from blog where `blog_id` = '$blog_id'";
    $qu = mysqli_query($con,$select);
    $que = mysqli_fetch_array($qu);
  }
  else
  {
    header('location:index.php');
  }

              if(isset($_POST['submit']))
              {
                $blog_id = $_POST['blog_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                $sel3 = "select * from blog_comment where `email` = '$email' AND `blog_id` ='$blog_id'";
                $qu3 = mysqli_query($con,$sel3);
                $num1 = mysqli_num_rows($qu3);

                if($num1!=0)
                {
                  $msg = "You had already gave comment to us";
                }
                else
                {
                  $insert_cmt = "insert into blog_comment (`blog_id`,`name`,`email`,`message`) values ('$blog_id','$name','$email','$message')";
                }

                @$cmt_fire = mysqli_query($con,$insert_cmt);
                if(@$cmt_fire)
                {
                  $msg = "Comment added successfully";
                }
  }

          

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Blog Details</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="blog.php">Blog</a></span> <span>Blog Single</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <h2 class="mb-3"><?php echo $que['blog_name']; ?></h2>
            <h5><?php echo $que['blog_header']; ?></h5>
            <br>
            <p>
              <img src="admin/image/blog/<?php echo $que['image']; ?>" alt="" class="img-fluid">
            </p><br>
            <p><?php echo $que['blog_desc']; ?></p>
          
            <div>
                <br><br><br><br>              
            </div>
            
            <div class="about-author d-flex">
              <div class="bio align-self-md-center mr-5">
                <img width="500px" src="admin/image/blog/<?php echo $que['chef_image']; ?>" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3><?php echo $que['chef_name']; ?></h3>
                <p><?php echo $que['chef_desc']; ?></p>
              </div>
            </div>

            <?php $sel_cmt = "select * from blog_comment where `blog_id` = '$blog_id'";
            $fire_cmt = mysqli_query($con,$sel_cmt); 
            $cmt_num = mysqli_num_rows($fire_cmt);
            ?>

            <div class="pt-5 mt-5">
              <h3 class="mb-5"><?php echo $cmt_num; ?> Comments</h3>
              <ul class="comment-list">
                  <?php while($fetch_cmt = mysqli_fetch_array($fire_cmt)) { ?>
                  <div class="comment-body">
                    <h3><?php echo $fetch_cmt['name']; ?></h3>
                    <div class="meta"><?php echo $fetch_cmt['created_at']; ?></div>
                    <p><?php echo $fetch_cmt['message']; ?></p>
                   
                  </div>
                <?php } ?>
              </ul>
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form method="post">
                  <?php if(isset($msg)) { ?>
                    <div class="alert alert-success"><?php echo $msg; ?></div>
                  <?php } ?>
                  <div class="form-group">
                    <input type="hidden" name="blog_id" value="<?php echo $que['blog_id']; ?>">
                    <label for="name">Name *</label>
                    <input type="text" name="name" value="<?php echo @$_SESSION['users']['name']; ?>" placeholder="<?php echo @$_SESSION['users']['name']; ?>"  class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" placeholder="<?php echo @$_SESSION['users']['email']; ?>" value="<?php echo @$_SESSION['users']['email']; ?>" class="form-control" id="email">
                  </div>
               
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                	<div class="icon">
	                  <span class="icon-search"></span>
                  </div>
                    <input type="text" class="form-control" id="category" onkeyup="return choose_category()" name="category" placeholder="Search...">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories" id="category_echo">
                <h3>Categories</h3>
                 <?php 
                $cat_sel = "select * from category";
                $cat_fire = mysqli_query($con,$cat_sel);

                $cat_num_rows = mysqli_num_rows($cat_fire);

                while($cat_fetch_data = mysqli_fetch_array($cat_fire)) { ?>
                      
                  <?php 
                         $cat_id = $cat_fetch_data['cat_id'];
                         $sub_sel = "select * from subcategory where `cat_id` = '$cat_id'";
                         $sub_fire = mysqli_query($con,$sub_sel);
                         $sub_num_rows = mysqli_num_rows($sub_fire);

                   ?>
                <li><a href="shop.php" ><?php echo $cat_fetch_data['category_name']; ?><span><?php echo $sub_num_rows; ?></span></a></li>
              <?php } ?>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <?php $sel2 = "select * from blog ORDER BY blog_id DESC limit 6";
          $qu2 = mysqli_query($con,$sel2); 
          while($que2 = mysqli_fetch_array($qu2)) {  ?>
         
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(admin/image/blog/<?php echo $que2['image']; ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="blog_single.php?blog_id=<?php echo $que2['blog_id']; ?>"><?php echo $que2['blog_header']; ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> <?php echo $que2['created_at']; ?></a></div>
                    <div><a href="contact_us.php"><span class="icon-person"></span> Admin</a></div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>

       

            <div class="sidebar-box ftco-animate">
             <h3>Our Quotes</h3>
              <p>“Eating at fast food outlets and other restaurants is simply a manifestation of the commodification of time coupled with the relatively low value many Americans have placed on the food they eat.“</div>
            </div>
          </div>

        </div>
      </div>
    </section> <!-- .section -->
   <?php include('footer.php'); ?>

   <script type="text/javascript">
      
    function choose_category()
    {
      var search = $('#category').val();

        $.ajax({
        url : "search_category.php",
        type :"post",
        data :
        {
          'search' : search,
          'search_record' : 'search_record'
        },
        success :function(sear)
        {
          // alert(sear);
          $('#category_echo').html(sear);
        }
      });
    }


   </script>