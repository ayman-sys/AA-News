<?php
session_start();
require_once("../../db/config.php");
require_once("../../const/web-info.php");
require_once("../../const/mail.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../mail/src/Exception.php';
require '../../mail/src/PHPMailer.php';
require '../../mail/src/SMTP.php';

$name = ucwords($_GET['name']);
$email = $_GET['email'];
$subject = ucwords($_GET['subject']);
$message = $_GET['message'];
$mail_message = '<div style="font-family:segoe ui;"><p style="font-family:segoe ui;">'.$message.'<br><hr><b>Sender Information</b><br>Name : '.$name.'<br>Email : '.$email.'</p></div>';

$mail = new PHPMailer;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->isSMTP();
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Host = $smtp_server;
$mail->SMTPAuth = true;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->SMTPSecure = $smtp_conn_type;
$mail->Port = $smtp_conn_port;

$mail->setFrom($smtp_username, WBName);
$mail->addAddress(WBEmail);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body    = $mail_message;
$mail->AltBody = $mail_message;

if(!$mail->send()) {
print '
<div class="alert alert-danger closeable">
Mailer Error: ' . $mail->ErrorInfo.';
</div>
';
} else {
print '
<div class="alert alert-success closeable">
Your message was sent.
</div>
';
}

?>
