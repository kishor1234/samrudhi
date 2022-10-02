<?php
require("PHPMailerAutoload.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];  
$ipa = $_SERVER['REMOTE_ADDR'];


$mail = new PHPMailer();

// $mail->IsSMTP();
// $mail->Host = "mail.domain.com";

// $mail->SMTPAuth = true;
// //$mail->SMTPSecure = "ssl";
// $mail->Port = 587;
// $mail->Username = "info@domain.com";
// $mail->Password = "12345678";

$mail->setFrom($email, $name);
$mail->AddAddress("contactus@cns.ac.in");
$mail->AddAddress("it.coordinator@cns.ac.in");
$mail->AddReplyTo("$email");

$mail->IsHTML(true);

$mail->Subject = "Chatrabhuj Narsee School - Contact Form";
$mail->Body = "
Name: $name <br>
Email: $email <br>
Phone: $phone <br>
Subject: $subject <br>
Message: $message <br>
Ip Adddress: $ipa <br>
";
$mail->Send();

$mail->ClearAllRecipients();

$mail->Subject = "Thank You - Chatrabhuj Narsee School";
$mail->Body = "Thank You for contacting Chatrabhuj Narsee School";

$mail->AddAddress("$email");




//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

?>