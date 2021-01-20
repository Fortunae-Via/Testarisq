<?php

session_start(); 

//On récupère les données de la session
$IdTest = $_SESSION['IdTest'];
$IdBoitier = $_SESSION['IdBoitier'];
$NumeroTest = $_SESSION['NumeroTest'] ;
$EtapeTest = $_SESSION['EtapeTest'] ;

require 'modele/connexionbdd.php';
require 'modele/RequetesGenerales.php';
require 'modele/RequetesTest.php';

require 'controleurs/FonctionsTest.php'; 


//Si on a fini le test
if ($NumeroTest > 5) { // On a donc fini le test complet

	require 'vues/FinTest.php';

}

//Sinon
else {

	//Si c'est la première étape d'un test on crée la mesure dans la bdd
	if ($EtapeTest==1) {

		if (in_array($NumeroTest,array(1,2))) {
			$IdTypeCapteur = 1; //capteur de réactivité
		}
		else if ($NumeroTest == 3) {
			$IdTypeCapteur = 2; //capteur de fréquence cardiaque
		}
		else if ($NumeroTest == 4) {
			$IdTypeCapteur = 3; //capteur de température
		}
		else if ($NumeroTest == 5) {
			$IdTypeCapteur = 4; //capteur de précision de tonalité
		}

		//On identifie le capteur unique contenu dans le boitier qui va faire la mesure
		$IdCapteur = IdCapteur($bdd,$IdBoitier,$IdTypeCapteur);
		//On crée une nouvelle mesure nulle pour l'instant et on note son ID
		$IdMesure = NouvelleMesure($bdd,$IdTest,$IdCapteur);
		$_SESSION['MesureEnCours'] = $IdMesure;
	}

	//Sinon on récupère l'id de celle notée en session
	else {
		 $IdMesure = $_SESSION['MesureEnCours'] ;
	}


	//Si l'utilisateur a appuyé sur valeur rentrée on vérifie que ce soit en effet le cas pour savoir si on affiche effectivement la page suivante ou non
	if ($EtapeTest==3) {

		if (ValeurRentree($bdd,$IdMesure)) {
			$ResultatMesure = ResultatMesure($bdd,$_SESSION['MesureEnCours']);
		}

		else {
			$EtapeTest = 2 ;
			$_SESSION['EtapeTest'] = 2 ;
			$MessageErreurValeurRentree = true;
		}
		
	}

	//On affiche
	switch($EtapeTest) {

		case 1 :		// Étape 1 
			require 'controleurs/Etape1.php';
			break;

		case 2 :		// Étape 2
			require 'controleurs/Etapes23.php';
			break;

		case 3 :		// Étape 3
			require 'controleurs/Etapes23.php';
			break;

	}


}

