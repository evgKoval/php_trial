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
$mail->Host       = 'smtp.gmail.com'; // SMTP сервера GMAIL
$mail->Username   = 'ekovalwork'; // Логин на почте
$mail->Password   = 'lovkacok123PRO'; // Пароль на почте
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('ekovalwork@gmail.com', 'Евгений Коваль'); // Адрес самой почты и имя отправителя
// Получатель письма
$mail->addAddress($email);

// -----------------------
// Само письмо
// -----------------------
$mail->isHTML(true);

$mail->Subject = 'Confirm the email';
$mail->Body    = "
	For confirm your email check this link:<br>
	http://blog.loc:8080/confirm?hash=$hash
";

if ($mail->send()) {
	header("Location: /login");
}