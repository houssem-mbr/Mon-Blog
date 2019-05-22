<?php
if(isset($_POST['prenom'])){
		$errors = array();
		$nom= $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$password = $_POST['password']; 
		//var_dump($tab);
		if (empty($prenom)) {
			array_push($errors, "T'as oublier le prénom !!");
		}
		if (empty($nom)) {
			array_push($errors, "T'as oublier le nom !!");
		}
		if (empty($email)) {
			array_push($errors, "T'as oublier ton email !!");
		}
		if (empty($password)) {
			array_push($errors, "T'as oublier le mot de passe !!");
		}
		if (empty($errors)){

			$pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
			$pdo->exec('SET NAMES UTF8');//
			$query = $pdo->prepare("INSERT INTO `user`( `firstname`, `lastname`, `email`, `password`) VALUES (?,?,?,?)");
			$tab=[$_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['password']];
			$query->execute($tab);
			$success = 'Le nouvelle admin a été bien ajouté';
			
		}
}
include 'addusers.phtml';
?>