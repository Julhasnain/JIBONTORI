<?php
if (isset($_POST['submit'])) {

    $message =
        'Full Name:	' . $_POST['name'] . '<br />
Subject:	' . $_POST['subject'] . '<br />
Phone:	' . $_POST['phone'] . '<br />
Email:	' . $_POST['emailid'] . '<br />
Comments:	' . $_POST['comments'] . '
';
    require "class.phpmailer.php"; //include phpmailer class

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
    $mail->Username = "mohammedjulhasnain@gmail.com"; // Your full Gmail address
    $mail->Password = "nian949504"; // Your Gmail password

    // Compose
    $mail->SetFrom($_POST['emailid'], $_POST['name']);
    $mail->AddReplyTo($_POST['emailid'], $_POST['name']);
    $mail->Subject = "New Contact Form Enquiry";      // Subject (which isn't required)  
    $mail->MsgHTML($message);

    // Send To  
    $mail->AddAddress("mohammedjulhasnain@gmail.com", "Recipient Name"); // Where to send it - Recipient
    $result = $mail->Send();        // Send!
    $message = $result ? 'Successfully Sent!' : 'Sending Failed!';
    unset($mail);

}
?>