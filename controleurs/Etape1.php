<?php


$classeheader = "etape1";
switch($NumeroTest) {

	case 1 :		// Stimulus sonore
		$nom_test = 'Mesure de la réactivité au bruit' ;
		$NumeroTestFR = ('Premier test');
		$infostest= <<<EOD
			<p>Ce premier test constitue une mesure de votre sensibilité sonore.</br>
			Pour cela, nous allons vous faire écouter un son à un moment aléatoire une fois le test commencé.
			Lorsque vous entendrez le son, il vous suffira d'appuyer le plus rapidement possible sur le bouton.
			Nous pourrons alors mesurer votre temps de réaction.</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 2 :		// Stimulus visuel
		$nom_test = 'Mesure de la réactivité à la lumière' ;
		$NumeroTestFR = ('Second test');
		$infostest= <<<EOD
			<p>Ce second test constitue une mesure de votre sensibilité visuelle.</br>
			Pour cela, nous allons allumer une lumière à un moment aléatoire.
			Lorsque vous verrez la lumière, appuyez sur le bouton le plus rapidement possible.
			Nous pourrons alors mesurer votre temps de réaction.</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 3 :		// Fréquence cardiaque
		$nom_test = 'Mesure de la fréquence cardiaque' ;
		$NumeroTestFR = ('Troisième test');
		$infostest= <<<EOD
			<p>Ce troisième test est une mesure de votre fréquence cardique.</br>
			Pour cela, nous utilisons un capteur de fréquence. Il vous suffit de placer votre index entre
			la lumière et le phototransistor (avec l'ongle de préférance côté transistor).
			Nous pourrons alors mesurer efficacement votre fréquence cardiaque.</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

	case 4 :		// Température superficielle de la peau
		$nom_test = 'Mesure de la température superficielle de la peau' ;
		$NumeroTestFR = ('Quatrième test');
		$infostest= <<<EOD
			<p>Ce quatrième test est une mesure de la température superficielle de votre peau.</br>
			Il vous suffit d'être au contact du capteur thermique afin que nous puissions mesurer votre temperature superficielle, 
			et en déterminer à l'aide du test précédent votre niveau de stress.</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;
		
	case 5 :		// Qualité de reconnaissance de tonalité
		$nom_test = 'Mesure de la qualité de reconnaissance de tonalité' ;
		$NumeroTestFR = ('Cinquième test');
		$infostest= <<<EOD
			<p>Ce dernier test constitue une estimation de la qualité de votre reconnaissance de tonalité.</br>
			Pour cela, nous allons diffuser un son correspondant à une note précise entre 130 et 4000 hertz.
			Essayer de reproduire le son de la manière la plus exacte possible.</p>
			EOD;
		require 'vues/EtapesTest.php';
		break;

}