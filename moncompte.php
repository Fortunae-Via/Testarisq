<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/MonCompte.css" />
	<title>TESTARISQ - Mon Compte</title>
</head>
<body>

	<!-- Header -->
	<?php include("php/header.php"); ?>
	
	<div class="div_page">
		<header>
            <h2>Votre profil :</h2>
        </header>
		<section id = "sect">
			<div class="infos">
				<p>Nom de famille :<span class="user_info">Dupont</span></p>
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