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
$title = ucwords($_POST['title']);
$category = $_POST['category'];
$content = $_POST['content'];
$description = $_POST['description'];

if (!empty($_POST['y_video'])) {
  $y_video = $_POST['y_video'];
}else{
  $y_video = "";
}
$tags = $_POST['tags'];
$create_date = date('F d, Y');

$target_dir = "../../images/blog/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'blog_post'.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = array (array("warning","Only JPG, PNG and JPEG files are allowed"));
header("location:../new-article");
}else{
if (move_uploaded_file($_FILES["file"]["tmp_name"], $destn_upload)) {

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("INSERT INTO tbl_blog_posts (title, pub_date, category, media, content, short_desc, yt_video, tags) VALUES (?,?,?,?,?,?,?,?)");
$stmt->execute([$title, $create_date, $category, $destn_file, $content, $description, $y_video, $tags]);
$_SESSION['reply'] = array (array("success","Article created successfully"));
header("location:../new-article");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
$_SESSION['reply'] = array (array("danger","An error occured while uploading image"));
header("location:../new-article");
}

}
}else{
header("location:../");
}

?>
