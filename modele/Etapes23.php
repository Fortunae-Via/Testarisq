<?php

$classeheader = "etapesuivantes";

switch($NumeroTest) {

	case 1 :		// Stimulus sonore
		$nom_test = 'Mesure de la réactivité au bruit' ;
		$NumeroTestFR = ('Premier test');
		require 'vues/EtapesTest.php';
		break;

	case 2 :		// Stimulus visuel
		$nom_test = 'Mesure de la réactivité à la lumière' ;
		$NumeroTestFR = ('Second test');
		require 'vues/EtapesTest.php';
		break;

	case 3 :		// Fréquence cardiaque
		$nom_test = 'Mesure de la fréquence cardiaque' ;
		$NumeroTestFR = ('Troisième test');
		require 'vues/EtapesTest.php';
		break;

	case 4 :		// Température superficielle de la peau
		$nom_test = 'Mesure de la température superficielle de la peau' ;
		$NumeroTestFR = ('Quatrième test');
		require 'vues/EtapesTest.php';
		break;
		
	case 5 :		// Qualité de reconnaissance de tonalité
		$nom_test = 'Mesure de la qualité de reconnaissance de tonalité' ;
		$NumeroTestFR = ('Cinquième test');
		require 'vues/EtapesTest.php';
		break;

}