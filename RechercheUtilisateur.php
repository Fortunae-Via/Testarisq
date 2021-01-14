<?php

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='AUE' AND $_SESSION['TypeCompte']!='POL' ) {	
	header('Location: Accueil.php');
}

//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){

	// Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche

	// Definition du regex pour le nom recherché
	$regex = '"%' . $_POST['id_name'] . '%"';

	// Affichage de la structure HTML
	include("vues/RechercheUtilisateur.php");

}else{
	/**
	Cas où aucun des filtres n'a été utilisé et qu'aucun utilisateur n'a été 
	recherché (cas par défaut, ie. arrivé sur la page)
	**/

	// Affichage de la structure HTML
	include("vues/RechercheUtilisateur.php");
}
?>