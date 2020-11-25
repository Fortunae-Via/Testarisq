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

			<h1 class="heure">
				<script type="text/javascript">
				var currentTime = new Date()
				var hours = currentTime.getHours()
				var minutes = currentTime.getMinutes()
				if (minutes < 10){
				minutes = "0" + minutes
				}
				document.write(hours + ":" + minutes + " ")
				</script>
			</h1>

			<h1 classe="lieu">Issy-Les-Moulineaux</h1>

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