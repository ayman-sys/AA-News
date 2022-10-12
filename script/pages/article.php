<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');


if (isset($_GET['key'])) {
  $blog_id = $_GET['key'];

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

  $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id  WHERE tbl_blog_posts.id = ? ");
  $stmt->execute([$blog_id]);
  $result = $stmt->fetchAll();

  if (count($result) < 1) {

    if (WBCleanURL == "true") {
    header("location:../../");
    }else{
    header("location:../");
    }

  }else{
    foreach($result as $row)
    {
      $title = $row[1];
      $category_id = $row[3];
      $category = $row[12];
      $media = $row[5];
      $cont = $row[6];
      $short_desc = $row[7];
      $yt_vid = $row[8];
      $tags = $row[9];
      $visibilty = $row[10];
      $post_date = $row[2];
      $post_views = number_abbr($row[4]);

      if (WBCleanURL == "true") {
        $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[12]);
        $st2 =  preg_replace('/\s+/', ' ', $st1);
        $cat_title = strtolower(str_replace(' ', '-', $st2));

        $post_cat_link = "category/$category_id/$cat_title";
      }else{
        $post_cat_link = "pages/category?key=$category_id";
      }

    }

    $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE id < ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$blog_id]);
    $result = $stmt->fetchAll();
    $previous_post = "";
    $prev_link = "";
    foreach($result as $row) {
      if (WBCleanURL == "true") {
        $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
        $st2 =  preg_replace('/\s+/', ' ', $st1);
        $prev_title = strtolower(str_replace(' ', '-', $st2));
        $prev_id = $row[0];

        $prev_link = "article/$prev_id/$prev_title";
        $prev_nme = $row[1];
      }else{
        $prev_link = "pages/article?key=$prev_id";
        $prev_nme = $row[1];
      }
    }




    $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE id > ? ORDER BY id ASC LIMIT 1");
    $stmt->execute([$blog_id]);
    $result = $stmt->fetchAll();
    $previous_post = "";
    $next_link = "";
    foreach($result as $row) {
      if (WBCleanURL == "true") {
        $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
        $st2 =  preg_replace('/\s+/', ' ', $st1);
        $next_title = strtolower(str_replace(' ', '-', $st2));
        $next_id = $row[0];

        $next_link = "article/$next_id/$next_title";
        $next_nme = $row[1];
      }else{
        $next_link = "pages/article?key=$next_id";
        $next_nme = $row[1];
      }
    }


    $stmt = $conn->prepare("SELECT * FROM tbl_admin LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row) {
      $ad_name = ''.$row[1].' '.$row[2].'';
      $ad_email = $row[3];
      $ad_about = $row[4];
      $ad_avator = $row[6];
    }


  }


  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }

}else{
  if (WBCleanURL == "true") {
  header("location:../../");
  }else{
  header("location:../");
  }
}
$sharelink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//Count Visitor:
require_once('../const/blog_views.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo WBName; ?> - <?php echo $title; ?></title>
  <?php
  if (WBCleanURL == "true") {
  ?><base href="../../"><?php
  }else{
  ?><base href="../"><?php
  }
  ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="description" content="<?php echo WBDescription; ?>" />
	<meta name="keywords" content="<?php echo WBKeywords; ?>" />
	<link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
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
  					<h3 class="trending-title">Latest Posts</h3>
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
     				  <li><a href="articles">Articles</a></li>
              <li><?php echo $title; ?></a></li>
     				</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="block-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">

					<div class="single-post">

						<div class="post-title-area">
							<a class="post-cat" href="<?php echo $post_cat_link; ?>"><?php echo $category; ?></a>
							<h2 class="post-title">
				 				<?php echo $title; ?>
				 			</h2>
				 			<div class="post-meta">
								<span class="post-date"><i class="feather icon-clock"></i> <?php echo $post_date; ?></span>
								<span class="post-comment"><i class="feather icon-eye"></i>
								<span><?php echo $post_views; ?></span></span>
							</div>
						</div>

						<div class="post-content-area">
							<div class="entry-content">
                <?php
                if ($yt_vid == "") {
                  ?>
                  <div class="post-media post-featured-image">
                  <img src="images/blog/<?php echo $media; ?>" class="img-fluid single_blog" alt="">
                  </div>
                  <?php
                }else{
                  ?>
                  <div class="post-media post-video">
                    <div class="embed-responsive">
                      <iframe src="https://www.youtube.com/embed/<?php echo $yt_vid; ?>"></iframe>
                    </div>
                  </div>
                  <?php
                }
                ?>
                <?php echo $cont?>

							</div>

							<div class="tags-area clearfix">
								<div class="post-tags">
									<span>Tags:</span>
                  <?php
                  $post_tags = explode(",",$tags);
                  foreach ($post_tags as $tag) {

                    if (WBCleanURL == "true") {
                      $st1 = preg_replace("/[^a-zA-Z]/", " ", $tag);
                      $st2 =  preg_replace('/\s+/', ' ', $st1);
                      $tag_title = strtolower(str_replace(' ', '-', $st2));

                      $tag_link = "tags/$tag_title";
                    }else{
                      $tag_link = "pages/tags?key=$tag_title";
                    }

                  ?><a href="<?php echo $tag_link; ?>"><?php echo $tag; ?></a><?php
                  }
                  ?>
	   						</div>
							</div>

							<div class="share-items clearfix">
   							<ul class="post-social-icons unstyled">
   								<li class="facebook">
   									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $sharelink; ?>">
   									<i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a>
   								</li>
   								<li class="twitter">
   									<a href="https://twitter.com/intent/tweet?url=<?php echo $sharelink; ?>">
   									<i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a>
   								</li>

                  <li class="whatsapp">
                    <a href="https://api.whatsapp.com?url=<?php echo $sharelink; ?>">
                    <i class="fa fa-whatsapp"></i> <span class="ts-social-title">whats app</span></a>
                  </li>


   								<li class="gplus">
   									<a href="mailto:info@example.com?&subject=&cc=&bcc=&body=<?php echo $sharelink; ?>">
   									<i class="fa fa-envelope"></i> <span class="ts-social-title">Email</span></a>
   								</li>
   							</ul>
   						</div>

						</div>
					</div>

					<nav class="post-navigation clearfix">
                  <div class="post-previous">
                    <?php
                    if ($prev_link == "") {
                    ?>
                    <a href="javascript:void(0);">
                        <span><i class="fa fa-angle-left"></i>Previous Post</span>
                        <h3>

                        </h3>
                    </a>
                    <?php
                    }else{
                      ?>
                      <a href="<?php echo $prev_link; ?>">
                          <span><i class="fa fa-angle-left"></i>Previous Post</span>
                          <h3>
                            <?php echo $prev_nme; ?>
                          </h3>
                      </a>
                      <?php
                    }
                    ?>

                  </div>
                  <div class="post-next">

                    <?php
                    if ($next_link == "") {
                      ?>
                      <a href="javascript:void(0);">
                          <span>Next Post <i class="fa fa-angle-right"></i></span>
                          <h3>

                          </h3>
                      </a>
                      <?php
                    }else{
                      ?>
                      <a href="<?php echo $next_link; ?>">
                          <span>Next Post <i class="fa fa-angle-right"></i></span>
                          <h3>
                            <?php echo $next_nme; ?>
                          </h3>
                      </a>
                      <?php
                    }
                    ?>
                  </div>
               </nav>

					<div class="author-box">
						<div class="author-img pull-left">
							<img class="auth_av_post" src="images/user/<?php echo $ad_avator; ?>" alt="">
						</div>
						<div class="author-info">
							<h3><?php echo $ad_name; ?></h3>
							<p class="author-url"><a href="mailto:<?php echo $ad_email; ?>"><?php echo $ad_email; ?></a></p>
							<p><?php echo $ad_about; ?></p>
							<div class="authors-social">
              <span>Follow Me: </span>
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

              </div>
						</div>
					</div>

					<div class="related-posts block">
						<h3 class="block-title"><span>Related Posts</span></h3>

						<div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">

              <?php

              try {
              $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' AND tbl_blog_posts.category = ? AND tbl_blog_posts.id != ? ORDER BY tbl_blog_posts.id DESC LIMIT 5");
              $stmt->execute([$category_id, $blog_id]);
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
                  $category_title = strtolower(str_replace(' ', '-', $st2));
                  $category_link = "category/$cat_id/$category_title";
                }else{
                  $blog_link = "pages/article?key=$id";
                  $category_link = "pages/category?key=$cat_id";
                }
                ?>
                <div class="item">
                  <div class="post-block-style clearfix">
                    <div class="post-thumb">
                      <a href="<?php echo $blog_link; ?>"><img class="img-fluid" src="images/blog/<?php echo $row[5]; ?>" alt="" /></a>
                    </div>
                    <a class="post-cat" href="<?php echo $category_link; ?>"><?php echo $row[12]; ?></a>
                    <div class="post-content">
                      <h2 class="post-title title-medium txt_limit">
                        <a href="<?php echo $blog_link; ?>"><?php echo $row[1]; ?></a>
                      </h2>
                      <div class="post-meta">
                        <span class="post-date"><?php echo $row[2];?></span>
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

					</div>

					<div id="comments" class="comments-area block">
						<h3 class="block-title"><span>Comments</span></h3>

						<ul class="comments-list">
              <div id="disqus_thread"></div>
              <script>
                  var disqus_config = function () {
                  this.page.url = '<?php echo $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>';
                  this.page.identifier = '<?php echo $blog_id;?>';
                  };

                  (function() {
                  var d = document, s = d.createElement('script');
                  s.src = '<?php echo WBDiscus; ?>';
                  s.setAttribute('data-timestamp', +new Date());
                  (d.head || d.body).appendChild(s);
                  })();
              </script>
              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
						</ul>
					</div>

				</div>

				<div class="col-lg-4 col-md-12">
					<div class="sidebar sidebar-right">


						<div class="widget color-default">
							<h3 class="block-title"><span>Popular Posts</span></h3>

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
