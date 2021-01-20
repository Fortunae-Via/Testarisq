<?php


$classeheader = "etape1";
switch($NumeroTest) {

	case 1 :		// Stimulus sonore
		$nom_test = 'Mesure de la réactivité au bruit' ;
		$NumeroTestFR = ('Premier test');
		$infostest= <<<EOD
			<p>Ce premier test constitue une mesure de votre sensibilité sonore.</br>
			Pour cela, nous allons diffuser un son ...</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 2 :		// Stimulus visuel
		$nom_test = 'Mesure de la réactivité à la lumière' ;
		$NumeroTestFR = ('Second test');
		$infostest= <<<EOD
			<p>Ce second test constitue une mesure de votre sensibilité visuelle.</br>
			Pour cela, nous allons allumer une lumière ...</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 3 :		// Fréquence cardiaque
		$nom_test = 'Mesure de la fréquence cardiaque' ;
		$NumeroTestFR = ('Troisième test');
		$infostest= <<<EOD
			<p>Ce troisième test est une mesure de votre fréquence cardique.</br>
			Pour cela, nous utilisons un appareil ...</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 4 :		// Température superficielle de la peau
		$nom_test = 'Mesure de la température superficielle de la peau' ;
		$NumeroTestFR = ('Quatrième test');
		$infostest= <<<EOD
			<p>Ce quatrième test est une mesure de la température superficielle de votre peau.</br>
			Pour cela, nous allons ...</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;
		
	case 5 :		// Qualité de reconnaissance de tonalité
		$nom_test = 'Mesure de la qualité de reconnaissance de tonalité' ;
		$NumeroTestFR = ('Cinquième test');
		$infostest= <<<EOD
			<p>Ce dernier test constitue une estimation de la qualité de votre reconnaissance de tonalité.</br>
			Pour cela, nous allons diffuser un son ...</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

}