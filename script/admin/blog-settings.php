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

<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_smtp LIMIT 1");
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
echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo WBName; ?> - Blog Settings</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">

  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">

  <link href="cpanel/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">

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
            <a href="admin/new-banner"><div class="pull-left"><i class="feather icon-file-plus mr-20"></i><span class="right-nav-text">Create Banners</span></div><div class="clearfix"></div></a>
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
            <a class="active" href="admin/blog-settings"><div class="pull-left"><i class="feather icon-settings mr-20"></i><span class="right-nav-text">Blog Settings</span></div><div class="clearfix"></div></a>
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
            <h5 class="txt-dark">Blog Settings</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="."><?php echo WBName; ?></a></li>
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Blog Settings</span></li>
            </ol>
          </div>


        </div>

        <div class="row">

          <div class="col-sm-12">
            <?php require_once('../const/check-reply.php'); ?>
            <div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Basic Information</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form id="app_frm" action="admin/core/update_basic_blog" method="POST" autocomplete="OFF" >
                            <div class="form-group">
    													<label class="control-label mb-10 text-left">Name</label>
    													<input type="text" class="form-control" value="<?php echo WBName; ?>" name="blog" required>
    												</div>
    												<div class="form-group">
    													<label class="control-label mb-10 text-left">Email</label>
    													<input type="email" class="form-control" value="<?php echo WBEmail; ?>" name="email" required>
    												</div>
                            <div class="form-group">
    													<label class="control-label mb-10 text-left">Phone</label>
    													<input type="text" class="form-control" value="<?php echo WBPhone; ?>" name="phone" required>
    												</div>
                            <div class="form-group">
    													<label class="control-label mb-10 text-left">Address</label>
    													<input type="text" class="form-control" value="<?php echo WBAddress; ?>" name="address" required>
    												</div>
                            <div class="form-group">
                              <label class="control-label mb-10 text-left">Description</label>
                              <input type="text" class="form-control" value="<?php echo WBDescription; ?>" name="description" required>
                            </div>

    												<div class="form-group">
    													<label class="control-label mb-10 text-left">Keywords</label>
    													<textarea style="resize:none" class="form-control" name="keywords" rows="5" required><?php echo WBKeywords; ?></textarea>
    												</div>

                            <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

      											</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


              <div class="panel panel-default card-view">
                  <div class="panel-heading">
                    <div class="pull-left">
                      <h6 class="panel-title txt-dark">Preferences</h6>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-sm-12 col-xs-12">
                          <div class="form-wrap">
                            <form id="app_frm3" action="admin/core/update_preference_blog" method="POST" autocomplete="OFF" >

                              <div class="form-group">
                                <label class="control-label mb-10 text-left">Disqus URL</label>
                                <input type="text" class="form-control" value="<?php echo WBDiscus; ?>" name="disqus" required>
                              </div>


                              <div class="form-group">
                                <label class="control-label mb-10 text-left">Timezone</label>
                                <select class="form-control select2" name="timezone" required>
                                  <option selected disabled>Select</option>

                                  <?php
                                  $current_cont = "";
                                  try {
                                  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                                  $stmt = $conn->prepare("SELECT * FROM tbl_timezones ORDER BY continet");
                                  $stmt->execute();
                                  $result = $stmt->fetchAll();

                                  foreach($result as $row)
                                  {
                                    if ($current_cont == $row[1]) {
                                      ?><option <?php if (WBTimezone == $row[2]) { print 'selected';} ?> value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option><?php
                                    }else{
                                      if ($current_cont == "") {

                                      }else{
                                        ?></optgroup><?php
                                      }
                                      $current_cont = $row[1];

                                      ?>
                                      <optgroup label="<?php echo $current_cont; ?> Timezones">
                                      <option <?php if (WBTimezone == $row[2]) { print 'selected';} ?> value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>
                                      <?php
                                    }
                                    ?>
                                    <?php
                                  }
                                  }catch(PDOException $e)
                                  {
                                  echo "Connection failed: " . $e->getMessage();
                                  }
                                  ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label class="control-label mb-10 text-left">Use Clean URL</label>
                                <div>
                                  <input name="clean_url" id="check_box_switch" type="checkbox" data-off-text="Disabled" data-on-text="Enabled"  class="bs-switch">
                              </div>
                              </div>


                              <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                      <div class="pull-left">
                        <h6 class="panel-title txt-dark">SMTP Settings</h6>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-12 col-xs-12">
                            <div class="form-wrap">
                              <form id="app_frm2" action="admin/core/update_smtp" method="POST" autocomplete="OFF" >
                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">SMTP Server</label>
                                  <input type="text" class="form-control" value="<?php echo $smtp_server; ?>" name="smtp_server" required>
                                </div>
                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">SMTP Username</label>
                                  <input type="text" class="form-control" value="<?php echo $smtp_username; ?>" name="smtp_username" required>
                                </div>
                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">SMTP Password</label>
                                  <input type="password" class="form-control" value="<?php echo $smtp_password; ?>" name="smtp_password" required>
                                </div>
                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">SMTP Port</label>
                                  <input type="number" class="form-control" value="<?php echo $smtp_conn_port; ?>" name="smtp_conn_port" required>
                                </div>
                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">Security Connection</label>
                                  <select name="smtp_connection" required class="form-control">
                                  <option <?php if ($smtp_conn_type == "tls") { print ' selected '; } ?> value="tls">TLS</option>
                                  <option <?php if ($smtp_conn_type == "ssl") { print ' selected '; } ?> value="ssl">SSL</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label class="control-label mb-10 text-left">Sender Name</label>
                                  <input type="text" class="form-control" value="<?php echo $smtp_sender; ?>" name="smtp_sender" required>
                                </div>

                                <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="panel panel-default card-view">
                      <div class="panel-heading">
                        <div class="pull-left">
                          <h6 class="panel-title txt-dark">Website Logo</h6>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-12 col-xs-12">
                              <div class="form-wrap">
                                  <form id="app_frm4" action="admin/core/update_logo_blog" method="POST" autocomplete="OFF" enctype="multipart/form-data">

                                  <img id="logo_preview" class="brand-img inner_logo" src="images/logos/<?php echo WBLogo; ?>" alt="brand">

                                  <div class="form-group">
                                    <input required type="file" onchange="readURL(this);" accept="image/*" class="form-control" name="file">
                                  </div>


                                  <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                          <div class="pull-left">
                            <h6 class="panel-title txt-dark">Website Logo Inverse</h6>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-sm-12 col-xs-12">
                                <div class="form-wrap">
                                    <form id="app_frm5" action="admin/core/update_logo_inverse_blog" method="POST" autocomplete="OFF" enctype="multipart/form-data">

                                    <img id="logo_preview2" style="background-color:black;" class="brand-img inner_logo" src="images/logos/<?php echo WBLogoInverse; ?>" alt="brand">

                                    <div class="form-group">
                                      <input required type="file" onchange="readURL2(this);" accept="image/*" class="form-control" name="file">
                                    </div>


                                    <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="panel panel-default card-view">
                          <div class="panel-heading">
                            <div class="pull-left">
                              <h6 class="panel-title txt-dark">Website Icon</h6>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                  <div class="form-wrap">
                                      <form id="app_frm6" action="admin/core/update_favicon_blog" method="POST" autocomplete="OFF" enctype="multipart/form-data">

                                      <img id="icon_preview" class="brand-img inner_logo" src="images/<?php echo WBFavicon; ?>" alt="brand">

                                      <div class="form-group">
                                        <input required type="file" onchange="readURL3(this);" accept=".png, .jpg, .jpeg, .ico" class="form-control" name="file">
                                      </div>


                                      <button name="submit" value="1" type="submit" class="btn btn-danger mr-10">Save Changes</button>

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





		</div>

    </div>


  <script src="cpanel/vendors/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="cpanel/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
  <script src="cpanel/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
  <script src="cpanel/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
  <script src="cpanel/vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="cpanel/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <script src="cpanel/dist/js/form-advance-data.js"></script>
  <script src="cpanel/dist/js/jquery.slimscroll.js"></script>
  <script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
  <script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>
  <script src="cpanel/dist/js/init.js"></script>
  <script>

  $('.bs-switch').bootstrapSwitch('state', <?php echo WBCleanURL; ?>);
  $('#check_box_value').text($("#check_box_switch").bootstrapSwitch('state'));

  $('#check_box_switch').on('switchChange.bootstrapSwitch', function () {
  	$("#check_box_value").text($('#check_box_switch').bootstrapSwitch('state'));
  });

  function readURL(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  $('#logo_preview')
  .attr('src', e.target.result);
  };

  reader.readAsDataURL(input.files[0]);
  }
  }

  function readURL2(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  $('#logo_preview2')
  .attr('src', e.target.result);
  };

  reader.readAsDataURL(input.files[0]);
  }
  }

  function readURL3(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  $('#icon_preview')
  .attr('src', e.target.result);
  };

  reader.readAsDataURL(input.files[0]);
  }
  }

  </script>


</body>

</html>
