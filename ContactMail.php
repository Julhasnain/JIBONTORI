<?php
if(isset($_POST['submit']))
{

$message=
'Full Name:	'.$_POST['name'].'<br />
Subject:	'.$_POST['subject'].'<br />
Phone:	'.$_POST['phone'].'<br />
Email:	'.$_POST['email'].'<br />
Comments:	'.$_POST['messages'].'
';
    require "phpmailer/class.phpmailer.php"; //include phpmailer class

    // Instantiate Class
    $mail = new PHPMailer();

    // Set up SMTP
    $mail->IsSMTP();                // Sets up a SMTP connection
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization
    $mail->SMTPSecure = "ssl";      // Connect using a TLS connection
    $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
    $mail->Port = 465;  //Gmail SMTP port
    $mail->Encoding = '7bit';

    // Authentication
    $mail->Username   = "jibontori768@gmail.com"; // Your full Gmail address
    $mail->Password   = "jibontori2017"; // Your Gmail password

    // Compose
    $mail->SetFrom($_POST['email'], $_POST['name']);
    $mail->AddReplyTo($_POST['email'], $_POST['name']);
    $mail->Subject = "New contact from Website";      // Subject (which isn't required)
    $mail->MsgHTML($message);

    // Send To
    $mail->AddAddress("jibontori768@gmail.com", "Recipient Name"); // Where to send it - Recipient
    $result = $mail->Send();		// Send!
	$message = $result ? "<div class='alert alert-success'> Successfully Sent!!</div>" : "<div class='alert alert-success'>Sending Failed!!</div>";
	unset($mail);

}
?>
