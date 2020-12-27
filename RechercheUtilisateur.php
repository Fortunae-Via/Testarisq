<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='AUE' AND $_SESSION['TypeCompte']!='POL' ) {	
	header('Location: Accueil.php');
}

?>

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
		<?php
		if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){
		?>
			<section>

				<form method="post">

					<h3>Identifiant ou nom du conducteur :</h3>
					<div class="barre_recherche">
						<input id="id_name" name="id_name"/>
						<button type="submit"><img class="search_icon" src="img/search_icon.png" alt="search_icon"/></button>
					</div>

					<div class="fitres">
						<label for="option">Filtrer par :</label>
						<select name="sexe" size="1">
							<option selected hidden>Sexe</option>
							<option value="Homme">Homme</option>
							<option value="Femme">Femme</option>
							<option value="Autre">Autre</option>
							<option value="Non-précisé">Non-précisé</option>
						</select>
						<select name="region">
							<option selected hidden>Région</option>
							<?php
							try{
								$bdd = new PDO('mysql:host=localhost; dbname=departement', 'root', 'root');
							}catch(Exception $e){
								die('Erreur : '. $e->getMessage());
							}

							$region = $bdd->query('SELECT departement_nom FROM departement');
							while($display = $region->fetch()){
								echo'<option value="'. $display['departement_nom'] .'">'. $display['departement_nom'] .'</option>';
							}
							$region->closeCursor();
							?>
						</select>
						<select name="year">
							<option selected hidden>Année</option>
						<?php
							for($i=date("Y"); $i>=1900; $i--){
								echo'<option value="'. $i .'">'. $i .'</option>';
							}
						?>
						</select>
						<label for="test_number">Nombre de tests passés : </label><input id="test_number" name="test_number"/>	
					</div>

				</form>

				<h3>Utilisateur :</h3>
					<?php
					require 'modele/connexionbdd.php';

					/**count() des test where id_personne = machin**/
					$regex = '"^' . $_POST['id_name'] . '"';
					$year = '"^'.$_POST['year'].'"';
					/*$adresse = '"^'.$_POST['region'].'"';*/

					/*$recherche = $bdd->prepare('SELECT * FROM personne WHERE Sexe=? OR DateNaissance=? OR NIR=? OR NomDeFamille=? OR NomDUsage=? OR Prenom1=? OR Prenom2=? OR Prenom3=? /*WHERE Identifiant unique*/ /*REGEXP' /*. $regex);*/

					/*$recherche = $bdd->query('SELECT * FROM personne WHERE Sexe="'. $_POST['sexe'] .'" OR DateNaissance REGEXP'. $year .' OR NIR REGEXP'. $regex . ' OR NomDeFamille REGEXP'. $regex . ' OR NomDUsage REGEXP'. $regex . ' OR Prenom1 REGEXP'. $regex . ' OR Prenom2 REGEXP'. $regex . ' OR Prenom3 REGEXP'. $regex . '');*/

					$recherche = $bdd->query('SELECT * FROM personne JOIN adresse ON personne.Adresse_Id=adresse.Id WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance REGEXP'. $year .' OR (personne.NIR OR personne.NomDeFamille OR personne.NomDUsage OR personne.Prenom1 OR personne.Prenom2 OR personne.Prenom3) REGEXP'. $regex .' OR adresse.Region="'. $_POST['region'] .'"');

					/*$recherche->execute(array($_POST['sexe'], $year, $_POST['id_name'], $_POST['id_name'], $_POST['id_name'], $_POST['id_name'], $_POST['id_name'], $_POST['id_name']));*/
					?>
					<table>
						<tr>
							<th>Id</th>
							<th>Nom de famille</th>
							<th>Nom d'usage</th>
							<th>Prénom</th>
							<th>Date de naissance</th>
							<th>Sexe</th>
							<th>Courriel</th>
							<th>Téléphone</th>
							<th>Adresse</th>
							<th>Nombre de test<span style="font-size:11px;">(s)</span> passé<span style="font-size:11px;">(s)</span></th>
						</tr>
					<?php
					while($display = $recherche->fetch()){
						echo'<tr><th>'. $display['NIR'] . '</th><th>' . $display['NomDeFamille'] . '</th><th>' . $display["NomDUsage"] . '</th><th>'. $display['Prenom1'] . ' '. $display['Prenom2'] . ' '. $display['Prenom3'] . '</th><th>'. $display['DateNaissance'] . '</th><th>'. $display['Sexe'] . '</th><th>'. $display['Courriel'] . '</th><th>'. $display['Portable'] . '</th><th>' . $display['NumeroRue'] . ' ' . $display['Rue'] . ' ' . $display['CodePostal'] . ' ' . $display['Ville'] . ' ' . $display['Region'] . ' ' . $display['Pays'] ./*$display['nbr_test'] .*/ '</th></tr>';
					}
					$recherche->closeCursor();
					?>
					</table>
			</section>

		<?php
		}else{
		?>
			<section>

				<form method="post">

					<h3>Identifiant ou nom du conducteur :</h3>
					<div class="barre_recherche">
						<input id="id_name" name="id_name"/>
						<button type="submit"><img class="search_icon" src="img/search_icon.png" alt="search_icon"/></button>
					</div>

					<div class="fitres">
						<label for="option">Filtrer par :</label>
						<select name="sexe" size="1">
							<option selected hidden>Sexe</option>
							<option value="Homme">Homme</option>
							<option value="Femme">Femme</option>
							<option value="Autre">Autre</option>
							<option value="Non-precise">Non-précisé</option>
						</select>
						<select name="region">
							<option selected hidden>Région</option>
							<?php
							try{
								$bdd = new PDO('mysql:host=localhost; dbname=departement', 'root', '');
							}catch(Exception $e){
								die('Erreur : '. $e->getMessage());
							}

							$region = $bdd->query('SELECT departement_nom FROM departement');
							while($display = $region->fetch()){
								echo'<option value="'. $display['departement_nom'] .'">'. $display['departement_nom'] .'</option>';
							}
							$region->closeCursor();
							?>
						</select>
						<select name="year">
							<option selected hidden>Année</option>
						<?php
							for($i=date("Y"); $i>=1900; $i--){
								echo'<option value="'. $i .'">'. $i .'</option>';
							}
						?>
						</select>
						<label for="test_number">Nombre de tests passés : </label><input id="test_number" name="test_number"/>	
					</div>
				</form>

				<h3>Utilisateur :</h3>
				<table>
					<tr>
						<th>Id</th>
						<th>Nom de famille</th>
						<th>Nom d'usage</th>
						<th>Prénom</th>
						<th>Date de naissance</th>
						<th>Sexe</th>
						<th>Courriel</th>
						<th>Téléphone</th>
						<th>Adresse</th>
						<th>Nombre de test<span style="font-size:11px;">(s)</span> passé<span style="font-size:11px;">(s)</span></th>
					</tr>
				</table>
			</section>
		<?php
		}
		?>
	</div>

</body>
</html>