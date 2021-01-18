<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil.php');
}

// Si on a bien récupérer l'identifiant d'un utilisateur à la page précédente Alors :
if(isset($_GET['NIR'])){
	// Appel  de la base de donnée
	require("../modele/connexionbdd.php");


	/**
	Suppression d'un compte où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table personne par une clé étagère.
	**/
	$supprimer = $bdd->prepare('DELETE FROM compte WHERE Personne_NIR=? AND TypeCompte_Type!="CIT"');
	$supprimer->execute(array($_GET['NIR']));
	$supprimer->closeCursor();

	sleep(1);
	if('1'){
		/**
		L'utilisateur est redirigé vers la page de recherche.
		(Retour à la page précédente)
		**/
		$_SESSION['MessageModifsUtilisateur'] = "Le compte \"pro\" de l'utilisateur a bien été supprimé.";
		$_SESSION['RechercheEnCours'] = true;
		header('Location: ../GestionUtilisateurs.php');
	}
}
?>