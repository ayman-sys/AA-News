<?php
if(!isset($_COOKIE["__news247__logged"])) {
$res = "0";
} else {

if(!isset($_COOKIE["__news247__key"])) {
$res = "0";
}else{
$session_key = $_COOKIE["__news247__key"];
$current_ip = $_SERVER['REMOTE_ADDR'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_login_sessions LEFT JOIN tbl_admin ON tbl_login_sessions.account_id = tbl_admin.id WHERE tbl_login_sessions.sessi_id = ?");
$stmt->execute([$session_key]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
$res = "0";
}else{
foreach($result as $row)
{
$user_id = $row[3];
$session_ip = $row[2];
$fname = $row[5];
$lname = $row[6];
$email = $row[7];
$about = $row[8];
$avator = $row[10];
}

if ($current_ip == $session_ip) {
$res = "1";
}else{
$res = "2";
}
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}
}
?>
