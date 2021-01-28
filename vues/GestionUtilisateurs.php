<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des utilisateurs</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
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

		<?php 
			if (isset($_SESSION['MessageModifsUtilisateur'])) {
				echo ("<h4>".$_SESSION['MessageModifsUtilisateur']."</h4>");
			}
			if(isset($_SESSION['MessageErreur'])){
				echo ("<h4>".$_SESSION['MessageErreur']."</h4>");
			}
		?>

		<div id="ajout" class="bloc ajout">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
				<h3>Ajouter un utilisateur</h3>
				<?php 
					if ($Mode==1) {
						echo("<img id=\"fleche1\" class=\"fleche_expand_down\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
						
					}
					else {
						echo("<img id=\"fleche1\" class=\"fleche_expand\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
				?>
			</button>

			<?php 
				if ($Mode==1) {
					echo("<div id=\"dropdown1\" class=\"dropdown-content\" style=\"display: block;\">");
				}
				else {
					echo("<div id=\"dropdown1\" class=\"dropdown-content\" style=\"display: none;\">");
				}
				
				require 'vues/BlocAjout.php'; 
			?>
			</div>
		</div>

		<div id="ajout-compte-pro" class="bloc ajout">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
				<h3>Ajouter un compte professionnel à un utilisateur existant</h3>
				<?php 
					if ($Mode==2) {
						echo("<img id=\"fleche2\" class=\"fleche_expand_down\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
					else {
						echo("<img id=\"fleche2\" class=\"fleche_expand\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
				?>
			</button>
			<?php 
				if ($Mode==2) {
					echo("<div id=\"dropdown2\" class=\"dropdown-content\" style=\"display: block;\">");
				}
				else {
					echo("<div id=\"dropdown2\" class=\"dropdown-content\" style=\"display: none;\">");
				}
				
				require 'vues/BlocAjoutCompte.php' ; 
			?>
			</div>

		</div>

		<div id="recherche" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown3'); BasculerClasse('fleche3','fleche_expand','fleche_expand_down') ">
				<h3>Rechercher un utilisateur</h3>
				<?php 
					if ($Mode==3) {
						echo("<img id=\"fleche3\" class=\"fleche_expand_down\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
					else {
						echo("<img id=\"fleche3\" class=\"fleche_expand\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
				?>
			</button>
			<?php 
				if ($Mode==3) {
					echo("<div id=\"dropdown3\" class=\"dropdown-content\" style=\"display: block;\">");
				}
				else {
					echo("<div id=\"dropdown3\" class=\"dropdown-content\" style=\"display: none;\">");
				}
			?>
				<form method="post" action="GestionUtilisateurs">
			<?php
				require 'vues/BlocRecherche.php';

				if ($PageMaximum > 1) {
					echo ('<div class="nav_pages">');
					    AffichageNavigationPages ('GestionUtilisateurs', $PageAffichage, $PageMaximum, $ChampRecherche, $lienSQLFiltres);
					echo('</div>');
				}
				?>
			</div>

		</div>
	</div>

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>
	<script type="text/javascript" src="js/AjoutUtilisateur.js"></script>
	<script type="text/javascript" src="js/AjoutCompte.js"></script>

</body>
</html>