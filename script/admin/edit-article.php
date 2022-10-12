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

if (isset($_GET['id'])) {
  $article_id = $_GET['id'];

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE id = ?");
  $stmt->execute([$article_id]);
  $result = $stmt->fetchAll();

  if (count($result) < 1) {
    header("location:./");
  }

  foreach($result as $row)
  {
    $title = $row[1];
    $category = $row[3];
    $media = $row[5];
    $cont = $row[6];
    $short_desc = $row[7];
    $yt_vid = $row[8];
    $tags = $row[9];
    $visibilty = $row[10];
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
	<title><?php echo WBName; ?> - Edit Article</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
  <link rel="stylesheet" href="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css" />
  <link href="cpanel/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
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
            <a href="admin/new-article"><div class="pull-left"><i class="feather icon-edit-1 mr-20"></i><span class="right-nav-text">Publish Article</span></div><div class="clearfix"></div></a>
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
            <h5 class="txt-dark">Edit Article</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="."><?php echo WBName; ?></a></li>
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Edit Article</span></li>
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
											<form id="app_frm" action="admin/core/update_blog_post" method="POST" enctype="multipart/form-data" autocomplete="OFF" class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Title</label>
                          <div class="col-sm-10">
                            <input value="<?php echo $title; ?>" placeholder="Enter post title" type="text" class="form-control txt-cap" name="title" required>
                          </div>
                        </div>

												<div class="form-group">
													<label class="control-label mb-10 col-sm-2" >Category</label>
    											<div class="col-sm-10">
                            <select name="category" required class="form-control">
                            <option selected disabled value="">Select one</option>
                            <?php
                            try {
                            $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                            $stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY name");
                            $stmt->execute();
                            $result = $stmt->fetchAll();


                            foreach($result as $row)
                            {
                              ?><option <?php if ($category == $row[0]) { print ' selected '; } ?> value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option><?php
                            }
                            }catch(PDOException $e)
                            {
                            echo "Connection failed: " . $e->getMessage();
                            }
                            ?>

													</select>
    											</div>
												</div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2">Short Description</label>
                        <div class="col-sm-10">
                          <textarea id="short_description" name="description" class="form-control" rows="5" required placeholder="Enter short description (Minimum 150 Characters)"><?php echo $short_desc; ?></textarea>
                        </div>
                        </div>

												<div class="form-group">
													<label class="control-label mb-10 col-sm-2">Content</label>
												<div class="col-sm-10">
													<textarea name="content" class="textarea_editor form-control" rows="15" required placeholder="Enter content ..."><?php echo $cont; ?></textarea>
												</div>
												</div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Image (Leave blank if no update)</label>
                          <div class="col-sm-10">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"> <i class="feather icon-image fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                              <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i class="feather icon-upload"></i> <span class="fileinput-new btn-text">Select file</span> <span class="fileinput-exists btn-text">Change</span>
                              <input type="file" accept="image/*" name="file">
                              </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="feather icon-trash-2"></i><span class="btn-text"> Remove</span></a>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Youtube Video ID</label>
                          <div class="col-sm-10">
                            <input value="<?php echo $yt_vid; ?>" placeholder="*optional* video will be displayed instead of image" type="text" class="form-control" name="y_video">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Visibilty</label>
                          <div class="col-sm-10">
                            <div class="checkbox checkbox-success">
  														<input <?php if ($visibilty == "1") { print ' checked '; } ?> id="checkbox3" type="checkbox" name="visibilty">
  														<label for="checkbox3">
  															Visible to audience
  														</label>
  													</div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Tags</label>
                          <div class="col-sm-10">
                            	<input value="<?php echo $tags; ?>" name="tags" required type="text" class="form-control" data-role="tagsinput" placeholder="Add Tags"/>
                          </div>
                        </div>

                        <input type="hidden" name="article" value="<?php echo $article_id; ?>">
                        <input type="hidden" name="old_img" value="<?php echo $media; ?>">

												<div class="form-group mb-0">
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" id="article_btn" name="submit" class="btn btn-danger"><span class="btn-text">Save Changes</span></button>
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
	<script src="cpanel/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>
  <script src="cpanel/vendors/bower_components/wysihtml5x/dist/wysihtml5x.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js"></script>
  <script src="cpanel/dist/js/bootstrap-wysuhtml5-data.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


</body>

</html>
