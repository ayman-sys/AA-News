<?php
$rpp = 12;
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

if (!empty($_GET['query'])) {
  if (!empty($_GET['search'])) {
    if ($_GET['search'] == "✓") {
      $is_searched = 1;
      $query = $_GET['query'];
    }else{
      $is_searched = 0;
    }
  }else{
    $is_searched = 0;
  }
}else{
  $is_searched = 0;
}

if ($is_searched == "1") {
$query_1 = "SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' AND tbl_blog_posts.title LIKE ? ORDER BY tbl_blog_posts.id DESC LIMIT $page1,12";
$query_2 = "SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' AND tbl_blog_posts.title LIKE ?";
$keyword = "%$query%";
$title = 'Search for "'.$query.'"';
}else{
$query_1 = "SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1' ORDER BY tbl_blog_posts.id DESC LIMIT $page1,12";
$query_2 = "SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id WHERE tbl_blog_posts.visibility = '1'";
$title = 'Browse Articles';
}

?>
