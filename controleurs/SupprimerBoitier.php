<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: ../Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: ../Accueil.php');
}

// Si on a bien récupéré l'id du boitier
if(isset($_GET['IdBoitier'])){

	require '../modele/connexionbdd.php';
	require '../modele/RequetesGestionBoitiers.php';
	SuppBoitier($bdd, $_GET['IdBoitier']);

	$_SESSION['MessageModifBoitiers'] = "Le boîtier a bien été supprimé." ;
	header('Location: ../GestionBoitiers.php');

}
