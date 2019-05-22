<?php 
//$firstname = $name = $email = $phone = $message= "";//L'utilisateur n'a pas envoyer les données
//$firstnameError = $nameError = $emailError = $phoneError = $messageError= "";
//$isSuccess = false;//message d'envoi valider false à l'ouverture de page
					//---on remplace pour amélioration ajax les variable en cette façon----
$array = array ("firstname" => "","name" => "","email" => "","phone" => "","message" => "","firstnameError" => "","nameError" => "","emailError" => "","phoneError" => "","messageError" => "","isSuccess" => false);//envoyer les infos vers ajax (script.js) sous forme d'un fichier type json

$emailTo = "houssemeddinemabrouk@gmail.com";//Variable qui reçoit l'adresse email de l'admin(Mon email par exemple) on n'a pas besoin de l'envoyer au js 

if ($_POST) {       //oui je suis dans la 2ème lecture l'utilisateur a envoyer les donneés 
	//Appel des inputs depuis le formulaire
	$array["firstname"]= verifyInput($_POST["firstname"]);//au lieu de $firstname on fait $array["firstname"] value de firstname
	$array["name"] = verifyInput($_POST["name"]);
	$array["email"] = verifyInput($_POST["email"]);
	$array["phone"] = verifyInput($_POST["phone"]);
	$array["message"] = verifyInput($_POST["message"]);
	$array["isSuccess"] = true; //message d'envoi valider prend true lorsque on appuis sur le envoyer 
	$emailText = "";//Variable qui contient le Contenu de cet email (vide ici)
	//-----------------------------------------------
	//Validation des inputs coté serveur 
	//-----------------------------------------------
	if (empty($array["firstname"])) {
		$array["firstnameError"] = "Je veux connaitre ton prénom !!";
		$array["isSuccess"] = false;//si pas valide message d'envoi valider false 
	}
	else{
		$emailText .= "FirstName: {$array["firstname"]}\n";//Si il n'ya pas d'erreur $emailtext reçoit l'input//les {} remplace la concatination 
	}

	if (empty($array["name"])) {
		$array["nameError"] = "Et oui je veux tout savoir. Mème ton nom !!";
		$array["isSuccess"] = false;//si pas valide message d'envoi valider false 
	}
	else{
		$emailText .= "Name: {$array["name"]}\n";//Si il n'ya pas d'erreur $emailtext reçoit l'input et l'ajoute à qui précede par (.=)
	}

	if (!isEmail($array["email"])) {
		$array["emailError"] = "T'essaies de me rouler ? c'est pas un email ça !!";
		$array["isSuccess"] = false;//si pas valide message d'envoi valider false 
	}
	else{
		$emailText .= "Email: {$array["email"]}\n";//Si il n'ya pas d'erreur $emailtext reçoit l'input et l'ajoute à qui précede par (.=)
	}

	if (!isPhone($array["phone"])) {
		$array["phoneError"] = "Que des chiffres et des espaces, stp... !!";
		$array["isSuccess"] = false;//si pas valide message d'envoi valider false 
	}
	else{
		$emailText .= "Phone: {$array["phone"]}\n";//Si il n'ya pas d'erreur $emailtext reçoit l'input et l'ajoute à qui précede par (.=)
	}
	
	if (empty($array["message"])) {
		$array["messageError"] = "Qu'est-ce que tu veux me dire !!";
		$array["isSuccess"] = false;//si pas valide message d'envoi valider false 
	}
	else{
		$emailText .= "Message: {$array["message"]}\n";//Si il n'ya pas d'erreur $emailtext reçoit l'input et l'ajoute à qui précede par (.=)
	}

	if ($array["isSuccess"]) {
		$headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReplay-To {$array["email"]}";
		mail($emailTo,"Un message de votre site",$emailText,$headers);//Fonction PHP pour l'envoi de l'email aprés validations des inputs prend mon email,message objet,emailtext

		//Envoie à la base des données---------------------------------------------------
		$host = "localhost";//nom de hote de de l'hébergeur //localhost mème en hébergement
		$username = "root";//Nom d'utilisateur//username de base des données
		$password = ""; //mot de passe de base de donnée
		$db="blog"; //Nom de la base des données
		try {
    		$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    		}
		catch(PDOException $e)
   		{
   			echo "Connection failed: " . $e->getMessage();
   		}


		$query = $conn->prepare("INSERT INTO `contacts`( `prenom`, `nom`, `adresseMail`, `phone`,`message`) VALUES (?,?,?,?,?)");
		$tab=[$array["firstname"],$array["name"],$array["email"],$array["phone"],$array["message"]];
		$query->execute($tab);
//-------------------------------------------------------------------------------------------
		}
	echo json_encode($array);//renvoyer le travaille de ce php (encode moi en objet json le $array qui contient tout le résultat de travaille php)

};
//------------------------------------------------------
//Cas spécial: fonction pour validation de l'email
//------------------------------------------------------
function isEmail($var){
	return filter_var($var,FILTER_VALIDATE_EMAIL);//filter_var prendre le variable et le comparer a un filter,
	//FILTER_VALIDATE_EMAIL:Check if the variable $email is a valid email address
}
//----------------------------------------------------------
//Cas spécial:  fonction pour validation de téléphone
//----------------------------------------------------------
function isPhone($var){
	return preg_match("/^[0-9 ]*$/",$var);//savoir si ma variable respecte les lois de cette expression réguliere
}
//-----------------------------------------------------------------------------
//Fonction pour la Sécurité de formulaire: vérifier les inputs------
//------------------------------------------------------------------------------
function verifyInput($var){
	$var = trim($var);//
	//Supprime les espaces (ou d'autres caractères) en début et fin de chaîne  retourne la chaîne str, après avoir supprimé les caractères invisibles en début et fin de chaîne
	$var = stripcslashes($var);//enlever tout les anti slash
	$var = htmlspecialchars($var);
	return $var;
};
//-------------------------------------------------------------------------------


 ?>
 