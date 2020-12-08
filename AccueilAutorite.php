<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Accueil</title> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style/AccueilAutorite_style.php"/>
</head>

<body>

	<!-- Header -->
	<?php include("php/header.php"); ?>
	
	<div class="divpage">

		<h2 class="bienvenue">
			<?php
			$Personne_Prenom = 'Utilisateur' ;
			echo 'Bienvenue ' . $Personne_Prenom . ' !';
			?>
		</h2>

		<div class="heurelieu">

			<h1 id="heure"> <!-- On charge puis affiche l'heure avec du JS, donc actualisé en temps réel -->

				--:--	<!--texte affiché par défaut, avant d'être remplacé par l'heure-->

				<SCRIPT type=text/javascript>
					function afficher_heure() {
						var heure_actuelle = new Date();
						var heures = heure_actuelle.getHours();
						var minutes = heure_actuelle.getMinutes();
				        if (heures < 10) {heures = "0" + heures ;}
				        if (minutes < 10) {minutes = "0" + minutes ;}
				        document.getElementById("heure").innerHTML = heures +':'+ minutes; //on remplace le placeholder par l'heure mise en forme
				    } 
					window.setInterval("afficher_heure()",1000); //On actualise toutes les secondes
				</SCRIPT>
				
			</h1>

			<h1 id="lieu">Issy-Les-Moulineaux</h1>

		</div>

		<div class="modes">

			<!-- Panneau pour lancer le test -->

			<div class="mode test"> 

				<header>
					<a href="#">Mode Test<img class="switch_button" src="img/switch_button.png" alt="switch_button" href="#"/></a>
				</header>

				<form> 
					<div class="champ">
						<label for="identifiant">Identifiant du conducteur :</label><br>
						<input type="text" id="identifiant" name="identifiant"><br>
					</div>
					<div class="bouton">
						<input type="submit" value="Démarrer le test"><br>
					</div>
				</form>

			</div>

			<!-- Panneau pour lancer une recherche -->

			<div class="mode recherche">

				<header>
					<a href="#">Mode Recherche<img class="switch_button" src="img/switch_button.png" alt="switch_button" href="#"/></a>
				</header>

				<form> 
					<div class="champ">
						<label for="recherche">Identifiant ou nom du conducteur :</label><br>
						<input type="text" id="recherche" name="recherche"><br>
					</div>
					<div class="bouton">
						<input type="submit" value="Chercher l'utilisateur"><br>
					</div>
				</form>

			</div>
			

		</div>

	</div>

</body>

</html>