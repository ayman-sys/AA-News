<?php
session_start();
require_once("../db/config.php");
require_once("../const/uniques.php");
require_once('../const/web-info.php');

if (isset($_GET['key'])) {
$key = $_GET['key'];
$email = $_GET['email'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_subscribers WHERE email = ?");
$stmt->execute([$email]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
header("location:../");
}else{

foreach($result as $row)
{

if (password_verify($row[0], $key)) {
$stmt = $conn->prepare("DELETE FROM tbl_subscribers WHERE email = ?");
$stmt->execute([$email]);
$_SESSION['reply'] = array (array("info","Subscription removed successfully"));
header("location:../");
}else{
header("location:../");
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
