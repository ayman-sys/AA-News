<?php
$ip =  $_SERVER['REMOTE_ADDR'];
$ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
if($ip_info && $ip_info->geoplugin_countryName != null){
$country = $ip_info->geoplugin_countryName;
$country_code = $ip_info->geoplugin_countryCode;

if ($country == "") {
  $country = "N/A";
}

if ($country_code == "") {
  $country_code = "N/A";
}

}else{
$country = "N/A";
$country_code = "N/A";
}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_cords WHERE country = ?");
$stmt->execute([$country_code]);
$result = $stmt->fetchAll();

if ($country == "N/A") {
  $latlong = "N/A";
  $view_date = date('Y-m-d');
  $country_name = "N/A";

}

foreach($result as $row)
{
$latlong = ''.$row[1].','.$row[2].'';
$view_date = date('Y-m-d h:i:s');
$country_name = $row[3];
}

$stmt = $conn->prepare("SELECT * FROM tbl_blog_views WHERE article = ? AND ip_address = ?");
$stmt->execute([$blog_id, $ip]);
$result = $stmt->fetchAll();

if (count($result) < 1) {

$stmt = $conn->prepare("INSERT INTO tbl_blog_views (article, v_date, country_domain, country, ip_address, cords) VALUES (?,?,?,?,?,?)");
$stmt->execute([$blog_id, $view_date, $country_code, $country_name, $ip, $latlong]);

$stmt = $conn->prepare("UPDATE tbl_blog_posts SET views = views + 1 WHERE id = ?");
$stmt->execute([$blog_id]);
}


}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>
