<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');	

if (!$_SESSION['conect']) 
{
	//header('location:index.php')
}

if (isset($_POST['forminscription'])) 
{
	if (!empty($_POST['text'])) 
	{
		$id_utilisateur = $_SESSION['id'];
		$text = htmlspecialchars($_POST['text']);
		var_dump($_SESSION);
		var_dump($_POST['text']);
		// User connecté en insertion dans la base de données du commentaires!
		if ($text <= 1000) 
		{
			
			$in = date("Y-m-d H:i:s");
			
			$insertnbr = $bdd->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,?)");
			$insertnbr->execute(array($text, $id_utilisateur, $in));
			
			$erreur = "votre commentaire a bien été posté!";
					
					
		}
		else
		{
			$erreur = "Votre commentaire depasse 1000 caractéres!";
		}	
	}
	else
	{
		$erreur = "tous les champs doivents etre remplis!";
	}	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" type="text/css" href="livre.css">
		<title>Commentaires</title>
	</head>
	<body class="debut">
		<div class="commentaire">
			<form action="commentaire.php" method="POST">
				
				<h1>Commentaires:</h1>
				<textarea name="text" placeholder="votre commentaire!" cols="45" rows="3"></textarea>
				<br>
				<input type="submit" name="forminscription" value="Valider" class="envoie">
			</form>
		</div>
		<?php if (isset($erreur)) { echo $erreur;}?>
	</body>
</html>



