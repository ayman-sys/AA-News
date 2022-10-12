<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title><?php echo WBName; ?> - Contact Us</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="<?php echo WBDescription; ?>" />
	<meta name="keywords" content="<?php echo WBKeywords; ?>" />
	<link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<meta name="author" content="Bwiresoft"/>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/colorbox.css">
	<link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
	<?php echo WBScript; ?>


</head>

<body id="SELECTOR">

	<div class="body-inner"  id="body-inner">


    <div class="trending-bar d-md-block d-lg-block d-none">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<h3 class="trending-title">Latest News</h3>
  					<div id="trending-slide" class="owl-carousel owl-theme trending-slide">
  						<?php

  						try {
  						$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  						$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' ORDER BY tbl_blog_posts.id DESC LIMIT 5");
  						$stmt->execute();
  						$result = $stmt->fetchAll();

  						foreach($result as $row)
  						{
  							$id = $row[0];

  							if (WBCleanURL == "true") {
  								$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
  								$st2 =  preg_replace('/\s+/', ' ', $st1);
  								$article_title = strtolower(str_replace(' ', '-', $st2));
  								$blog_link = "article/$id/$article_title";
  							}else{
  								$blog_link = "pages/article?key=$id";
  							}
  							?>
  							<div class="item">
  								 <div class="post-content">
  										<h2 class="post-title title-small">
  											 <a href="<?php echo $blog_link; ?>"><?php echo $row[1]; ?></a>
  										</h2>
  								 </div>
  							</div>
  							<?php
  						}
  						}catch(PDOException $e)
  						{
  						echo "Connection failed: " . $e->getMessage();
  						}
  						?>

  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

    <div id="top-bar" class="top-bar">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-8">
  					<div class="ts-date">
  						<i class="fa fa-calendar-check-o"></i><?php echo date('F d, Y'); ?>
  					</div>
  					<ul class="unstyled top-nav">
  						<li><a href="login">Admin Panel</a></li>
  						<li><a href="articles">Browse Articles</a></li>
  						<li><a href="contact">Contact</a></li>
  					</ul>
  				</div>

  				<div class="col-md-4 top-social text-lg-right text-md-center">
  					<ul class="unstyled">
  						<li>

  						<?php

  						try {
  						$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  						$stmt = $conn->prepare("SELECT * FROM tbl_social_links ORDER BY id LIMIT 10");
  						$stmt->execute();
  						$result = $stmt->fetchAll();

  						foreach($result as $row)
  						{
  							if ($row[2] == "#") {
  								?>
  								<a title="<?php echo $row[1]; ?>" href="javascript:void(0);">
  									<span class="social-icon"><i class="<?php echo $row[3]; ?>"></i></span>
  								</a>
  								<?php
  							}else{
  								?>
  								<a title="<?php echo $row[1]; ?>" href="redirect?link=<?php echo $row[2]; ?>">
  									<span class="social-icon"><i class="<?php echo $row[3]; ?>"></i></span>
  								</a>
  								<?php
  							}

  						}
  						}catch(PDOException $e)
  						{
  						echo "Connection failed: " . $e->getMessage();
  						}
  						?>
  						</li>
  					</ul>
  				</div>
  			</div>
  		</div>
  	</div>

    <header id="header" class="header">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-3 col-sm-12">
  					<div class="logo">
  						 <a href="./">
  							<img src="images/logos/<?php echo WBLogo; ?>" alt="">
  						 </a>
  					</div>
  				</div>

  				<div class="col-md-9 col-sm-12 header-right">

  					<div class="ad-banner float-right">
  						<?php include '../const/banners/72890.php'; ?>
  					</div>
  				</div>
  			</div>
  		</div>
  	</header>

    <div class="main-nav clearfix">
  		<div class="container">
  			<div class="row">
  				<nav class="navbar navbar-expand-lg col">
  					<div class="site-nav-inner float-left">
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                 </button>

  						<div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
  							<ul class="nav navbar-nav">
  								<?php

  								try {
  								$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  								$stmt = $conn->prepare("SELECT * FROM tbl_categories ORDER BY name LIMIT 9");
  								$stmt->execute();
  								$result = $stmt->fetchAll();

  								foreach($result as $row)
  								{
  									$id = $row[0];

  									if (WBCleanURL == "true") {
  										$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
  										$st2 =  preg_replace('/\s+/', ' ', $st1);
  										$cat_title = strtolower(str_replace(' ', '-', $st2));

  										$cat_link = "category/$id/$cat_title";
  									}else{
  										$cat_link = "pages/category?key=$id";
  									}

  									?>
  									<li>
  										<a href="<?php echo $cat_link; ?>"><?php echo $row[1]; ?></a>
  									</li>
  									<?php
  								}
  								}catch(PDOException $e)
  								{
  								echo "Connection failed: " . $e->getMessage();
  								}
  								?>

  							</ul>
  						</div>

  					</div>
  				</nav>

  				<div class="nav-search">
  					<span id="search"><i class="fa fa-search"></i></span>
  				</div>

  				<div class="search-block" style="display: none;">
  					<form action="articles" method="GET" autocomplete="OFF">
  					<input required type="text" name="query" class="form-control" placeholder="Type what you want and hit enter">
  					<input type="hidden" name="search" value="✓">
  					<span class="search-close">&times;</span>
  				</form>
  				</div>
  			</div>
  		</div>

  	</div>


	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
     					<li><a href="./">Home</a></li>
     					<li>Contact Us</li>
     				</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="block-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">

				<div class="widget contact-info mb-3">

					<div class="contact-info-box">
						<div class="contact-info-box-content">
							<h4><?php echo WBName; ?> Physical Location</h4>
							<p><?php echo WBAddress; ?></p>
						</div>
					</div>

					<div class="contact-info-box">
						<div class="contact-info-box-content">
							<h4>Mail Us</h4>
							<p><?php echo WBEmail; ?></p>
						</div>
					</div>

					<div class="contact-info-box">
						<div class="contact-info-box-content">
							<h4>Call Us</h4>
							<p><?php echo WBPhone; ?></p>
						</div>
					</div>

				</div>

				<h3>Contact Form</h3>
	    			<div class="error-container" id="error-container"></div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
								<input class="form-control form-control-name txt-cap" name="name" id="name" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control form-control-email" name="email" id="email" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Subject</label>
									<input class="form-control form-control-subject txt-cap" name="subject" id="subject">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="30" required></textarea>
						</div>

						<div class="text-right"><br>
							<button id="send-msg" class="btn btn-primary solid blank" >Send Message</button>
						</div>
					</form>



				</div>

				<div class="col-lg-4 col-md-12">
					<div class="sidebar sidebar-right">

            <div class="widget color-default">
							<h3 class="block-title"><span>Popular News</span></h3>

							<?php


							try {
							$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

							$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' ORDER BY tbl_blog_posts.views DESC LIMIT 1");
							$stmt->execute();
							$result = $stmt->fetchAll();

							foreach($result as $row)
							{
								$id = $row[0];
								$cat_id = $row[3];

								if (WBCleanURL == "true") {
									$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
									$st2 =  preg_replace('/\s+/', ' ', $st1);
									$article_title = strtolower(str_replace(' ', '-', $st2));
									$blog_link = "article/$id/$article_title";

									$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[12]);
									$st2 =  preg_replace('/\s+/', ' ', $st1);
									$category_title = strtolower(str_replace(' ', '-', $st2));
									$category_link = "category/$cat_id/$category_title";
								}else{
									$blog_link = "pages/article?key=$id";
									$category_link = "pages/category?key=$cat_id";
								}
								?>
								<div class="post-overaly-style clearfix">
									<div class="post-thumb">
											<a href="<?php echo $blog_link; ?>">
													<img class="img-fluid blog_image_2" src="images/blog/<?php echo $row[5]; ?>" alt="">
											</a>

									</div>

									<div class="post-content">
										<a class="post-cat" href="<?php echo $category_link; ?>"><?php echo $row[12]; ?></a>
										<h2 class="post-title title-small txt_limit">
											<a href="<?php echo $blog_link; ?>"><?php echo $row[1]; ?></a>
										</h2>
										<div class="post-meta">
											<span class="post-date"><?php echo $row[2]; ?></span>
										</div>
									</div>
								</div>
								<?php
							}
							}catch(PDOException $e)
							{
							echo "Connection failed: " . $e->getMessage();
							}
							?>





							<div class="list-post-block">
								<ul class="list-post">
									<?php


									try {
									$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

									$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' ORDER BY tbl_blog_posts.views DESC LIMIT 4");
									$stmt->execute();
									$result = $stmt->fetchAll();
									$st = 0;

									foreach($result as $row)
									{
										$id = $row[0];
										$cat_id = $row[3];

										if (WBCleanURL == "true") {
											$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
											$st2 =  preg_replace('/\s+/', ' ', $st1);
											$article_title = strtolower(str_replace(' ', '-', $st2));
											$blog_link = "article/$id/$article_title";

											$st1 = preg_replace("/[^a-zA-Z]/", " ", $row[12]);
											$st2 =  preg_replace('/\s+/', ' ', $st1);
											$category_title = strtolower(str_replace(' ', '-', $st2));
											$category_link = "category/$cat_id/$category_title";
										}else{
											$blog_link = "pages/article?key=$id";
											$category_link = "pages/category?key=$cat_id";
										}

										?>
										<li class="clearfix">
											<div class="post-block-style post-float clearfix">
												<div class="post-thumb">
													<a href="<?php echo $blog_link; ?>">
														<img class="img-fluid blog_image_mini" src="images/blog/<?php echo $row[5]; ?>" alt="">
													</a>
													<a class="post-cat" href="<?php echo $category_link; ?>"><?php echo $row[12]; ?></a>
												</div>

												<div class="post-content">
													<h2 class="post-title title-small txt_limit2">
														<a href="<?php echo $blog_link; ?>"><?php echo $row[1]; ?></a>
													</h2>
													<div class="post-meta">
														<span class="post-date"><?php echo $row[2]; ?></span>
													</div>
												</div>
											</div>
										</li>

										<?php
									}
									}catch(PDOException $e)
									{
									echo "Connection failed: " . $e->getMessage();
									}
									?>

								</ul>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</section>


  <?php require_once('../const/draws/footer.php'); ?>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="js/smoothscroll.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="js/contact.js"></script>
	<script src="plugins/loader/waitMe.js"></script>

	</div>
</body>

</html>
