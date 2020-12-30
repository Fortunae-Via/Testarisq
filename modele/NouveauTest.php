<?php

session_start(); 

// On récupère les données du formulaire
$NIRConducteur = $_POST['NIRConducteur'];
$IdBoitier = $_POST['IdBoitier'];
$Latitude = $_POST['LatitudeTest']; 
$Longitude = $_POST['LongitudeTest']; 

require '../modele/connexionbdd.php';
require '../modele/fonctionsSQL.php';

$BonNIRConducteur = NIRExiste($bdd,$NIRConducteur);
$BonBoitier = BoitierExiste($bdd,$IdBoitier);

if ($BonNIRConducteur AND $BonBoitier) {

	$Coordonnees = $Latitude . ';' . $Longitude;

	// On crée une nouvelle entrée dans la table Test et on récupère l'id du test créé
	$IdTest = NouveauTest($bdd,$Coordonnees,$NIRConducteur,$IdBoitier);

	$_SESSION['IdTest'] = $IdTest;
	$_SESSION['IdBoitier'] = $IdBoitier;
	$_SESSION['NumeroTest'] = 1 ;
	$_SESSION['EtapeTest'] = 1 ;
	header('Location: ../Test.php');
}

else if ($BonBoitier) {
	$_SESSION['ErreurLancementTest'] = "Le NIR du conducteur est incorrect.";
	header('Location: ../Accueil.php');
}

else if ($BonNIRConducteur) {
	$_SESSION['ErreurLancementTest'] = "Le numéro du boîtier est incorrect.";
	header('Location: ../Accueil.php');
}

else {
	$_SESSION['ErreurLancementTest'] = "Le NIR du conducteur et le numéro du boîtier sont incorrects.";
	header('Location: ../Accueil.php');
}