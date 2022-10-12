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
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php echo WBName; ?> - Forgot Password</title>
		<meta name="description" content="<?php echo WBDescription; ?>" />
		<meta name="keywords" content="<?php echo WBKeywords; ?>" />
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
										<div class="mb-10">
                      <h5 class="text-center txt-dark mb-10">Need help with your password?</h5>
                      <h6 class="text-center txt-grey nonecase-font">Enter the email you use and we’ll help you create a new password.</h6>
										</div>
										<?php require_once('../const/check-reply.php'); ?>

                    <div class="form-wrap">
											<form id="app_frm" action="core/forgot-pw" method="POST" autocomplete="OFF">
												<div class="form-group">
													<label class="control-label mb-10">Email address</label>
													<input type="email" class="form-control" required name="email" placeholder="Enter your email">
												</div>

												<div class="form-group text-center">
													<button name="submit" value="1" type="submit" class="btn btn-danger btn-rounded">Reset Password</button>
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
