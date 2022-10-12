<?php
session_start();
//Database configuration:
require_once('db/config.php');
//Website Settings:
require_once('const/web-info.php');
//Check login session:
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title><?php echo WBName; ?> - <?php echo WBDescription; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="<?php echo WBDescription; ?>" />
	<meta name="keywords" content="<?php echo WBKeywords; ?>" />
	<link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<meta name="author" content="Bwiresoft"/>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/colorbox.css">
	<?php echo WBScript; ?>


</head>

<body>
<h1>Redirecting...</h1>
<?php
if (isset($_GET['link'])) {
  $link = $_GET['link'];
  ?>
  <script>
  window.location.href = "<?php echo $link; ?>";
  </script>
  <?php
}else{
  header("location:./");
}
?>

</body>
</html>
