<?php
require("PHPMailerAutoload.php");

$name = $_POST['name'];
$email = $_POST['email'];
$qauli = $_POST['qauli'];
$exp = $_POST['exp'];
$inputPost = $_POST['inputPost']; 
//$inputResume = $_FILES["inputResume"]["tmp_name"];//$_POST['inputResume'];   
$ipa = $_SERVER['REMOTE_ADDR'];
$file_name = $_FILES['inputResume']['name'];
$file_tmp = $_FILES['inputResume']['tmp_name'];
move_uploaded_file($file_tmp,"uploads/".$file_name);
$mail = new PHPMailer();

// $mail->IsSMTP();
// $mail->Host = "mail.domain.com";

// $mail->SMTPAuth = true;
// //$mail->SMTPSecure = "ssl";
// $mail->Port = 587;
// $mail->Username = "info@domain.com";
// $mail->Password = "12345678";jsuchitra4

$mail->setFrom($email, $name);
$mail->AddAddress("jsuchitra4@gmail.com");
$mail->AddReplyTo("$email");

$mail->IsHTML(true);

$mail->Subject = "Chatrabhuj Narsee School - Career Form";
$mail->Body = "
Name: $name <br>
Email: $email <br>
Qualification: $qauli <br>
Total Years of Experience: $exp <br>
Post Applied for: $inputPost <br>
Ip Adddress: $ipa <br>
";
$mail->AddAttachment("uploads/".$file_name);
$mail->Send();



$mail->ClearAllRecipients();
$mail->clearAttachments();
//$mail = new PHPMailer();
//
//$mail->setFrom($email, $name);
//
//$mail->IsHTML(true);
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