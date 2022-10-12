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

if ($avator == "default.png") {
header("location:../profile");
}else{
unlink("../../images/user/$avator");
}

$destn_file = "default.png";

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_admin SET first_name = ?, last_name = ?, email = ?, about = ?, avator = ?");
$stmt->execute([$fname, $lname, $email, $about, $destn_file]);
$_SESSION['reply'] = array (array("success","Profile updated successfully"));
header("location:../profile");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

?>
