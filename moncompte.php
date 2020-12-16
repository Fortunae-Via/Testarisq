<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="style/MonCompte_style.php" />
	<title>TESTARISQ - Mon Compte</title>
</head>
<body>

	<!-- Header -->
	<?php include("php/header.php");?>
	
	<div class="div_page">
		<header>
            <h2>Votre profil :</h2>
        </header>
		<section id = "sect">
			<div class="infos">

				<?php 
				try
		{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=bdd_testarisq;charset=utf8', 'root', '');
		
		}
		catch(Exception $e)
		{
			
		// En cas d'erreur, on affiche un message et on arrête tout
     	   die('Erreur : '.$e->getMessage());
		}
				/*$req = $bdd->prepare("INSERT INTO 'nom de la bdd' SET username = ?, password = ?, email = ?");
				 --> dans la page register */
				session_start();
				$user = $bdd->query('select * from personne'); 
				while ($data = $user->fetch())
					{$prenom1 = $data['Premier prénom'];
			$prenom2 = $data['Deuxième Prénom'];
			$prenom3 = $data['Troisième Prénom'];}
				?>
				<p>Nom de famille :<span class="user_info">Dupont <?= $prenom1 ?> <?= $prenom2 ?> <?= $prenom3 ?></span></p>
				<p>Nom d'usage :<span class="user_info"></span></p>
				<p>Prénoms :<span class="user_info">Jean, Jacques, Paul</span></p>
				<p>Né(e) le :<span class="user_info">01/01/2000</span></p>
				<p>Identifiant unique :<span class="user_info">180634300210</span></p>
				<p>Adresse :<span class="user_info">28 Rue Notre Dame des Champs, 75006 Paris</span></p>
				<p>Téléphone portable :<span class="user_info">0607080910</span></p>
				<p>Courriel :<span class="user_info">jean.dupont@isep.fr</span></p>
			</div>
			<p class="bottom">Un renseignement incorrect ? Signalez-le <a href="mailto:tanguy.robilliard@gmail.com">ici</a> à un administrateur.</p>
		</section>
	</div>
	
</body>
</html>