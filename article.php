<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: index.php');
}
else{
	extract($_GET);//Importe les variables dans la table des symboles
	$id = strip_tags($id);// tente de retourner la chaîne str après avoir supprimé tous les octets nuls, toutes les balises PHP et HTML du code.
	require_once('config/fonction.php');
	$article = getArticle($id);
	$comments=  getComments($id);
	$users=  getArticleAdmin($id);
	$nombre = getCommentsNombre($id);
	$random = getArticleRand();
	$user=  getuser();
}
include('article.phtml');
?>