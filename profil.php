<?php 

session_start();


$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');

if (isset($_SESSION['id'])) 
{
	$requser = $bdd->prepare("SELECT * FROM utilisateurs  WHERE id = ?");

	$requser->execute(array($_SESSION['id']));

	$user = $requser->fetch();

	if (isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login'])
	{
		$newlogin = htmlspecialchars($_POST['newlogin']);
		$insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
		$insertlogin->execute(array($newlogin, $_SESSION['id']));
		header("location: profil.php?id=".$_SESSION['id']);
	}

	

	if (isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND isset($_POST['newpassword1']) AND !empty($_POST['newpassword1']))
	{
		$password = sha1($_POST['newpassword']);
		$password1 = sha1($_POST['newpassword1']);
		if ($password == $password1)
		{
			$insertpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
			$insertpassword->execute(array($password, $_SESSION['id']));
			header("location: profil.php?id=".$_SESSION['id']);
		}
		else
		{
			$message = "Vos deux mots de passe ne coorespondent pas !";
		}	
	}	

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" type="text/css" href="livre.css">
		<title>Profil</title>
	</head>
	<body class="debut">
		<div class="profil">
			<form action="profil.php" method="POST">
				<h1>Profil</h1>
				<p>login:</p>
				<input type="text" name="newlogin" placeholder="newlogin" value ="<?php echo $user['login']; ?>">
				<p>password:</p>
				<input type="password" name="newpassword">
				<p>Confirmer mot de passe:</p>
				<input type="password" name="newpassword1">
				<br>
				<input type="submit"  value="Modifier" class="envoie" >
			</form>
		</div>
		<?php if (isset($message)) {echo $message;}?>
	</body>
</html>

<?php 


}

else
{
	header("location:connexion.php");
}

?>