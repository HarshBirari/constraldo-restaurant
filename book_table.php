<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

if(isset($_SESSION['users']['user_id']))
{

	$email = $_SESSION['email'];
	$name = $_SESSION['users']['username'];
	$booking_table_id = $_SESSION['booking_table_id'];
	$message = $_SESSION['message'];
	$date =  $_SESSION['date'];
	$time = $_SESSION['time'];

	$mail = new PHPMailer;
	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'rohanradadiya02@gmail.com';          // SMTP username
	$mail->Password = 'mxxeooqbjztaorbu'; 						   // SMTP password
	$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                 // TCP port to connect to
	$mail->setFrom($email, 'Costraldo');
	$mail->addReplyTo($email, 'Costraldo shop');
	$mail->addAddress($email);   
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = "<h1>Hi.. <b>$name</b>,</h1>";
	$bodyContent .= "<p>You recently requested to booking for table.</p>";
	$bodyContent .= "<p>We Accepted your booking for event of <b>$message</b></p>";
	$bodyContent .= "<p>Your's Booking Date and time is :<b>$date</b> | <b>$time</b></p>";
	$bodyContent .= "<p>Your Booking id is : <b>$booking_table_id</b></p>";
	$bodyContent .= "<p><b>Thanks,<b></p>";
	$bodyContent .= "<p>team</p>";

	$mail->Subject = 'Booking table';
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    header("location:index.php");
	}
}
else
{
	header('location:login.php');
	$_SERVER['HTTP_REFERER'];
}
?>