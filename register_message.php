<?php
require 'PHPMailer/PHPMailerAutoload.php';
include('admin/db.php');

session_start();

$email = $_SESSION['email_register'];

$mail = new PHPMailer;
	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'rohanradadiya02@gmail.com';          // SMTP username
	$mail->Password = 'zzqgerwoqmyugbhu'; 						   // SMTP password
	$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                 // TCP port to connect to
	$mail->setFrom($email, 'Costraldo');
	$mail->addReplyTo($email, 'Costraldo shop');
	$mail->addAddress($email);   

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = "<h1>Thanks for signing up,</h1>";
	$bodyContent .= "<p>We'll keep you on latest website. product updates, news and special offers for you.</p>";
	$bodyContent .= "<br>";
	$bodyContent .= "<p><b>Thanks,<b></p>";
	$bodyContent .= "<p>Costraldo Shop</p>";

	$mail->Subject = 'Email From Costraldo Shop';
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$sel = "select * from users ORDER BY user_id DESC limit 1";
		$que = mysqli_query($con,$sel);
		$fetch = mysqli_fetch_array($que);

		$user_id = $fetch['user_id'];
		$coupon_code = "BMBCA05";
		$promocode_make = "insert into coupon (`username`,`coupon_code`) values ('$user_id','$coupon_code')";
		$que1 = mysqli_query($con,$promocode_make);

		$sel_festival_offer = "select * from festival_offer";
		$qu_festival = mysqli_query($con,$sel_festival_offer);

		while($fetch_festival = mysqli_fetch_array($qu_festival))
		{
			$coupon_code = $fetch_festival['promocode'];
			$sel = "insert into coupon (`username`,`coupon_code`,`festival`) values ('$user_id','$coupon_code','yes')";
			mysqli_query($con,$sel);
		}

		$_SESSION['users'] = $fetch;
		header('location:index.php');

	}




	?>