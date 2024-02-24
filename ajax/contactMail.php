<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function ContactMail($email, $sub, $message) {
    require("phpmailer/Exception.php");
    require("phpmailer/PHPMailer.php");
    require("phpmailer/SMTP.php");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'quickcarhire.india@gmail.com';                     //SMTP username   quickcarhire.india@gmail.com
        $mail->Password = 'zltmzgqhqqedughi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = phpmailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('quickcarhire.india@gmail.com', $sub);
        $mail->addAddress('quickcarhire.india@gmail.com');     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $sub;
        $mail->Body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div
    style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href
               style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                Quick Car Hire</a>
        </div>
    <p style="font-size:1.1em">Hi,</p>
           Email :
         <b><pre> ' . $email . '</pre></b>
         <br/>
         message :
         <b><pre> ' . $message . '</pre></b>
        <p style="font-size:0.9em;">Regards,<br />Quick Car Hire</p>
        <hr style="border:none;border-top:1px solid #eee" />
        <div
            style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Quick Car Hire Inc</p>
        </div>
    </div>
</div>
</body>
</html>';

        $mail->send();
    } catch (Exception $e) {
        echo "<script> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
