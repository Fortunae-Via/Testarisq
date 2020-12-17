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
	<?php include("php/header.php"); ?>
	
	<div class="divpage">

		<h2 class="bienvenue">
			<?php
                //Si on a déjà noté le Prénom1 dans la session
                if (isset($_SESSION['Prenom1'])) {
                    $Prenom1=$_SESSION['Prenom1'];
                }
                else {
                    $Infos=InfosPersonne($bdd,$_SESSION['NIR']);
                    $Prenom1=$Infos['Prenom1'];
                    $_SESSION['Prenom1'] = $Prenom1;
                }
                echo 'Bienvenue ' . $Prenom1 . ' !';
            ?>
		</h2>

		<div class="heurelieu">

			<h1 id="heure">

			<?php
			date_default_timezone_set("Europe/Paris");
			echo date('H') . ':' . date('i') ;
			/* heure donnée par le PHP affichée en premier, avant d'être remplacée par l'heure actualisée chargée par le JS */
			?>

			</h1>
			

			<h1 id="lieu">

			<!--localisation par défaut, déterminée à partir de l'adresse ip-->
			<!--
			<?php
			try {
				if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //Si l'utilisateur utilise un proxy
				    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} 
				else {
				    $ip = $_SERVER['REMOTE_ADDR'];
				}
				$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
				echo $details->city;
			} 
			catch (Exception $e) {}
			?>
			La partie PHP fonctionnera sur un vrai serveur mais ne fonctionne pas en local-->

			</h1>

		</div>

		<div class="modes">


			<!-- Panneau pour lancer le test -->

			<div class="mode test" id="bloctest" style="display: block;"> 

				<header>
					<button onClick="BasculerMode()">Mode Test<img class="switch_button" src="img/switch_button.png" alt="switch_button"/></button>
				</header>

				<form> 
					<div class="champ">
						<label for="identifiant">Identifiant du conducteur :</label><br>
						<input type="text" id="identifiant" name="identifiant"><br>
						<label for="idboitier">Numéro du boîtier test :</label><br>
						<input type="text" id="idboitier" name="idboitier"><br>
					</div>
					<div class="bouton">
						<input type="submit" value="Démarrer le test"><br>
					</div>
				</form>

			</div>

			<!-- Panneau pour lancer une recherche -->

			<div class="mode recherche" id ="blocrecherche" style="display: none;">

				<header>
					<button onClick="BasculerMode()">Mode Recherche<img class="switch_button" src="img/switch_button.png" alt="switch_button"/></button>
				</header>

				<form method="post" action="RechercheUtilisateur.php"> 
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

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>
	<script type="text/javascript" src="js/AccueilAutorite.js"></script>


</body>

</html>