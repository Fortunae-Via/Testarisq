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
	<?php include("vues/Header.php"); ?>
	
	<div class="div_page">
		<header>
            <h2>Votre profil :</h2>
        </header>
		<section id = "sect">
			<div class="infos">

				<p>Nom de famille :
					<span class="user_info">
						<?= $InfosUser['NomDeFamille']; ?>
					</span>
				</p>
				<p>Nom d'usage :
					<span class="user_info">
						<?= $InfosUser['NomDUsage']; ?>
					</span>
				</p>
				<p>Prénoms :
					<span class="user_info">
						<?= $InfosUser['Prenom1'] .', '. $InfosUser['Prenom2'] .', '. $InfosUser['Prenom3'] ?>
					</span>
				</p>
				<p>Né(e) le :
					<span class="user_info">
						<?= $InfosUser['DateNaissance'] ?>	
					</span>
				</p>
				<p>NIR :
					<span class="user_info">
						<?= $NIR = $InfosUser['NIR']; ?>
					</span>
				</p>
				<p>Adresse :
					<span class="user_info">
						<?= $Adresse['NumeroRue'] .' '. $Adresse['Rue'] .', '. $Adresse['CodePostal'] .' '. $Adresse['Ville'] .', '. $Adresse['Region'] .', '. $Adresse['Pays']?>
					</span>
				</p>
				<p>Téléphone portable :
					<span class="user_info">
						<?= $InfosUser['Portable']; ?>
					</span>
				</p>
				<p>Courriel :
					<span class="user_info">
						<?= $InfosUser['Courriel'] ?>
					</span>
				</p>
			</div>
			<p class="bottom">Un renseignement incorrect ? Signalez-le <a href="InformationIncorrecte.php">ici</a> à un administrateur.</p>
		</section>
	</div>
	
</body>
</html>