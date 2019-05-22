<?php 

	require_once('config/fonction.php'); 

	if (!empty($_POST)) {

		extract($_POST);
		$errors = array();
		$name = strip_tags($name);
		if (empty($name)) {
			array_push($errors, "Entrer le catégorie de votre article !!");
		}
		if (count($errors) == 0) {

			addCategory($name); 

			header('Location: admin.php');
		}
	}

include('category.phtml');
?>
