<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Recherche d'un utilisateur</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/RechercheUtilisateur.css" />
    <link rel="stylesheet" href="style/BlocRecherche.css" />
    <?php
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/Safari/i',$u_agent)) {
    	echo '<link rel="stylesheet" href="style/GestionUtilisateursSafari.css"/>';
	} 
	?>
</head>

<body>

	<!-- Header -->
    <?php include("vues/Header.php"); ?>

	<div class="div_page">

		<header>
            <h2>Rechercher un utilisateur :</h2>
        </header>

		<div id="recherche" class="bloc">
			<form method="post" action="RechercheUtilisateur">
			<?php include("vues/BlocRecherche.php"); 

			if ($PageMaximum > 1) {
				echo ('<div class="nav_pages">');
				    AffichageNavigationPages ('RechercheUtilisateur', $PageAffichage, $PageMaximum, $ChampRecherche, $lienSQLFiltres);
				echo('</div>');
			}
			?>
		</div>
	</div>

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>

</body>
</html>