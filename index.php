<?php 

session_start();


$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');


?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" type="text/css" href="livre.css">
		<title>Page index</title>
	</head>
	<body>
		
		<div class="sidebar">
			<header>Mon livre d'or</header>
			
			<ul>
					<li><a href="index.php" ><i class="fa fa-home"></i>Home </a></li>
					<li><a href="livre-or.php" ><i class="fa fa-comments"></i>Commentaires</a></li>
					<li><a href="profil.php" ><i class="fa fa-user"></i>Modifier profil</a></li>
					<li><a href="commentaire.php" ><i class="fa fa-comments"></i>Ajouter un commentaire</a></li>
					<li><a href="deconnexion.php" ><i class="fa fa-sign-out"></i>Deconnexion</a></li>
			</ul>
		</div>
		<section>
			<a class="livre">Bienvenue sur mon livre!</a>
		</section>
	</body>
</html>

