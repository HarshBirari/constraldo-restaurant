  <footer class="ftco-footer ftco-section img">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About Us</h2>
              <p>We are student of Tapi Diploma Engineering College.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a target="blank" href="https://twitter.com/harsh_birari"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a target="blank" href="https://www.facebook.com/people/Harsh-Birari/pfbid02JZciszD8nthfVjWf9cu8mqKGXgiyJVG7RHUfrMwWFJwKu4iZAkNJn3KCcCkgeiNQl/?mibextid=ZbWKwL"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a target="blank" href="https://www.instagram.com/insta.user2422/"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Recent Blog</h2>
              <?php $sel2 = "select * from blog ORDER BY blog_id DESC limit 2";
          $qu2 = mysqli_query($con,$sel2); 
          while($que2 = mysqli_fetch_array($qu2)) { $blog_id = $que2['blog_id']; ?>
            <?php $sel1 = "select * from blog JOIN blog_comment ON blog_comment.blog_id = blog.blog_id where blog_comment.`blog_id` = '$blog_id'";
            $qu1 = mysqli_query($con,$sel1);
            $num = mysqli_num_rows($qu1); ?> 
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(admin/image/blog/<?php echo $que2['image']; ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#"><?php echo $que2['blog_header']; ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> <?php echo $que2['created_at']; ?></a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> <?php echo $num; ?></a></div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 mb-5 mb-md-5">
             <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Services</h2>
              <ul class="list-unstyled">
                <li><a href="services.php" class="py-2 d-block">EASY TO ORDER</a></li>
                <li><a href="services.php" class="py-2 d-block">SECURE PAYMENT</a></li>
                <li><a href="services.php" class="py-2 d-block">FASTEST DELIVERY</a></li>
                <li><a href="services.php" class="py-2 d-block">MONEY BACK GUARANTEE</a></li>
                <li><a href="services.php" class="py-2 d-block">QUALITY COFFEE</a></li>
                <li><a href="services.php" class="py-2 d-block">ONLINE SUPPORT</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Categories</h2>
            	<div class="block-23 mb-3">
	              <ul>
	              
                  <li><a href="shop.php"><span class="icon icon-coffee"></span><span class="text">Coffee  </span></a></li>
                  <li><a href="shop.php"><span class="icon icon-cutlery"></span><span class="text">Main Food  </span></a></li>
                  <li><a href="shop.php"><span class="icon icon-birthday-cake"></span><span class="text">Desserts  </span></a></li>
	                <li><a href="shop.php"><span class="icon icon-glass"></span><span class="text">Drinks  </span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
     
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>