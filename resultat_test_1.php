<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
require 'modele/connexionbdd.php';
include('modele/RequetesTest.php');
include("vues/Header.php");
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/resultat_test.css" />
	<title>TESTARISQ - Mes résultats</title>
</head>
<body>

	<div class="div_page">
		<header>
			<h1>Résultat : <?php Apte($bdd,$_SESSION['NIR']) ?></h1>


            <h2>Détail de vos résultats :</h2>
        </header>


	

		
<section id = "sect">
	<div class="resultat">

		<p>Réactivité au son et aux lumières :<span class="resultat_test"></br>
		<?php AfficherRéactivité($bdd,$_GET['Id_Resultat']); ?></span></p>

		<p>Fréquence cardiaque :<span class="resultat_test"><?php AfficherFrequenceCard($bdd,$_GET['Id_Resultat']); ?> bpm.</span></p>

		<p>Température de la peau :<span class="resultat_test"><?php AfficherTemperature($bdd,$_GET['Id_Resultat']); ?> °C.</span></p>

		<p>Reproduction sonore :<span class="resultat_test">reproduction juste à +/- <?php AfficherTonalite($bdd,$_GET['Id_Resultat']); ?> Hz.</span></p>
	</div>
		<p class="bottom">Vous avez une question ? Posez-là <a href="mailto:tanguy.robilliard@gmail.com">ici</a> à un administrateur.</p>
		</section> 
	</div>
	
</body>
</html>
