<!DOCTYPE html>
<html>
	<head>
		<title>Testarisq - Rechercher Utilisateur</title>
		<meta charset="ytf-8"/>
		<link rel="stylesheet" href="style/RechercherUtilisateur.css"/>
	</head>
	<body>
		<?php
		if(isset($_POST['id_name'])&&isset($_POST['option1'])&&isset($_POST['option2'])&&isset($_POST['option3'])&&isset($_POST['test_number'])){
		?>
			<section>
				<form method="post">
					<h3>Identifiant ou nom du conducteur :</h3>
					<input id="id_name" name="id_name" type="search"/><!--<button type="submit">Rechercher</button>--><br/>
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
					try{
						$bdd = new PDO('mysql:host=localhost; dbname=departement', 'root', '');
					}catch(Exception $e){
						die('Erreur : '. $e->getMessage());
					}
					/**count() des test where id_personne = machin**/
					$regex = '"^' . $_POST['id_name'] . '"';
					$region = $bdd->query('SELECT * FROM Personne WHERE id REGEXP' . $regex);
					while($display = $region->fetch()){
						echo'<p>' $display['name_1'] . $display['name_2'] . $dislay['surname'] . $display['nbr_test'] . '</p>';
					}
					?>
			</section>
		<?php
		}else{
		?>
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
			</section>
		<?php
		}
		?>
	</body>
</html>