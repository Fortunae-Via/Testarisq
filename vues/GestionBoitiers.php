<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des boitiers</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionBoitiers.css" />
    <?php
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/Safari/i',$u_agent)) {
    	echo '<link rel="stylesheet" href="style/GestionUtilisateursSafari.css"/>';
	} 
	?>
    <link rel="stylesheet" href="style/BlocRecherche.css" />
</head>

<body>

	<!-- Header -->
    <?php include("vues/Header.php"); ?>

	<div class="div_page">

		<div id="ajout" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
				<h3>Ajouter un boîtier</h3>
				<img id="fleche1" class="fleche_expand_right" src="vues/img/expand.png" alt="fleche_expand"/>
			</button>
		</div>

		<div id="recherche" class="bloc">
			<button class="bandeau">
				<h3>Rechercher un boitier</h3>
			</button>
			<div class="contenu">
				<?php require 'vues/BlocRechercheBoitiers.php'; ?>
			</div>
		</div>
	</div>

</body>
</html>