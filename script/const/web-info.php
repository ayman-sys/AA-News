<?php
try

    {
    $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM tbl_web_info LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row)
    {
      DEFINE('WBName', $row[0]);
      DEFINE('WBEmail', $row[1]);
      DEFINE('WBPhone', $row[2]);
      DEFINE('WBAddress', $row[3]);
      DEFINE('WBLogo', $row[4]);
      DEFINE('WBLogoInverse', $row[5]);
      DEFINE('WBFavicon', $row[6]);
      DEFINE('WBTimezone', $row[7]);
      DEFINE('WBDescription', $row[8]);
      DEFINE('WBKeywords', $row[9]);
      DEFINE('WBScript', $row[10]);
      DEFINE('WBCleanURL', $row[11]);
      DEFINE('WBDiscus', $row[12]);
      date_default_timezone_set(WBTimezone);
    }

    }catch(PDOException $e)
    {

    }

?>
