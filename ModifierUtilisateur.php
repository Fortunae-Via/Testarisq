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

// Appel à la base de donnée
require("modele/connexionbdd.php");
// Appel des fonctions
require("modele/RequetesGestionUtilisateurs.php");

require 'controleurs/FonctionsGenerales.php';
// On effectue la modification du profil utilisateur d'identifiant $_GET['NIR']$NIR
if(isset($_GET['NIR'])){
	$NIR = securisation_totale($_GET['NIR']);

	// Si l'une (et une seule suffit) des données du profil est modifié Alors :
	if(isset($_POST['nom']) || isset($_POST['nom_usage']) || isset($_POST['prenom']) || isset($_POST['prenom_2']) || isset($_POST['prenom_3']) || isset($_POST['sexe']) || isset($_POST['mail']) || isset($_POST['telephone']) || isset($_POST['numeroRue']) ||isset($_POST['rue']) || isset($_POST['ville']) || isset($_POST['code']) || isset($_POST['region']) || isset($_POST['pays']) || isset($_POST['jour']) || isset($_POST['mois']) || isset($_POST['annee'])){

		$DateNaissance = securisation_totale($_POST['annee'])."-".securisation_totale($_POST['mois'])."-".securisation_totale($_POST['jour']);

		MiseAJour_personne($bdd, securisation_totale($_POST['nom']), securisation_totale($_POST['nom_usage']), securisation_totale($_POST['prenom']), securisation_totale($_POST['prenom_2']), securisation_totale($_POST['prenom_3']), securisation_totale($_POST['sexe']), securisation_totale($_POST['mail']), securisation_totale($_POST['telephone']), $DateNaissance, $NIR);

		// Si un des champs adresse n'est pas vide
		if( (!(empty($_POST['numeroRue']))) OR (!(empty($_POST['rue']))) OR (!(empty($_POST['ville']))) OR (!(empty($_POST['code']))) OR (!(empty($_POST['region']))) OR (!(empty($_POST['pays']))) ){

			$liste_donnees_adresse=array('numeroRue','rue','ville','code','region','pays');
			foreach ($liste_donnees_adresse as $champ_adresse) {
				$InfosAdresse[$champ_adresse]=securisation_totale($_POST[$champ_adresse]);
			}

			if(empty($InfosAdresse['region'])) {
				$InfosAdresse['region']=null;
			}

			require("modele/RequetesGenerales.php");
			$Id_Adresse=InfosPersonne($bdd, $NIR)['Adresse_Id'];

			MiseAJour_adresse($bdd, $InfosAdresse['numeroRue'], $InfosAdresse['rue'], $InfosAdresse['code'], $InfosAdresse['ville'], $InfosAdresse['pays'], $InfosAdresse['region'], $Id_Adresse, $NIR);
		}

		//Pour les changements d'aut res
		if (isset($_POST['aut_res'],$_SESSION['TypeCompteUserModifEnCours'])) {
			$TypeCompte=$_SESSION['TypeCompteUserModifEnCours'];
			unset($_SESSION['TypeCompteUserModifEnCours']);

			if ($TypeCompte=='AUE' OR $TypeCompte=='POL') {
				ModifierAutResCompte($bdd, $NIR, $TypeCompte, securisation_totale($_POST['aut_res']));
			}
		}

		$_SESSION['MessageModifsUtilisateur'] = "Les données de l'utilisateur ont bien été modifiées.";
		$_SESSION['RechercheEnCours'] = true;
		header('Location: GestionUtilisateurs');
					
	}

	else{
		// Récuperation des informations de l'utilisateur d'identifiant $NIR
		require 'modele/RequetesGenerales.php';
		require 'controleurs/FonctionsGestionUtilisateurs.php';
		//require 'controleurs/FonctionsGenerales.php';

		$InfosPersosUser = InfosPersonne($bdd, $NIR);
		$AdresseUser = InfosAdresse($bdd, $InfosPersosUser['Adresse_Id']);
		$TypeCompte = TypeComptePersonne($bdd, $NIR);
		$TypeCompteFR = TypeComptePersonneFR($TypeCompte);

		if ($TypeCompte == 'AUE') {
			$ListeAutoritesResponsables = ListeAutoritesResponsables($bdd,'AUE');
			$AutResUser = AutResCompte($bdd, $NIR, 'AUE');
			$_SESSION['TypeCompteUserModifEnCours']='AUE';
		}
		else if ($TypeCompte == 'POL') {
			$ListeAutoritesResponsables = ListeAutoritesResponsables($bdd,'POL');
			$AutResUser = AutResCompte($bdd, $NIR, 'POL');
			$_SESSION['TypeCompteUserModifEnCours']='POL';
		}

		$ListeRegionFR = ListeRegionsFR($bdd);

		$MoisFR=array('Jan.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov','Déc.');
		$Annee=substr($InfosPersosUser['DateNaissance'], 6, 4); 
		$Mois=intval(substr($InfosPersosUser['DateNaissance'], 3, 2)); //On récupère le mois et on convertit en int pour enlever l'éventuel 0 devant
		$Jour=intval(substr($InfosPersosUser['DateNaissance'], 0, 2)); //pareil
		
		$PreRemp = CreatePreRemp($InfosPersosUser,$AdresseUser);

		require("vues/BlocModifier.php");
	}
}
?>