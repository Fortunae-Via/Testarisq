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

// Appel à la base de donnée
require("modele/connexionbdd.php");
// Appel des fonctions
require("modele/RequetesGestion.php");
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

		sleep(true);
		$_SESSION['MessageModifsUtilisateur'] = "Les données de l'utilisateur ont bien été modifiées.";
		$_SESSION['RechercheEnCours'] = true;
		header('Location: GestionUtilisateurs.php');
					
	}else{
		// Récuperation des informations de l'utilisateur d'identifiant $NIR
		require 'modele/RequetesGenerales.php';
		$InfosPersosUser = InfosPersonne($bdd, $NIR);
		$AdresseUser = InfosAdresse($bdd, $InfosPersosUser['Adresse_Id']);

		$MoisFR=array('Jan.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov','Déc.');
		$Annee=substr($InfosPersosUser['DateNaissance'], 0, 4); 
		$Mois=intval(substr($InfosPersosUser['DateNaissance'], 5, 2)); //On récupère le mois et on convertit en int pour enlever l'éventuel 0 devant
		$Jour=intval(substr($InfosPersosUser['DateNaissance'], 8, 2)); //pareil

		//Liste des placeholders pour les champs potentiellement vides
		$Placeholders = array(
			'NomDUsage' => "Nom d'usage",	'Prenom2' => "2ème Prénom",
			'Prenom3' => "3ème Prénom",		'NumeroRue' => "N°",
			'Rue' => "Rue",					'CodePostal' => "Code Postal",
			'Ville' => "Ville",				'Pays' => "Pays",						
			'Portable' => "xxxxxxxxxx");
		//On crée tous les préremplissages, et si c'est vide on note juste le placeholder
		$ListeChamps = array('NomDeFamille','NomDUsage','Prenom1','Prenom2','Prenom3','Courriel','NumeroRue','Rue','CodePostal','Ville','Pays','Portable');
		$PreRemp = array_merge($InfosPersosUser,$AdresseUser);

		foreach ($ListeChamps as $champ) {
			if(empty($PreRemp[$champ])) { //donne if(empty($InfosPersosUser['NomDUsage'])) etc
				$PreRemp[$champ]="placeholder=\"".$Placeholders[$champ]. "\"";
			}else {
				$PreRemp[$champ]="value=\"".$PreRemp[$champ]. "\"";
			}
		}
		require("vues/BlocModifier.php");
	}
}
?>