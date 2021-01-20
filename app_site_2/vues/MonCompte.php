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

				<?php 
					if (!(empty($InfosUser['NomDUsage']))) {
				?>
				<p>Nom d'usage :
					<span class="user_info">
						<?= $InfosUser['NomDUsage']; ?>
					</span>
				</p>

				<?php 
					}
				?>

				<p>Prénom(s) :
					<span class="user_info">
						<?= $Prenoms ?>
					</span>
				</p>

				<p>Né(e) le :
					<span class="user_info">
						<?= $InfosUser['DateNaissance'] ?>	
					</span>
				</p>

				<p>NIR :
					<span class="user_info">
						<?= $InfosUser['NIR']; ?>
					</span>
				</p>

				<?php 
					if (!(empty($InfosUser['Adresse_Id']))) {
				?>
				<p>Adresse :
					<span class="user_info">
						<?= $Adresse?>
					</span>
				</p>

				<?php 
					}
					if (!(empty($InfosUser['Portable']))) {
				?>

				<p>Téléphone portable :
					<span class="user_info">
						<?= $InfosUser['Portable']; ?>
					</span>
				</p>
				<?php 
					}
				?>

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