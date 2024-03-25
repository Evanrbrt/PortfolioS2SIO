<?php
    session_start();

	function formulaire_connexion() { 
		$texte = "
		<form action='accueil.php' method='post'> 
		<fieldset>
		";
	   	$texte = $texte . "
		<label>Votre mot de passe :&nbsp; </label><input type='password' name='pass'/>
		<input type='submit' name='connexion' value='Se connecter' />
		</form> ";
		$texte = $texte . "
		<form action='creation.php' method='post'>
		<input type='submit' name='submit' value='Créer un mot de passe' />
		</fieldset>
		</form> ";
	    return $texte;
	}

	function formulaire_creation() {
		$texte = '
		<form action="" method="post">
			<label>Mot de passe : </label><input type="password" name="pwd">
			<label>Mail : </label><input type="mail" name="mail">
			<label>Numéro de téléphone : </label><input type="number" name="num">
			<input type="submit" value="Créer" name="submit">
		</form>';
		return $texte;
	}

	function formulaire_deconnexion() {
		if(isset($_POST['deconnexion'])) {
			session_unset();
			session_destroy();
			header('Location:accueil.php');
		}
		$texte = '
		<form action="" method="post">
			<input type="submit" value="Déconnecter" name="deconnexion">
		</form>';
		return $texte;
	}
		
?>
