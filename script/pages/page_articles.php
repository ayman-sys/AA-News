<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');
//Query Builder:
require_once('../const/query_builder.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title><?php echo WBName; ?> - <?php echo $title; ?></title>
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
            <?php
            if ($is_searched == "1") {
              ?><input required value="<?php echo $query; ?>" type="text" name="query" class="form-control" placeholder="Type what you want and hit enter"><?php
            }else{
              ?><input required type="text" name="query" class="form-control" placeholder="Type what you want and hit enter"><?php
            }
            ?>

  					<input type="hidden" name="search" value="???">
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
     					<li><?php echo $title; ?></li>
     				</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="block-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">

					<div class="block category-listing">
						<h3 class="block-title"><span>Articles</span></h3>

						<div class="row">

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

              $stmt = $conn->prepare($query_1);
              if ($is_searched == "1") {
                $stmt->execute([$keyword]);
              }else{
                $stmt->execute();
              }


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

                <div class="col-md-4">
                  <div class="post-block-style post-grid clearfix">
                    <div class="post-thumb">
                      <a href="<?php echo $blog_link; ?>">
                        <img class="img-fluid blog_image_article" src="images/blog/<?php echo $row[5]; ?>" alt="">
                      </a>
                    </div>
                    <a class="post-cat" href="<?php echo $category_link; ?>"><?php echo $row[12]; ?></a>
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

                <?php
              }
              }catch(PDOException $e)
              {
              echo "Connection failed: " . $e->getMessage();
              }
              ?>





						</div>
					</div>

					<div class="paging">
		            <ul class="pagination">
                  <?php
                  if ($is_searched == "1") {
                    $add_query = '?query='.$query.'&search=???';
                  }else{
                    $add_query = "?";
                  }

                  $href = "articles";
                  try

                  {
                  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $rec = 0;
                  $stmt = $conn->prepare($query_2);
                  if ($is_searched == "1") {
                    $stmt->execute([$keyword]);
                  }else{
                    $stmt->execute();
                  }
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
	</div>
</body>

</html>
