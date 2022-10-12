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
  $current_pw = $_POST['current_pw'];
  $new_pw = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT secret FROM tbl_admin");
  $stmt->execute();
  $result = $stmt->fetchAll();

  foreach($result as $row)
  {
    if (password_verify($current_pw, $row['secret'])) {
      $stmt = $conn->prepare("UPDATE tbl_admin SET secret = ?");
      $stmt->execute([$new_pw]);
      $_SESSION['reply'] = array (array("success","Password updated successfully"));
      header("location:../profile");
    }else{
      $_SESSION['reply'] = array (array("danger","Current password is not correct"));
      header("location:../profile");
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
