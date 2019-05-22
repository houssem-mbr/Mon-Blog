<?php 
	require_once('config/fonction.php'); 
	extract($_GET);//Importe les variables dans la table des symboles
	$id = strip_tags($id);// tente de retourner la chaîne str après avoir supprimé tous les octets nuls, toutes les balises PHP et HTML du code.
    $articles= getCategoryById($id);
	$user=  getuser();
	$category = getCategory();
	$onecatecory = getCategoryByIdOne($id);
	$latestcomments = getLatestComments();
	$videos = latestVideo();
	$popular = getPopularArticle();
	$categorynbr = getCategoryByNombreAr();
	include('getCategory.phtml')
      ?>
