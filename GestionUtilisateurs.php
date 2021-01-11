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
		if(isset($_POST['type_compte']) && isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['nom_usage']) && isset($_POST['prenom']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['sexe']) && isset($_POST['mail']) && isset($_POST['numeroRue']) && isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['region']) && isset($_POST['pays']) && isset($_POST['telephone'])){
		
			/*try{
				$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
			}catch(Exception $e){
				die('Erreur : '. $e->getMessage());
			}*/
			require("modele/connexionbdd.php");
			
			$add_personne = $bdd->prepare("INSERT INTO personne(NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, Prenom2, Prenom3, DateNaissance,Sexe, Courriel, Portable, Adresse_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$nir=$_POST['id'];
			$mdp="mdp";
			$ndf=$_POST['nom'];
			$ndu=$_POST['nom_usage'];
			$p1=$_POST['prenom'];
			$p2=$_POST['prenom_2'];
			$p3=$_POST['prenom_3'];
			$date=NULL;
			$sex=$_POST['sexe'];
			$mail=$_POST['mail'];
			$phone=$_POST['telephone'];
			$adresse=NULL;
			$add_personne->execute(array($nir, $mdp, $ndf, $ndu, $p1, $p2, $p3, $date, $sex, $mail, $phone, $adresse));

			/*$add_personne = $bdd->prepare('INSERT INTO personne (NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, DateNaissance, Sexe, Courriel, Portable) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

			$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
			for($i=1; $i<=12; $i++){
				$nbr=strlen($caract);
				$nbr=mt_rand(0, ($nbr-1));
				$mdp[$i]=$caract[$nbr];
			}

			$mdp=implode($mdp);

			$birthdate=$_POST['day'] ."-". $_POST['month'] ."-". $_POST['year'];
			$birthdate=implode($birthdate);

			$add_personne->execute(array($_POST['id'], $mdp, $_POST['name_1'], $_POST['name_2'], $_POST['surname'], $birthdate, $_POST['sex'], $_POST['mail'], $_POST['phone']));

			$add_personne->closeCursor();*/

			/*$add=$bdd->prepare('INSERT INTO personne (NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, Prenom2, Prenom3, DateNaissance, Sexe, Courriel, Portable, Adresse_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)');
			$add->execute(array($_POST['id']));
			$add->closeCursor();*/

			/*$add = $bdd->prepare('INSERT INTO personne (NIR, NomDeFamille, NomDUsage, Prenom1, Sexe, Courriel, Portable, Adresse_Id) VALUES (?, ?, ?, ?, ?, ?, ?, NULL)');
			$add->execute(array($_POST['id'], $_POST['name_1'], $_POST['name_2'], $_POST['surname'], $_POST['sex'], $_POST['mail'], $_POST['phone']));
			$add->closeCursor();*/

			/*$add_compte = $bdd->prepare('INSERT INTO Compte (Id, TypeCompte_Type, Personne_NIR, AutoriteResponsable_Id) VALUES (?, ?, ?, ?)');

			switch($_POST['account']){
				case '1':
					$add_compte->execute(array($_POST['id'], $mdp, 'Citoyen', $_POST['id']));
					break;
				case '2':
					$id=''. $_POST['id'] .'POL';
					$add_compte->execute(array($id, $mdp, 'Agent de Police', $_POST['id']));
					break;
				case '3':
					$id=''. $_POST['id'] .'AE';
					$add_compte->execute(array($id, $mdp, 'Auto-école', $_POST['id']));
					break;
				case '4':
					$id=''. $_POST['id'] .'Admin';
					$add_compte->execute(array($id, $mdp, 'Administrateur', $_POST['id']));
					break;
			}
			$add_compte->closeCursor();*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/*sleep(1);
			if('1'){
				if($_POST['type_compte']=='1'){
					header('Location: AccueilAdministrateur.php');
				}elseif($_POST['type_compte']=='2'||$_POST['type_compte']=='3'){
					header('Location: AccueilAutorite.php');
				}elseif($_POST['type_compte']=='4'){
					header('Location: AccueilCitoyen.php');
				}
			}*/

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
	            			<div class="ligne">
	            				<div class="info">
	            					<label for="type_compte">Type de compte* :</label>
	            				</div>
	            				<div class="bloc_boutons">
		            				<input type="radio" id="citizen" name="type_compte" value="1"/>
		            				<label for="citizen">Citoyen</label>
		            				<input type="radio" id="police" name="type_compte" value="2"/>
		            				<label for="police">Agent de Police</label>
		            				<input type="radio" id="school" name="type_compte" value="3"/>
		            				<label for="school">Auto-école</label>
		            				<input type="radio" id="admin" name="type_compte" value="4"/>
		            				<label for="admin">Administrateur</label>
		            			</div>
	            			</div>
	            			<div class="ligne">
	            				<div class="info">
	            					<label for="id">NIR* :</label>
	            				</div>
	            				<input name="id"/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="nom">Nom de famille* :</label>
	            				</div>
								<input name="nom"/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="nom_usage">Nom d'usage :</label>
	            				</div>
								<input name="nom_usage"/>
							</div>
							<div class="ligne">
								<div class="info">
									<label for="surname">Prénoms :<!--<strong> (séparés par une virgule)</strong>--></label>
	            				</div>
	            				<div class="special_size_inputs">
									<input maxlength="12" id="prenom" name="prenom"/>
									<input maxlength="12" id="prenom_2" name="prenom_2"/>
									<input maxlength="12" id="prenom_3" name="prenom_3"/>
								</div>
							</div>
							<div class="ligne">
								<div class="info">
									<label for="birthdate">Date de naissance* :</label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<p>
										<input maxlength="2" id="jour" name="jour" placeholder="JJ"/>/
										<input maxlength="4" id="mois" name="mois" placeholder="MM" />/
										<input maxlength="6" id="annee" name="annee" placeholder="AAAA" />
									<p>
								</div>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="sexe">Sexe* :</label>
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
	            					<label for="mail">Courriel* :</label>
	            				</div>
								<input name="mail" /><br/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="adresse">Adresse :</label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<input maxlength="4" id="numeroRue" name="numeroRue"/>
									<input maxlength="20" id="rue" name="rue"/>
									<input maxlength="12" id="ville" name="ville"/><br/>
									<input maxlength="6" id="code" name="code"/>
									<input maxlength="12" id="region" name="region"/>
									<input maxlength="10" id="pays" name="pays"/>
								</div>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label id="telephone" for="telephone">Téléphone portable :</label>
	            				</div>
	            				<div class="special_size_inputs">
	            					<input maxlength="10" id="telephone" name="telephone"/><br/>
	            				</div>
							</div>
							<div class="bloc_add"> 
								<button id="add" type="submit">Ajouter Utilisateur</button>
							</div>
						</form>
					</div>
        		</div>
       			<div id="recherche" class="bloc">
            		<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
            	    	<h3>Rechercher un utilisateur</h3>
            	    	<img id="fleche2" class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
           			</button>
           			<div id="dropdown2" class="dropdown-content" style="display: none;">
                		<p>Bloc recherche administrateur</p>
            		</div>
        		</div>
				<section></section>
			</div>
		<?php
		}
		?>
 		<script type="text/javascript" src="js/fonctions_generiques.js">
 			
 		</script>
	</body>
</html>