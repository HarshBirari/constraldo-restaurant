<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

if(isset($_SESSION['users']['email']))
{
	$email = $_SESSION['users']['email'];
	$name = $_SESSION['users']['username'];

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

	$bodyContent = "<h1>Hi <b>$name</b>,</h1>";
	$bodyContent .= "<p>Thank you for recently requested to notify our product.</p>";
	$bodyContent .= "<p>We will definitely back our stock within a one week and will inform you.</p>";
	$bodyContent .= "<br>";
	$bodyContent .= "<p><b>Thanks,<b></p>";
	$bodyContent .= "<p>team</p>";

	$mail->Subject = 'Email From Costraldo Shop';
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    header("location:shop.php");
	 
	}
  }
else
{
	header('location:login.php');
}



?>