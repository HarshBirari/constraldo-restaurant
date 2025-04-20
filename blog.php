<?php 

  include('header.php'); 

?>

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
              <h1 class="mb-3 mt-5 bread">Our Blog</h1>
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Our Blog</span></p>
            </div>

          </div>
        </div>
      </div>
     <div class="slider-item" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
              <h1 class="mb-3 mt-5 bread">Our Blog</h1>
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Our Blog</span></p>
            </div>

          </div>
        </div>
      </div>

    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
          <?php

          if(isset($_GET['page']))
          {
            $page = $_GET['page'];
          }
          else
          {
            $page = 0;
          }

          $per_page = 6;
          $page = $page * $per_page;

          $sel2 = "select * from blog";
          $qu2 = mysqli_query($con,$sel2);
          $number = mysqli_num_rows($qu2);
          $number1 = ceil($number/$per_page);

          $sel = "select * from blog limit $page,$per_page";
          $qu = mysqli_query($con,$sel);


          while($que = mysqli_fetch_array($qu)) {  $blog_id = $que['blog_id']; ?>

          <?php $sel1 = "select * from blog JOIN blog_comment ON blog_comment.blog_id = blog.blog_id where blog_comment.`blog_id` = '$blog_id'";
            $qu1 = mysqli_query($con,$sel1);
            $num = mysqli_num_rows($qu1); ?>
        <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog_single.php?blog_id=<?php echo $que['blog_id']; ?>" class="block-20" style="background-image: url(admin/image/blog/<?php echo $que['image']; ?>);">
              </a>
              <div class="text py-4 d-block">
                <div class="meta">
                  <div><a href="#"><?php echo $que['created_at']; ?></a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo $num; ?></a></div>
                </div>
                <h3 class="heading mt-2"><a href="blog_single.php?blog_id=<?php echo $que['blog_id']; ?>"><?php echo $que['blog_name']; ?></a></h3>
                <p><?php echo $que['blog_header']; ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
       
        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <?php for($i=0;$i<$number1;$i++) { ?>
                <li><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                <?php } ?>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php include('footer.php'); ?>