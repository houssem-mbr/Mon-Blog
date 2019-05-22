
<?php 
	require ('config/connect.php');
	require_once('config/fonction.php'); 

	if (!empty($_POST)) {

		extract($_POST);
		$errors = array();
		$email = strip_tags($email);
		$password = strip_tags($password);
		$tab=getuser();
		//var_dump($tab);
		if (empty($email)) {
			array_push($errors, "T'as oublier ton email !!");
		}
		if (empty($password)) {
			array_push($errors, "T'as oublier de taper votre mot de passe !!");
		}
		if (!empty($email) || !empty($password)){
			foreach ($tab as $value) {
				
				if(($email != $value->email)) {
				array_push($errors, "Adresse email incorrect !!");
				}
				if (($password != $value->password)) {
				array_push($errors, "Mot de passe incorrect !!");
				}
				if (($email == $value->email) && ($password==$value->password)) {

				header('Location: admin.php?id='.$value->id);
			
				}
			}
		}
		
	}
include('login.phtml');


?>
