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

if (isset($_GET['node'])) {
$article = $_GET['node'];
$img = $_GET['img'];
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("DELETE FROM tbl_blog_posts WHERE id = ?");
$stmt->execute([$article]);

$stmt = $conn->prepare("DELETE FROM tbl_blog_views WHERE article = ?");
$stmt->execute([$article]);

unlink('../../images/blog/'.$img.'');
$_SESSION['reply'] = array (array("success","Article deleted successfully"));
header("location:../articles");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}else{
header("location:../");
}

?>
