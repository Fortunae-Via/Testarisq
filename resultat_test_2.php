<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="style/resultat_test_style.php" />
	<title>TESTARISQ - Mes résultats</title>
</head>
<body>

	<!-- Header -->
	<?php include("php/header.php"); ?>

	<h1>Résultat : Félicitations, vous êtes apte à conduire !</h1>
	
	<div class="div_page">
		<header>
            <h2>TEST DU 14/11//2020 </br>
            Détail de vos résultats :</h2>
        </header>
		<section id = "sect">
			<div class="resultat">
				<p>Test sonore :<span class="resultat_test">reconnaissance des sons dans un intervalle de 1 à 4 secondes.</span></p>
				<p>Test visuel à une lumière en extérieur :<span class="resultat_test">reconnaissance des lumières dans un intervalle de 1 à 2 secondes.</span></p>
				<p>Fréquence cardiaque :<span class="resultat_test">79 bpm</span></p>
				<p>Température de la peau :<span class="resultat_test">37,1°C</span></p>
				<p>Reproduction sonore :<span class="resultat_test">reproduction juste à +/- 15Hz</span></p>
			</div>
			<p class="bottom">Vous avez une question ? Posez-là <a href="mailto:tanguy.robilliard@gmail.com">ici</a> à un administrateur.</p>
		</section>
	</div>
	
</body>
</html>