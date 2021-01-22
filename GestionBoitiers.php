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
require('modele/RequetesGenerales.php');
require('controleurs/FonctionsGestionBoitiers.php');

//Si on a posté le formulaire, on ajoute le boitier à la BDD
if( (isset($_POST['aut_res'])) ){

	$Aut_Res = $_POST['aut_res'];
	$IdBoitier = AjouterBoitierCapteurs($bdd, $Aut_Res);

	sleep(1);
	$_SESSION['MessageModifBoitiers'] = "Le boîtier n°". $IdBoitier ." a bien été ajouté." ;
	header('Location: GestionBoitiers.php');
}

else if( (isset($_POST['modif_aut_res'],$_POST['id_boitier'])) ){

	ModifierAutResBoitier($bdd, $_POST['id_boitier'], $_POST['modif_aut_res']);

	sleep(1);
	$_SESSION['MessageModifBoitiers'] = "L'autorité responsable du boîtier a bien été modifiée." ;
	header('Location: GestionBoitiers.php');
}

else{

	//Préparation pour l'ajout
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');
	$ListeCapteurs = ListeTypesCapteurs($bdd);

		
	//Préparation pour la recherche
	if(isset($_POST['id_name'])){
		// Definition du regex pour le nom recherché
		$Recherche=true;
		$regex = '%' . $_POST['id_name'] . '%';
	}
	else {
		//Affichage de tous les résultats
		$Recherche=false;
		$regex = "%%";
	}

	require 'controleurs/FonctionsPagination.php';
	$PageMaximum = PageMaximum($bdd,'Boitier');

	if (isset($_GET['page'])) {
		$PageDemandee = $_GET['page'];
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
		$Recherche=true;
	}
	else {
		$PageAffichage = 1;
	}

	// Affichage de la page
	require("vues/GestionBoitiers.php");

	if (isset($_SESSION['MessageModifBoitiers'])) {
		unset($_SESSION['MessageModifBoitiers']);
	}
}
