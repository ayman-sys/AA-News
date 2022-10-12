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
		<title><?php echo WBName; ?> - Admin Login</title>
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
										<div class="mb-20">
											<h3 class="text-center txt-dark mb-10">Sign in to <?php echo WBName; ?></h3>
											<h6 class="text-center nonecase-font txt-grey">Please login to start your session.</h6>
										</div>
										<?php require_once('../const/check-reply.php'); ?>


										<div class="form-wrap">
											<form id="app_frm" action="core/auth" method="POST" autocomplete="OFF">
												<div class="form-group">
													<label class="control-label mb-10">Email address</label>
													<input type="email" class="form-control" required name="email" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" >Password</label>
													<a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="forgot-password">forgot password ?</a>
													<div class="clearfix"></div>
													<input type="password" class="form-control" required name="password" placeholder="Enter password">
												</div>

												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" name="remember" type="checkbox">
														<label for="checkbox_2"> Keep me logged in</label>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<button  name="submit" value="1" type="submit" class="btn btn-danger btn-rounded">sign in</button>
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
