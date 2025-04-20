<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

 $order_id = $_SESSION['order_id'];
 $username = $_SESSION['users']['name'];
 $email = $_SESSION['users']['email'];
 $payment = $_SESSION['final_price'];

 $random=rand(100000,999999);
 $_SESSION['random_no'] =$random;

$mail = new PHPMailer;
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'chandan.bhalala@gmail.com';          // SMTP username
$mail->Password = 'Chandan@2699'; 						   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to
$mail->setFrom($email, 'costraldo shop');
$mail->addReplyTo($email, 'costraldo shop');
$mail->addAddress($email);   
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = "<h1>HI, <b>$username</b>,</h1>";
$bodyContent .= "<p>Thank you for using the our website for shopping!</p>";
$bodyContent .= "<p>We have successfully Processed your payment of <b>$payment/-</b> of order no. is <b>$order_id</b>.</p>";
$bodyContent .= "<br>";
$bodyContent .= "<p>You can get product maximum 1 hours.</p>";
$bodyContent .= "<p>if you any further questions please contact us on <b>9998012456</b>.</p>";
$bodyContent .= "<p><b>Thanks,<b></p>";
$bodyContent .= "<p>Chandan Bhalala</p>";

$mail->Subject = 'Email From Costraldo Shop';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:index.php");
    // echo "sent";
 
}
?>