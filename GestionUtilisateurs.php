<?php 

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
require('modele/RequetesGestionUtilisateurs.php');
require 'controleurs/FonctionsGestionUtilisateurs.php';
require 'controleurs/FonctionsPagination.php';
require 'controleurs/FonctionsGenerales.php';

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

	//Création de la condition SQL pour tous les filtres, soit "" soit AND x=y
	$GestionFiltres = GestionFiltres();
	$ListeFiltres = $GestionFiltres[0];
	$ConditionsSQLFiltres = $GestionFiltres[1];
	$ConditionsSQLNbTests = $GestionFiltres[2];
	$lienSQLFiltres = $GestionFiltres[3];

	//On regarde en amont le nombre de résultats de la recherche
	$TailleRecherche = TailleRechercheUtilisateur($bdd, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbTests);
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
	$ResultatsRecherche = RechercherUtilisateur($bdd, $PageAffichage, $regex, $ConditionsSQLFiltres, $ConditionsSQLNbTests);

	$ListeRegionFR = ListeRegionsFR($bdd);
	$ListeSexes = array('Homme','Femme','Autre','Non-précisé');
	$ListeAutoritesResponsablesAUE = ListeAutoritesResponsables($bdd,'AUE');
	$ListeAutoritesResponsablesPOL = ListeAutoritesResponsables($bdd,'POL');

	//affichage de la page
	$Mode=3;
	require("vues/GestionUtilisateurs.php");
}

//Si les informations minimales sont rentrées, un ajout à la bdd est possible
else if( (!(empty($_POST['type_compte']))) && (!(empty($_POST['id']))) && (!(empty($_POST['nom']))) && (!(empty($_POST['prenom']))) && (!(empty($_POST['jour']))) && (!(empty($_POST['mois']))) && (!(empty($_POST['annee']))) && (!(empty($_POST['sexe']))) && (!(empty($_POST['mail']))) ){

	$NIR=$_POST['id'];
	if(NIRExiste($bdd, $NIR)==false && !verifstring($_POST['nom']) && !verifstring($_POST['prenom']) && !verifnum($_POST['id']) && !verifnum($_POST['telephone']) && !verifstring($_POST['prenom_2']) && !verifstring($_POST['prenom_3']) && !verifstring($_POST['nom_usage']) && !verifnum($_POST['numeroRue']) && !verifstring($_POST['rue']) && !verifstring($_POST['ville']) && !verifnum($_POST['code']) && !verifstring($_POST['pays'])){
		// On récupère toutes les données du POST dans $DonneesUtilisateur
		$TypeCompte = securisation_totale($_POST['type_compte']);
		$DonneesUtilisateur = array(
			'datenaissance' => securisation_totale($_POST['annee'])."-".securisation_totale($_POST['mois'])."-".securisation_totale($_POST['jour']));

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
				$InfosAdresse[$champ_adresse]=securisation_totale($_POST[$champ_adresse]);
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
			if ( isset($_POST['aut_resAUE1']) && (!(empty($_POST['aut_resAUE1']))) ) {
				AjouterCompte($bdd, $DonneesUtilisateur['id'], 'AUE', securisation_totale($_POST['aut_resAUE1']));
			}
			else {
				AjouterCompte($bdd, $DonneesUtilisateur['id'], 'AUE');
			}
		}
		else if ($TypeCompte=='POL') {
			if ( isset($_POST['aut_resPOL1']) && (!(empty($_POST['aut_resPOL1']))) ) {
				AjouterCompte($bdd, $DonneesUtilisateur['id'], 'POL', securisation_totale($_POST['aut_resPOL1']));
			}
			else {
				AjouterCompte($bdd, $DonneesUtilisateur['id'], 'POL');
			}
		}
		else if ($TypeCompte=='ADM') {
			AjouterCompte($bdd, $DonneesUtilisateur['id'], 'ADM');
		}

		$_SESSION['MessageModifsUtilisateur'] = "L'utilisateur a bien été ajouté. Son mot de passe est ".$mdp." .";
		header('Location: GestionUtilisateurs');
	}
	else{
		$_SESSION['MessageErreur'] = "Erreur : L'utilisateur ".$NIR." existe déjà.";
		if(verifstring($_POST['nom']) || verifstring($_POST['prenom']) || verifstring($_POST['prenom_2']) || verifstring($_POST['prenom_3']) || verifstring($_POST['nom_usage'])){
			$_SESSION['MessageErreur'] = "Erreur : le nom, nom d'usage et les prénoms ne peuvent contenir que des lettres.";
		}
		else if(verifnum($_POST['id'])){
			$_SESSION['MessageErreur'] = "Erreur : le NIR ne doit contenir que des chiffres.";
		}
		else if(verifnum($_POST['telephone'])){
			$_SESSION['MessageErreur'] = "Erreur : le numéro de telephone ne doit contenir que des chiffres.";
		}
		else if(verifnum($_POST['numeroRue']) || verifnum($_POST['code'])){
			$_SESSION['MessageErreur'] = "Erreur : le numéro de rue et le code postal ne doit contenir que des chiffres.";
		}
		else if(verifstring($_POST['ville']) || verifstring($_POST['rue']) || verifstring($_POST['pays'])){
			$_SESSION['MessageErreur'] = "Erreur : la rue, le nom de la ville et le pays ne doit contenir que des lettres.";
		}
		header('Location: GestionUtilisateurs');
	}
}

else if( (!(empty($_POST['type_ajout_compte']))) && (!(empty($_POST['nir2']))) ){

	// On récupère toutes les données du POST dans $DonneesUtilisateur
	$TypeCompte = securisation_totale($_POST['type_ajout_compte']);
	$NIR = securisation_totale($_POST['nir2']);

	//Si le NIR rentré est correct
	if (NIRExiste($bdd, $NIR)) {
		//Si compte pro déjà existant update
		//Sinon crée compte
		if(CompteProExistant($bdd, $NIR)){

			if ($TypeCompte=='AUE') {
				if ( isset($_POST['aut_resAUE2']) && (!(empty($_POST['aut_resAUE2']))) ) {
					UpdateCompte($bdd, $NIR, 'AUE', securisation_totale($_POST['aut_resAUE2']));
				}
				else {
					UpdateCompte($bdd, $NIR, 'AUE');
				}
			}
			else if ($TypeCompte=='POL') {
				if ( isset($_POST['aut_resPOL2']) && (!(empty($_POST['aut_resPOL2']))) ) {
					UpdateCompte($bdd, $NIR, 'POL', securisation_totale($_POST['aut_resPOL2']));
				}
				else {
					UpdateCompte($bdd, $NIR, 'POL');
				}
			}
			else if ($TypeCompte=='ADM') {
				UpdateCompte($bdd, $NIR, 'ADM');
			}
			$_SESSION['MessageModifsUtilisateur'] = "Le compte a bien été mis à jour et associé à l'utilisateur ".$NIR." .";
		}
		else{

			if ($TypeCompte=='AUE') {
				if ( isset($_POST['aut_resAUE2']) && (!(empty($_POST['aut_resAUE2']))) ) {
					AjouterCompte($bdd, $NIR, 'AUE', securisation_totale($_POST['aut_resAUE2']));
				}
				else {
					AjouterCompte($bdd, $NIR, 'AUE');
				}
			}
			else if ($TypeCompte=='POL') {
				if ( isset($_POST['aut_resPOL2']) && (!(empty($_POST['aut_resPOL2']))) ) {
					AjouterCompte($bdd, $NIR, 'POL', securisation_totale($_POST['aut_resPOL2']));
				}
				else {
					AjouterCompte($bdd, $NIR, 'POL');
				}
			}
			else if ($TypeCompte=='ADM') {
				AjouterCompte($bdd, $NIR, 'ADM');
			}
			$_SESSION['MessageModifsUtilisateur'] = "Le compte a bien été ajouté à l'utilisateur ".$NIR." .";
		}
	}
	else {
		$_SESSION['MessageModifsUtilisateur'] = "Erreur : le NIR saisi n'appartient à aucun utilisateur.";
		$_SESSION['AjoutCompteEnCours'] = true;
	}

	header('Location: GestionUtilisateurs');
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
		$PageDemandee = securisation_totale($_GET['page']);
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
	if (isset($_SESSION['MessageErreur'])) {
		unset($_SESSION['MessageErreur']);
	}


}
