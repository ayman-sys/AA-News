<?php
session_start();
require_once("../../db/config.php");
require_once("../../const/web-info.php");

if (isset($_POST['email'])) {
$email = $_POST['email'];
$date_created = date('d F Y h:i:s A');

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_subscribers WHERE email = ?");
$stmt->execute([$email]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
echo "Email address is already in the subscription list.";
}else{
$stmt = $conn->prepare("INSERT INTO tbl_subscribers (email, date_created) VALUES (?,?)");
$stmt->execute([$email, $date_created]);
echo "Subscribed successfully.";
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}
?>
