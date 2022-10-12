<?php
session_start();
require_once("../../db/config.php");
require_once("../../const/uniques.php");
require_once('../../const/web-info.php');
require_once('../../const/check_session.php');

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

  $network = $_POST['network'];
  $link = $_POST['link'];
  switch($network) {
    case 'Behance';
    $icon = "fa fa-behance";
    break;

    case 'Facebook';
    $icon = "fa fa-facebook";
    break;

    case 'Github';
    $icon = "fa fa-github";
    break;

    case 'Instagram';
    $icon = "fa fa-instagram";
    break;

    case 'Linked In';
    $icon = "fa fa-linkedin";
    break;

    case 'Pinterest';
    $icon = "fa fa-pinterest";
    break;

    case 'Reddit';
    $icon = "fa fa-reddit";
    break;

    case 'Skype';
    $icon = "fa fa-skype";
    break;

    case 'Stack Over Flow';
    $icon = "fa fa-stack-overflow";
    break;

    case 'Twitter';
    $icon = "fa fa-twitter";
    break;

    case 'Vimeo';
    $icon = "fa fa-vimeo";
    break;

    case 'WhatsApp';
    $icon = "fa fa-whatsapp";
    break;

    case 'Youtube';
    $icon = "fa fa-youtube";
    break;


  }

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM tbl_social_links WHERE social_network = ?");
  $stmt->execute([$network]);
  $result = $stmt->fetchAll();

  if (count($result) > 0) {
  $_SESSION['reply'] = array (array("danger","Social profile is not available"));
  header("location:../profile");
  }else{
  $stmt = $conn->prepare("INSERT INTO tbl_social_links (social_network, profile_link, icon) VALUES (?,?,?)");
  $stmt->execute([$network, $link, $icon]);
  $_SESSION['reply'] = array (array("success","Social profile created successfully"));
  header("location:../profile");
  }


  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }

}else{
  header("location:../");
}



?>
