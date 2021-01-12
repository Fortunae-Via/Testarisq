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
	<title>TESTARISQ - Gestion des utilisateurs</title>
	<meta charset="ytf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
</head>
	<body>

		<?php
		if(isset($_POST['type_compte']) && isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['nom_usage']) && isset($_POST['prenom']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['sexe']) && isset($_POST['mail']) && isset($_POST['numeroRue']) && isset($_POST['rue']) && isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['region']) && isset($_POST['pays']) && isset($_POST['telephone'])){
		
			/*try{
				$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
			}catch(Exception $e){
				die('Erreur : '. $e->getMessage());
			}*/
			require("modele/connexionbdd.php");


			$add_adresse = $bdd->prepare('INSERT INTO adresse (Id, NumeroRue, Rue, CodePostal, Ville, Region, Pays) VALUES (?, ?, ?, ?, ?, ?, ?)');
			$add_adresse->execute(array($_POST['id'], $_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['region'], $_POST['pays']));
			$add_adresse->closeCursor();

			$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
			for($i=1; $i<=12; $i++){
				$nbr=strlen($caract);
				$nbr=mt_rand(0, ($nbr-1));
				$mdp[$i]=$caract[$nbr];
			}

			$mdp=implode($mdp);

			$DateNaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];

			$add_personne = $bdd->prepare('INSERT INTO personne (NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, Prenom2, Prenom3, DateNaissance, Sexe, Courriel, Portable, Adresse_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$add_personne->execute(array($_POST['id'], $mdp, $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $DateNaissance, $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $_POST['id']));
			$add_personne->closeCursor();

			$add_compte = $bdd->prepare('INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR, AutoriteResponsable_Id) VALUES (?, ?, ?, ?)');
			$add_compte->execute(array($_POST['id'], $_POST['type_compte'], $_POST['id'], NULL));
			$add_compte->closeCursor();

			sleep(1);
				if('1'){
					// Redirection vers Rechercheutilisateur.php (la page précédente)
					header('Location: GestionUtilisateurs.php');
			}

		}else{
			//Header
			include("vues/Header.php");
		?>
			<div class="div_page">
				<div id="ajout" class="bloc">
        		    <button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
            	    	<h3>Ajouter un utilisateur</h3>
               			<img id="fleche1" class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand"/>
           			</button>
           			<div id="dropdown1" class="dropdown-content" style="display: block;">
	            		<form method="post">
	            			<div class="ligne boutons">
	            				<div class="info">
	            					<label for="type_compte">Type de compte<strong style="color:red;">*</strong> :</label>
	            				</div>
	            				<div class="bloc_boutons">
		            				<input type="radio" id="citizen" name="type_compte" value="CIT"/>
		            				<label for="citizen">Citoyen</label>
		            				<input type="radio" id="police" name="type_compte" value="POL"/>
		            				<label for="police">Agent de Police</label>
		            				<input type="radio" id="school" name="type_compte" value="AUE"/>
		            				<label for="school">Auto-école</label>
		            				<input type="radio" id="admin" name="type_compte" value="ADM"/>
		            				<label for="admin">Administrateur</label>
		            			</div>
	            			</div>
	            			<div class="ligne">
	            				<div class="info">
	            					<label for="id">NIR<strong style="color:red;">*</strong> :</label>
	            				</div>
	            				<input name="id" placeholder="00000000000" />
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="nom">Nom de famille<strong style="color:red;">*</strong>  :</label>
	            				</div>
								<input name="nom" placeholder="Nom"/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="nom_usage">Nom d'usage<strong style="color:red;">*</strong> :</label>
	            				</div>
								<input name="nom_usage" placeholder="Nom d'usage"/>
							</div>
							<div class="ligne">
								<div class="info">
									<label for="surname">Prénoms<strong style="color:red;">*</strong> : <br/><strong> (séparés par une virgule)</strong></label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<p>
										<input maxlength="12" id="prenom" name="prenom" placeholder="Prénom *"/>
										<input maxlength="12" id="prenom_2" name="prenom_2" placeholder="2ème Prénom" />
										<input maxlength="12" id="prenom_3" name="prenom_3" placeholder="3ème Prénom"/>
									</p>
								</div>
							</div>
							<div class="ligne">
								<div class="info">
									<label for="birthdate">Date de naissance<strong style="color:red;">*</strong> : <strong> (JJ/MM/AAAA)</strong></label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<p>
										<input maxlength="2" id="jour" name="jour" placeholder="JJ"/>/
										<input maxlength="4" id="mois" name="mois" placeholder="MM" />/
										<input maxlength="6" id="annee" name="annee" placeholder="AAAA" />
									</p>
								</div>
							</div>
							<div class="ligne boutons">
								<div class="info">
	            					<label for="sexe">Sexe<strong style="color:red;">*</strong>  :</label>
	            				</div>
	            				<div class="bloc_boutons">
									<input type="radio" id="Homme" name="sexe" value="Homme"/>
									<label for="Homme">Homme</label>
									<input type="radio" id="Femme" name="sexe" value="Femme"/>
									<label for="Femme">Femme</label>
									<input type="radio" id="Autre" name="sexe" value="Autre"/>
									<label for="Autre">Autre</label>
									<input type="radio" id="Non-precise" name="sexe" value="Non-precise" />
									<label for="Non-precise">Non-précisé</label>
		            			</div>	
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="mail">Courriel<strong style="color:red;">*</strong>  :</label>
	            				</div>
								<input name="mail" /><br/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="adresse">Adresse<strong style="color:red;">*</strong> :<br/><strong> (Numero de Rue, Rue, Ville, Code Postal, Region, Pays)</strong></label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<input maxlength="4" id="numeroRue" name="numeroRue" placeholder="xxx"/>
									<input maxlength="20" id="rue" name="rue"/>
									<input maxlength="12" id="ville" name="ville" placeholder="Paris"/><br/>
									<input maxlength="6" id="code" name="code" placeholder="750xx" />
									<select name="region">
										<?php
											require("modele/connexionbdd.php");

											$region = $bdd->query('SELECT Region FROM regionfr');
											while($display = $region->fetch()){
												echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
											}
											
											$region->closeCursor();
										?>
									</select>
									<input maxlength="10" id="pays" name="pays" value="France"/>
								</div>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label id="telephone" for="telephone">Téléphone portable<strong style="color:red;">*</strong>  :</label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<input maxlength="10" id="telephone" name="telephone" placeholder="06xxxxxxxx" /><br/>
	            				</div>
							</div>
							<div class="bloc_add"> 
								<button id="add" type="submit">Ajouter Utilisateur</button>
							</div>

							<strong style="color:red;"> (* obligatoire)</strong>
						</form>
					</div>
        		</div>
       			<div id="recherche" class="bloc">
            		<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
            	    	<h3>Rechercher un utilisateur</h3>
            	    	<img id="fleche2" class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
           			</button>
           			<div id="dropdown2" class="dropdown-content" style="display: block;">
                		<?php include("RechercheUtilisateur.php"); ?>
            		</div>
        		</div>
			</div>
		<?php
		}
		?>
 		<script type="text/javascript" src="js/fonctions_generiques.js">
 			
 		</script>
	</body>
</html>