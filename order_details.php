<?php 

ob_start();
include('header.php'); 

if(isset($_GET['order_id']))
{
	$order_id = $_GET['order_id'];
	$sel = "select * from comfirm_order JOIN order_track ON order_track.order_id = comfirm_order.order_id where comfirm_order.`order_id` = '$order_id' AND comfirm_order.`order_status` = 'Confirm'";
	$qu = mysqli_query($con,$sel);
	$num = mysqli_num_rows($qu);

	if($num!=0)
	{
		$fetch = mysqli_fetch_array($qu);
		$p_id = $fetch['p_id'];
		$c_id = $fetch['city'];
		$s_id = $fetch['state'];

		$order_id = $_GET['order_id'];
	  	$sel4 = "select * from order_track where `order_id` = '$order_id'";
	  	$qu4 = mysqli_query($con,$sel4);

		$order_id = $_GET['order_id'];
		$sel2 = "select * from comfirm_order JOIN order_track ON order_track.order_id = comfirm_order.order_id where comfirm_order.`order_id` = '$order_id' AND comfirm_order.`order_status` = 'Confirm' ORDER BY track_id DESC LIMIT 1";
		$qu2 = mysqli_query($con,$sel2);
		$fetch2 = mysqli_fetch_array($qu2);

		$sel1 = "select * from product JOIN category ON category.cat_id = product.cat_id JOIN subcategory ON subcategory.sub_id = product.sub_id where product.p_id IN ($p_id)";
		$qu1 = mysqli_query($con,$sel1);
	}
	else
	{
		$msg = "Invalid Order id";
	}
}
else
{
	header('location:index.php');
}



?>


<?php if($num!=0) { ?>
<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(images/32.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">
				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Order Online</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Shop</span></p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ftco-menu mb-5 pb-5">
	<div class="container">
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="col-md-12 nav-link-wrap mb-5">
						<div class="col-md-6 mb-4">
								<h2 class="h4">Your orders delicious hot food!</h2>
							</div>
					</div>
					<div class="col-md-6 d-flex align-items-center">
						<div class="tab-content ftco-animate w-100" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-0-tab">
								<div class="row">

									<?php while($que1 = mysqli_fetch_array($qu1)) { ?>
										<div class="col-md-6">
											<div class="menu-entry">
												<a href="#" class="img" style="background-image: url(admin/image/<?php echo $que1['product_image']; ?>);"></a>
												<div class="text text-center pt-4">
													<h3><a href="product-single.html"><?php echo $que1['subcategory_name']; ?> <?php echo $que1['category_name']; ?></a></h3>
													<p style="height: 100px;overflow: hidden;"><?php echo $que1['product_description']; ?></p>
													<p class="price"><span><i class="fa fa-rupee"></i> <?php echo $que1['product_price']; ?></span></p>
													
												</div>
											</div>
										</div>


									<?php } ?>

								</div>
							</div>
							
						</div>
					</div>
					<div class="col-md-6 contact-info ftco-animate">
						<?php $sel2 = "select * from cities where `id`  ='$c_id'";
						$que2 = mysqli_query($con,$sel2);
						$city = mysqli_fetch_array($que2);

						$sel3 = "select * from states where `id`  ='$c_id'";
						$que3 = mysqli_query($con,$sel3);
						$state = mysqli_fetch_array($que3);

						 ?>
						<div class="row">
							<div class="col-md-6 mb-4">
								<h2 class="h4">Order #<?php echo $fetch['order_id']; ?> Details</h2>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">Order Date :</span> <?php echo $fetch['date']; ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">Address :</span> <?php echo $fetch['address']; ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">City :</span> <?php if(@$city) {echo $city['name'];} else { echo "No city found"; } ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">State :</span> <?php if(@$state) {echo $state['name'];} else { echo "No state found"; } ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">Phone :</span> +91 <?php echo $fetch['contact_no']; ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">Email :</span> <?php echo $fetch['email']; ?></p>
							</div>
							<div class="col-md-12 mb-6">
								<p><span style="color: #fff;">Total Payment :</span> <?php echo $fetch['payment']; ?>/-</p>
							</div>
							<?php if($fetch2['order_remarks']!="Food Delivered") { ?>
							<div class="col-md-12 mb-6">
								<p><a href="javascript:void(0)" onclick="return cancel_order(<?php echo $fetch['order_id']; ?>)" class="btn btn-primary btn-outline-primary">Cancel this order</a></p>
							</div>
						<?php } ?>
							<div class="col-md-12 mb-6">
                  			<a href="invoice/invoice_bill.php?order_id=<?php echo $fetch['order_id']; ?>" style="padding: 14px 50px;" name="submit" class="btn btn-primary">Invoice</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  			<?php if($fetch2['order_remarks']=="Waiting For Restaurant Confirmation...") { ?>
                  			<a href="#" style="color: red;"><?php echo $fetch2['order_remarks']; ?></a>
                  		<?php } else { ?>
                  			<a href="javascript:void(0)" onclick="return showtable()" style="padding: 14px 50px;" name="submit" class="btn btn-primary"><?php echo $fetch2['order_remarks']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  		<?php } ?>
							</div>
						</div><br>
						<?php 

						$created_at = $fetch2['created_at']; 
						$add_date = date('h:i A',strtotime('+30 minutes',strtotime($created_at)));
						
						 ?>
							<?php if($fetch2['order_remarks']!="Food Delivered") { ?>

						<div><h6 style="color: #fff;">	&#128666; Order within the next <b> 30 minutes </b> for fast dispatch. Estimated arrival by <?php echo $add_date ?>.</h6></div><?php } ?>
						<div>
							<table border="1px" id="table" style="border-color: #c49b63; display: none;" width="700px">
								<tr style="text-align: center;color: #c49b63;">
									<th colspan="4">Food Tracking History Of #<?php echo $fetch['order_id']; ?></th>
									
								</tr>
								<tr style="text-align: center;color: #ffffff;">
									<th>#</th>
									<th>Remark</th>
									<th>Time</th>
								</tr>
                <?php $i=1; while($record1 = mysqli_fetch_array($qu4)) { $time = explode(' ',$record1['updated_at']); ?>
								<tr style="text-align: center;">
									<td style="color: lightgreen;"><?php echo $i; ?></td>
									<td style="color: lightgreen;"><?php echo $record1['order_remarks']; ?></td>
									<td style="color:lightgreen;"><?php echo date('h:i:s A',strtotime($time[1])); ?></td>
								</tr>
							<?php $i++; } ?>
							</table>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
<?php } else { ?>

	<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">
				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Order Online</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Shop</span></p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="ftco-menu mb-5 pb-5">
	<div class="container">
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="col-md-12 nav-link-wrap mb-5">
						<div class="col-md-12  mb-4" style="text-align: center;">
								<h2 class="h4" style="color: red"><?php echo $msg; ?>&#128533;</h2>
						</div>
<br><br>
						<div class="col-md-12  mb-4" style="text-align: center;">
							<a href="track_order.php" style="padding: 14px 50px;" name="submit" class="btn btn-primary">Return Track Page</a>
						</div>

					</div>
				
				


				</div>
			</div>
		</div>
	</div>
</section>


<?php } ?>
<?php include('footer.php'); ?>

<script>
	
	function cancel_order(id)
	{
		var btn = confirm("Are you sure want to cancel order. ?");	

		if(btn==true)
		{
			$.ajax({
				url : "cancel_order.php",
				type :"post",
				data : {
					'order_id' : id
				},
				success:function(res)
				{
					alert(res);
					window.location = "index.php";
				}
			});
		}	
	}

	function showtable()
	{
		document.getElementById('table').style.display = "table";
	}

</script>