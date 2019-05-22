<?php 

require_once('../config/fonction.php');
$articles= getArticles();
$latest = getLatestArticles();
$user=  getuser();
$category = getCategory();
$latestcomments = getLatestComments();
$popular = getPopularArticle();
$latestbycat = getLatestArticlesByCategory();
$random = getArticleRand();
$videos = latestVideo();
$allvid= allVideo();
	

 ?>
 