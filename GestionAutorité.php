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
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('modele/RequetesGestionAutorité.php');
require 'controleurs/FonctionsGestionAutorité.php';
require 'controleurs/FonctionsPagination.php';


//Si un Autorite est recherché
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
	$ConditionsSQLNbBoitiers = $GestionFiltres[2];
	$lienSQLFiltres = $GestionFiltres[3];

	//On regarde en amont le nombre de résultats de la recherche
	$TailleRecherche = TailleRechercheAutorite($bdd, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbBoitiers);
	if($TailleRecherche!=0){
		$PageMaximum = ceil($TailleRecherche/10);
		$Vide=false;
	}else{
		$PageMaximum=1;
		$Vide=true;
	}

	if (isset($_GET['page'])) {
		$PageDemandee = $_GET['page'];
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
	}
	else {
		$PageAffichage = 1;
	}

	//Recherche
	$ResultatsRecherche = RechercherAutorite($bdd, $PageAffichage, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbBoitiers);

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeTypes = array('Agence de Police','Auto-école');
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	//affichage de la page
	$Mode=3;
	require("vues/GestionAutorité.php");
}

//Si les informations minimales sont rentrées, un ajout à la bdd est possible
else if( (!(empty($_POST['type_compte']))) && (!(empty($_POST['id']))) && (!(empty($_POST['type']))) && (!(empty($_POST['nom']))) ){

	// On récupère toutes les données du POST dans $DonneesAutorite
	$TypeCompte = $_POST['type_compte'];
	

	$liste_donnees_autorite=array('id','type','nom');
	foreach ($liste_donnees_autorite as $champ) {
		$DonneesAutorite[$champ]=$_POST[$champ];
	}

	// On crée le mot de passe de l'Autorite
	$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
	for($i=1; $i<=12; $i++){
		$nbr=strlen($caract);
		$nbr=mt_rand(0, ($nbr-1));
		$mdp[$i]=$caract[$nbr];
	}
	$mdp=implode($mdp);
	$mdphashe= password_hash($mdp, PASSWORD_DEFAULT);
	$DonneesAutorite['mdp']=$mdphashe;

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
		$DonneesAutorite['id_adresse']=$Id_Adresse;
	}
	else {
		$DonneesAutorite['id_adresse']=0;
	}
	
	AjouterPersonne($bdd, $DonneesAutorite);

	if ($TypeCompte=='AUE') {
		if ( isset($_POST['aut_resAUE1']) && (!(empty($_POST['aut_resAUE1']))) ) {
			AjouterCompte($bdd, $DonneesAutorite['id'], 'AUE', $_POST['aut_resAUE1']);
		}
		else {
			AjouterCompte($bdd, $DonneesAutorite['id'], 'AUE');
		}
	}
	else if ($TypeCompte=='POL') {
		if ( isset($_POST['aut_resPOL1']) && (!(empty($_POST['aut_resPOL1']))) ) {
			AjouterCompte($bdd, $DonneesAutorite['id'], 'POL', $_POST['aut_resPOL1']);
		}
		else {
			AjouterCompte($bdd, $DonneesAutorite['id'], 'POL');
		}
	}
	

else if( (!(empty($_POST['type_ajout_compte']))) && (!(empty($_POST['nir2']))) ){

	// On récupère toutes les données du POST dans $DonneesAutorite
	$TypeCompte = $_POST['type_ajout_compte'];
	$NIR = $_POST['nir2'];

	//Si le NIR rentré est correct
	if (NIRExiste($bdd, $NIR)) {
		//Si compte pro déjà existant update
		//Sinon crée compte
		if(CompteProExistant($bdd, $NIR)){

			if ($TypeCompte=='AUE') {
				if ( isset($_POST['aut_resAUE2']) && (!(empty($_POST['aut_resAUE2']))) ) {
					UpdateCompte($bdd, $NIR, 'AUE', $_POST['aut_resAUE2']);
				}
				else {
					UpdateCompte($bdd, $NIR, 'AUE');
				}
			}
			else if ($TypeCompte=='POL') {
				if ( isset($_POST['aut_resPOL2']) && (!(empty($_POST['aut_resPOL2']))) ) {
					UpdateCompte($bdd, $NIR, 'POL', $_POST['aut_resPOL2']);
				}
				else {
					UpdateCompte($bdd, $NIR, 'POL');
				}
			}
			else if ($TypeCompte=='ADM') {
				UpdateCompte($bdd, $NIR, 'ADM');
			}
			$_SESSION['MessageModifsAutorite'] = "Le compte a bien été mis à jour et associé à l'Autorite ".$NIR." .";
		}
		else{

			if ($TypeCompte=='AUE') {
				if ( isset($_POST['aut_resAUE2']) && (!(empty($_POST['aut_resAUE2']))) ) {
					AjouterCompte($bdd, $NIR, 'AUE', $_POST['aut_resAUE2']);
				}
				else {
					AjouterCompte($bdd, $NIR, 'AUE');
				}
			}
			else if ($TypeCompte=='POL') {
				if ( isset($_POST['aut_resPOL2']) && (!(empty($_POST['aut_resPOL2']))) ) {
					AjouterCompte($bdd, $NIR, 'POL', $_POST['aut_resPOL2']);
				}
				else {
					AjouterCompte($bdd, $NIR, 'POL');
				}
			}
			
			}
			$_SESSION['MessageModifsAutorite'] = "Le compte a bien été ajouté à l'Autorite ".$NIR." .";
		}
	}
	else {
		$_SESSION['MessageModifsAutorite'] = "Erreur : le NIR saisi n'appartient à aucun Autorite.";
		$_SESSION['AjoutCompteEnCours'] = true;
	}

	header('Location: GestionAutorité');
}

else{

	if (isset($_SESSION['RechercheEnCours'])) {
		$Mode=3;
		unset($_SESSION['RechercheEnCours']);
	}
	else if (isset($_SESSION['AjoutCompteEnCours'])) {
		$Mode=2;
		unset($_SESSION['AjoutCompteEnCours']);
	}
	else {
		$Mode = 1;
	}

	//On regarde en amont le nombre d'entrées de la table
	$PageMaximum = PageMaximum($bdd, 'Personne');
	if ($PageMaximum==0){
		$Vide=true;
	}
	else{
		$Vide=false;
	}

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
	$ResultatsRecherche = RechercherAutorite($bdd, $PageAffichage);

	$ListeRegionFR = ListeRegionsFR($bdd);
    $ListeTypes = array('Agence de Police','Auto-école');
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	// Affichage de la page
	require("vues/GestionAutorité.php");

	//Dans le cas ou on revient d'un ajout modif ou suppression, on supprime le message pour les prochaines fois
	if (isset($_SESSION['MessageModifsAutorite'])) {
		unset($_SESSION['MessageModifsAutorite']);
	}

}