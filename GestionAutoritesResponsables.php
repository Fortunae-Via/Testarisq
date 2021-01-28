<?php 

session_start(); 
// Si l'Autorite n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil');
}

// Appel de la base de donnée bdd_testarisq
require("modele/connexionbdd.php");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('modele/RequetesGestionAutorites.php');
require 'controleurs/FonctionsGestionAutorites.php';
require 'controleurs/FonctionsPagination.php';
require 'controleurs/FonctionsGenerales.php';


//Si une Autorite est recherché
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

	//Création de la condition SQL pour tous les filtres, soit "" soit AND x=y
	$GestionFiltres = GestionFiltresAutRes();
	$ListeFiltres = $GestionFiltres[0];
	$ConditionsSQLFiltres = $GestionFiltres[1];
	$ConditionsSQLNbBoitiers = $GestionFiltres[2];
	$lienSQLFiltres = $GestionFiltres[3];

	//On regarde en amont le nombre de résultats de la recherche
	$TailleRecherche = TailleRechercheAutRes($bdd, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbBoitiers);
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
	$ResultatsRecherche = RechercherAutRes($bdd, $PageAffichage, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbBoitiers);

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	//affichage de la page
	$Mode=2;
	require("vues/GestionAutoritesResponsables.php");
}

//Si on veut faire un ajout, les informations minimales sont rentrées donc un ajout à la bdd est possible
else if( (!(empty($_POST['Nom']))) && (!(empty($_POST['Type']))) ){

	// On récupère toutes les données du POST dans $DonneesAutorite
	
	$liste_donnees_autorite=array('Type','Nom');
	foreach ($liste_donnees_autorite as $champ) {
		$DonneesAutorite[$champ]=$_POST[$champ];
	}

	// Pour l'adresse, on regarde si un des champs est rempli
	if( (!(empty($_POST['numeroRue']))) OR (!(empty($_POST['rue']))) OR (!(empty($_POST['ville']))) OR (!(empty($_POST['code']))) OR (!(empty($_POST['region']))) OR (!(empty($_POST['pays']))) ){

		$liste_donnees_adresse=array('numeroRue','rue','ville','code','region','pays');
		foreach ($liste_donnees_adresse as $champ_adresse) {
			$InfosAdresse[$champ_adresse]=securisation_totale($_POST[$champ_adresse]);
		}

		if(empty($InfosAdresse['region'])) {
			$InfosAdresse['region']=null;
		}

		$Id_Adresse=AjouterAdresse($bdd, $InfosAdresse);
		$DonneesAutorite['id_adresse']=$Id_Adresse;
	}
	else {
		$DonneesAutorite['id_adresse']=0;
	}
	
	AjouterAutRes($bdd, $DonneesAutorite);

	$_SESSION['MessageModifsAutorite'] = "L'autorité reponsable ".$DonneesAutorite['Nom']." a bien été ajoutée.";
	header('Location: GestionAutoritesResponsables');
}

//Traitement de la modification du nom
else if( (isset($_POST['modif_nom_aut_res'],$_POST['id_autres'])) ){

	ModifierNomAutRes($bdd, securisation_totale($_POST['id_autres']), securisation_totale($_POST['modif_nom_aut_res']));

	$_SESSION['MessageModifsAutorite'] = "Le nom de l'autorité responsable a bien été modifié." ;
	header('Location: GestionAutoritesResponsables');
}

else{

	if (isset($_SESSION['RechercheEnCours'])) {
		$Mode=2;
		unset($_SESSION['RechercheEnCours']);
	}
	else {
		$Mode = 1;
	}

	//On regarde en amont le nombre d'entrées de la table
	$PageMaximum = PageMaximum($bdd, 'AutoriteResponsable');
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
	}
	else {
		$PageAffichage = 1;
	}

	//Recherche
	$ResultatsRecherche = RechercherAutRes($bdd, $PageAffichage);

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	// Affichage de la page
	require("vues/GestionAutoritesResponsables.php");

	//Dans le cas ou on revient d'un ajout modif ou suppression, on supprime le message pour les prochaines fois
	if (isset($_SESSION['MessageModifsAutorite'])) {
		unset($_SESSION['MessageModifsAutorite']);
	}

}