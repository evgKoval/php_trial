<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';


$name = $_POST['firstname'];
$email = $_POST['email'];
$mail = new PHPMailer\PHPMailer\PHPMailer();


$msg = "ok";
$mail->isSMTP();   
$mail->CharSet = "UTF-8";                                          
$mail->SMTPAuth   = true;
// Настройки вашей почты
$mail->Host       = 'smtp.gmail.com';
$mail->Username   = 'ekovalwork';
$mail->Password   = 'lovkacok123PRO';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('ekovalwork@gmail.com', 'Евгений Коваль');

$mail->addAddress($email);


$mail->isHTML(true);

$mail->Subject = 'Confirm the email';
$mail->Body    = "
    For confirm your email check this link:<br>
    http://blog.loc:8080/confirm?hash=$hash
";

if ($mail->send()) {
    header("Location: /login");
}