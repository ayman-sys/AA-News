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
$fname = ucwords($_POST['fname']);
$lname = ucwords($_POST['lname']);
$email = $_POST['email'];
$about = $_POST['about'];

if($_FILES['file']['name'] == "") {

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_admin SET first_name = ?, last_name = ?, email = ?, about = ?");
$stmt->execute([$fname, $lname, $email, $about]);
$_SESSION['reply'] = array (array("success","Profile updated successfully"));
header("location:../profile");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
$target_dir = "../../images/user/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'avator'.$user_id.''.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = array (array("warning","Only JPG, PNG and JPEG files are allowed"));
header("location:../profile");
}else{
if (move_uploaded_file($_FILES["file"]["tmp_name"], $destn_upload)) {
if ($avator == "default.png") {
}else{
unlink("../../images/user/$avator");
}

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


}
}

}


}else{
header("location:../");
}

?>
