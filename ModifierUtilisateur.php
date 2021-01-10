<!DOCTYPE html>
<html>
	<head>
		<title>TESTARISQ - Recherche Utilisateur</title>
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
			if(isset($_GET['NIR'])){
				try{
					$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
				}catch(Exception $e){
					die('Erreur : '. $e->getMessage());
				}
				if(isset($_POST['account']) && isset($_POST['id']) && isset($_POST['name_1']) && isset($_POST['name_2']) && isset($_POST['surname']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['sex']) && isset($_POST['mail']) && isset($_POST['numeroRue']) && isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['region']) && isset($_POST['pays']) && isset($_POST['phone'])){

					//UPDATE personne SET WHERE

				}else{
					try{
						$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
					}catch(Exception $e){
						die('Erreur : '. $e->getMessage());
					}
					$placeholder = $bdd->prepare("SELECT * FROM personne WHERE NIR=?");
					$placeholder->execute(array($_GET['NIR']));
					while($display = $placeholder->fetch()){
						$NIR=$display['NIR'];
						$NomDeFamille=$display['NomDeFamille'];
						$NomDUsage=$display["NomDUsage"];
						$Prenom1=$display['Prenom1'];
						$Prenom2=$display['Prenom2'];
						$Prenom3=$display['Prenom3'];
						$DateNaissance=$display['DateNaissance'];
						$Sexe=$display['Sexe'];
						$Courriel=$display['Courriel'];
						$Portable=$display['Portable'];
						$NumeroRue=$display['NumeroRue'];
						$Rue=$display['Rue'];
						$CodePostal=$display['CodePostal'];
						$Ville=$display['Ville'];
						$Region=$display['Region'];
						$Pays=$display['Pays'];
					}
		?>
					<div class="div_page">
						<div id="ajout" class="bloc">

        				    <button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
            			    	<h3>Modifier l'utilisateur N°<?php echo $NIR; ?> - (<?php echo $NomDeFamille ." ". $Prenom1; ?>) </h3>
           	    				<img id="fleche1" class="fleche_expand_down" src="img/expand.png" alt="fleche_expand"/>
         		  			</button>

           					<div id="dropdown1" class="dropdown-content" style="display: block;">
	            				<form method="post">

	            					<div class="ligne">
	            						<div class="info">
	            							<label for="account">Type de compte :</label>
	            						</div>
	            						<div class="bloc_boutons">
		            						<input type="radio" id="citizen" name="account" value="1" <?php //if($TypeCompte=="CT"){echo "checked";} ?>/>
		            						<label for="citizen">Citoyen</label>
		            						<input type="radio" id="police" name="account" value="2" <?php //if($TypeCompte=="POL"){echo "checked";} ?>/>
		            						<label for="police">Agent de Police</label>
		            						<input type="radio" id="school" name="account" value="3" <?php //if($TypeCompte=="ATE"){echo "checked";} ?>/>
		            						<label for="school">Auto-école</label>
		            						<input type="radio" id="admin" name="account" value="4"<?php //if($TypeCompte=="ADM"){echo "checked";} ?>/>
		            						<label for="admin">Administrateur</label>
		            					</div>
	            					</div>

	            					<div class="ligne">
	            						<div class="info">
	            							<label for="id">Identifiant unique :</label>
	            						</div>
	            						<input name="id" placeholder=<?php echo $NIR; ?> />
									</div>

									<div class="ligne">
										<div class="info">
	            							<label for="name_1">Nom de famille :</label>
	            						</div>
										<input name="name_1" placeholder=<?php echo $NomDeFamille; ?> />
									</div>

									<div class="ligne">
										<div class="info">
	            							<label for="name_2">Nom d'usage :</label>
	            						</div>
										<input name="name_2" placeholder=<?php echo $NomDUsage; ?> />
									</div>

									<div class="ligne">
										<div class="info">
											<label for="surname">Prénoms :<!--<strong> (séparés par une virgule)</strong>--></label>
	            						</div>
										<input maxlength="12" id="surname" name="surname" placeholder=<?php echo $Prenom1; ?> /><br/>
										<input maxlength="12" id="surname1" name="surname1" placeholder=<?php echo $Prenom2; ?> /><br/>
										<input maxlength="12" id="surname2" name="surname2" placeholder=<?php echo $Prenom3; ?> />
									</div>

									<div class="ligne">
										<div class="info">
											<label for="birthdate">Date de naissance :</label>
	        	    					</div>

	   	    	    					<div class="inputs_birthdate">
											<input maxlength="2" id="day" name="day"/>
											<input maxlength="2" id="month" name="month"/>
											<input maxlength="4" id="year" name="year"/>
										</div>
									</div>

									<div class="ligne">
										<div class="info">
	    	        						<label for="sex">Sexe :</label>
	    	        					</div>
	    	        					<?php
	    	        					?>
	    	        					<div class="bloc_boutons">
											<input type="radio" id="Homme" name="sex" value="Homme" <?php if($Sexe=="Homme"){echo "checked";} ?>/>
											<label for="Homme">Homme</label>
											<input type="radio" id="Femme" name="sex" value="Femme" <?php if($Sexe=="Femme"){echo "checked";} ?>/>
											<label for="Femme">Femme</label>
											<input type="radio" id="Autre" name="sex" value="Autre" <?php if($Sexe=="Autre"){echo "checked";} ?>/>
											<label for="Autre">Autre</label>
											<input type="radio" id="Non-precise" name="sex" value="Non-precise" <?php if($Sexe=="Non-precise"){echo "checked";} ?>/>
											<label for="Non-precise">Non-précisé</label>
		   		         				</div>	
									</div>

									<div class="ligne">
										<div class="info">
	           		 						<label for="mail">Courriel :</label>
	           		 					</div>
										<input name="mail" /><br/>
									</div>

									<div class="ligne">
										<div class="info">
	            							<label for="address">Adresse :</label>
	            						</div>
										<input maxlength="20" id="rue" name="rue" placeholder=<?php echo $Rue; ?> />
										<input maxlength="12" id="ville" name="ville" placeholder=<?php echo $Ville; ?> /><br/>
										<input maxlength="6" id="code" name="code" placeholder=<?php echo $CodePostal; ?> />
										<input maxlength="12" id="region" name="region" placeholder=<?php echo $Region; ?> />
										<input maxlength="10" id="pays" name="pays" placeholder=<?php echo $Pays; ?> />
									</div>

									<div class="ligne">
										<div class="info">
	            							<label id="phone" for="phone">Téléphone portable :</label>
	            						</div>
										<input id="phone" name="phone" placeholder=<?php echo $Portable; ?> /><br/>
									</div>

									<div class="bloc_add"> 
										<button id="add" type="submit">Modifier Utilisateur</button>
									</div>

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