<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.mailgun.org';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'info@mail.apextreasure.com';
$mail->Password = 'dfddf585d9d446a49509f5b6b16a9d05-53c13666-fd9b0ab6';
$mail->setFrom('info@mail.apextreasure.com', 'apextreasure');
$mail->addAddress('syafiq@apextreasuresoftware.com', 'Receiver Name');
$mail->Subject = 'Testing PHPMailer';
//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
?>
