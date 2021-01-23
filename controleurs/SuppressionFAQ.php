<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: ../Accueil');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: ../Accueil');
}

// Si on a bien récupérer l'id de la question à supprimer
if(isset($_POST['idsupp'])){

	require '../modele/connexionbdd.php';
	require '../modele/RequetesFAQ.php';
	SuppQuestion($bdd, $_POST['idsupp']);

	$_SESSION['MessageModifFAQ'] = "L'élément a bien été supprimé." ;
	header('Location: ../GestionFAQ');

}
