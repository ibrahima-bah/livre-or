<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');


if (isset($_POST['submit']))
{

	$login = htmlspecialchars($_POST['login']);
	$password = sha1($_POST['password']);
		
	if (!empty($login) AND !empty($password))
	{	
		
		$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
		$req->execute(array($login, $password));
		$userexist = $req->rowCount();
		if ($userexist == 1) 
		{
			$userinfo = $req->fetch();
			
			$_SESSION['conect'] == true;
			$_SESSION['id'] = $userinfo['id'];

			$_SESSION['login'] = $userinfo['login'];
			$_SESSION['password'] = $userinfo['password'];
			header("location:index.php?id=".$_SESSION['id']);
		}
		
		else
		{
			$erreur="Mauvais identifiants!";
		}
			
	}
	else
	{
		$erreur="tous les champs doivent etre remplis";
	}
	

		
}		

	

?>







<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" href="livre.css">
		<title>Connexion</title>
	</head>
	<body>
		<div class="form">
			<form  action="" method="POST">
				<h1>Connexion</h1>
				<p>Login</p>
				<input type="text" name="login" placeholder="login"></input>
				<p>Password</p>
				<input type="password" name="password" placeholder="mot de passe">
				<br>
				<input type="submit" name="submit" value="Connexion">
			</form>
			<?php 
			if (isset($erreur)) {
				echo "$erreur";
			}
			?>
		</div>	
	</body>
</html>
