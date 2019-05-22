<?php
if(isset($_POST['nom'])){
		$errors = array();
		$nom= $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$message = $_POST['demande'];
		//var_dump($tab);
		if (empty($nom)) {
			array_push($errors, "T'as oublier ton nom !!");
		}
		if (empty($prenom)) {
			array_push($errors, "T'as oublier ton prénom !!");
		}
		if (empty($email)) {
			array_push($errors, "T'as oublier ton email !!");
		}
		if (empty($message)) {
			array_push($errors, "T'as oublier ton demande !!");
		}
		if (empty($errors)){

			$pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
			$pdo->exec('SET NAMES UTF8');//
			$query = $pdo->prepare("INSERT INTO `demande`( `nom`, `prenom`, `email`, `message`,`date`) VALUES (?,?,?,?,NOW())");
			$tab=[$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['demande']];
			$query->execute($tab);
			$success = 'Votre demande a été envoyé on va le traité le plut tôt possible';
			
		}
}
include 'requestadmin.phtml';
?>