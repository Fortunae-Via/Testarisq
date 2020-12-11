<!DOCTYPE html>
<html>
	<head>
		<title>Testarisq - Rechercher Utilisateur</title>
		<meta charset="ytf-8"/>
		<link rel="stylesheet" href="style/RechercherUtilisateur.css"/>
	</head>
	<body>
		<section>
			<form method="post">
				<h3>Identifiant ou nom du conducteur :</h3>
				<input id="id_name" name="id_name"/><button type="submit">Rechercher</button><br/>
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
			</form>
			<h3>Utilisateur :</h3>
				<?php

				?>
		</section>
	</body>
</html>