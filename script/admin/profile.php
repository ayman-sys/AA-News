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
	<title><?php echo WBName; ?> - Admin Profile</title>
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
            <a href="admin/newsletter"><div class="pull-left"><i class="feather icon-mail mr-20"></i><span class="right-nav-text">Create Newsletter</span></div><div class="clearfix"></div></a>
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
            <a class="active" href="admin/profile"><div class="pull-left"><i class="feather icon-user mr-20"></i><span class="right-nav-text">Profile</span></div><div class="clearfix"></div></a>
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
            <h5 class="txt-dark">Admin Profile</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="."><?php echo WBName; ?></a></li>
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Admin Profile</span></li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
                      <div class="form-group ml-20">

												<img id="avator" class="inline_img" src="images/user/<?php echo $avator; ?>" alt="user">
                        <h5 class="block mt-10 mb-5 weight-500  txt-danger"><?php echo $fname; ?> <?php echo $lname; ?></h5>
                        <p class="block pb-20"><?php echo $email; ?></p>
                        <p class="inline-block"><span><?php echo $about; ?></span></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

          <div class="col-sm-8">
            <?php require_once('../const/check-reply.php'); ?>
            <div class="panel panel-default card-view pa-0">
            							<div class="panel-wrapper collapse in">
            								<div class="panel-body pb-0">
            									<div class="tab-struct custom-tab-1">
            										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
            											<li class="active" role="presentation"><a data-toggle="tab" id="profile_tab" role="tab" href="#profile" aria-expanded="true"><span>Edit Profile</span></a></li>
            											<li role="presentation" class=""><a data-toggle="tab" id="social_tab" role="tab" href="#social" aria-expanded="false"><span>Social Links</span></a></li>
                                  <li role="presentation" class=""><a data-toggle="tab" id="password_tab" role="tab" href="#password" aria-expanded="false"><span>Change Password</span></a></li>
            										</ul>
            										<div class="tab-content" id="myTabContent_8">
            											<div id="profile" class="tab-pane fade active in" role="tabpanel">
            												<div class="col-md-12">
                                      <div class="panel-wrapper collapse in">
                          								<div class="panel-body">
                          									<div class="row">
                          										<div class="col-sm-12 col-xs-12">
                          											<div class="form-wrap">
                          												<form id="app_frm" action="admin/core/update_profile" method="POST" autocomplete="OFF" enctype="multipart/form-data">
                          													<div class="form-group">
                          														<label class="control-label mb-10">First Name</label>
                          														<div class="input-group">
                          															<div class="input-group-addon"><i class="feather icon-user"></i></div>
                          															<input type="text" class="form-control txt-cap" placeholder="First Name" name="fname" value="<?php echo $fname; ?>" required>
                          														</div>
                          													</div>
                                                    <div class="form-group">
                          														<label class="control-label mb-10">Last Name</label>
                          														<div class="input-group">
                          															<div class="input-group-addon"><i class="feather icon-user"></i></div>
                          															<input type="text" class="form-control txt-cap" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>" required>
                          														</div>
                          													</div>
                                                    <div class="form-group">
                          														<label class="control-label mb-10">Email</label>
                          														<div class="input-group">
                          															<div class="input-group-addon"><i class="feather icon-mail"></i></div>
                          															<input type="email" class="form-control" placeholder="Email Address" name="email" value="<?php echo $email; ?>" required>
                          														</div>
                          													</div>
                                                    <div class="form-group">
                          														<label class="control-label mb-10">Display Image</label>
                                                       <?php if ($avator !== "default.png") {
                                                       ?>
                                                       <a onclick="return confirm('Delere avator?');" href="admin/core/drop-img"><i class="text-danger feather icon-trash-2"></i></a>
                                                       <?php
                                                       }
                                                       ?>
                          														<div class="input-group">
                          															<div class="input-group-addon"><i class="feather icon-image"></i></div>
                          															<input type="file" onchange="readURL(this);" accept="image/*" class="form-control" name="file">
                          														</div>
                          													</div>
                                                    <div class="form-group">
                                                      <label class="control-label mb-10">About Me</label>

                                                        <textarea required class="form-control" placeholder="About Me....." name="about"><?php echo $about; ?></textarea>
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

                                  <div id="social" class="tab-pane fade" role="tabpanel">
                                    <div class="col-md-12">

                                      <div class="table-wrap mb-40">

                                      <div class="table-responsive">
                                        <div class="pull-left mb-10">
                                          <button  data-toggle="modal" data-target="#add_social" class="btn btn-danger"><i class="feather icon-plus-circle"></i> <span class="btn-text">Add New</span></button>
                                        </div>
                                      <table class="table table-striped table-bordered mb-0">
                                      <thead>
                                      <tr>
                                      <th>Social Network</th>
                                      <th>Profile Link</th>
                                      <th></th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        try {
                                        $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                                        $stmt = $conn->prepare("SELECT * FROM tbl_social_links ORDER BY social_network");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();

                                        foreach($result as $row)
                                        {
                                          ?>
                                          <tr>
                                          <td width="200"><i class="<?php echo $row[3]; ?>"></i> <?php echo $row[1]; ?></td>
                                          <td><?php echo $row[2]; ?></td>
                                          <td width="100"><a onclick="return confirm('Delete social profile?');" href="admin/core/drop-social?node=<?php echo $row[0]; ?>"><i class="text-danger feather icon-trash-2"></i> Delete</a></td>
                                          </tr>
                                          <?php
                                        }
                                        }catch(PDOException $e)
                                        {
                                        echo "Connection failed: " . $e->getMessage();
                                        }
                                        ?>


                                      </tbody>
                                      </table>
                                      </div>
                                      </div>

                                    </div>
                                  </div>

                                  <div id="password" class="tab-pane fade" role="tabpanel">
                                    <div class="col-md-12">
                                      <div class="panel-wrapper collapse in">
                                          <div class="panel-body">
                                            <div class="row">
                                              <div class="col-sm-12 col-xs-12">
                                                <div class="form-wrap">
                                                  <form id="app_frm2" action="admin/core/update_password" method="POST" autocomplete="OFF" >
                                                    <div class="form-group">
                                                      <label class="control-label mb-10">Current Password</label>
                                                      <div class="input-group">
                                                        <div class="input-group-addon"><i class="feather icon-lock"></i></div>
                                                        <input required type="password" class="form-control" placeholder="Enter your current password" id="current_pswd" name="current_pw">
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="control-label mb-10">New Password</label>
                                                      <div class="input-group">
                                                        <div class="input-group-addon"><i class="feather icon-lock"></i></div>
                                                        <input required type="password" class="form-control" placeholder="Enter your new password" id="new_pswd" name="new_pw">
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="control-label mb-10">Confirm Current Password</label>
                                                      <div class="input-group">
                                                        <div class="input-group-addon"><i class="feather icon-lock"></i></div>
                                                        <input required type="password" class="form-control" placeholder="Confirm your new password" id="confirm_pswd" name="confirm_pw">
                                                      </div>
                                                    </div>

                                                    <button id="change_pw" name="submit" value="1" type="submit" class="btn btn-danger mr-10">Change Password</button>
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
            						</div>
						</div>

        </div>

			</div>

      <div id="add_social" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 class="modal-title">Add Social Link</h5>
          </div>
          <div class="modal-body">
            <div class="form-wrap">
              <form id="app_frm3" action="admin/core/new_social" method="POST" autocomplete="OFF">
                <div class="form-group">
                  <label class="control-label mb-10">Select Social Network</label>
                  <select class="form-control" name="network" required>
									<option value="Behance">Behance</option>
									<option value="Facebook">Facebook</option>
                  <option value="Github">Github</option>
                  <option value="Instagram">Instagram</option>
                  <option value="Linked In">Linked In</option>
                  <option value="Pinterest">Pinterest</option>
                  <option value="Reddit">Reddit</option>
                  <option value="Skype">Skype</option>
                  <option value="Stack Over Flow">Stack Over Flow</option>
                  <option value="Twitter">Twitter</option>
                  <option value="Vimeo">Vimeo</option>
                  <option value="WhatsApp">WhatsApp</option>
                  <option value="Youtube">Youtube</option>
									</select>
                </div>

                <div class="form-group">
								<label class="control-label mb-10 text-left">Profile Link</label>
								<input type="text" name="link" required class="form-control" placeholder="Enter Profile Link">
								</div>

                <div class="form-group mb-0">
                  <button name="submit" value="1" type="submit" class="btn btn-danger"><span class="btn-text">Save</span></button>
                </div>
              </form>
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
  <script>
  function readURL(input) {
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
  $('#avator')
  .attr('src', e.target.result);
  };

  reader.readAsDataURL(input.files[0]);
  }
  }

  </script>


</body>

</html>
