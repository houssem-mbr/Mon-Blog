<?php
require_once('config/fonction.php');
$user=  getuser();
if (!empty($_POST)) {
			extract($_POST);
		$title = trim($title);//pour supprimer les espaces dans la requête de l'internaute
		$title = strip_tags($title);
		$recherche=search($title);
			
		}
		$articles= getArticles();
		$user=  getuser();
		$category = getCategory();
		$latestcomments = getLatestComments();
		$popular = getPopularArticle();
		$latestbycat = getLatestArticlesByCategory();
		$random = getArticleRand();
		$videos = latestVideo();
		$allvid= allVideo();
include('resultat.phtml');
?>
