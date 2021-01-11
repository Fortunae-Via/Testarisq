<?php
	// Section pour tester les versions light des autorité
	// A supprimer
	session_start();
	$_SESSION['TypeCompte']='ADM';
?>

<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Recherche Utilisateur</title>
	<meta charset="utf-8"/>
	<!-- Appel du stylesheet commun à toutes les pages -->
	<link rel="stylesheet" href="style/style_commun.css" />
	<!-- Appel du stylesheet particulier au header -->
	<link rel="stylesheet" href="style/header.css" />
	<link rel="stylesheet" href="style/RechercheUtilisateur.css"/>
</head>
<body>

	<!-- include Header -->
	<?php include("vues/Header.php"); ?>
	
	<!-- Section principale de la page -->
	<div class="div_page">
		<?php
		//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
		if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){
		?>
		<!-- Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche-->
			<section>
				<form method="post">

					<!-- Barre de recherche input="id_name"-->
					<h3>Identifiant ou nom du conducteur :</h3>
					<div class="barre_recherche">
						<input id="id_name" name="id_name"/>
						<button type="submit"><img class="search_icon" src="vues/img/search_icon.png" alt="search_icon"/></button>
					</div>

					<div class="fitres">
						<label for="option">Filtrer par :</label>

						<!-- Filtrer par sexe -->
						<select name="sexe" size="1">
							<option selected hidden>Sexe</option>
							<option value="Homme">Homme</option>
							<option value="Femme">Femme</option>
							<option value="Autre">Autre</option>
							<option value="Non-précisé">Non-précisé</option>
						</select>

						<!-- Filtrer par region -->
						<select name="region">
							<option selected hidden>Région</option>
							<?php
							/**
							Appel d'une base de donnée nommé departement qui contient 
							une liste des noms des départements
							de la France
							**/
							/*try{
								$bdd = new PDO('mysql:host=localhost;dbname=departement;port=3308', 'root', '');
							}catch(Exception $e){
								die('Erreur : '. $e->getMessage());
							}*/
							require("modele/connexionbdd.php");

							/**
							On Affiche les différents départements dans notre select en tant que option,
							ainsi ils peuvent être selectionnés et envoyer par formulaire
							sous $_POST['region']
							**/
							$region = $bdd->query('SELECT Region FROM regionfr');
							while($display = $region->fetch()){
								echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
							}
							$region->closeCursor();
							?>
						</select>

						<!-- Filtrer par Année (de Naissance) -->
						<!--
							On aurait pu penser à un filtrage par tranche d'âge
							Pour l'instant le choix à été fait de garder le choix d'une année
							précise. La base de donnée étant sensé recenser un nombre important
							de citoyens.
						-->
						<select name="year">
							<option selected hidden>Année</option>
						<?php
							for($i=date("Y"); $i>=1900; $i--){
								echo'<option value="'. $i .'">'. $i .'</option>';
							}
						?>
						</select>

						<!-- Filtre par nombre de test passés -->
						<label for="test_number">Nombre de tests passés : </label><input id="test_number" name="test_number"/>	
					</div>

				</form>

				<!-- Affichage des résultats d'un recherche -->
				<h3>Utilisateur :</h3>
					<?php
					// Appel de la base de données du projet
					/*try{
						$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
					}catch(Exception $e){
						die('Erreur : '. $e->getMessage());
					}*/
					require("modele/connexionbdd.php");

					/**
						Definition des regex pour le nom recherché.
					**/
					$regex = '"%' . $_POST['id_name'] . '%"';

					/**
						La requête SQL permet d'aller récuperer dans la base de donnée
						les informations concernant des utilisateurs en fonction des différents
						choix fait dans le formulaire (et donc les filtres).
					
						A faire : Nombre de tests
					**/
					$recherche = $bdd->query('SELECT * FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance LIKE "'. $_POST['year'] .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $_POST['region'] .'"');
					/*$recherche = $bdd->query('SELECT *, COUNT(*) AS count_test FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id INNER JOIN test ON personne.NIR=test.Personne_NIR WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance LIKE "'. $_POST['year'] .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $_POST['region'] .'"');*/
					?>

					<!-- L'Affichage des résultats se trouve sous forme de tableaux -->
					<table>
						<tr>
							<!-- Nom des colonnes -->
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
							<?php
							/**
								Affichage des options de modification ou de suppression
								d'un compte en fonction du type de compte de
								la session de l'utilisateur.
								C'est-à-dire que lorsqu'un administrateur est connecté
								il a accès au options alors qu'un officier ou une auto-école non.
							**/
								if(isset($_SESSION['TypeCompte'])){
									if($_SESSION['TypeCompte']=='ADM'){
										echo'<th>Options</th>';
									}
								}
							?>
						</tr>

					<?php
					/**
						Affichage des résultats d'une recherche.
						On affiche les informations concernant un utilisateur
						selon les filtres utilisés et donc la requête SQL executée
						quelques lignes au-dessus.
					**/
					while($display = $recherche->fetch()){
						echo'<tr><th>'. $display['NIR'] . '</th><th>' . $display['NomDeFamille'] . '</th><th>' . $display["NomDUsage"] . '</th><th>'. $display['Prenom1'] . ' '. $display['Prenom2'] . ' '. $display['Prenom3'] . '</th><th>'. $display['DateNaissance'] . '</th><th>'. $display['Sexe'] . '</th><th>'. $display['Courriel'] . '</th><th>'. $display['Portable'] . '</th><th>' . $display['NumeroRue'] . ' ' . $display['Rue'] . ' ' . $display['CodePostal'] . ' ' . $display['Ville'] . ' ' . $display['Region'] . ' ' . $display['Pays'] . '</th><th>'. ' ' . '</th>';
						/**
							Affiche les boutons permettant la modification ou la suppression de l'utilisateur de la ligne correspondante
							à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'utilisateur.
							Cette partie est seulement accèssible aux administrateurs.
						**/
						if(isset($_SESSION['TypeCompte'])){
							if($_SESSION['TypeCompte']=='ADM'){
								echo'<th><a href="ModifierUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/modif.png"/></a><a href="SupprimerUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/suppr.png"/></a></th></tr>';
							}
						}
					}
					//Fermeture de la requête SQL
					$recherche->closeCursor();
					?>
					</table>
					<!-- Fin  du tableaux et de la section d'affichage des résultats -->
			</section>

		<?php
		}else{
		?>
			<!--
				Cas où aucun des filtres n'a été utilisé et qu'aucun utilisateur n'a été 
				rechercher (cas par défaut, ie. arriver sur la page)
			-->

			<!-- Les commentaires ne varient pas entre les deux sections -->
			<section>
				<form method="post">
					<h3>Identifiant ou nom du conducteur :</h3>
					<div class="barre_recherche">
						<input id="id_name" name="id_name"/>
						<button type="submit"><img class="search_icon" src="vues/img/search_icon.png" alt="search_icon"/></button>
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
							/*try{
								$bdd = new PDO('mysql:host=localhost; dbname=departement;port=3308', 'root', '');
							}catch(Exception $e){
								die('Erreur : '. $e->getMessage());
							}*/
							require("modele/connexionbdd.php");


							$region = $bdd->query('SELECT Region FROM regionfr');
							while($display = $region->fetch()){
								echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
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
						<?php
							if(isset($_SESSION['TypeCompte'])){
								if($_SESSION['TypeCompte']=='ADM'){
									echo'<th>Options</th>';
								}
							}
						?>
					</tr>
				</table>
			</section>
		<?php
		}
		?>
	</div>

</body>
</html>