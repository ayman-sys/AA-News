<?php
session_start();
require_once("../db/config.php");
require_once("../const/uniques.php");
require_once('../const/web-info.php');

if (isset($_POST['submit'])) {
$email = $_POST['email'];
$secret = $_POST['password'];

if (!empty($_POST['remember'])) {
  $cookie_length = "20160";
}else{
  $cookie_length = "1440";
}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE email = ?");
$stmt->execute([$email]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
$_SESSION['reply'] = array (array("danger","Invalid login details"));
header("location:../login");
}else{

foreach($result as $row)
{
$account_id = $row[0];
$session_id = md5(get_rand_numbers(12));
$ip =  $_SERVER['REMOTE_ADDR'];
if ($row[9] == "0") {
$_SESSION['reply'] = array (array("warning","Your access have been revooked"));
header("location:../login");
}else{
if (password_verify($secret, $row[5])) {

$stmt = $conn->prepare("DELETE FROM tbl_login_sessions WHERE account_id = ?");
$stmt->execute([$account_id]);

$stmt = $conn->prepare("INSERT INTO tbl_login_sessions (sessi_id, ip_address, account_id) VALUES (?,?,?)");
$stmt->execute([$session_id, $ip, $account_id]);

setcookie("__news247__logged", "1", time() + (60 * $cookie_length), "/");
setcookie("__news247__key", "$session_id", time() + (60 * $cookie_length), "/");

header("location:../admin");

}else{
$_SESSION['reply'] = array (array("danger","Invalid login details"));
header("location:../login");
}
}
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
