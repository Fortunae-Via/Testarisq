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

// On effectue la modification du profil utilisateur d'identifiant $_GET['NIR']$NIR
if(isset($_GET['NIR'])){
	$NIR = $_GET['NIR'];

	// Si l'une (et une seule suffit) des données du profil est modifié Alors :
	if(isset($_POST['nom']) || isset($_POST['nom_usage']) || isset($_POST['prenom']) || isset($_POST['prenom_2']) || isset($_POST['prenom_3']) || isset($_POST['sexe']) || isset($_POST['mail']) || isset($_POST['telephone']) || isset($_POST['numeroRue']) ||isset($_POST['rue']) || isset($_POST['ville']) || isset($_POST['code']) || isset($_POST['region']) || isset($_POST['pays']) || isset($_POST['jour']) || isset($_POST['mois']) || isset($_POST['annee'])){

		$DateNaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];

		MiseAJour_personne($bdd, $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $DateNaissance, $NIR);

		require("modele/RequetesGenerales.php");
		$Id_Adresse=InfosPersonne($bdd, $NIR)['Adresse_Id'];

		MiseAJour_adresse($bdd, $_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['pays'], $_POST['region'], $Id_Adresse);

		//Pour les changements de type de compte
		if (isset($_POST['aut_res'],$_SESSION['TypeCompteUserModifEnCours'])) {
			$TypeCompte=$_SESSION['TypeCompteUserModifEnCours'];
			unset($_SESSION['TypeCompteUserModifEnCours']);

			if ($TypeCompte=='AUE' OR $TypeCompte=='POL') {
				ModifierAutResCompte($bdd, $NIR, $TypeCompte, $_POST['aut_res']);
			}
		}

		sleep(true);
		$_SESSION['MessageModifsUtilisateur'] = "Les données de l'utilisateur ont bien été modifiées.";
		$_SESSION['RechercheEnCours'] = true;
		header('Location: GestionUtilisateurs');
					
	}

	else{
		// Récuperation des informations de l'utilisateur d'identifiant $NIR
		require 'modele/RequetesGenerales.php';
		require 'controleurs/FonctionsGestionUtilisateurs.php';
		require 'controleurs/FonctionsGenerales.php';

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
		$Annee=substr($InfosPersosUser['DateNaissance'], 0, 4); 
		$Mois=intval(substr($InfosPersosUser['DateNaissance'], 5, 2)); //On récupère le mois et on convertit en int pour enlever l'éventuel 0 devant
		$Jour=intval(substr($InfosPersosUser['DateNaissance'], 8, 2)); //pareil
		
		$PreRemp = CreatePreRemp($InfosPersosUser,$AdresseUser);

		require("vues/BlocModifier.php");
	}
}
?>