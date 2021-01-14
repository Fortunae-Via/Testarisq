<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des utilisateurs</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
</head>

<body>

	<!-- Header -->
    <?php include("vues/Header.php"); ?>

	<div class="div_page">

		<div id="ajout" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
				<h3>Ajouter un utilisateur</h3>
				<img id="fleche1" class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand"/>
			</button>

			<div id="dropdown1" class="dropdown-content" style="display: block;">
				<?php require 'vues/BlocAjout.php'; ?>
			</div>
		</div>

		<div id="recherche" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
				<h3>Rechercher un utilisateur</h3>
				<img id="fleche2" class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
			</button>
			<div id="dropdown2" class="dropdown-content" style="display: block;">
				<?php include("RechercheUtilisateur.php"); ?>

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>

</body>
</html>