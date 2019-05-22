<?php
//Fonction qui récupère tous les articles
function getArticles(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.date, articles.image , category.name FROM articles INNER JOIN category ON articles.idcategory = category.id ORDER BY articles.id DESC');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function nbrArticles(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT COUNT(*) AS nombre FROM articles');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
//Fonction qui récupère un article
function getArticle($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content,articles.date, articles.image, articles.video, category.name FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE articles.id= ?');
	$req->execute(array($id));
	if ($req->rowCount() == 1) {
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
	else{
		header('Location: index.php');
		$req->closeCursor();
	}
}
//Fonction qui ajoute un commentaire en base des données
function addComment($articleId,$author,$comment){
	require('config/connect.php');
	$req = $bdd->prepare('INSERT INTO comments(articleId, author, comment, date) VALUES (?,?,?, NOW())');
	$req->execute(array($articleId, $author, $comment));
	$req->closeCursor();
}
//Fonction qui récupère les commeyaires d'un article
function getComments($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM comments WHERE articleId = ?');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getCommentsNombre($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT *, COUNT(*) AS nombrecomm FROM comments WHERE articleId = ?');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
//Fonction qui ajoute les article à la BD
function addArticles($title,$content,$use,$cat,$image,$video){
	
	require('config/connect.php');
	$req = $bdd->prepare('INSERT INTO articles(title, content,date, iduser,idcategory,image,video) VALUES (?,?,NOW(),?,?,?,?)');
	$req->execute(array($title,$content,$use,$cat,$image,$video));
	$req->closeCursor();
}
function addCategory($name){
	require('config/connect.php');
	$req = $bdd->prepare('INSERT INTO category (name) VALUES (?)');
	$req->execute(array($name));
	$req->closeCursor();
	}
function getCategory(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM category ');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getuser(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM user ');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getArticleUpdate($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content,articles.date,articles.idcategory, articles.image, articles.video, category.name FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE articles.id= ?');
	$req->execute(array($id));
	if ($req->rowCount() == 1) {
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
	else{
		header('Location: admin.php');
		$req->closeCursor();
	}
}
function removeArticle($id){
	require('config/connect.php');
	$req = $bdd->prepare("DELETE FROM articles where id= ?");
$req->execute(array($id));
	header('Location: admin.php');
	$req->closeCursor();
}
/*function removeComment($id,$article){ utilisateur
	require('config/connect.php');
	$req = $bdd->prepare("DELETE FROM comments where id= ?");
$req->execute(array($id));
	header('Location: article.php?id='.$article);
	$req->closeCursor();
}*/
function removeCommentAdmin($id,$article){
	require('config/connect.php');
	$req = $bdd->prepare("DELETE FROM comments where id= ?");
$req->execute(array($id));
	header('Location: update.php?id='.$article);
	$req->closeCursor();
}
function modifierArticle($tab){
	require('config/connect.php');
	
	$req = $bdd->prepare("UPDATE articles SET title =?, content =?, idcategory =?, iduser =?, image=?, video=? WHERE id=?");;
$req->execute([$tab['title'],$tab['content'],$tab['cat'],$tab['use'],$tab['image'],$tab['video'],$tab['id_article_mod']]);
header('Location: update.php?id='.$tab['id_article_mod']);
	$req->closeCursor();
}
function getAdmin($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT * FROM user WHERE user.id = ?');
	$req->execute([$id]);
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getArticleAdmin($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content,articles.date,articles.iduser, user.firstname, user.lastname FROM articles INNER JOIN user ON articles.iduser = user.id WHERE articles.id= ?');
	$req->execute(array($id));
	
		$data = $req->fetch(PDO::FETCH_OBJ);
		return $data;
	}
function getCategoryById($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content,articles.date,articles.idcategory, articles.image, category.name FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE category.id= ?');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
	
}
function getCategoryByIdOne($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT COUNT(articles.idcategory) AS n, articles.id, articles.title, articles.content,articles.date,articles.idcategory, articles.image, category.name FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE category.id= ? LIMIT 1');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getLatestArticles(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.date, articles.image , category.name,articles.idcategory FROM articles INNER JOIN category ON articles.idcategory = category.id ORDER BY articles.id DESC LIMIT 3');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function getLatestComments(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.title,comments.id,comments.articleId,comments.author,comments.date,comments.comment FROM comments INNER JOIN articles ON comments.articleId=articles.id ORDER BY comments.id DESC LIMIT 1');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function getLatestArticlesByCategory()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT category.name, articles.id, articles.idcategory, articles.title, articles.date, articles.image
FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE articles.id IN ( SELECT MAX(articles.id) FROM articles GROUP BY articles.idcategory) ');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function getPopularArticle()
{
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content,articles.date, articles.image, comments.id, articles.id, count(*) AS nbrcomments FROM comments INNER JOIN articles ON comments.articleId = articles.id GROUP BY comments.articleId ORDER BY nbrcomments DESC LIMIT 1');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function getArticleRand(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.id, articles.title, articles.content, articles.date, articles.idcategory, articles.image, category.name FROM articles INNER JOIN category ON articles.idcategory=category.id ORDER BY RAND ()*100');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function search($x){
	require('config/connect.php');
	$req = $bdd->prepare("SELECT articles.id, articles.title, articles.content, articles.date, articles.idcategory, articles.image, category.name FROM articles INNER JOIN category ON articles.idcategory=category.id WHERE articles.title LIKE '$x%' OR category.name LIKE '$x%'");
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function latestVideo(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.video FROM articles ORDER BY articles.id DESC LIMIT 4');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function allVideo(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT articles.video FROM articles ORDER BY articles.id DESC ');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();//Ferme le curseur, permettant à la requête d'être de nouveau exécutée
}
function verifyInput($var){
	$var = trim($var);//
	//Supprime les espaces (ou d'autres caractères) en début et fin de chaîne  retourne la chaîne str, après avoir supprimé les caractères invisibles en début et fin de chaîne
	$var = stripcslashes($var);//enlever tout les anti slash
	$var = htmlspecialchars($var);
	return $var;
};
function getNbrArtByCat($id){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT COUNT(articles.idcategory) AS n , category.name FROM articles INNER JOIN category ON articles.idcategory = category.id WHERE category.id= ?');
	$req->execute(array($id));
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
function addContacts($prenom,$nom,$adresseMail,$phone,$message){
	require('config/connect.php');
	$req = $bdd->prepare('INSERT INTO `contacts`( `prenom`, `nom`, `adresseMail`, `phone`,`message`) VALUES (?,?,?,?,?)');
	$req->execute(array($prenom,$nom,$adresseMail,$phone,$message));
	$req->closeCursor();
}
function getCategoryByNombreAr(){
	require('config/connect.php');
	$req = $bdd->prepare('SELECT category.id, COUNT(articles.idcategory) AS n, category.name FROM articles INNER JOIN category ON articles.idcategory = category.id GROUP BY category.name');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);
	return $data;
	$req->closeCursor();
}
?>