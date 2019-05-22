<?php 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: article.php?id='.$article);
}
else{
	extract($_GET);//Importe les variables dans la table des symboles
	$id = strip_tags($id);// tente de retourner la chaîne str après avoir supprimé tous les octets nuls, toutes les balises PHP et HTML du code.
	require_once('config/fonction.php'); 
		$category = getCategory();
     	$user=  getuser();
     	$article = getArticleUpdate($id);
     	
		if (!empty($_POST)) {
		extract($_POST);
		$errors = array();
		$title = strip_tags($title);
		$content= strip_tags($content);
		$cat = strip_tags($cat);
		$use= strip_tags($use);
		$image= strip_tags($image);
		$video = strip_tags($video);
		if (empty($title)) {
			array_push($errors, "Entrer le titre de l'article !!");
		}
		if (empty($content)) {
			array_push($errors, "Entrer le corps de l'article !!");
		}
		if (empty($image)) {
			array_push($errors, "Entrer le lien de l'image !!");
		}
		if (empty($video)) {
			array_push($errors, "Entrer le lien youtube de l'article !!");
		}
		if (count($errors) == 0) {
			modifierArticle($_POST);
			$success = 'Votre article a été modifié';
			
		}
	}
}
include('modifierArticle.phtml');
 ?>
