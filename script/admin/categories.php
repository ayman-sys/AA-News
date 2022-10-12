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
	<title><?php echo WBName; ?> - Categories</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
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
            <a  class="active" href="admin/categories"><div class="pull-left"><i class="feather icon-layers mr-20"></i><span class="right-nav-text">Categories</span></div><div class="clearfix"></div></a>
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
            <a  href="admin/new-banner"><div class="pull-left"><i class="feather icon-file-plus mr-20"></i><span class="right-nav-text">Create Banners</span></div><div class="clearfix"></div></a>
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
            <h5 class="txt-dark">Blog Categories</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="."><?php echo WBName; ?></a></li>
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Blog Categories</span></li>
            </ol>
          </div>

        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default card-view">
              <div class="panel-heading">
                <div class="pull-left">
                  <button  data-toggle="modal" data-target="#add_category" class="btn btn-danger"><i class="feather icon-plus-circle"></i> <span class="btn-text">Add New</span></button>
                </div>


                <div class="clearfix"></div>
              </div>

              <div class="panel-wrapper collapse in">
                <?php require_once('../const/check-reply.php'); ?>
                <div class="panel-body">

                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table id="datable_1" class="table table-hover display  pb-30" >
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          try {
                          $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                          $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY name");
                          $stmt->execute();
                          $result = $stmt->fetchAll();

                          foreach($result as $row)
                          {
                            if ($row[3] == "Active") {
                              $status = '<span class="label label-success">Active</span>';
                            }else{
                              $status = '<span class="label label-danger">Inactive</span>';
                            }
                            ?>
                            <tr>
                              <td><?php echo $row[1]; ?></td>
                              <td><?php echo $row[2]; ?></td>
                              <td><?php echo $status; ?></td>
                              <td width="10"><button id="<?php echo $row[0]; ?>" onclick="get_category(this.id);" data-toggle="modal" data-target="#edit_category" class="btn btn-default  btn-xs">Edit</button></td>
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
            </div>
          </div>
        </div>

			</div>
      <div id="add_category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 class="modal-title">Add Category</h5>
          </div>
          <div class="modal-body">
            <div class="form-wrap">
							<form id="app_frm" action="admin/core/new_category" method="POST" autocomplete="OFF">
								<div class="form-group">
									<label class="control-label mb-10">Category Name</label>
									<input type="text" required name="category" class="form-control txt-cap" >
								</div>

								<div class="form-group mb-0">
									<button name="submit" value="1" type="submit" class="btn btn-danger"><span class="btn-text">Save Changes</span></button>
								</div>
							</form>
						</div>
          </div>

        </div>
        </div>
      </div>


      <div id="edit_category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 class="modal-title">Edit Category</h5>
          </div>
          <div class="modal-body">
            <div class="form-wrap">
              <form id="app_frm2" action="admin/core/edit_category" method="POST" autocomplete="OFF">
                <div id="edit_category_ajax">

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
	<script src="cpanel/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="cpanel/dist/js/dataTables-data.js"></script>
	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>
  <script src="js/categories.js"></script>


</body>

</html>
