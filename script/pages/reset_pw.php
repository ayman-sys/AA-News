<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');
//Check login session:
require_once('../const/check_session.php');

switch($res) {
case '1':
header("location:admin");
break;
}

if (isset($_GET['token'])) {
  $token = $_GET['token'];

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $stmt = $conn->prepare("SELECT * FROM tbl_reset_tokens WHERE token = ?");
  $stmt->execute([$token]);
  $result = $stmt->fetchAll();

  if (count($result) < 1) {
    header("location:./");
  }

  foreach($result as $row)
  {
    $_SESSION['reset_start'] = "1";
    $_SESSION['reset_email'] = $row[1];
  }
  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }


}else{
  header("location:./");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php echo WBName; ?> - Reset Password</title>
		<meta name="description" content="<?php echo WBDescription; ?>" />
		<link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
		<meta name="author" content="Bwiresoft"/>
		<link href="cpanel/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
		<link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">

	</head>
	<body>

		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>

		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="./">
						<img class="brand-img mr-0" src="images/logos/<?php echo WBLogo; ?>" alt="brand"/>
					</a>
				</div>
				<div class="clearfix"></div>
			</header>

			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">

					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12" id="SELECTOR">
										<div class="mb-20">
											<h3 class="text-center txt-dark mb-20">Reset Password</h3>
										</div>
										<?php require_once('../const/check-reply.php'); ?>


										<div class="form-wrap">
											<form id="app_frm" action="core/new-pw" method="POST" autocomplete="OFF">
												<div class="form-group">
													<label class="pull-left control-label mb-10">New Password</label>
													<input type="password" class="form-control" required placeholder="Enter your new password" id="new_pswd" name="new_pw">
												</div>
                        <div class="form-group">
                          <label class="pull-left control-label mb-10">Confirm New Password</label>
                          <input type="password" class="form-control" required placeholder="Confirm your new password" id="confirm_pswd" name="confirm_new_pw">
                        </div>
												<div class="form-group text-center">
													<button id="reset_pw" name="submit" value="1" type="submit" class="btn btn-danger btn-rounded">Reset Password</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
		<script src="cpanel/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="cpanel/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="cpanel/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
		<script src="cpanel/dist/js/init.js"></script>
		<script src="plugins/loader/waitMe.js"></script>
		<script src="js/forms.js"></script>
	</body>

</html>
