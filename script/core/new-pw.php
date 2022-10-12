<?php
session_start();
require_once("../db/config.php");
require_once("../const/uniques.php");
require_once('../const/web-info.php');

if (isset($_POST['submit'])) {

if (!empty($_SESSION['reset_start'])) {
  $new_pw = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
  $email = $_SESSION['reset_email'];

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("UPDATE tbl_admin SET secret = ?");
  $stmt->execute([$new_pw]);
  unset($_SESSION['reset_start']);
  unset($_SESSION['reset_email']);

  $stmt = $conn->prepare("DELETE from tbl_reset_tokens WHERE email = ?");
  $stmt->execute([$email]);
  
  $_SESSION['reply'] = array (array("success","Password updated successfully"));
  header("location:../login");

  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }

}else{
  header("location:../");
}

}else{
header("location:../");
}

?>
