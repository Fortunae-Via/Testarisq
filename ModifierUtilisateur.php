<!DOCTYPE html>
<html>
	<head>
		<title>TESTARISQ - Modifier Utilisateur</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style/style_commun.css" />
		<!--
			On peut utiliser la stylesheet de la page GestionUtilisateurs.
			Comme les deux pages se ressemblent de par leur formulaire identique.
		-->
		<link rel="stylesheet" href="style/GestionUtilisateurs.css"/>
	</head>
	<body>
		<?php
			// On effectue la modification du profil utilisateur d'identifiant $_GET['NIR']
			if(isset($_GET['NIR'])){
				// Appel à la base de donnée
				require("modele/connexionbdd.php");

				// Si l'une (et une seule suffit) des données du profil est modifié Alors :
				if(isset($_POST['nom']) || isset($_POST['nom_usage']) || isset($_POST['prenom']) || isset($_POST['prenom_2']) || isset($_POST['prenom_3']) || isset($_POST['sexe']) || isset($_POST['mail']) || isset($_POST['telephone']) || isset($_POST['numeroRue']) ||isset($_POST['rue']) || isset($_POST['ville']) || isset($_POST['code']) || isset($_POST['region']) || isset($_POST['pays'])){

					// La base de donnée est Mise à Jour (UPDATE) avec les informations du formulaire
					// Mise à Jour de la table "personne"
					$update = $bdd->prepare("UPDATE personne SET NomDeFamille=?, NomDUsage=?, Prenom1=?, Prenom2=?, Prenom3=?, Sexe=?, Courriel=?, Portable=? WHERE NIR=?");
					$update->execute(array($_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $_GET['NIR']));
					$update->closeCursor();

					// Mise à Jour de la table "adresse"
					$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=? ');
					$update->execute(array($_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['pays'], $_POST['region'], $_GET['NIR']));
					$update->closeCursor();


					sleep(1);
					if('1'){
						// Redirection vers Rechercheutilisateur.php (la page précédente)
						header('Location: RechercheUtilisateur.php');
					}

				}else{

					// Récuperation des informations de l'utilisateur d'identifiant $_GET['NIR']
					// Récupération des informations de la table personne
					$placeholder = $bdd->prepare("SELECT * FROM personne WHERE NIR=?");
					$placeholder->execute(array($_GET['NIR']));
					while($display = $placeholder->fetch()){
						$NIR=$display['NIR'];
						$NomDeFamille=$display['NomDeFamille'];
						$NomDUsage=$display["NomDUsage"];
						$Prenom1=$display['Prenom1'];
						$Prenom2=$display['Prenom2'];
						$Prenom3=$display['Prenom3'];
						$DateNaissance[]=$display['DateNaissance'];
						$Sexe=$display['Sexe'];
						$Courriel=$display['Courriel'];
						$Portable=$display['Portable'];
					}
					$placeholder->closeCursor();

					$Annee=$DateNaissance[0][0].$DateNaissance[0][1].$DateNaissance[0][2].$DateNaissance[0][3];
					$Mois=$DateNaissance[0][5].$DateNaissance[0][6];
					$Jour=$DateNaissance[0][8].$DateNaissance[0][9];

					// Récupération des informations de la table adresse
					$placeholder = $bdd->prepare("SELECT * FROM adresse WHERE Id=?");
					$placeholder->execute(array($_GET['NIR']));
					while($display = $placeholder->fetch()){
						$NumeroRue=$display['NumeroRue'];
						$Rue=$display['Rue'];
						$CodePostal=$display['CodePostal'];
						$Ville=$display['Ville'];
						$Region=$display['Region'];
						$Pays=$display['Pays'];
					}
					$placeholder->closeCursor();
		?>
					<div class="div_page">
						<div id="ajout" class="bloc">

        				    <button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
        				    	<!-- Affichage de l'identifiant, du nom de famille et du prenom de l'utilisateur à modifier -->
            			    	<h3>Modifier l'utilisateur N°<?php echo $NIR; ?> - (<?php echo $NomDeFamille ." ". $Prenom1; ?>) </h3>
           	    				<img id="fleche1" class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand"/>
         		  			</button>

           					<div id="dropdown1" class="dropdown-content" style="display: block;">
	            				<form method="post">

									<div class="ligne">
										<div class="info">
	            							<label for="nom">Nom de famille<strong style="color:red;">*</strong> :</label>
	            						</div>
	            						<!-- Pré-remplissage du formulaire dans le cas où aucune modification n'est faite -->
										<input name="nom" value=<?php echo $NomDeFamille; ?> />
									</div>

									<div class="ligne">
										<div class="info">
	            							<label for="nom_usage">Nom d'usage<strong style="color:red;">*</strong> :</label>
	            						</div>
										<input name="nom_usage" value=<?php echo $NomDUsage; ?> />
									</div>

									<div class="ligne">
										<div class="info">
											<label for="surname">Prénoms<strong style="color:red;">*</strong> : <br/><strong> (séparés par une virgule)</strong></label>
	            						</div>
	            						<div class="special_size_inputs">
	            							<p>
												<input maxlength="12" id="prenom" name="prenom" value=<?php echo $Prenom1; ?> />,
												<input maxlength="12" id="prenom_2" name="prenom_2" value=<?php echo $Prenom2; ?> />,
												<input maxlength="12" id="prenom_3" name="surname_3" value=<?php echo $Prenom3; ?> />
											</p>
										</div>
									</div>

									<div class="ligne">
										<div class="info">
											<label for="birthdate">Date de naissance<strong style="color:red;">*</strong> : <strong> (JJ/MM/AAAA)</strong></label>
	        	    					</div>

	   	    	    					<div class="special_size_inputs">
											<p>
												<input maxlength="2" id="jour" name="jour" value=<?php echo $Jour; ?> />/
												<input maxlength="4" id="mois" name="mois" value=<?php echo $Mois; ?> />/
												<input maxlength="6" id="annee" name="annee" value=<?php echo $Annee; ?> />
											</p>
										</div>
									</div>

									<div class="ligne">
										<div class="info">
	    	        						<label for="sex">Sexe<strong style="color:red;">*</strong> :</label>
	    	        					</div>
	    	        					<?php
	    	        					?>
	    	        					<div class="bloc_boutons">
											<input type="radio" id="Homme" name="sexe" value="Homme" <?php if($Sexe=="Homme"){echo "checked";} ?>/>
											<label for="Homme">Homme</label>
											<input type="radio" id="Femme" name="sexe" value="Femme" <?php if($Sexe=="Femme"){echo "checked";} ?>/>
											<label for="Femme">Femme</label>
											<input type="radio" id="Autre" name="sexe" value="Autre" <?php if($Sexe=="Autre"){echo "checked";} ?>/>
											<label for="Autre">Autre</label>
											<input type="radio" id="Non-precise" name="sexe" value="Non-precise" <?php if($Sexe=="Non-precise"){echo "checked";} ?>/>
											<label for="Non-precise">Non-précisé</label>
		   		         				</div>	
									</div>

									<div class="ligne">
										<div class="info">
	           		 						<label for="mail">Courriel<strong style="color:red;">*</strong> :</label>
	           		 					</div>
										<input name="mail" value=<?php echo $Courriel; ?> /><br/>
									</div>

									<div class="ligne">
										<div class="info">
	            							<label for="adresse">Adresse<strong style="color:red;">*</strong> :<br/><strong> (Numero de Rue, Rue, Ville, Code Postal, Region, Pays)</strong></label>
	            						</div>
	            						<div class="special_size_inputs">
	            							<input maxlength="4" id="numeroRue" name="numeroRue" value=<?php echo $NumeroRue; ?> />
											<input maxlength="20" id="rue" name="rue" value=<?php echo $Rue; ?> />
											<input maxlength="12" id="ville" name="ville" value=<?php echo $Ville; ?> /><br/>
											<input maxlength="6" id="code" name="code" value=<?php echo $CodePostal; ?> />
											<select name="region">
											<?php
												require("modele/connexionbdd.php");


												$region = $bdd->query('SELECT Region FROM regionfr');
												while($display = $region->fetch()){
													if($display['Region']==$Region){
														echo'<option selected value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
													}else{
														echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
													}
												}
												$region->closeCursor();
											?>
											</select>
											<!--<input maxlength="12" id="region" name="region" value=<?php echo $Region; ?> />-->
											<input maxlength="10" id="pays" name="pays" value=<?php echo $Pays; ?> />
										</div>
									</div>

									<div class="ligne">
										<div class="info">
	            							<label id="telephone" for="telephone">Téléphone portable<strong style="color:red;">*</strong> :</label>
	            						</div>
										<input id="telephone" name="telephone" value=<?php echo $Portable; ?> /><br/>
									</div>

									<div class="bloc_add"> 
										<button id="add" type="submit">Modifier Utilisateur</button>
									</div>

									<strong style="color:red;"> (* obligatoire)</strong>
								</form>
							</div>
        				</div>
        			</div>
		<?php			
				}
			}
		?>
	</body>
</html>