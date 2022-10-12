<?php
session_start();
require_once("../../db/config.php");
require_once("../../const/uniques.php");
require_once('../../const/web-info.php');
require_once('../../const/check_session.php');

require_once("../../const/mail.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../mail/src/Exception.php';
require '../../mail/src/PHPMailer.php';
require '../../mail/src/SMTP.php';

switch($res) {
case '0':
$_SESSION['reply'] = array (array("warning","You must login first"));
header("location:../../login");
break;

case '2':
$_SESSION['reply'] = array (array("warning","Invalid login session"));
header("location:../../login");
break;
}

if (isset($_POST['submit'])) {

$subject = ucwords($_POST['subject']);
$letter = $_POST['letter'];

$url = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']. explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$logo = WBLogo;
$img = str_replace("admin/core/send_letter","images/logos/$logo",$url);
$domain = str_replace("admin/core/send_letter","",$url);
// var_dump(file_get_contents($img));exit();
$whitelist = array(
  '127.0.0.1',
  'localhost',
  '::1'
);

if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
  $img = "data:".mime_content_type("../../images/logos/$logo").";base64,".base64_encode(file_get_contents($img));
}


try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_subscribers ORDER BY id");
$stmt->execute();
$result = $stmt->fetchAll();

if (count($result) > 0) {
foreach($result as $row){

  $sub_email = $row[1];
  $key = password_hash($row[0], PASSWORD_DEFAULT);
  $unsub_link = str_replace("admin/core/send_letter","core/unsub?key=$key&email=$sub_email",$url);

  $mail_msg = '<!doctype html>
  <html>
  <head>
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>'.WBName.' - Newsletter</title>
  <style>
  @media only screen and (max-width: 620px) {
  table[class=body] h1 {
  font-size: 28px !important;
  margin-bottom: 10px !important;
  }

  table[class=body] p,
  table[class=body] ul,
  table[class=body] ol,
  table[class=body] td,
  table[class=body] span,
  table[class=body] a {
  font-size: 16px !important;
  }

  table[class=body] .wrapper,
  table[class=body] .article {
  padding: 10px !important;
  }

  table[class=body] .content {
  padding: 0 !important;
  }

  table[class=body] .container {
  padding: 0 !important;
  width: 100% !important;
  }

  table[class=body] .main {
  border-left-width: 0 !important;
  border-radius: 0 !important;
  border-right-width: 0 !important;
  }

  table[class=body] .btn table {
  width: 100% !important;
  }

  table[class=body] .btn a {
  width: 100% !important;
  }

  table[class=body] .img-responsive {
  height: auto !important;
  max-width: 100% !important;
  width: auto !important;
  }
  }
  @media all {
  .ExternalClass {
  width: 100%;
  }

  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
  line-height: 100%;
  }

  .apple-link a {
  color: inherit !important;
  font-family: inherit !important;
  font-size: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
  text-decoration: none !important;
  }

  .btn-primary table td:hover {
  background-color: #502bf4 !important;
  }

  .btn-primary a:hover {
  background-color: #502bf4 !important;
  border-color: #502bf4 !important;
  }
  }
  </style></head>
  <body class style="background-color: #eaebed; font-family: verdana; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #eaebed; width: 100%;" width="100%" bgcolor="#eaebed">
  <tr>
  <td style="font-family: verdana; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
  <td class="container" style="font-family: verdana; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; Margin: 0 auto;" width="580" valign="top">
  <div class="header" style="padding: 20px 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
  <tr>
  <td class="align-center" style="font-family: verdana; font-size: 14px; vertical-align: top; text-align: center;" valign="top" align="center">
  <a href="'.$domain.'" style="color: #ec0867; text-decoration: underline;"><img src="'.$img.'" height="40" alt="'.WBName.'" style="border: none; -ms-interpolation-mode: bicubic; max-width: 100%;"></a>
  </td>
  </tr>
  </table>
  </div>
  <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

  <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

  <tr>
  <td class="wrapper" style="font-family: verdana; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
    <tr>
      <td style="font-family: verdana; font-size: 14px; vertical-align: top;" valign="top">
        <p style="font-family: verdana; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">'.$letter.'</p>
        <p style="font-family: verdana; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">'.$smtp_sender.'<br>'.WBName.'</p>
      </td>
    </tr>
  </table>
  </td>
  </tr>

  </table>


  <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
  <tr>
    <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
      <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">'.WBAddress.'</span>
      <br> Dont like these emails? <a href="'.$unsub_link.'" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
    </td>
  </tr>
  <tr>
  <td class="content-block powered-by" style="font-family: verdana; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
    Powered by <a href="'.$domain.'" style="color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;">'.WBName.'</a>.
  </td>
  </tr>
  </table>
  </div>
  </div>
  </td>
  <td style="font-family: verdana; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
  </tr>
  </table>
  </body>
  </html>';


  $mail = new PHPMailer;
  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );
  $mail->isSMTP();
  $mail->SMTPDebug  = 1;  
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Host = $smtp_server;
  $mail->SMTPAuth = true;
  $mail->Username = $smtp_username;
  $mail->Password = $smtp_password;
  $mail->SMTPSecure = $smtp_conn_type;
  $mail->Port = $smtp_conn_port;

  $mail->setFrom($smtp_username, WBName);
  $mail->addAddress($sub_email);

  $mail->isHTML(true);

  $mail->Subject = $subject;
  $mail->Body    = $mail_msg;
  $mail->AltBody = $mail_msg;

  if(!$mail->send()) {
    $me = 'Mailer Error: ' . $mail->ErrorInfo;
    $_SESSION['reply'] = array (array("danger","$me"));
    header("location:../newsletter");
  } else {
    $_SESSION['reply'] = array (array("success","Newsletter was sent successfully"));
    header("location:../newsletter");
  }

}

}else{

}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
