<?php

$codeinput= strtoupper($_POST['f_codein']);
$code= $_POST['f_code'];
$rand = pack ("H*", $code);

    $f_name = $_POST['name'];
    $f_email = $_POST['email'];
	 $f_phone = $_POST['phone'];
 	 $f_sub = $_POST['subject'];
    $f_comment = $_POST['message'];  
    $ErrorMessage = "Spam code mis-matched. Please try again.<br>"; 


    /* recipients */ $recipient = "akshay.khambe@gmail.com" ; //note the comma 
	
   

          
    $subject="Chatrabhuj Narsee School";
    $referers = array('www.pounamuapartments.co.nz','');
 //   $message .= $_POST['message']."\n";
    $message = "\n Your name    : " . $_POST['name'];
    $message .= "\n Your email address:   : " . $_POST['email'];
    $message .= "\n Your phone number:     : " . $_POST['phone'];
    $message .= "\n Your Subject: : " . $_POST['suject'];  

    $message .= "\n Your comments: : " . $_POST['message'];  
    $mail .= "\n " . $_POST['email']; 
    $headers .= "From: $mail  \n";


    /*$headers .= "cc : seo@staah.com,seo@staah.com\n"; */
    /*$headers .= "Bcc : gavin@staah.com, seo@staah.com\n"; */


    mail($recipient, $subject, $message, $headers);
		          /* Sending mal process end */
	

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script>
location.href="thanks.html";
</script>
<body>
</script> 
<script type="text/javascript">
_uacct = "UA-4995622-1";
urchinTracker();
</script>
<div align="center" style="position: absolute; z-index: -1; top: 20px; left: 855px; right:100px; width: 125px;" width="550" id="new zealand"> </div>
<div align="right" style="position:fixed; left:85%; top:50%; z-index:10000;"> <a href="https://secure.staah.com/common-cgi/properties/b2c/Reservations.pl?action=showpage&amp;MotelId=89" style="margin-right: 0 !important" class="simpleBTN orange normal  btn-87248"><img class="buttonicon" src="images/orangebooknow.png"></a> <a href="skype:pounamuonline?call"><img src="http://www.pounamuapartments.co.nz/images/call_blue_white_153x63.png" style="border: none;" width="153" height="63" alt="Skype Me�!" /></a> <br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.skype.com/go/download" target="_blank" style="color:#FFFF00; font-size:9px; ">Get Skype</a> <span style="color:#000; font-size:9px;">and Phone us for free</span> <br />
  <br/>
</div>
</body>
</html>
