<?php 

$array = array ("author" => "","comment" => "","authorerr" => "" ,"commenterr" =>"","isSuccess" => false);
	require_once('config/fonction.php'); 
		extract($_POST);


		$id = $_POST["id"];
		$array["author"]= verifyInput($_POST["author"]);
		$array["comment"] = verifyInput($_POST["comment"]);
		$array["isSuccess"] = true;
		$errors = array();
		if (empty($array["author"])) {
			$array["authorerr"] = "Entrer un pseudo !!";
			$array["isSuccess"] = false;
		}
		if (empty($array["comment"])) {
			$array["commenterr"] = "Entrer un commentaire stp !!";
			$array["isSuccess"] = false;
		}
		if ($array["isSuccess"]) {
			$comment= addComment($id, $author, $comment);
			$success = 'Votre commentaire a été publié';
			unset($author);//vider les champs aprés l'envoi 
			unset($comment);

		}


		$data = getComments($id);
		echo json_encode($data);
		




 ?>