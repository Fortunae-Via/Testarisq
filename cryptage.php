<?php

if (isset($_GET['nir'])) {
	$NIR= $_GET['nir'];	//Mettre ici le NIR à modifier
	require 'modele/connexionbdd.php';

	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ?");
	$requete->execute(array($NIR));
	$resultat = $requete->fetch();
	$mdp = $resultat['MotDePasse'];

	$mdp_crypte = password_hash($mdp, PASSWORD_DEFAULT);

	$update = $bdd->prepare("UPDATE personne SET MotDePasse=? WHERE NIR=?");
	$update->execute(array($mdp_crypte, $NIR));

	echo('Mot de passe crypté.');
	echo('Ancien mot de passe :');
	echo($mdp);
}
else {echo ('Erreur');}  
