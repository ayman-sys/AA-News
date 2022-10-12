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
$timezone = $_POST['timezone'];
$disqus = $_POST['disqus'];
if (!empty($_POST['clean_url'])) {
  $clean_url = "true";
}else{
  $clean_url = "false";
}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET timezone = ?, use_clean = ?, disqus_url = ?");
$stmt->execute([$timezone, $clean_url, $disqus]);
$_SESSION['reply'] = array (array("success","Preference updated successfully"));
header("location:../blog-settings");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
