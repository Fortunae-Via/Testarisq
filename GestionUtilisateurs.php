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
	$lienSQLFiltres = $GestionFiltres[2];

	//On regarde en amont le nombre de résultats de la recherche
	$TailleRecherche = TailleRechercheUtilisateur($bdd, $regex, $ConditionsSQLFiltres);
	$PageMaximum = ceil($TailleRecherche/10);

	if (isset($_GET['page'])) {
		$PageDemandee = $_GET['page'];
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
	}
	else {
		$PageAffichage = 1;
	}

	//Recherche
	$ResultatsRecherche = RechercherUtilisateur($bdd, $PageAffichage, $regex, $ConditionsSQLFiltres);

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeSexes = array('Homme','Femme','Autre','Non-précisé');
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	//affichage de la page
	$Recherche=true;
	require("vues/GestionUtilisateurs.php");
}

//Si les informations minimales sont rentrées, un ajout à la bdd est possible
else if( (!(empty($_POST['type_compte']))) && (!(empty($_POST['id']))) && (!(empty($_POST['nom']))) && (!(empty($_POST['prenom']))) && (!(empty($_POST['jour']))) && (!(empty($_POST['mois']))) && (!(empty($_POST['annee']))) && (!(empty($_POST['sexe']))) && (!(empty($_POST['mail']))) ){

	// On récupère toutes les données du POST dans $DonneesUtilisateur
	$TypeCompte = $_POST['type_compte'];
	$DonneesUtilisateur = array(
		'datenaissance' => $_POST['annee']."-".$_POST['mois']."-".$_POST['jour']);

	$liste_donnees_utilisateur=array('id','nom','nom_usage','prenom','prenom_2','prenom_3','sexe','mail','telephone');
	foreach ($liste_donnees_utilisateur as $champ) {
		$DonneesUtilisateur[$champ]=$_POST[$champ];
	}

	// On crée le mot de passe de l'utilisateur
	$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
	for($i=1; $i<=12; $i++){
		$nbr=strlen($caract);
		$nbr=mt_rand(0, ($nbr-1));
		$mdp[$i]=$caract[$nbr];
	}
	$mdp=implode($mdp);
	$mdphashe= password_hash($mdp, PASSWORD_DEFAULT);
	$DonneesUtilisateur['mdp']=$mdphashe;

	// Pour l'adresse, on regarde si un des champs est rempli
	if( (!(empty($_POST['numeroRue']))) OR (!(empty($_POST['rue']))) OR (!(empty($_POST['ville']))) OR (!(empty($_POST['code']))) OR (!(empty($_POST['region']))) OR (!(empty($_POST['pays']))) ){

		$liste_donnees_adresse=array('numeroRue','rue','ville','code','region','pays');
		foreach ($liste_donnees_adresse as $champ_adresse) {
			$InfosAdresse[$champ_adresse]=$_POST[$champ_adresse];
		}

		if(empty($InfosAdresse['region'])) {
			$InfosAdresse['region']=null;
		}


		$Id_Adresse=AjouterAdresse($bdd, $InfosAdresse);
		$DonneesUtilisateur['id_adresse']=$Id_Adresse;
	}
	else {
		$DonneesUtilisateur['id_adresse']=0;
	}
	
	AjouterPersonne($bdd, $DonneesUtilisateur);

	if ($TypeCompte=='AUE') {
		if ( isset($_POST['aut_resAUE']) && (!(empty($_POST['aut_resAUE']))) ) {
			AjouterCompte($bdd, $DonneesUtilisateur['id'], 'AUE', $_POST['aut_resAUE']);
		}
		else {
			AjouterCompte($bdd, $DonneesUtilisateur['id'], 'AUE');
		}
	}
	else if ($TypeCompte=='POL') {
		if ( isset($_POST['aut_resPOL']) && (!(empty($_POST['aut_resPOL']))) ) {
			AjouterCompte($bdd, $DonneesUtilisateur['id'], 'POL', $_POST['aut_resPOL']);
		}
		else {
			AjouterCompte($bdd, $DonneesUtilisateur['id'], 'POL');
		}
	}
	else if ($TypeCompte=='ADM') {
		AjouterCompte($bdd, $DonneesUtilisateur['id'], 'ADM');
	}

	sleep(1);
	$_SESSION['MessageModifsUtilisateur'] = "L'utilisateur a bien été ajouté. Son mot de passe est ".$mdp." .";
	header('Location: GestionUtilisateurs.php');
}

else{

	if (isset($_SESSION['RechercheEnCours'])) {
		$Recherche=true;
		unset($_SESSION['RechercheEnCours']);
	}
	else {
		$Recherche = false;
	}

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

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeSexes = array('Homme','Femme','Autre','Non-précisé');
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	// Affichage de la page
	require("vues/GestionUtilisateurs.php");

	//Dans le cas ou on revient d'un ajout modif ou suppression, on supprime le message pour les prochaines fois
	if (isset($_SESSION['MessageModifsUtilisateur'])) {
		unset($_SESSION['MessageModifsUtilisateur']);
	}

}
