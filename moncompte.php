<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="style/moncompte.css" />
    <link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
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
					die('Erreur : '.$e->getMessage());
				}
				
				session_start();
				$nir = $_SESSION['NIR'];
				$user = $bdd->query("SELECT * FROM personne INNER JOIN compte ON compte.Personne_NIR = personne.NIR WHERE Id = '{$nir}'"); 
				while ($data = $user->fetch())
				{
					$nomFamille = $data['NomDeFamille'];
					$nomUsage = $data['NomDUsage'];
					$prenom1 = $data['Prenom1'];			
					$prenom2 = $data['Prenom2'];			
					$prenom3 = $data['Prenom3'];
					$date = $data['DateNaissance'];
					$mail = $data['Courriel'];
					$tel = $data['Portable'];
					$adresse = $data['Adresse_Id'];

				}
		?>
				<p>Nom de famille :<span class="user_info"><?= $nomFamille ?></span></p>
				<p>Nom d'usage :<span class="user_info"><?= $nomUsage ?></span></p>
				<p>Prénoms :<span class="user_info"><?= $prenom1 .', '. $prenom2 .', '. $prenom3 ?></span></p>
				<p>Né(e) le :<span class="user_info"><?= $date ?></span></p>
				<p>Identifiant unique :<span class="user_info"><?= $nir ?></span></p>
				<p>Adresse :<span class="user_info"><?= $adresse ?></span></p>
				<p>Téléphone portable :<span class="user_info"><?= $tel ?></span></p>
				<p>Courriel :<span class="user_info"><?= $mail ?></span></p>
			</div>
			<p class="bottom">Un renseignement incorrect ? Signalez-le <a href="mailto:tanguy.robilliard@gmail.com">ici</a> à un administrateur.</p>
		</section>
	</div>
	
</body>
</html>