<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des utilisateur</title>
	<meta charset="ytf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
</head>
<body>

		<?php
		if(isset($_POST['account']) && isset($_POST['id']) && isset($_POST['name_1']) && isset($_POST['name_2']) && isset($_POST['surname']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['sex']) && isset($_POST['mail']) && isset($_POST['address']) && isset($_POST['phone'])){
		
			try{
				$bdd = new PDO('mysql:host=localhost; dbname=app2', 'root', '');
			}catch(Exception $e){
				die('Erreur : '. $e->getMessage());
			}

			
			$add_personne = $bdd->prepare("INSERT INTO personne(NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, Prenom2, Prenom3, DateNaissance,Sexe, Courriel, Portable, Adresse_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$nir=$_POST['id'];
			$mdp="mdp";
			$ndf=$_POST['name_1'];
			$ndu=$_POST['name_2'];
			$p1=$_POST['surname'];
			$p2=$_POST['surname'];
			$p3=$_POST['surname'];
			$date=NULL;
			$sex=$_POST['sex'];
			$mail=$_POST['mail'];
			$phone=$_POST['phone'];
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

			$pass=1;
			sleep(2);
			if($pass){
				if($_POST['account']=='1'){
					header('Location: AccueilAdministrateur.php');
				}elseif($_POST['account']=='2'||$_POST['account']=='3'){
					header('Location: AccueilAutorite.php');
				}elseif($_POST['account']=='4'){
					header('Location: AccueilCitoyen.php');
				}
			}
		}else{
			//Header
			include("php/header.php");
		?>
			<div class="div_page">
				<div id="ajout" class="bloc">
        		    <button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
            	    	<h3>Ajouter un utilisateur</h3>
               			<img id="fleche1" class="fleche_expand_down" src="img/expand.png" alt="fleche_expand"/>
           			</button>
           			<div id="dropdown1" class="dropdown-content" style="display: block;">
	            		<form method="post">
	            			<div class="ligne">
	            				<div class="info">
	            					<label for="account">Type de compte :</label>
	            				</div>
	            				<div class="bloc_boutons">
		            				<input type="radio" id="citizen" name="account" value="1"/>
		            				<label for="citizen">Citoyen</label>
		            				<input type="radio" id="police" name="account" value="2"/>
		            				<label for="police">Agent de Police</label>
		            				<input type="radio" id="school" name="account" value="3"/>
		            				<label for="school">Auto-école</label>
		            				<input type="radio" id="admin" name="account" value="4"/>
		            				<label for="admin">Administrateur</label>
		            			</div>
	            			</div>
	            			<div class="ligne">
	            				<div class="info">
	            					<label for="id">Identifiant unique :</label>
	            				</div>
	            				<input name="id"/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="name_1">Nom de famille :</label>
	            				</div>
								<input name="name_1"/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label for="name_2">Nom d'usage :</label>
	            				</div>
								<input name="name_2"/>
							</div>
							<div class="ligne">
								<div class="info">
									<label for="surname">Prénoms :<strong> (séparés par une virgule)</strong></label>
	            				</div>
								<input name="surname"/>
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
	            				<div class="bloc_boutons">
									<input type="radio" id="Homme" name="sex" value="Homme"/>
									<label for="Homme">Homme</label>
									<input type="radio" id="Femme" name="sex" value="Femme"/>
									<label for="Femme">Femme</label>
									<input type="radio" id="Autre" name="sex" value="Autre"/>
									<label for="Autre">Autre</label>
									<input type="radio" id="Non-precise" name="sex" value="Non-precise" />
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
								<input name="address"/><br/>
							</div>
							<div class="ligne">
								<div class="info">
	            					<label id="phone" for="phone">Téléphone portable :</label>
	            				</div>
								<input id="phone" name="phone"/><br/>
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
            	    	<img id="fleche2" class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
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