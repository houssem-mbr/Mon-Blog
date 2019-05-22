<?php 

require_once('config/fonction.php');
$articles= getArticles();
$user=  getuser();
$category = getCategory();
$latestcomments = getLatestComments();
	$videos = latestVideo();
	$popular = getPopularArticle();
	$nombre = nbrArticles();
	$categorynbr = getCategoryByNombreAr();
include('posts.phtml');

 ?>
 