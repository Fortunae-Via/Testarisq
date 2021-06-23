<?php

session_start(); 

// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil');
}

//On récupère les données de la session
$IdTest = $_SESSION['IdTest'];
$IdBoitier = $_SESSION['IdBoitier'];
$NumeroTest = $_SESSION['NumeroTest'] ;
$EtapeTest = $_SESSION['EtapeTest'] ;

require 'modele/connexionbdd.php';
require 'modele/RequetesGenerales.php';
require 'modele/RequetesTest.php';

require 'controleurs/FonctionsTest.php'; 
require 'controleurs/FonctionsLogs.php'; 


//Si on a fini le test
if ($NumeroTest > 5) { // On a donc fini le test complet

	require 'vues/FinTest.php';

}

//Sinon
else {

	switch ($EtapeTest){

		// Si c'est la première étape d'un test on note le type de capteur en session
		case 1:

			if ($NumeroTest == 1 OR $NumeroTest == 2) {
				$TypeCapteur = 1; //capteur de réactivité
			}
			else if ($NumeroTest == 3 OR $NumeroTest == 4 OR $NumeroTest == 5) {
				$TypeCapteur = $NumeroTest - 1;
				//capteur de fréquence cardiaque, température et précision de tonalité
			}

			$_SESSION['TypeCapteur'] = $TypeCapteur;

			break;


		// On vient de cliquer sur lancer le test
		case 2:
			// On enregistre le numéro de la dernière trame enregistrée sur le serveur
			$IdDerniereTrameLog = GetLastLogIndexForObject($IdBoitier);
			$_SESSION['DerniereTrameLog'] = $IdDerniereTrameLog;

			// On envoie la trame à la passerelle pour lancer le test
			SendCommand($IdBoitier, $NumeroTest);
			$TypeCapteur = $_SESSION['TypeCapteur'];
			// $IdBoitier ="G5A-";
			// $NumeroTest = 1 à 5;


		// Si l'utilisateur a appuyé sur valeur rentrée on vérifie que ce soit en effet le cas 
		// On ajoute alors la valeur à la BDD et on affiche la page suivante
		case 3:

			// Si on a effectué une mesure, on a rajouté une nouvelle ligne au fichier log
			$IdNouvelleDerniereTrameLog = GetLastLogIndexForObject($IdBoitier);
			if ($IdNouvelleDerniereTrameLog > $_SESSION['DerniereTrameLog']) {

				if (!(isset($_SESSION['ResultatMesure']))) {
					// On récupère la trame et ses informations
					$Logs = GetLogsForObject($IdBoitier);
					$NouvelleTrame = end($Logs);
					$InfosTrame = DecodeLogLine($NouvelleTrame);

					// On identifie le capteur unique contenu dans le boitier qui va faire la mesure
					$IdBoitierBDD = ($IdBoitier == "G5A-") ? 1 : $IdBoitier;
					$TypeCapteur = $_SESSION['TypeCapteur'];
					$IdCapteur = IdCapteur($bdd, $IdBoitierBDD, $TypeCapteur);
					
					// On récupère la valeur et on la convertit bien en chiffres
					if ($TypeCapteur == 2 OR $TypeCapteur == 3 OR $TypeCapteur == 4){    // BPM, température ou reco avec précision au dixième
						$ValeurTest = floatval($InfosTrame["Valeur"]) / 10;
					}
					else {
						$ValeurTest = floatval($InfosTrame["Valeur"]);
					}

					$score = Score($NumeroTest, $ValeurTest);
					
					// On ajoute la mesure à la BDD
					NouvelleMesure($bdd, $IdTest, $IdCapteur, $ValeurTest);

					if ($TypeCapteur == 4){
						$Resultat = $ValeurTest . ' ' . UniteMesure($bdd, $TypeCapteur);
					}
					else {
						$Resultat = $ValeurTest . ' ' . UniteMesure($bdd, $TypeCapteur) . ". Votre score est : " . $score;
					}
					$_SESSION['ResultatMesure'] = $Resultat; 
				}

				else {
					$Resultat = $_SESSION['ResultatMesure'];
				}

				

			}

			else {
				$EtapeTest = 2 ;
				$_SESSION['EtapeTest'] = 2 ;
				$MessageErreurValeurRentree = true;
			}

			break;

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

