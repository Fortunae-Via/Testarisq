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
					require 'modele/connexionbdd.php';
					require 'modele/fonctionsSQL.php';
		
				}
				catch(Exception $e)
				{
					die('Erreur : '.$e->getMessage());
				}

                $Infos=$_SESSION['Infos'];
                $Adresse=InfosAdresse($bdd,$Infos['Adresse_Id']);

				?>

				<p>Nom de famille :
					<span class="user_info">
						<?= $Infos['NomDeFamille']; ?>
					</span>
				</p>
				<p>Nom d'usage :
					<span class="user_info">
						<?= $Infos['NomDUsage']; ?>
					</span>
				</p>
				<p>Prénoms :
					<span class="user_info">
						<?= $Infos['Prenom1'] .', '. $Infos['Prenom2'] .', '. $Infos['Prenom3'] ?>
					</span>
				</p>
				<p>Né(e) le :
					<span class="user_info">
						<?= $Infos['DateNaissance'] ?>	
					</span>
				</p>
				<p>NIR :
					<span class="user_info">
						<?= $NIR = $Infos['NIR']; ?>
					</span>
				</p>
				<p>Adresse :
					<span class="user_info">
						<?= $Adresse['NumeroRue'] .' '. $Adresse['Rue'] .', '. $Adresse['CodePostal'] .' '. $Adresse['Ville'] .', '. $Adresse['Region'] .', '. $Adresse['Pays']?>
					</span>
				</p>
				<p>Téléphone portable :
					<span class="user_info">
						<?= $Infos['Portable']; ?>
					</span>
				</p>
				<p>Courriel :
					<span class="user_info">
						<?= $Infos['Courriel'] ?>
					</span>
				</p>
			</div>
			<p class="bottom">Un renseignement incorrect ? Signalez-le <a href="InformationIncorrecte.php">ici</a> à un administrateur.</p>
		</section>
	</div>
	
</body>
</html>