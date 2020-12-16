<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Recherche Utilisateur</title>
	<meta charset="ytf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/RechercheUtilisateur.css" />
</head>
<body>

	<!-- Header -->
	<?php include("php/header.php"); ?>
	
	<div class="div_page">
		<section>

			<form method="post">

				<h3>Identifiant ou nom du conducteur :</h3>
				<div class="barre_recherche">
					<input id="id_name" name="id_name"/>
					<button type="submit"><img class="search_icon" src="img/search_icon.png" alt="search_icon"/></button>
				</div>

				<div class="fitres">
					<label for="option">Filtrer par :</label>
					<select name="option option1" size="1">
						<option selected hidden>Sexe</option>
						<option>Homme</option>
						<option>Femme</option>
						<option>Autre</option>
						<option>Non-précisé</option>
					</select>
					<select name="option option2">
						<option selected hidden>Région</option>
						<?php
						try{
							$bdd = new PDO('mysql:host=localhost; dbname=departement', 'root', '');
						}catch(Exception $e){
							die('Erreur : '. $e->getMessage());
						}

						$region = $bdd->query('SELECT departement_nom FROM departement');
						while($display = $region->fetch()){
							echo'<option>'. $display['departement_nom'] .'</option>';
						}
						?>
					</select>
					<select name="option option3">
						<option selected hidden>Age</option>
					<?php
						for($i=date("Y"); $i>=1900; $i--){
							echo'<option>'. $i .'</option>';
						}
					?>
					</select>
					<label for="test_number">Nombre de tests passés : </label><input id="test_number" name="test_number"/>
				</div>
				
			</form>

			<h3>Utilisateur :</h3>
				<?php

				?>

		</section>
	</div>

</body>
</html>