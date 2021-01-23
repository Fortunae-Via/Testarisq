<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil');
}

?>

<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Test de contrôle</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/TestControle.css" />
</head>

<body>

	<!-- Header -->
	<?php include("vues/Header.php"); ?>
	
	<div class="div_page">

		<header>
            <h2>Lancer un test de contrôle :</h2>
        </header>

		<!-- Panneau pour lancer le test -->
		<div class="test" id="bloctest"> 

			<?php
                if (isset($_SESSION['ErreurLancementTest'])) {
                	$affichage = '<h3>' . $_SESSION['ErreurLancementTest'] . '</h3>';
            		echo $affichage;
                }
            ?>

			<form method="post" action="controleurs/NouveauTest.php"> 
				<div class="champ">
					<label for="NIRConducteur">NIR du conducteur :</label><br>
					<input type="text" id="NIRConducteur" name="NIRConducteur" required><br>
					<label for="IdBoitier">Numéro du boîtier test :</label><br>
					<input type="text" id="IdBoitier" name="IdBoitier" required><br>
					<input type="hidden" name="LatitudeTest" id="LatitudeTest" value=""/>
					<input type="hidden" name="LongitudeTest" id="LongitudeTest" value=""/>
				</div>
				<div class="bouton">
					<input type="submit" value="Démarrer le test"><br>
				</div>
			</form>

		</div>			

	</div>

</body>

</html>