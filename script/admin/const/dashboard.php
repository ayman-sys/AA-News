<?php
$published_articles = 0;
$visible_articles = 0;
$hidden_articles = 0;
$advertising_banners = 0;

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts");
$stmt->execute();
$result = $stmt->fetchAll();
$published_articles = count($result);

foreach($result as $row)
{
  switch($row[10]) {
    case '1';
    $visible_articles++;
    break;

    case '0';
    $hidden_articles++;
    break;

  }
}


$stmt = $conn->prepare("SELECT * FROM tbl_banners");
$stmt->execute();
$result = $stmt->fetchAll();
$advertising_banners = count($result);

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

?>
