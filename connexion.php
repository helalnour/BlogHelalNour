<?php
	
	session_start();

	include('includes/connexion.inc.php');
	include('fonctions/fonctions.php');

	if (isset($_POST['connexion'])) {
		$login = htmlspecialchars($_POST['login']);
		$mdp = md5(htmlspecialchars($_POST['mdp']));
		$sql = 'SELECT COUNT(*) FROM utilisateurs WHERE login = "'.$login.'" AND mdp = "'.$mdp.'"';
		$res = mysql_query($sql);
		$res = mysql_fetch_array($res);
		$utilisateur = $res[0];
		if ($utilisateur == 1) {
			$_SESSION['login'] = $login;
			header('location:index.php');
			exit();
		}
	}else{

		include('includes/haut.inc.php');

?>
		<h1>Connexion</h1>

		<form role="form" action="connexion.php" method="POST">
			<div class="form-group">
				<label for="login">login</label>
				<input type="text" class="form-control" id="login" name="login">
			</div>
			<div class="form-group">
				<label for="mdp">Mot de passe</label>
				<input type="password" class="form-control" id="mdp" name="mdp">
			</div>
			<input type="submit" class="btn btn-primary" id="connexion" name="connexion" value="Se connecter"/>
		</form>

<?php
		include('includes/bas.inc.php');
	}
?>