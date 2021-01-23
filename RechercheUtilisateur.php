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

// Appel de la base de donnée bdd_testarisq
require("modele/connexionbdd.php");
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('modele/RequetesGestionUtilisateurs.php');
require 'controleurs/FonctionsGestionUtilisateurs.php';
require 'controleurs/FonctionsPagination.php';


//Si un utilisateur est recherché
if(isset($_POST['id_name']) OR isset($_GET['id_name'])){

	// Definition du regex pour le nom recherché
	if (isset($_POST['id_name'])) {
		$ChampRecherche = $_POST['id_name'];
		$regex = '%' . $ChampRecherche . '%';
	}
	else if (isset($_GET['id_name'])) {
		$ChampRecherche = $_GET['id_name'];
		$regex = '%' . $ChampRecherche . '%';
	}
	else {
		$ChampRecherche ="";
	}

	//Création de la condition SQL pour tous les filtres, soit "" soit AND x=y
	$GestionFiltres = GestionFiltres();
	$ListeFiltres = $GestionFiltres[0];
	$ConditionsSQLFiltres = $GestionFiltres[1];
	$ConditionsSQLNbTests = $GestionFiltres[2];
	$lienSQLFiltres = $GestionFiltres[3];

	//On regarde en amont le nombre de résultats de la recherche
	$TailleRecherche = TailleRechercheUtilisateur($bdd, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbTests);
	$PageMaximum = ceil($TailleRecherche/10);

	if (isset($_GET['page'])) {
		$PageDemandee = $_GET['page'];
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
	}
	else {
		$PageAffichage = 1;
	}

	//Recherche
	$ResultatsRecherche = RechercherUtilisateur($bdd, $PageAffichage, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbTests);
}

else{
	/**
	Cas par défaut, ie. arrivée sur la page, donc on affiche toutes les personnes
	**/

	//On regarde en amont le nombre d'entrées de la table
	$PageMaximum = PageMaximum($bdd, 'Personne');
	$ChampRecherche= "";
	$lienSQLFiltres = "";

	if (isset($_GET['page'])) {
		$PageDemandee = $_GET['page'];
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
	}
	else {
		$PageAffichage = 1;
	}

	//Recherche
	$ResultatsRecherche = RechercherUtilisateur($bdd, $PageAffichage);
}
$ListeRegionFR = ListeRegionsFR($bdd);
$ListeSexes = array('Homme','Femme','Autre','Non-précisé');
// Affichage de la structure HTML
require("vues/RechercheUtilisateur.php");
