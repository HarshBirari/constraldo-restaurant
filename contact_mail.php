<?php
require 'PHPMailer/PHPMailerAutoload.php';

session_start();

 $email = 'rohanradadiya02@gmail.com';
 $name = $_SESSION['name'];
 $sub_email = $_SESSION['email'];
 $subject = $_SESSION['subject'];
 $msg = $_SESSION['msg'];

$mail = new PHPMailer;
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rohanradadiya02@gmail.com';          // SMTP username
$mail->Password = 'mxxeooqbjztaorbu'; 						   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to
$mail->setFrom($email, 'Costraldo shop');
$mail->addReplyTo($email, 'Costraldo shop');
$mail->addAddress($email);   
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = "<h1>HI <b>$name</b></h1>";
$bodyContent .= "<p>$msg</p>";
$bodyContent .= "<p>Contact you as $sub_email</p>";

$mail->Subject = $subject;
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:contact_us.php");
}
?>