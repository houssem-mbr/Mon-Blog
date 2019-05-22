<?php 

require_once('config/fonction.php');
$articles = getArticles();
//$users = getAdmin($_GET['id'] //pleusieur admins
$users = getuser();
$category = getCategory();
$nombre = nbrArticles();
include('admin.phtml');
 ?>
 