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
$banner_name = ucwords($_POST['banner_name']);
$banner_size = $_POST['banner_size'];
$banner_code = $_POST['banner_code'];
$create_date = date('d F Y h:i:s A');

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_banners WHERE name = ? AND size = ?");
$stmt->execute([$banner_name, $banner_size]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['reply'] = array (array("danger","Banner is already used"));
header("location:../new-banner");
}else{
$stmt = $conn->prepare("INSERT INTO tbl_banners (name, size, code, create_date) VALUES (?,?,?,?)");
$stmt->execute([$banner_name, $banner_size, $banner_code, $create_date]);
$_SESSION['reply'] = array (array("success","Banner created successfully"));
header("location:../new-banner");
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
