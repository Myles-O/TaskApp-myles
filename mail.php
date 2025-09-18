<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'myles.otieno@strathmore.edu';   
    $mail->Password   = 'jqxq ozmn yqus ahck';     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;


    $mail->setFrom('myles.otieno@strathmore.edu', 'Task App');
    $mail->addAddress('mylesmark12@gmail.com', 'Myles Mark'); 

    
    $mail->isHTML(true);
    $mail->Subject = 'Welcome to BBIT';
    $mail->Body    = 'This is a new semester. <b>Let’s enjoy coding</b>';
    $mail->AltBody = 'This is a new semester. Let’s enjoy coding';

    $mail->send();
    echo "✅ Test email sent successfully";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}";
}
