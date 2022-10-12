<?php

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_smtp");
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
  $smtp_server = $row[0];
  $smtp_username = $row[1];
  $smtp_password = $row[2];
  $smtp_conn_type = $row[3];
  $smtp_conn_port = $row[4];
  $smtp_sender = $row[5];
 }


}catch(PDOException $e)
{

}


?>
