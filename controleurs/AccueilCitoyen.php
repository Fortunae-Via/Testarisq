<?php

$Prenom1=$_SESSION['Infos']['Prenom1'];

require 'modele/RequetesTest.php';
require 'modele/connexionbdd.php';

$TroisDerniersTests = TroisDerniersTestsPersonne($bdd,$_SESSION['NIR']);

if (empty($TroisDerniersTests)) {
	$ZeroTest = true;
} 
else {
	$ZeroTest = false;
}


//Récupérer les infos sur les derniers tests passés etc
require 'vues/AccueilCitoyen.php'; 