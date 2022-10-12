<?php
session_start();
require_once("../db/config.php");
require_once("../const/uniques.php");
require_once('../const/web-info.php');

require_once("../const/mail.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/src/Exception.php';
require '../mail/src/PHPMailer.php';
require '../mail/src/SMTP.php';

if (isset($_POST['submit'])) {
$email = $_POST['email'];
$token = md5(get_rand_numbers(8));

$url = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']. explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$reset_link = str_replace("core/forgot-pw","reset-pw?token=$token",$url);

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE email = ?");
$stmt->execute([$email]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
$_SESSION['reply'] = array (array("danger","Account was not found"));
header("location:../forgot-password");
}else{

$stmt = $conn->prepare("DELETE from tbl_reset_tokens WHERE email = ?");
$stmt->execute([$email]);

$stmt = $conn->prepare("INSERT INTO tbl_reset_tokens (email, token) VALUES (?,?)");
$stmt->execute([$email, $token]);

$mail_msg = '<b>Click the link below to reset your password</b><br><a href="'.$reset_link.'">'.$reset_link.'</a>';


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
$mail->addAddress($email);

$mail->isHTML(true);

$mail->Subject = "Reset Password";
$mail->Body    = $mail_msg;
$mail->AltBody = $mail_msg;

if(!$mail->send()) {
  $me = 'Mailer Error: ' . $mail->ErrorInfo;
  $_SESSION['reply'] = array (array("danger","$me"));
  header("location:../forgot-password");
} else {
  $_SESSION['reply'] = array (array("success","Check $email"));
  header("location:../forgot-password");
}

}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
