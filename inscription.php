<?php 

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');	

if (isset($_POST['forminscription'])) 
{
	if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password1'])) 
	{
		$login = htmlspecialchars($_POST['login']);
		$password = sha1($_POST['password']);
		$password1 = sha1($_POST['password1']);

		
		$loginlenght = strlen($login);
		if ($loginlenght <= 255) 
		{
				if ($password == $password1) 
				{
					$insertnbr = $bdd->prepare("INSERT INTO utilisateurs (login, password) VALUES (?,?)");
					$insertnbr->execute(array($login, $password));
					$erreur = "votre compte a bien été crée!";
					header('location:connexion.php');
				}
				else
				{
					$erreur = "les mots de passes ne correspondents pas !";
				}	
		}
		else
		{
			$erreur = "Votre login depasse 255 caractéres!";
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
		<title>Inscription</title>
	</head>
	<body class="debut">
		<div class="inscription">
			<form action="" method="POST">
				<h1>Inscription</h1>
				<p>login:</p>
				<input type="text" name="login">
				<p>password:</p>
				<input type="password" name="password">
				<p>Confirmer mot de passe:</p>
				<input type="password" name="password1">
				<br>
				<input type="submit" name="forminscription" value="Valider" class="envoie" >
			</form>
		</div>
		<?php 
			if (isset($erreur)) {
				echo "$erreur";
			}
		?>

	</body>
</html>