<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Accueil</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/AccueilAutorite.css" />
</head>

<body>

	<!-- Header -->
	<?php include("vues/Header.php"); ?>
	
	<div class="divpage">

		<h2 class="bienvenue">
			<?php echo 'Bienvenue ' . $Prenom1 . ' !'; ?>
		</h2>

		<div class="heurelieu">

			<h1 id="heure">

			<?php echo $heure ; ?>
			<!-- heure donnée par le PHP affichée en premier, avant d'être remplacée par l'heure actualisée chargée par le JS -->
			
			</h1>
			

			<h1 id="lieu">

			<!--localisation par défaut, déterminée à partir de l'adresse ip-->
			<!--	<?php echo $ville; ?>
			La partie PHP fonctionnera sur un vrai serveur mais ne fonctionne pas en local-->

			</h1>

		</div>

		<div class="modes">


			<!-- Panneau pour lancer le test -->

			<div class="mode test" id="bloctest" style="display: block;"> 

				<header>
					<button onClick="BasculerMode()">Mode Test<img class="switch_button" src="vues/img/switch_button.png" alt="switch_button"/></button>
				</header>

				<?php
                    if (isset($_SESSION['ErreurLancementTest'])) {
                    	$affichage = '<h3>' . $_SESSION['ErreurLancementTest'] . '</h3>';
                		echo $affichage;
                    }
                ?>

				<form method="post" action="controleurs/NouveauTest.php"> 
					<div class="champ">
						<label for="NIRConducteur">NIR du conducteur :</label><br>
						<input type="text" id="NIRConducteur" name="NIRConducteur" required><br>
						<label for="IdBoitier">Numéro du boîtier test :</label><br>
						<input type="text" id="IdBoitier" name="IdBoitier" required><br>
						<input type="hidden" name="LatitudeTest" id="LatitudeTest" value=""/>
						<input type="hidden" name="LongitudeTest" id="LongitudeTest" value=""/>
					</div>
					<div class="bouton">
						<input type="submit" value="Démarrer le test"><br>
					</div>
				</form>

			</div>

			<!-- Panneau pour lancer une recherche -->

			<div class="mode recherche" id ="blocrecherche" style="display: none;">

				<header>
					<button onClick="BasculerMode()">Mode Recherche<img class="switch_button" src="vues/img/switch_button.png" alt="switch_button"/></button>
				</header>

				<form method="post" action="RechercheUtilisateur"> 
					<div class="champ">
						<label for="id_name">NIR ou nom du conducteur :</label><br>
						<input type="text" id="recherche" name="id_name" required><br>
					</div>
					<div class="bouton">
						<input type="submit" value="Chercher l'utilisateur"><br>
					</div>
				</form>

			</div>
			

		</div>

	</div>

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>
	<script type="text/javascript" src="js/AccueilAutorite.js"></script>


</body>

</html>