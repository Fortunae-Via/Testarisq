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

	// Création d'une nouvelle entrée dans la table Test

	$requete = $bdd->prepare("
		INSERT INTO Test (DateDebut, Position, Personne_NIR, Boitier_Id) 
		VALUES (CURDATE(), :position, :personne_nir, :boitier_id) 
		");
	$requete->execute(array(
		'position' => $Coordonnees, 
		'personne_nir' => $NIRConducteur, 
		'boitier_id' => $IdBoitier
	));
	$IdTest = $bdd->lastInsertId();	//On récupère l'id du test créé
	$_SESSION['IdTest'] = $IdTest;
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