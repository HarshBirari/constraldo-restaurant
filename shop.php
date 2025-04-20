<?php include('header.php'); ?>

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(images/2.jpeg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Order Online</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
				</div>

			</div>
		</div>
	</div>
</section>


<section class="ftco-menu mb-5 pb-5">

	<div class="container">
		<div class="mt-1">
			<form style="margin-left: auto;width: 30%;">
				<div class="d-flex justify-content-end">
					<input type="text" id="serpro" onkeyup="return searchproduct()" name="search" placeholder="Type here to search" style="height: 54px;text-indent: 10px;color:#fff;background: transparent;border: 0;width: 75%;border: 1px solid #c49b63;">
					
				</div>

			</form>
		</div><br>
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="col-md-12 nav-link-wrap mb-5">
						<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<?php $sel = "select * from category where `cat_status` = 1"; 
							
							$qu = mysqli_query($con,$sel); 
							while($category = mysqli_fetch_array($qu)) { 
								$cat_id = $category['cat_id'];
								if($category['cat_id']!=2) {
									?>
									
									<a href="javascript:void(0)" class="nav-link" id="v-pills-1-tab" data-toggle="pill" role="tab" aria-controls="v-pills-1" aria-selected="false" onclick="return set_category(<?php echo $category['cat_id']; ?>)"><?php echo $category['category_name']; ?></a>
								<?php } } ?>

								
							</div>
						</div>

						<div class="col-md-12 d-flex align-items-center">
							
							<div class="tab-content ftco-animate w-100" id="v-pills-tabContent">

								<div class="tab-pane fade show active" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-0-tab">
									<div class="row" id="subcat">
										<?php 
										$sel = "select * from product JOIN subcategory ON subcategory.sub_id = product.sub_id where `product_status` = '1'";			
										$qu = mysqli_query($con,$sel); ?>
										<?php while($que = mysqli_fetch_array($qu)) { ?>
											<div class="col-md-3">
												<div class="menu-entry">
													<a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="img" style="background-image: url(admin/image/<?php echo $que['product_image']; ?>);"></a>
													<div class="text text-center pt-4">
														<h3><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>"><?php echo $que['subcategory_name']; ?></a></h3>
														<p style="height: 80px;overflow: hidden;"><?php echo $que['product_description']; ?></p>
														<p class="price"><span><i class="fa fa-rupee"> <?php echo $que['product_price']; ?>.00</i></span></p>
														<p><a href="single_product.php?p_id=<?php echo $que['p_id']; ?>" class="btn btn-primary btn-outline-primary">Show Product</a></p>
													</div>
												</div>	
											</div>
										<?php } ?>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include('footer.php'); ?>

	<script type="text/javascript">

		function set_category(cat_id)
		{
			$.ajax({
				url : "set_subcategory.php",
				type : "post",
				data :
				{
					'cat_id' : cat_id
				},
				success :function(sub)
				{
					$('#subcat').html(sub);
			}
		});
		}


		function searchproduct()
		{
			var ser= $('#serpro').val();

			$.ajax({
				url : "searchproduct.php",
				type : "post",
				data :
				{
					'search' : ser,
				},
				success :function(ser)
				{
					$('#subcat').html(ser);
			}
		});

		}

	</script>