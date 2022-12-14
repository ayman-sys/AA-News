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
$category = ucwords($_POST['category']);
$status = $_POST['status'];
$cat_id = $_POST['cat_id'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_categories WHERE name = ? AND id != ?");
$stmt->execute([$category, $cat_id]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['reply'] = array (array("danger","Category is already registered"));
header("location:../categories");
}else{
$stmt = $conn->prepare("UPDATE tbl_categories SET name = ?,status = ? WHERE id = ?");
$stmt->execute([$category,$status, $cat_id]);
$_SESSION['reply'] = array (array("success","Category updated successfully"));
header("location:../categories");
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
