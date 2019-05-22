<?php 
	if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: article.php');
}
	else{

	extract($_GET);

	$id = strip_tags($id);// tente de retourner la chaîne str après avoir supprimé tous les octets nuls, toutes les balises PHP et HTML du code.
	require_once('config/fonction.php');
	removeCommentAdmin($id,$article);
	}

 ?>