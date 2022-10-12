<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');

if (isset($_GET['key'])) {
  $tag = $_GET['key'];

}else{
  if (WBCleanURL == "true") {
  header("location:../../");
  }else{
  header("location:../");
  }
}

$rpp = 7;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  if ($page=="" || $page=="1")
  {
  $page1 = 0;
  $page = 1;
  }else{
  $page1 = ($page*$rpp)-$rpp;
  }
  }else{
  $page1 = 0;
  $page = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title><?php echo WBName; ?> - <?php echo $tag; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <?php
  if (WBCleanURL == "true") {
  ?><base href="../"><?php
  }else{
  ?><base href="../"><?php
  }
  ?>
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
	<?php echo WBScript; ?>


</head>

<body id="SELECTOR">

	<div class="body-inner" id="body-inner">

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
  				<div class="col-sm-12">
  					<ol class="breadcrumb">
       					<li><a href="./">Home</a></li>
                <li>Tags</li>
       					<li><?php echo $tag; ?></li>
       				</ol>
  				</div>
  			</div>
  		</div>
  	</div>

	<section class="block-wrapper">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 col-md-12">

					<div class="block category-listing category-style2 color-red">
						<h3 class="block-title"><span>Latest News</span></h3>

						<?php

						function number_abbr($number)
						{
						$abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

						foreach ($abbrevs as $exponent => $abbrev) {
							if (abs($number) >= pow(10, $exponent)) {
								$display = $number / pow(10, $exponent);
								$decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
								$number = number_format($display, $decimals).$abbrev;
								break;
							}
						}

						return $number;
						}

						try {
						$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $keyword = "%$tag%";

						$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' AND tbl_blog_posts.tags LIKE ? ORDER BY tbl_blog_posts.id DESC LIMIT $page1,7");
						$stmt->execute([$keyword]);
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
							<div class="post-block-style post-list clearfix">
								<div class="row">
									<div class="col-lg-5 col-md-6">
										<div class="post-thumb thumb-float-style">
											<a href="<?php echo $blog_link; ?>">
												<img class="img-fluid blog_image" src="images/blog/<?php echo $row[5]; ?>" alt="">
											</a>
											<a class="post-cat" href="<?php echo $category_link; ?>"><?php echo $row[12]; ?></a>
										</div>
									</div>

									<div class="col-lg-7 col-md-6">
										<div class="post-content">
								 			<h2 class="post-title title-large txt_limit">
								 				<a href="<?php echo $blog_link; ?>"><?php echo $row[1]; ?></a>
								 			</h2>
								 			<div class="post-meta">
								 				<span class="post-date"><?php echo $row[2]; ?></span>
								 				<span class="post-comment pull-right"><i class="feather icon-eye"></i>
												<a class="comments-link"><span><?php echo number_abbr($row[4]); ?></span></a></span>
								 			</div>
								 			<p class="txt_limit2"><?php echo $row[7]; ?></p>
							 			</div>
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

					</div>

          <div class="paging">
                <ul class="pagination">
                  <?php
                  $add_query = "?";
                  if (WBCleanURL == "true") {
                  $href = "tags/$tag";
                  }else{
                  $href = "pages/tags?key=$tag";
                  }
                  $keyword = "%$tag%";
                  try

                  {
                  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $rec = 0;
                  $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE visibility = '1' AND tags = ?");
                  $stmt->execute([$keyword]);
                  $result = $stmt->fetchAll();
                  $rec = count($result);
                  $total_pages = $rec /$rpp;
                  $total_pages = ceil($total_pages);

                  $totalpage      = $total_pages;
                  $currentpage    = (isset($_GET['page']) ? $_GET['page'] : 1);
                  $firstpage      = 1;
                  $lastpage       = $totalpage;
                  $loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
                  $startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );
                  $pagination = "";
                  if($totalpage > 1) {
                    $pagination .= '<li><a aria-label="Previous" href="'.$href.''.$add_query.'&page=1" id="1-page"><span aria-hidden="true"><i class="fa fa-long-arrow-left"></i></span></a></li>';
                    for($i = $startCounter; $i <= $loopcounter; $i++)
                    {
                      if ($i == $page) {
                      $pagination .= '<li class="active"><a  href="'.$href.''.$add_query.'&page='.$i.'">'.$i.'</a></li>';
                      }else{
                      $pagination .= '<li><a  href="'.$href.''.$add_query.'&page='.$i.'">'.$i.'</a></li>';
                      }

                    }
                    $pagination .= '<li><a aria-label="Next" href="'.$href.''.$add_query.'&page='.$totalpage.'"  id="'.$totalpage.'-page"><span aria-hidden="true"><i class="fa fa-long-arrow-right"></i></span></a></li>';
                  }
                  }catch(PDOException $e)
                  {

                  }
                  echo $pagination;
                  ?>
                </ul>
              </div>


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

									$stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' ORDER BY tbl_blog_posts.views DESC LIMIT 5");
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

						<div class="widget text-center">
								<?php include '../const/banners/300250.php'; ?>
						</div>

						<div class="widget m-bottom-0">
							<h3 class="block-title"><span>Newsletter</span></h3>
							<div class="ts-newsletter">
								<div class="newsletter-introtext">
									<h4>Get Updates</h4>
									<p>Subscribe to our newsletter to get the best stories into your inbox!</p>
								</div>

								<div class="newsletter-form">
										<div class="form-group">
											<input type="email" id="newsletter-form-email" class="form-control form-control-lg" placeholder="Enter your E-mail" autocomplete="off">
											<button id="subscription" class="btn btn-primary">Subscribe</button>
										</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>

		</div>
	</section>




	<section class="ad-content-area text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php include '../const/banners/72890.php'; ?>
				</div>
			</div>
		</div>
	</section>
	<?php require_once('../const/draws/footer.php'); ?>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="js/smoothscroll.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	</div>
</body>

</html>
