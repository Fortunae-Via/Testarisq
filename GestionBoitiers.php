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

// Appel de la base de donnée bdd_testarisq
require("modele/connexionbdd.php");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('controleurs/FonctionsGestionBoitiers.php');

//Si on fait une recherche
if(isset($_POST['id_name'])){
	// Definition du regex pour le nom recherché
	$regex = '%' . $_POST['id_name'] . '%';
}
else {
	$regex = "%%";
}

// Affichage de la page
require("vues/GestionBoitiers.php");
