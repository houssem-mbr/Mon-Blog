<?php 

	require_once('config/fonction.php'); 

	$category = getCategory();
     $user=  getuser();
	if (!empty($_POST)) {

		extract($_POST);
		$errors = array();
		$title = strip_tags($title);
		$content= strip_tags($content);
		$cat = strip_tags($cat);
		$use= strip_tags($use);
		$image = strip_tags($image);
		$video = strip_tags($video);
		
		if (empty($title)) {
			array_push($errors, "Entrer le titre de l'article !!");
		}
		if (empty($content)) {
			array_push($errors, "Entrer le corps de l'article !!");
		}
		if (empty($image)) {
			array_push($errors, "Entrer l'image associé au article !!");
		}
		if (empty($video)) {
			array_push($errors, "Entrer le video associé au article !!");
		}
		if (count($errors) == 0) {

			addArticles($title,$content,$use,$cat,$image,$video); 
			$success = 'Votre article a été publié';
			unset($title);//vider les champs aprés l'envoi 
			//unset($content);
			unset($content);
			unset($image);
			unset($video);
			header('Location: admin.php');
		}
	}

include('addPosts.phtml');
?>
