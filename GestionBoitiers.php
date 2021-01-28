<?php 
require 'controleurs/FonctionsGenerales.php';

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil');
}

// Appel de la base de donnée bdd_testarisq
require("modele/connexionbdd.php");
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('controleurs/FonctionsGestionBoitiers.php');

//Traitement de l'ajout de boitier
if( (isset($_POST['aut_res'])) ){
	
	$Aut_Res = securisation_totale($_POST['aut_res']);
	$IdBoitier = AjouterBoitierCapteurs($bdd, $Aut_Res);

	$_SESSION['MessageModifBoitiers'] = "Le boîtier n°". $IdBoitier ." a bien été ajouté." ;
	header('Location: GestionBoitiers');
}

//Traitement de la modification de boitier
else if( (isset($_POST['modif_aut_res'],$_POST['id_boitier'])) ){

	ModifierAutResBoitier($bdd, securisation_totale($_POST['id_boitier']), securisation_totale($_POST['modif_aut_res']));

	$_SESSION['MessageModifBoitiers'] = "L'autorité responsable du boîtier a bien été modifiée." ;
	header('Location: GestionBoitiers');
}

//Partie affichage simple
else{

	require 'controleurs/FonctionsPagination.php';

	//Préparation pour la partie ajout
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');
	$ListeCapteurs = ListeTypesCapteurs($bdd);


	//Si un utilisateur est recherché
	if(isset($_POST['id_name']) OR isset($_GET['id_name'])){

		// Definition du regex pour le nom recherché
		if (isset($_POST['id_name'])) {
			$ChampRecherche = securisation_totale($_POST['id_name']);
			$regex = '%' . $ChampRecherche . '%';
		}
		else if (isset($_GET['id_name'])) {
			$ChampRecherche = securisation_totale($_GET['id_name']);
			$regex = '%' . $ChampRecherche . '%';
		}
		else {
			$ChampRecherche ="";
		}

		//On regarde en amont le nombre de résultats de la recherche
		$TailleRecherche = TailleRechercheBoitier($bdd, $regex);
		if($TailleRecherche!=0){
			$PageMaximum = ceil($TailleRecherche/10);
			$Vide=false;
		}else{
			$PageMaximum=1;
			$Vide=true;
		}

		if (isset($_GET['page'])) {
			$PageDemandee = securisation_totale($_GET['page']);
			$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
		}
		else {
			$PageAffichage = 1;
		}

		//Recherche
		$ResultatsRecherche = RechercherBoitierBDD($bdd, $PageAffichage, $regex);

		$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
		$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

		//affichage de la page
		$Recherche=true;
		require("vues/GestionBoitiers.php");
	}

	else {
		$Recherche = false;

		//On regarde en amont le nombre d'entrées de la table
		$PageMaximum = PageMaximum($bdd, 'Boitier');
		if ($PageMaximum==0){
			$Vide=true;
		}
		else{
			$Vide=false;
		}
		$ChampRecherche= "";
		$lienSQLFiltres = "";

		if (isset($_GET['page'])) {
			$PageDemandee = securisation_totale($_GET['page']);
			$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
			$Recherche=true;
		}
		else {
			$PageAffichage = 1;
		}

		//Recherche
		$ResultatsRecherche = RechercherBoitierBDD($bdd, $PageAffichage);

		$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
		$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

		// Affichage de la page
		require("vues/GestionBoitiers.php");

		//Dans le cas ou on revient d'un ajout modif ou suppression, on supprime le message pour les prochaines fois
		if (isset($_SESSION['MessageModifBoitiers'])) {
		unset($_SESSION['MessageModifBoitiers']);
		}
	}
}
