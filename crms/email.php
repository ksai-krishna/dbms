<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
$html = "<h1>Hello </h1>";
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                          
    $mail->Host       = 'smtp.titan.email'; 
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'user@crimeportal.com';               
    $mail->Password   = 'password';                           
    $mail->SMTPSecure = 'ssl';                                  
    $mail->Port       = 465;                                  

    //Recipients
    $mail->setFrom('contact@domain.com', 'domain Team');
    $mail->addAddress('receiver1@gmail.com', 'Joe User');    
    $mail->addAddress('receiver2@gmail.com', 'Joe User');    
    // Attachments
    // Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $html;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo true;

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}