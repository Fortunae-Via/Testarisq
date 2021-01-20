<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}

require 'modele/connexionbdd.php';
require 'modele/RequetesGenerales.php';

// On récupère toutes ses informations
$InfosUser=$_SESSION['Infos'];

if (!(empty($InfosUser['Adresse_Id']))) {
	$PartiesAdresse=InfosAdresse($bdd,$InfosUser['Adresse_Id']);
	$Adresse = $PartiesAdresse['NumeroRue'] .' '. $PartiesAdresse['Rue'] .', '. $PartiesAdresse['CodePostal'] .' '. $PartiesAdresse['Ville'] .', '. $PartiesAdresse['Region'] .', '. $PartiesAdresse['Pays'];
}

if (empty($InfosUser['Prenom3'])) {
	if (empty($InfosUser['Prenom2'])) {
		$Prenoms = $InfosUser['Prenom1'];
	}
	else {
		$Prenoms = $InfosUser['Prenom1'] .', '. $InfosUser['Prenom2'];
	} 
}
else {
	$Prenoms = $InfosUser['Prenom1'] .', '. $InfosUser['Prenom2'] .', '. $InfosUser['Prenom3'];
}


//On affiche la page
require 'vues/MonCompte.php'; 



