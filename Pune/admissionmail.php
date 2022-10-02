<?php
require("PHPMailerAutoload.php");

    $name = $_POST['name'];

    $datepicker = $_POST['datepicker'];

    $grade = $_POST['grade'];

    $fname = $_POST['fname'];
    
    $fqauli = $_POST['fqauli'];

    $foccup = $_POST['foccup'];

    $mname = $_POST['mname'];

    $mqauli = $_POST['mqauli'];

    $moccup = $_POST['moccup'];

    $sibinfo = $_POST['sibinfo'];

    $con1 = $_POST['con1'];

    $con2 = $_POST['con2'];

    $pemail1 = $_POST['pemail1'];

    $pemail2 = $_POST['pemail2'];

    $cs = $_POST['cs'];

    $gp = $_POST['gp'];

    $cadd = $_POST['cadd'];

    $city = $_POST['city'];

    $state = $_POST['state'];

    $country = $_POST['country'];

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

$mail->Subject = "Chatrabhuj Narsee School - Admission Form";
$mail->Body = "

Name of the Child: $name <br>

Birth Date: $datepicker <br>

Grade in Which applicant wants admission: $grade <br>

Father's Name: $fname <br>
    
Father's Qualification: $fqauli <br>

Father's Occupation: $foccup <br>

Mother's Name: $mname <br>

Mother's Qualification: $mqauli <br>

Mother's Occupation: $moccup <br>

Sibling Information: $sibinfo <br>

Contact No 1: $con1 <br>

Contact No 2: $con2 <br>

Parent's Email id 1: $pemail1 <br>

Parent's Email id 2: $pemail2 <br>

Current School: $cs <br>

Grade in which child is studying Presently: $gp <br>

Current Address: $cadd <br>

City: $city <br>

State: $state <br>

Country: $country <br>

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