<?php 

// connexion à la base de données

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');

if (isset($_GET['modifier']) AND !empty($_GET['modifier']))
{
	$approuver = (int) $_GET['approuver'];


	$require = $bdd->prepare('UPDATE utilisateurs SET approuver = 1 WHERE id = ?');
	$require->execute(array($approuver));
}

if (isset($_GET['supprimer']) AND !empty($_GET['supprimer']))
{
	$supprimer = (int) $_GET['supprimer'];
	$require = $bdd->prepare('DELETE FROM utilisateurs WHERE id = ?');
	$require->execute(array($supprimer));
}


$commentaires = $bdd->query("SELECT * FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date");

?>



<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="livre.css">
		<meta charset="utf-8">
		<title>Bienvenue sur la page commentaire!</title>
	</head>
	<body>
		<div class="or">
			<section class="corps">
				<h2><strong>Mes commentaires:</strong></h2>
				
				<hr>
				<ul>
					<?php while ($c = $commentaires->fetch()) { ?>
						
					
					<li>Posté le, <?= $c['date'] ?> : <?= $c['commentaire']?> par : <?= $c['login'] ?> <?php if($c['modifier'] == 0) {?> - <a href="commentaire.php?Ajout=<?= $c['id'] ?>">Ajouter un commentaire</a><?php } ?> 
					<?php  }?> </li>		
				</ul>
			</section>
		</div>
	</body>
</html>