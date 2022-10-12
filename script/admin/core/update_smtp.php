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

$smtp_server = $_POST['smtp_server'];
$smtp_username = $_POST['smtp_username'];
$smtp_password = $_POST['smtp_password'];
$smtp_conn_type = $_POST['smtp_connection'];
$smtp_conn_port = $_POST['smtp_conn_port'];
$smtp_sender = ucwords($_POST['smtp_sender']);

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_smtp SET server = ?, username = ?, password = ?, conn_type = ?, conn_port = ?, sender_name = ?");
$stmt->execute([$smtp_server, $smtp_username, $smtp_password, $smtp_conn_type, $smtp_conn_port, $smtp_sender]);
$_SESSION['reply'] = array (array("success","SMTP settings updated successfully"));
header("location:../blog-settings");

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}

?>
