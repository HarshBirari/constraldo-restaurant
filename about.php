<?php 

include('header.php');

$sel = "select * from about_us JOIN admin ON admin.id = about_us.admin_id";
$que = mysqli_query($con,$sel);
$record = mysqli_fetch_array($que);

?>

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(images/12.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">About Us</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>About</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-about d-md-flex">
	<div class="one-half img" style="background-image: url(images/22.jpg);"></div>
	<div class="one-half ftco-animate">
		<div class="overlap">
			<div class="heading-section ftco-animate ">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Our Story</h2>
			</div>
			<div>
				<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/23.jpg);"  data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Testimony</span>
				<h2 class="mb-4">Customers Says</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
	</div>
	<div class="container-wrap">
		<div class="row d-flex no-gutters">
			<?php   $odd_sel = "select * from review_by "; 
			$odd = mysqli_query($con,$odd_sel);

			while($odd_data = mysqli_fetch_array($odd)) {
				?>
				<div class="col-lg align-self-sm-end">
					<div class="testimony">
						<blockquote>
							<p>&ldquo;<?php echo $odd_data['msg']; ?>&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">

							<div style="color: #151111 !important;" class="name align-self-center"><?php echo $odd_data['name']; ?> <span style="color:#151111 !important;" class="position"><?php echo $odd_data['designation']; ?></span></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 pr-md-5">
				<div class="heading-section text-md-right ftco-animate">
					<span class="subheading">Discover</span>
					<h2 class="mb-4">Our Menu</h2>
					<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
					<p><a href="menu.php" class="btn btn-primary btn-outline-primary px-4 py-3">View Full Menu</a></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<div class="menu-entry">
							<a href="shop.php" class="img" style="background-image: url(admin/image/1085pexels-bich-tran-2362391.jpg);"></a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="menu-entry mt-lg-4">
							<a href="shop.php" class="img" style="background-image: url(admin/image/3741pexels-valeria-boltneva-580612.jpg);"></a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="menu-entry">
							<a href="shop.php" class="img" style="background-image: url(admin/image/8450pexels-thanachat-chantaramanee-887853.jpg);"></a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="menu-entry mt-lg-4">
							<a href="shop.php" class="img" style="background-image: url(admin/image/6708pexels-daria-obymaha-1691924.jpg);"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section contact-section">
	<div class="container mt-5">
		<div class="row block-9">
			<div class="col-md-4 contact-info ftco-animate">
				
			</div>
			<div class="col-md-4 contact-info ftco-animate">
				<div class="row">
					<div class="col-md-12 mb-3">
						<p><span>Name :</span> <?php echo $record['name']; ?></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Phone :</span>+91 <?php echo $record['contact_no']; ?></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Email :</span> <?php echo $record['email']; ?></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Country :</span> <?php echo $record['country']; ?></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Image :</span> <img src="admin/image/<?php echo $record['image']; ?>" width="150px;"></p>
					</div>

				</div>
			</div>
			<div class="col-md-1"></div>

		</div>
	</div>
</section>

<?php include('footer.php'); ?>