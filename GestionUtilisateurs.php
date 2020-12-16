<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Testarisq - Gestion Utilisateurs</title>
	<link rel="stylesheet" href="style/GestionUtilisateurs_style.php"/>
</head>
<body>

	<?php
	if(isset($_POST['account'])&&isset($_POST['id'])&&isset($_POST['name_1'])&&isset($_POST['name_2'])&&isset($_POST['surname'])&&isset($_POST['birthdate day'])&&isset($_POST['birthdate month'])&&isset($_POST['birthdate year'])&&isset($_POST['sex'])&&isset($_POST['mail'])&&isset($_POST['address'])&&isset($_POST['phone'])){
		
		try{
			$bdd = new PDO('mysql:host=localhost; dbname=BDD_APP', 'root', '');
		}catch(Exception $e){
			die('Erreur : '. $e->getMessage());
		}

		$add_personne = $bdd->prepare('INSERT INTO Personne (id, name_1, name_2, surname, birthdate, sex, mail, address, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

		$birthdate=''. $_POST['birthdate day'] .'/'. $_POST['birthdate month'] .'/'. $_POST['birthdate year'] .'';
		$add_personne->execute(array($_POST['id'], $_POST['name_1'], $_POST['name_2'],$_POST['surname'], $birthdate, $_POST['sex'],$_POST['mail'],$_POST['address'],$_POST['phone']));
		$add_personne->closeCursor();

		$add_compte = $bdd->prepare('INSERT INTO Compte (id, mdp, type_compte, id_personne, id_autorite) VALUES (?, ?, ?, ?)');

		$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
		for($i=1; $i<=12; $i++){
			$nbr=strlen($caract);
			$nbr=mt_rand(0, ($Nbr-1));
			$mdp[$i]=$caract[$Nbr];
		}

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
		$add_compte->closeCursor();

		$pass=1;
		sleep(2);
		if($pass){
			if($_POST['account']=='1'){
				header('Location: AccueilAdmin.php');
			}elseif($_POST['account']=='2'||$_POST['account']=='3'){
				header('Location: AccueilAutorite.php');
			}elseif($_POST['account']=='4'){
				header('Location: AccueilCitoyen.php');
			}
		}
	}else{
	?>

	<!-- Header -->
	<?php include("php/header.php"); ?>
	
	<div class="div_page">

		<div id="ajout" class="bloc">
            <button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
                <h3>Ajouter un utilisateur</h3>
                <img id='fleche1' class="fleche_expand_down" src="img/expand.png" alt="fleche_expand"/>
            </button>
            <div id='dropdown1' class="dropdown-content" style="display: block;">
	            <form method="post">
	            	<div class="ligne">
	            		<div class="info">
	            			<label for="account">Type de compte :</label>
	            		</div>
	            		<div class="bloc_boutons">
		            		<button type="button" id="citizen" name="account" value="1">Citoyen</button>
		            		<button type="button" id="police" name="account" value="2">Agent de police</button>
		            		<button type="button" id="school" name="account" value="3">Auto-école</button>
		            		<button type="button" id="admin" name="account" value="4">Administrateur</button>
		            	</div>
	            	</div>
	            	<div class=ligne>
	            		<div class="info">
	            			<label for="id">Identifiant unique :</label>
	            		</div>
	            		<input name="id"/>
					</div>
					<div class=ligne>
						<div class="info">
	            			<label for="name_1">Nom de famille :</label>
	            		</div>
						<input name="name_1"/>
					</div>
					<div class=ligne>
						<div class="info">
	            			<label for="name_2">Nom d'usage :</label>
	            		</div>
						<input name="name_2"/>
					</div>
					<div class=ligne>
						<div class="info">
							<label for="surname">Prénoms :<strong> (séparés par une virgule)</strong></label>
	            		</div>
						<input name="surname"/>
					</div>
					<div class=ligne>
						<div class="info">
							<label for="birthdate">Date de naissance :</label>
	            		</div>
	            		<div class="inputs_birthdate">
							<input maxlength="2" id="day" name="birthdate day"/>
							<input maxlength="2" id="month" name="birthdate month"/>
							<input maxlength="4" id="year" name="birthdate year"/>
						</div>
					</div>
					<div class=ligne>
						<div class="info">
	            			<label for="sex">Sexe :</label>
	            		</div>
	            		<div class="bloc_boutons">
		            		<button type="button" name="sex" value="1">Homme</button>
							<button type="button" name="sex" value="2">Femme</button>
							<button type="button" name="sex" value="3">Autre</button>
							<button type="button" name="sex" value="4">Non-précisé</button>
		            	</div>	
					</div>
					<div class=ligne>
						<div class="info">
	            			<label for="mail">Courriel :</label>
	            		</div>
						<input name="mail" /><br/>
					</div>
					<div class=ligne>
						<div class="info">
	            			<label for="address">Adresse :</label>
	            		</div>
						<input name="address"/><br/>
					</div>
					<div class=ligne>
						<div class="info">
	            			<label id="phone" for="phone">Téléphone portable :</label>
	            		</div>
						<input id="phone" name="phone"/><br/>
					</div>
					<div class="bloc_add"> 
						<button id="add" type="submit" onclick="missing()">Ajouter Utilisateur</button>
					</div>
				</form>
			</div>
        </div>

        <div id="recherche" class="bloc">
            <button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
                <h3>Rechercher un utilisateur</h3>
                <img id='fleche2' class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
            </button>
            <div id='dropdown2' class="dropdown-content" style="display: none;">
                <p>Bloc recherche administrateur</p>
            </div>
        </div>


		<section>
			
		</section>
	</div>

	<script>
		function missing(){
			<?php
			if(!isset($_POST['account'])||!isset($_POST['id'])||!isset($_POST['name_1'])||!isset($_POST['name_2'])||!isset($_POST['surname'])||!isset($_POST['birthdate day'])||!isset($_POST['birthdate month'])||!isset($_POST['birthdate year'])||!isset($_POST['sex'])||!isset($_POST['mail'])||!isset($_POST['address'])||!isset($_POST['phone'])){
			?>
				alert('missing info');
			<?php
			}
			?>
		}
	</script>
	<?php
	}
	?>

 	<script type="text/javascript" src="js/fonctions_generiques.js"></script>

</body>
</html>