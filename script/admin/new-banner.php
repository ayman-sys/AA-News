<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');
//Check login session:
require_once('../const/check_session.php');

switch($res) {
case '0':
$_SESSION['reply'] = array (array("warning","You must login first"));
header("location:../login");
break;

case '2':
$_SESSION['reply'] = array (array("warning","Invalid login session"));
header("location:../login");
break;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo WBName; ?> - Create Banners</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
</head>

<body id="SELECTOR">

	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>

    <div class="wrapper theme-4-active pimary-color-red">

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="./">
							<img class="brand-img inner_logo" src="images/logos/<?php echo WBLogoInverse; ?>" alt="brand"/>
						</a>
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="dripicons-menu"></i></a>

			</div>

		</nav>

		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span>
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="admin"><div class="pull-left"><i class="feather icon-airplay mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li>

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Content</span>
					<i class="zmdi zmdi-more"></i>
          <li>
            <a href="admin/categories"><div class="pull-left"><i class="feather icon-layers mr-20"></i><span class="right-nav-text">Categories</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/new-article"><div class="pull-left"><i class="feather icon-edit-1 mr-20"></i><span class="right-nav-text">Publish Article</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/articles"><div class="pull-left"><i class="feather icon-file-text mr-20"></i><span class="right-nav-text">Manage Article</span></div><div class="clearfix"></div></a>
          </li>
				</li>

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Newsletter</span>
					<i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/subscribers"><div class="pull-left"><i class="feather icon-users mr-20"></i><span class="right-nav-text">Subscribers</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/newsletter"><div class="pull-left"><i class="feather icon-mail mr-20"></i><span class="right-nav-text">Create Newsletter</span></div><div class="clearfix"></div></a>
          </li>
				</li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Advertisement</span>
          <i class="zmdi zmdi-more"></i>
          <li>
            <a   class="active"  href="admin/new-banner"><div class="pull-left"><i class="feather icon-file-plus mr-20"></i><span class="right-nav-text">Create Banners</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/manage-banners"><div class="pull-left"><i class="feather icon-grid mr-20"></i><span class="right-nav-text">Manage Banners</span></div><div class="clearfix"></div></a>
          </li>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Settings</span>
          <i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/blog-settings"><div class="pull-left"><i class="feather icon-settings mr-20"></i><span class="right-nav-text">Blog Settings</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/scripts"><div class="pull-left"><i class="feather icon-code mr-20"></i><span class="right-nav-text">Scripts</span></div><div class="clearfix"></div></a>
          </li>

        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Account</span>
          <i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/profile"><div class="pull-left"><i class="feather icon-user mr-20"></i><span class="right-nav-text">Profile</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="logout"><div class="pull-left"><i class="feather icon-power mr-20"></i><span class="right-nav-text">Logout</span></div><div class="clearfix"></div></a>
          </li>

        </li>

			</ul>
		</div>

		<div class="page-wrapper" id="thewraper">
      <div class="container-fluid pt-25">

        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Create Banner</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="."><?php echo WBName; ?></a></li>
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Create Banner</span></li>
            </ol>
          </div>

        </div>

        <div class="row">

          <div class="col-sm-12">
							<div class="panel panel-default card-view">

								<div class="panel-wrapper collapse in">
                  <?php require_once('../const/check-reply.php'); ?>
									<div class="panel-body">
										<div class="form-wrap">
											<form id="app_frm" action="admin/core/new_banner" method="POST" autocomplete="OFF" class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Banner Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control txt-cap" name="banner_name" required>
                          </div>
                        </div>

												<div class="form-group">
													<label class="control-label mb-10 col-sm-2" >Banner Size</label>
    											<div class="col-sm-10">
                            <select name="banner_size" required class="form-control">
                            <option selected disabled value=""></option>
														<option value="250 * 250">250 * 250</option>
                            <option value="468 * 60">468 * 60</option>
                            <option value="300 * 250">300 * 250</option>
                            <option value="728 * 90">728 * 90</option>
													</select>
    											</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 col-sm-2" for="pwd_hr">Banner Code</label>
												<div class="col-sm-10">
													<textarea name="banner_code" required class="form-control" rows="5"></textarea>
												</div>
												</div>

												<div class="form-group mb-0">
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" name="submit" class="btn btn-danger"><span class="btn-text">Save</span></button>
													</div>
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

	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>


</body>

</html>
