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
	    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
	    <?php
	    $u_agent = $_SERVER['HTTP_USER_AGENT'];
	    if(preg_match('/Safari/i',$u_agent)) {
	    	echo '<link rel="stylesheet" href="style/GestionUtilisateursSafari.css"/>';
		}
		?>
	    <!-- Pour les spécificités de cette page-->
		<link rel="stylesheet" href="style/ModifierUtilisateur.css"/>
	</head>
	<body>
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
								<input maxlength="30" id="prenom" name="prenom" <?=$PreRemp['Prenom1']?> />
								<input maxlength="30" id="prenom_2" name="prenom_2" <?=$PreRemp['Prenom2']?> />
								<input maxlength="30" id="prenom_3" name="prenom_3" <?=$PreRemp['Prenom3']?> />
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
									}else{
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
									}else{
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
									}else{
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
						<input type="mail" name="mail" <?=$PreRemp['Courriel']?> /><br/>
					</div>

					<div class="ligne">
						<div class="info">
							<label for="adresse">Adresse :</label>
						</div>
						<div class="special_size_inputs">
							<input maxlength="4" id="numeroRue" name="numeroRue"<?=$PreRemp['NumeroRue']?> />
							<input maxlength="100" id="rue" name="rue" <?=$PreRemp['Rue']?> />
							<input maxlength="60" id="ville" name="ville" <?=$PreRemp['Ville']?> /><br/>
							<input maxlength="25" id="code" name="code" <?=$PreRemp['CodePostal']?> />
							<select name="region">
								<option value="">Région</option>
								<?php Region($bdd); ?>
							</select>
							<!--<input maxlength="12" id="region" name="region" value=<?php echo $Region; ?> />-->
							<input maxlength="25" id="pays" name="pays" <?=$PreRemp['Pays']?> />
						</div>
					</div>

					<div class="ligne">
						<div class="info">
							<label id="telephone" for="telephone">Téléphone portable :</label>
						</div>
						<input type="tel" maxlength="25" id="telephone" name="telephone" <?=$PreRemp['Portable']?> /><br/>
					</div>

					<div class="bloc_add"> 
						<button id="add" type="submit">Modifier Utilisateur</button>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>