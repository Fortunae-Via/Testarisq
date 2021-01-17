<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil.php');
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>TESTARISQ - Modifier Utilisateur</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style/style_commun.css" />
		<link rel="stylesheet" href="style/header.css" />
		<!--
			On peut utiliser la stylesheet de la page GestionUtilisateurs.
			Comme les deux pages se ressemblent de par leur formulaire identique.
		-->
		<link rel="stylesheet" href="style/GestionUtilisateurs.css"/>
		<!-- Pour les spécificités de cette page-->
		<link rel="stylesheet" href="style/ModifierUtilisateur.css"/>
	</head>
	<body>
		<?php
			// On effectue la modification du profil utilisateur d'identifiant $_GET['NIR']
			if(isset($_GET['NIR'])){
				// Appel à la base de donnée
				require("modele/connexionbdd.php");

				// Si l'une (et une seule suffit) des données du profil est modifié Alors :
				if(isset($_POST['nom']) || isset($_POST['nom_usage']) || isset($_POST['prenom']) || isset($_POST['prenom_2']) || isset($_POST['prenom_3']) || isset($_POST['sexe']) || isset($_POST['mail']) || isset($_POST['telephone']) || isset($_POST['numeroRue']) ||isset($_POST['rue']) || isset($_POST['ville']) || isset($_POST['code']) || isset($_POST['region']) || isset($_POST['pays']) || isset($_POST['jour']) || isset($_POST['mois']) || isset($_POST['annee'])){

					$DateNaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];

					// La base de donnée est Mise à Jour (UPDATE) avec les informations du formulaire
					// Mise à Jour de la table "personne"
					$update = $bdd->prepare("UPDATE personne SET NomDeFamille=?, NomDUsage=?, Prenom1=?, Prenom2=?, Prenom3=?, Sexe=?, Courriel=?, Portable=?, DateNaissance=? WHERE NIR=?");
					$update->execute(array($_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $DateNaissance, $_GET['NIR']));
					$update->closeCursor();

					// Mise à Jour de la table "adresse"
					$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=? ');
					$update->execute(array($_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['pays'], $_POST['region'], $_GET['NIR']));
					$update->closeCursor();


					sleep(1);
					$_SESSION['MessageModifsUtilisateur'] = "L'utilisateur a bien été ajouté";
					$_SESSION['RechercheEnCours'] = true;
					header('Location: GestionUtilisateurs.php');
					

				}else{

					// Récuperation des informations de l'utilisateur d'identifiant $_GET['NIR']
					require 'modele/RequetesGenerales.php';
					$InfosPersosUser = InfosPersonne($bdd, $_GET['NIR']);
					$AdresseUser = InfosAdresse($bdd, $InfosPersosUser['Adresse_Id']);

					$MoisFR=array('Jan.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov','Déc.');
					$Annee=substr($InfosPersosUser['DateNaissance'], 0, 4); 
					$Mois=intval(substr($InfosPersosUser['DateNaissance'], 5, 2)); //On récupère le mois et on convertit en int pour enlever l'éventuel 0 devant
					$Jour=intval(substr($InfosPersosUser['DateNaissance'], 8, 2)); //pareil


					//Liste des placeholders pour les champs potentiellement vides
					$Placeholders = array(
						'NomDUsage' => "Nom d'usage",	'Prenom2' => "2ème Prénom",
						'Prenom3' => "3ème Prénom",		'NumeroRue' => "N°",
						'Rue' => "Rue",					'CodePostal' => "Code Postal",
						'Ville' => "Ville",				'Pays' => "Pays",						
						'Portable' => "xxxxxxxxxx");
					//On crée tous les préremplissages, et si c'est vide on note juste le placeholder
					$ListeChamps = array('NomDeFamille','NomDUsage','Prenom1','Prenom2','Prenom3','Courriel','NumeroRue','Rue','CodePostal','Ville','Pays','Portable');
					$PreRemp = array_merge($InfosPersosUser,$AdresseUser);

					foreach ($ListeChamps as $champ) {
						if(empty($PreRemp[$champ])) { //donne if(empty($InfosPersosUser['NomDUsage'])) etc
							$PreRemp[$champ]="placeholder=\"".$Placeholders[$champ]. "\"";
						}
						else {
							$PreRemp[$champ]="value=\"".$PreRemp[$champ]. "\"";
						}
					
					}

		?>

		<!-- Header -->
	    <?php include("vues/Header.php"); ?>

		<div class="div_page">

			<header>
	            <h2>Modifier l'utilisateur <?=($InfosPersosUser['Prenom1']  ." ". $InfosPersosUser['NomDeFamille'])?> (NIR : <?=$InfosPersosUser['NIR']?>) :</h2>
	        </header>

			<div id="ajout" class="bloc">

				<form method="post">

					<p class="indication">Les champs indiqués d'une étoile sont obligatoires.</p>

					<div class="ligne">
						<div class="info">
							<label for="nom">Nom de famille<strong>*</strong> :</label>
						</div>
						<!-- Pré-remplissage du formulaire dans le cas où aucune modification n'est faite -->
						<input name="nom" <?=$PreRemp['NomDeFamille']?> />
					</div>

					<div class="ligne">
						<div class="info">
							<label for="nom_usage">Nom d'usage :</label>
						</div>
						<input name="nom_usage" <?=$PreRemp['NomDUsage']?> />
					</div>

					<div class="ligne">
						<div class="info">
							<label for="surname">Prénoms<strong>*</strong> : <br/></label>
						</div>
						<div class="special_size_inputs">
							<p>
								<input maxlength="12" id="prenom" name="prenom" <?=$PreRemp['Prenom1']?> />
								<input maxlength="12" id="prenom_2" name="prenom_2" <?=$PreRemp['Prenom2']?> />
								<input maxlength="12" id="prenom_3" name="surname_3" <?=$PreRemp['Prenom3']?> />
							</p>
						</div>
					</div>

					<div class="ligne">
						<div class="info">
							<label for="birthdate">Date de naissance<strong>*</strong> :</label>
    					</div>

	    					<div class="special_size_inputs">
							<p>	
								<select name="jour">
									<?php
									for($i=1; $i<=31; $i++){
										if ($i == $Jour) {
											echo"<option value=\"". $i ."\" selected >" . $i . "</option>";
										}
										else {
											echo"<option value=\"". $i ."\">" . $i . "</option>";
										}	
									}
									?>
								</select>
								/
								<select name="mois">
									<?php
									for($i=1; $i<=12; $i++){
										if ($i == $Mois) {
											echo"<option value=\"". $i ."\" selected >" . $MoisFR[$i-1] . "</option>";
										}
										else {
											echo"<option value=\"". $i ."\">" . $MoisFR[$i-1] . "</option>";
										}	
									}
									?>
								</select>
								/
								<select name="annee">
									<?php
									for($i=date("Y"); $i>=1900; $i--){
										if ($i == $Annee) {
											echo"<option value=\"". $i ."\" selected >" . $i . "</option>";
										}
										else {
											echo'<option value="'. $i .'">'. $i .'</option>';
										}
									}
									?>
								</select>
							</p>
						</div>
					</div>

					<div class="ligne">
						<div class="info">
    						<label for="sex">Sexe<strong>*</strong> :</label>
    					</div>
    					<?php
    					?>
    					<div class="bloc_boutons">
							<input type="radio" id="Homme" name="sexe" value="Homme" <?php if($InfosPersosUser['Sexe']=="Homme"){echo "checked";} ?>/>
							<label for="Homme">Homme</label>
							<input type="radio" id="Femme" name="sexe" value="Femme" <?php if($InfosPersosUser['Sexe']=="Femme"){echo "checked";} ?>/>
							<label for="Femme">Femme</label>
							<input type="radio" id="Autre" name="sexe" value="Autre" <?php if($InfosPersosUser['Sexe']=="Autre"){echo "checked";} ?>/>
							<label for="Autre">Autre</label>
							<input type="radio" id="Non-precise" name="sexe" value="Non-precise" <?php if($InfosPersosUser['Sexe']=="Non-precise"){echo "checked";} ?>/>
							<label for="Non-precise">Non-précisé</label>
	         				</div>	
					</div>

					<div class="ligne">
						<div class="info">
		 						<label for="mail">Courriel<strong>*</strong> :</label>
		 					</div>
						<input name="mail" <?=$PreRemp['Courriel']?> /><br/>
					</div>

					<div class="ligne">
						<div class="info">
							<label for="adresse">Adresse :</label>
						</div>
						<div class="special_size_inputs">
							<input maxlength="4" id="numeroRue" name="numeroRue"<?=$PreRemp['NumeroRue']?> />
							<input maxlength="20" id="rue" name="rue" <?=$PreRemp['Rue']?> />
							<input maxlength="12" id="ville" name="ville" <?=$PreRemp['Ville']?> /><br/>
							<input maxlength="6" id="code" name="code" <?=$PreRemp['CodePostal']?> />
							<select name="region">
								<option value="">Région</option>
								<?php
									require("modele/connexionbdd.php");


									$region = $bdd->query('SELECT Region FROM regionfr');
									while($display = $region->fetch()){
										if($display['Region']==$AdresseUser['Region']){
											echo'<option selected value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
										}else{
											echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
										}
									}
									$region->closeCursor();
								?>
							</select>
							<!--<input maxlength="12" id="region" name="region" value=<?php echo $Region; ?> />-->
							<input maxlength="10" id="pays" name="pays" <?=$PreRemp['Pays']?> />
						</div>
					</div>

					<div class="ligne">
						<div class="info">
							<label id="telephone" for="telephone">Téléphone portable :</label>
						</div>
						<input id="telephone" name="telephone" <?=$PreRemp['Portable']?> /><br/>
					</div>

					<div class="bloc_add"> 
						<button id="add" type="submit">Modifier Utilisateur</button>
					</div>

				</form>
			</div>
		</div>
		<?php			
				}
			}
		?>
	</body>
</html>